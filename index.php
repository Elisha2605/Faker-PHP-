<?php

require ('classes/faker.php');

$p = new Faker();


$person = $p->getPhone();

echo "<pre>";
print_r($person);
echo "<pre>";