<?php
include_once 'dbConfig.php';
include_once 'Person.class.php';


$connection = new PDO("mysql:host=localhost;dbname=dbphpexam", 'root', '');

$person = new Person(10, "Richard", "Montreal", "Canada", "514-858-1344", "richard@videotron.ca");
/*
if($person->create($connection)){
    echo "A person was added successfully!";
}

if($person->update($connection, "meriam@gmail.com", 9)){
    echo "A person is updated successfully!";
}
*/?>
<html>
<body>
<?php 
$person->getHeader();
$person->Display($connection, 9);
$person->getFooter();
?>
</body>
</html>