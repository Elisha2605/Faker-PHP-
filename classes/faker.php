<?php


class Faker
{
    private string $first_name;
    private string $last_name;
    private string $gender;
    private string $CPR;
    private $dateOfBirth;
    private string $address;
    private string $phone;

    /**
     * Methods
     */
    public function getCPR(): string
    {
        /** Return fake CPR */
        require __DIR__ . '/../src/fetch_data.php';

        $timestamp = mt_rand(1, time());
        $randomDate = date("dmy", $timestamp);

        $even = rand(0, 9) & ~1;
        $odd = rand(0, 9) | 1;

        $random_cpr = $randomDate . "-" . rand(111, 999);
        $default_CPR = $random_cpr;

        $this->CPR = $random_cpr;
        $this->dateOfBirth = $randomDate;

        $key = array_rand($persons);
        $value = $persons[$key];
        if (empty($this->gender)) {
            if ($value['gender'] == 'female') {
                return $default_CPR . $even;
            } else {
                return $default_CPR . $odd;
            }
        } else {
            if ($this->gender == 'female') {
                return $this->CPR . $even;
            } else {
                return $this->CPR . $odd;
            }
        }
    }
    public function getFullNameAndGender(): array
    {
        /** Return a fake name and Gender */
        $person = $this->randomPerson();

        $data = [
            "full_name" => $person['full_name'],
            "gender" => $person['gender'],
        ];

        return $data;
    }
    public function getCPR_FullNameAndGender(): array
    {
        /** Return fake CRP, full name and gender */
        $person = $this->randomPerson();

        $data = [
            "cpr" =>  $this->getCPR(),
            "full_name" => $person['full_name'],
            "gender" => $person['gender']
        ];

        return $data;
    }
    public function getCPR_FullNameAndGender_dateOfBirth(): array
    {
        /** Return fake CPR, full name, gender and date of birth */
        $person = $this->randomPerson();
        $cpr = $this->getCPR();
        $dateOfBirth = DateTime::createFromFormat('dmy', $this->dateOfBirth);
        $date = $dateOfBirth->format('d/m/y');

        $data = [
            "cpr" => $cpr,
            "full_name" => $person['full_name'],
            "gender" => $person['gender'],
            "birth" => $date
        ];

        return $data;
    }
    public function getAddress(): string
    {
        /** Return fake address */
        require __DIR__ . '/../src/fetch_data.php';

        $random_floor_num = array('', $this->generateRandomString(1));
        $random_floor_array = array('st.', rand(1, 999));

        $random_door_op1 = $this->generateRandomString(1) . rand(1, 9);
        $random_door_op2 = $this->generateRandomString(1) . '-' . rand(1, 999);
        $random_door_array = array($random_door_op1, $random_door_op2);
        $random_door_directions = array('th', 'mf', 'tv');


        $street = ucfirst(strtolower($this->generateRandomString(15)));
        $house_num = rand(1, 999);
        $appartement_num = strtoupper($random_floor_num[array_rand($random_floor_num)]);
        $floor_num = $random_floor_array[array_rand($random_floor_array)];
        $door = $random_door_directions[array_rand($random_door_directions)];
        $door_option1 = $door . ". " . rand(1, 50);
        $door_option2 = $random_door_array[array_rand($random_door_array)];

        $door_options_array = array($door_option1, $door_option2);
        $door_num = $door_options_array[array_rand($door_options_array)];


        $key = array_rand($postal_codes_and_town);
        $post_and_town = $postal_codes_and_town[$key];

        $this->address = $street . " " . 
                $house_num . $appartement_num . ", " . 
                $floor_num . ", " . $door_num . ", " . 
                $post_and_town['postal_code'] . " " . 
                $post_and_town['town_name'];

        return $this->address;
    }
    public function getPhone(): string
    {
        /** Return fake phone number */
        require __DIR__ . '/../src/fetch_data.php';

        $random_phone_digits = $phone_starting_digits[array_rand($phone_starting_digits)];

        if (strlen($random_phone_digits) == 1) {
            $random_num = mt_rand(1111111, 9999999);
            $this->phone = $random_phone_digits . $random_num;
            return $this->phone;
        } elseif (strlen($random_phone_digits) == 2) {
            $random_num = mt_rand(111111, 999999);
            $this->phone = $random_phone_digits . $random_num;
            return $this->phone;
        } elseif (strlen($random_phone_digits) == 3) {
            $random_num = mt_rand(11111, 99999);
            $this->phone = $random_phone_digits . $random_num;
            return $this->phone;
        } elseif (strlen($random_phone_digits) == 7) {
            $random_num = mt_rand(11, 99);
            $this->phone = $random_phone_digits . $random_num;
            return $this->phone;
        }
    }
    public function getAllInfo(): array
    {
        $person = $this->getCPR_FullNameAndGender_dateOfBirth();
        $address = $this->getAddress();
        $phone = $this->getPhone();

        $data = [
            "cpr" => $person['cpr'],
            "full_name" => $person['full_name'],
            "gender" => $person['gender'],
            "birth" => $person['birth'],
            "address" => $address,
            "phone" => $phone
        ];
        return $data;
    }
    public function getAllInfoBuilk(): array
    {
        /** Return fake person information in bulk (all information for 2 to 100 persons) */
        require __DIR__ . '/../src/fetch_data.php';

        $data = array();
        for ($i=0; $i < rand(2, 100); $i++) { 
            $data[] = $this->getAllInfo();
        }
        return $data; 
    }
    /** Helper methods */
    function randomPerson() {
        require __DIR__ . '/../src/fetch_data.php';

        $key = array_rand($persons);
        $value = $persons[$key];

        $this->first_name = $value['name'];
        $this->last_name = $value['surname'];
        $this->gender = $value['gender'];

        $person = [
            "full_name" => $this->first_name . $this->last_name,
            "gender" => $this->gender
        ];

        return $person;
    }
    function generateRandomString($length = 25)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}


