<?php
session_start();
require_once('database_connection.php');
$fooled = 0;

$sign = $_COOKIE['sign'];
//starta om allas fooled till 0
for($id = 1; $id <1001; $id++){
    $sql = "UPDATE $sign SET fooled=:fooled WHERE id=:id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(array('fooled' => $fooled,'id' => $id));
}

//töm alla session variabler
session_unset();

//skicka användaren till startsidan
header('location: fooling.php');
