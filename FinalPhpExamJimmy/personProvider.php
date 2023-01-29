<?php
include_once 'dbConfig.php';
include_once 'Person.class.php';


$connection = new PDO("mysql:host=localhost;dbname=dbphpexam", 'root', '');

$person = new Person();
$person->DisplayByProvider($connection);