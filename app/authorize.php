<?php

session_start();

$root = __DIR__ . '\..\\';

if (! (isset($_SESSION['user']))) {
    header('Location: index.php'); die;
}