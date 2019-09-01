<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';

$name = $_POST['name'];
$year = $_POST['year'];
$trimester = $_POST['trimester'];
$cubicle = $_POST['cubicle'] ?: null;
$group_id = $_GET['group_id'];

$sth = $pdo->prepare("
    UPDATE `groups` 
    SET `name` = :name, 
        `year_id` = :year, 
        `cubicle_id` = :cubicle, 
        `trimester_id` = :trimester
    WHERE `id` = :group_id
;");
$sth->bindValue(':name', $name, PDO::PARAM_STR);
$sth->bindValue(':year', $year, PDO::PARAM_STR);
$sth->bindValue(':cubicle', $cubicle, PDO::PARAM_INT);
$sth->bindValue(':trimester', $trimester, PDO::PARAM_INT);
$sth->bindValue(':group_id', $group_id, PDO::PARAM_INT);
$sth->execute();

header('Location: /groep/index.php');