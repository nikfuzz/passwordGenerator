<?php

$servername="localhost";
$username="";//enter the username for your local host
$pass="";//enter the password for your local host
$dbname="";
$con =new mysqli($servername,$username,$pass,$dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

//database
$sql="CREATE DATABASE ";//Enter a database name after "DATABASE" 

$result=mysqli_query($con, $sql);
if($result)
{
    echo "Updated!";
}
else{
    die(mysqli_error($con));
}
$dbname="";//enter the name of the database within quotes
$con =new mysqli($servername,$username,$pass,$dbname);
$sql_table="CREATE TABLE Pass( id integer primary key NOT NULL AUTO_INCREMENT, passwords text)";//enter table name after "TABLE"
$result_table=mysqli_query($con, $sql_table);
if($result_table)
{
    echo "<br>"."Table has been created!";
}
else{
    die(mysqli_error($con));
}