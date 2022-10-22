<?php

use PHPUnit\Framework\TestCase;
    
require ('classes/faker.php');


class FakerTest extends TestCase {
    
    public function testCPREqualToTenDigits(): void {
        $obj = new Faker();
        $cpr_with_dash = $obj->getCPR();
        $cpr_only_digits = str_replace('-', '', $cpr_with_dash);
        $cpr_length = strlen($cpr_only_digits);
        $expected = 10;
        $this->assertEquals($expected, $cpr_length);
    }
    public function testGetFulNameAndGenderElementsNumber(): void {
        $obj = new Faker();
        $number_of_lements = count($obj->getFullNameAndGender());
        $expected = 2;
        $this->assertEquals($expected, $number_of_lements);
    }
    public function testCPRFirstDigitsEqualsToDateOfBirth() {
        $obj = new Faker();
        $person = $obj->getCPR_FullNameAndGender_dateOfBirth();
        $cpr_with_dash = $person['cpr'];
        $cpr_only_first_digits = substr($cpr_with_dash, 0, -5);
        $birth_day_with_slash = $person['birth'];
        $birth_only_digits = str_replace('/', '', $birth_day_with_slash);        
        $this->assertEquals($cpr_only_first_digits, $birth_only_digits);
    }
}