<?php
$servername = "localhost";
$database = "datausers";
$username = "root";
$password = "dtb456";

$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
} catch (PDOException $error) {
    echo 'Connection error: ' . $error->getMessage();
}
/*
// Set the variables for admin
$nameusrs = array("admin", "adminadmin");

$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO uzivatel (username, password) VALUES (?, ?)");

if ($my_Insert_Statement->execute($nameusrs)) {
    echo "New record created successfully";
} else {
    echo "Unable to create record";
}*/