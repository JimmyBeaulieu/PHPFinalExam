<?php

class Person {
    
    private $id;
    private $name;
    private $city;
    private $country;
    private $phone;
    private $email;
    
    function __construct($id=null,$name=null,$city=null,$country=null,$phone=null,$email=null){
        
        $this->id=$id;
        $this->name=$name;
        $this->city=$city;
        $this->country=$country;
        $this->phone=$phone;
        $this->email=$email;
    }
    
    public function getId(){
        return $this->id;
        
    }
    
    public function getName(){
        return $this->name;
        
    }
    
    public function getCity(){
        return $this->city;
        
    }
    
    public function getCountry(){
        return $this->country;
        
    }
    
    public function getPhone(){
        return $this->phone;
        
    }
    public function getEmail(){
        return $this->email;
        
    }
    public function setId($id){
        
        $this->id = $id;
    }
    
    public function setName($name){
        
        $this->name = $name;
    }
    
    public function setPhone($phone){
        $this->phone = $phone;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setCity($city){
        $this->city = $city;
    }
    
    public function setCountry($country){
        $this->country = $country;
    }
    
    function __toString()
    {
        return "ID:$this->id - Name:$this->name - City:$this->city - Country:$this->country - Phone:$this->phone - Email:$this->email </br>";
    }
    
    function create($connection)
    {
        $id = $this->id;
        $name = $this->name;
        $city = $this->city;
        $country = $this->country;
        $phone = $this->phone;
        $email = $this->email;
        $query = "insert into person values($id, '$name', '$city', '$country', '$phone', '$email')";
        
        return $connection->exec($query);
    }
    
    
    function update($connection, $newEmail, $id)
    {
        $query = "update person set email = '$newEmail' where id = $id";   
        return $connection->exec($query);     
    }
    
    
    
    function getPersonById($connection, $id)
    {
        $query = $connection->prepare("select * from person where id = '$id'");
        
        $query->execute();
        $result = $query->fetchAll();
        
        return new Person($result[0][0], $result[0][1], $result[0][2], $result[0][3], $result[0][4], $result[0][5]);

        }
    
    
    function getPersonByCountry($connection, $country)
    {
        $query = $connection->prepare("select * from person where country = '$country'");
        
        $query->execute();
        return $query->fetchAll();        
    }    
    
    function getHeader(){
        echo "<table border=1>
        <tr>
        <td>Person Id</td>
        <td>Name</td>
        <td>City</td>
        <td>Country</td>
        <td>Phone</td>
        <td>Email</td>
        </tr>";
    }
    
    function getFooter(){
        echo "</table>";
    }
    
    function Display($connection, $id){
        $query = $connection->prepare("select * from person where id = '$id'");        
        $query->execute();
        $info = $query->fetchAll(); 
        echo"
    <tr>
        <td>".$info[0][0]."</td>
        <td>".$info[0][1]."</td>
        <td>".$info[0][2]."</td>
        <td>".$info[0][3]."</td>
        <td>".$info[0][4]."</td>
        <td>".$info[0][5]."</td>
    </tr>";
    }
    
    function DisplayByProvider($connection){
        $query = $connection->prepare("select * from person");
        $query->execute();
        $info = $query->fetchAll();
        $counter = 0;
        $yahooca = 0;
        $hotmailca=0;
        $hotmailcom = 0;
        $gmailcom = 0;
        $videotronca = 0;
        
        for($i = 0; $i < count($info); $i++){
            $provider = explode("@", $info[$i][5]);
            if($provider[1] == "yahoo.ca"){
                $yahooca++;
            }
            if($provider[1] == "hotmail.ca"){
                $hotmailca++;
            }
            if($provider[1] == "hotmail.com"){
                $hotmailcom++;
            }
            if($provider[1] == "gmail.com"){
                $gmailcom++;
            }
            if($provider[1] == "videotron.ca"){
                $videotronca++;
            }
        }
            echo "
<table border = 1>
<tr>
    <td>Provider</td>
    <td>Total Account</td>
</tr>
<tr>
    <td>yahoo.ca</td>
    <td>$yahooca</td>
</tr>
<tr>
    <td>hotmail.ca</td>
    <td>$hotmailca</td>
</tr>
<tr>
    <td>hotmail.com</td>
    <td>$hotmailcom</td>
</tr>
<tr>
    <td>gmail.com</td>
    <td>$gmailcom</td>
</tr>
<tr>
    <td>videotron.ca</td>
    <td>$videotronca</td>
</tr>
";
        }
    }



?>