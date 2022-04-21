<?php
# Variabler för databasen
if(strcmp($_SERVER['SREVER_NAME'],"localhost") == 0){
    $host = "loclahost";
    $user = "root";
    $pwd = "root";
    $db = "gyar_db";
} else{
    $host = "server1.serverdrift.com";
    $user = "alstromh_030520sk";
    $pwd = "C5([61gI(.b4";
    $db = "alstromh_030520sk";
}
# dsn - data source name
$dsn = "mysql:host=$host;dbname=$db";

# Inställningar som körs när objektet skapas
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
    PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_EMULATE_PREPARES, false
);

# Skapa objektet eller kasta ett fel
try{
    $pdo = new PDO($dsn, $user, $pwd, $options);
}
catch(Exception $e){
    die('Could not connect to the database:<br/>'.$e);
}

?>