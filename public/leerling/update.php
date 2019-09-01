<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';

$student = $_GET['student'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$group = $_POST['group'] ?: null;
$level = $_POST['level'];
$cohort = $_POST['cohort'];

$sth = $pdo->prepare("
    UPDATE `students` 
    SET `name` = :name, 
        `surname` = :surname, 
        `group_id` = :group, 
        `cohort_id` = :cohort, 
        `level_id` = :level 
    WHERE `id` = :student
;");
$sth->bindValue(':name', $name, PDO::PARAM_STR);
$sth->bindValue(':surname', $surname, PDO::PARAM_STR);
$sth->bindValue(':group', $group, PDO::PARAM_INT);
$sth->bindValue(':cohort', $cohort, PDO::PARAM_INT);
$sth->bindValue(':level', $level, PDO::PARAM_INT);
$sth->bindValue(':student', $student, PDO::PARAM_INT);
$sth->execute();

header('Location: /leerling.php?leerling=' . $_GET['student']);