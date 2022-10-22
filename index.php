<?php

require ('classes/faker.php');

$p = new Faker();


$person = $p->getCPR_FullNameAndGender_dateOfBirth();

$cpr = $person['cpr'];
echo $cpr;