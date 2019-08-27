<?php

session_start();

$root = __DIR__ . '\..\\';

require_once $root . 'app\\pdo.php';

$user = $_POST['user'];
$password = $_POST['password'];

$sth = $pdo->prepare("SELECT `user_ID`, `user`, `wachtwoord` FROM `users` WHERE `user` = :user;");
$sth->bindValue(':user', $user, PDO::PARAM_STR);
$sth->execute();

$result = $sth->fetchAll(PDO::FETCH_ASSOC);

// Incorrect user
if (count($result) == 0) {
    $_SESSION['errors'] = ['Deze gebruiker bestaat niet'];
    header('Location: index.php'); die;
}

// Incorrect password
if ($result[0]['wachtwoord'] != $password) {
    $_SESSION['errors'] = ['Ongeldige wachtwoord'];
    header('Location: index.php'); die;
}

$_SESSION['user'] = $result[0]['user_ID'];

header('Location: kaart.php');