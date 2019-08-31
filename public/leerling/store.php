<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';

$name = $_POST['name'];
$surname = $_POST['surname'];
$cohort = $_POST['cohort'];
$level = $_POST['level'];
$group = $_POST['group'];

$sth = $pdo->prepare("
    INSERT INTO `students` (`name`, `surname`, `cohort_id`, `level_id`, `group_id`) 
    VALUES (:name, :surname, :cohort, :level, :group)
;");
$sth->bindValue(':name', $name, PDO::PARAM_STR);
$sth->bindValue(':surname', $surname, PDO::PARAM_STR);
$sth->bindValue(':cohort', $cohort, PDO::PARAM_INT);
$sth->bindValue(':level', $level, PDO::PARAM_INT);
$sth->bindValue(':group', $group, PDO::PARAM_INT);

$sth->execute();

header("Location: /leerling");