<?php
require_once('database_connection.php');
session_start();
$fooled = 0;

for($id = 1; $id <1001; $id++){
    $sql = "UPDATE MOCK_DATA SET fooled=:fooled WHERE id=:id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(array('fooled' => $fooled,'id' => $id));
}

session_unset();

header('location: fooling.php');


