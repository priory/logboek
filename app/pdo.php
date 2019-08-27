<?php

$dbname = 'logboek_appl';
$username = 'root';
$passwd = 'qwe123';

$dsn = 'mysql:dbname=' . $dbname . ';host=localhost';

try {
    $pdo = new PDO($dsn, $username, $passwd);
} catch (PDOException $e) {
    echo 'Connection failed: '.$e->getMessage();
}