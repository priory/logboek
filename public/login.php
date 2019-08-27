<?php

session_start();

$root = __DIR__ . '\..\\';

$user = $_POST['user'];
$password = $_POST['password'];

// Incorrect user
if (! (true)) {
    $_SESSION['errors'] = ['Deze gebruiker bestaat niet'];
    header('Location: index.php'); die;
}

// Incorrect password
if (! (true)) {
    $_SESSION['errors'] = ['Ongeldige wachtwoord'];
    header('Location: index.php'); die;
}

header('Location: kaart.php');