<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';
$group_id = $_GET['group_id'];
$sth = $pdo->prepare("
    DELETE FROM `groups` WHERE `groups`.`id` = :group_id;)
;");
$sth->bindValue(':group_id', $group_id ?: null, PDO::PARAM_INT);
$sth->execute();
header("Location: /groep");
?>

<html>delete</html>