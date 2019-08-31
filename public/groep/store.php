<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';
$name = $_POST['name'];
$year = $_POST['year'];
$trimester = $_POST['trimester'];
$cubicle = $_POST['cubicle'];
$sth = $pdo->prepare("
    INSERT INTO `groups` (`cubicle_id`, `year_id`, `trimester_id`, `name`) 
    VALUES (:cubicle, :year, :trimester, :name)
;");
$sth->bindValue(':cubicle', $cubicle ?: null, PDO::PARAM_INT);
$sth->bindValue(':year', $year, PDO::PARAM_INT);
$sth->bindValue(':trimester', $trimester, PDO::PARAM_INT);
$sth->bindValue(':name', $name, PDO::PARAM_STR);
$sth->execute();
header("Location: /groep");
echo "<script>alert('added');</script>";