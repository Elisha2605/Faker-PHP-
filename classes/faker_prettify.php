<?php


class FakerPrettify
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
    public function getCPR()
    {
        /** Return fake CPR */
        include __DIR__ . '/../src/fetch_data.php';
        $key = array_rand($persons);
        $value = $persons[$key];
        
        $timestamp = mt_rand(1, time());
        $randomDate = date("dmy", $timestamp);

        $even = rand(0, 9) & ~1;
        $odd = rand(0, 9) | 1;

        $CPR = $randomDate . "-" . rand(111, 999);

        $this->CPR = $randomDate . "-" . rand(111, 999);
        $this->dateOfBirth = $randomDate;

        if (empty($this->gender)) {
            if ($value['gender'] == 'female') {
                return "<b>CPR</b> : " . $CPR . $even . "<br>";
            } else {
                return "<b>CPR</b> : " . $CPR . $odd . "<br>";
            }
        } else {
            if ($this->gender == 'female') {
                return "<b>CPR</b> : " . $this->CPR . $even . "<br>";
            } else {
                return "<b>CPR</b> : " . $this->CPR . $odd . "<br>";
            }
        }
    }
    public function getFullNameAndGender()
    {
        /** Return a fake name and Gender */
        include __DIR__ . '/../src/fetch_data.php';

        $key = array_rand($persons);
        $value = $persons[$key];

        $this->first_name = $value['name'];
        $this->last_name = $value['surname'];
        $this->gender = $value['gender'];

        return <<<PERSON
        <b>Full name</b>: {$this->first_name} {$this->last_name}<br>
        <b>Gender</b>: {$this->gender} <br>
        PERSON;
    }
    public function getCPR_FullNameAndGender()
    {
        /** Return fake CRP, full name and gender */
        include __DIR__ . '/../src/fetch_data.php';

        $person = $this->getFullNameAndGender();
        $cpr = $this->getCPR();

        return $cpr . $person;
    }
    public function getCPR_FullNameAndGender_dateOfBirth()
    {
        /** Return fake CPR, full name, gender and date of birth */
        $person = $this->getFullNameAndGender();
        $cpr = $this->getCPR();
        $dateOfBirth = DateTime::createFromFormat('dmy', $this->dateOfBirth);
        $date = $dateOfBirth->format('d/m/y');

        return <<<PERSON
        {$cpr}
        {$person}
        <b>Date Of birth</b>: {$date} <br>
        PERSON;
    }
    public function getAddress()
    {
        /** Return fake address */
        include __DIR__ . '/../src/fetch_data.php';

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

        $this->address = $street . " " . $house_num . $appartement_num . ", " . $floor_num . ", " . $door_num . ", " . $post_and_town['postal_code'] . " " . $post_and_town['town_name'];

        return "<b>Address</b>: {$this->address} <br>";
    }
    public function getPhone()
    {
        /** Return fake phone number */
        include __DIR__ . '/../src/fetch_data.php';

        $random_phone_digits = $phone_starting_digits[array_rand($phone_starting_digits)];

        if (strlen($random_phone_digits) == 1) {
            $random_num = mt_rand(1111111, 9999999);
            $this->phone = $random_phone_digits . $random_num;
            return "<b>Phone</b>: {$this->phone} <br>";
        } elseif (strlen($random_phone_digits) == 2) {
            $random_num = mt_rand(111111, 999999);
            $this->phone = $random_phone_digits . $random_num;
            return "<b>Phone</b>: {$this->phone} <br>";
        } elseif (strlen($random_phone_digits) == 3) {
            $random_num = mt_rand(11111, 99999);
            $this->phone = $random_phone_digits . $random_num;
            return "<b>Phone</b>: {$this->phone} <br>";
        } elseif (strlen($random_phone_digits) == 7) {
            $random_num = mt_rand(11, 99);
            $this->phone = $random_phone_digits . $random_num;
            return "<b>Phone</b>: {$this->phone} <br>";
        }
    }
    public function getAllInfo()
    {
        /** Return
         * CPR
         * full name
         * gender
         * date of birth
         * address
         * mobile phone number
         */
        $personal_info = $this->getCPR_FullNameAndGender_dateOfBirth();
        $address = $this->getAddress();
        $phone = $this->getPhone();

        return <<<PERSON
        {$personal_info}
        {$address}
        {$phone} <br>
        PERSON;
    }
    public function getAllInfoBuilk()
    {
        /** Return fake person information in bulk (all information for 2 to 100 persons) */
        include __DIR__ . '/../src/fetch_data.php';

        $persons = " ";
        for ($i=0; $i < rand(2, 100); $i++) { 
            $persons .= $this->getAllInfo();
        }

        return $persons; 
    }
    /** Helper methods */
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

$person = new FakerPrettify();
echo $person->getAllInfoBuilk();


