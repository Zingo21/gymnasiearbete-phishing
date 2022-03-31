<?php
# Öppnar sessionen
session_start();
# Läser in databasuppkopplingen
require_once('database_connection.php');


# Hämta username och password från formuläret
$username = trim($_POST['username']);
$password = sha1(trim($_POST['password']));


# Gör anropet till databasen
$sql = "SELECT * FROM user_v2 WHERE username = :username AND password = :password AND active = 1";
$stm = $pdo->prepare($sql);
$stm->execute(array('username' => $username, 'password' => $password));
$res = $stm->fetch(PDO::FETCH_ASSOC); # fetch() eftersom vi bara får ett svar


# Om det hittades en post i databasen med rätt användarnamn och lösenord
if(isset($res['userId'])){
    $_SESSION['username'] = $username;
    header('location: admin.php');
} else {
    header('location: index.php?mess=Du har angivit felaktiga inloggningsuppgifter.');
}

?>