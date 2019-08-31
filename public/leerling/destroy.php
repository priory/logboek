<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';

$student = $_GET['student'];

$sth = $pdo->prerare("DELETE FROM `students` WHERE `id` = :student");
$sth->bindValue(':student', $student, PDO::PARAM_STR);
$sth->execute();

header('Location: /leerling');
?>