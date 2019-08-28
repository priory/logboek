<?php
session_start();

$root = __DIR__ . '\..\\';

require_once $root . 'app\\guest.php';

unset($_SESSION['user']);

header('Location: index.php');