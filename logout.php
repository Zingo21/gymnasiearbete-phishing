<?php
session_start();
session_unset();
session_destroy();

# Skicka vidare till index.php med meddelande
header('location: index.php?mess=Du har blivit utloggad.');
?>