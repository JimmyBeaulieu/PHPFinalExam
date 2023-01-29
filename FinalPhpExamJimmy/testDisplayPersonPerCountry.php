<?php
include_once 'dbConfig.php';
include_once 'Person.class.php';

if(isset($_GET["Country"])){
    $connection = new PDO("mysql:host=localhost;dbname=dbphpexam", 'root', '');
    $person = new Person();
    $result = $person->getPersonByCountry($connection, $_GET["Country"]);
    $person->getHeader();
    $counter = 0;
    foreach ($result as $row=>$info){
        $person->Display($connection, $info[0]);
        $counter += 1;
    }
    $person->getFooter();
    echo "Total number is: $counter";
}

?>
<html>
    <body>
        <form action="#" method="get">
            <table>
                  <select name="Country" id="countries">
                  <option value="Canada">Canada</option>
                  <option value="Algeria">Algeria</option>
                  <option value="India">India</option>
                  <option value="France">France</option>
                  <option value="England">England</option>
                </select>
            </table>
            <button type="submit">Display</button>
        </form>
    </body>
</html>