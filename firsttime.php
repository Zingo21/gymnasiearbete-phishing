<?php
session_start();
require_once('database_connection.php');

$cookie_name = "sign";
$cookie_value = $s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 6);;
setcookie($cookie_name, $cookie_value, time() + (86400 * 7), "/"); // 86400 = 1 day

echo $_COOKIE['sign'];

$tableName = $cookie_value;

$query = "CREATE TABLE $tableName AS SELECT * FROM MOCK_DATA;";
$stmt = $pdo->prepare($query);
$stmt->execute();

$signature = $cookie_value;
$sql = "INSERT INTO signature(signature) VALUES(:signature);";
$stm = $pdo->prepare($sql);
$stm->execute(array(':signature' => $signature));

header("location:index.php");