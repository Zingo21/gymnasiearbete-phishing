<?php 
$host = "localhost";
$user = "root";
$pwd = "root"; #MacBook
// $pwd = ""; #Windows
$db = "gyar";

#dsn - data source name
$dsn = "mysql:host=".$host.";dbname=".$db;

#Inställningar som körs när objektet startas
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
    PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES, false);

#skapa objekt eller ge error
try {
    $pdo = new PDO($dsn, $user, $pwd, $options);
}
catch(Exception $e) {
    die('Could not connect to the database <br/>'.$e);
}


