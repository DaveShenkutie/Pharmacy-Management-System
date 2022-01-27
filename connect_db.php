<?php

error_reporting (1);
// $con=mysql_pconnect('localhost:10080','root','')or die("cannot connect to server");
// mysql_select_db('pharmacy')or die("cannot connect to database");


$sn="localhost";
$un="root";
$pw="";
$db="pharmacy";
$dbs="mysql:host=$sn;dbname=$db";

try{
    $con= new PDO($dbs,$un,$pw);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEXCEPTION $e){
    echo "Connection failed because of: ".$e->getMessage();
    } 
   		
?>