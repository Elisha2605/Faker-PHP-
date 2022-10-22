<?php
# person
$preson_names_json = file_get_contents("data/person-names.json");
$person_names = json_decode($preson_names_json, true);
$persons = $person_names['persons'];

# postal code
$postal_codes_json = file_get_contents("data/postal-codes.json");
$postal_codes_and_town = json_decode($postal_codes_json, true);

$phone_starting_digits = array('2', '30', '31', '40', '41', '42', '50', '51', '52', '53', '60', '61', '71', '81', '91', '92', 
                                '93', '342', '344-349', '356-357', '359', '362', '365-366', '389', '398', '431', 
                                '441', '462', '466', '468', '472', '474', '476', '478', '485-486', '488-489',  
                                '493-496', '498-499', '542-543',  '545',  '551-552', '556', '571-574', '577', 
                                '579', '584', '586-587', '589', '597-598', '627', '629', '641', '649', '658', '662-665', 
                                '667', '692-694', '697', '771-772', '782-783', '785-786', '788-789', '826-827','829'
                         );

// $random_phone_digits = $phone_starting_digits[array_rand($phone_starting_digits)];
   
// $random_num = " ";
// if (strlen($random_phone_digits) == 2) {
//     $random_num = mt_rand(111111, 999999);
//     $random_num = $random_phone_digits . $random_num;
//     echo $random_num;
// } elseif (strlen($random_phone_digits) == 3) {
//     $random_num = mt_rand(11111, 99999);
//     $random_num = $random_phone_digits . $random_num;
//     echo $random_num;
// } elseif (strlen($random_phone_digits) == 7) {
//     $random_num = mt_rand(11, 99);
//     $random_num = $random_phone_digits . $random_num;
//     echo $random_num;
// }