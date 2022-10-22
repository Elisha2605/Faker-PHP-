<?php

require ('classes/faker.php');

$p = new Faker();


$person = $p->getCPR_FullNameAndGender_dateOfBirth();

$cpr = $person['cpr'];
echo substr($cpr, 0, -5);
// $pers = json_decode($person);
// echo $pers->cpr;