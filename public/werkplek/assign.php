<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';

$cubicle = $_GET['cubicle'];
$group = $_GET['group'] ?: null;

$sth = $pdo->prepare("UPDATE `cubicles` SET `group_id` = :group WHERE `id` = :cubicle;");
$sth->bindValue(':group', $group, PDO::PARAM_INT);
$sth->bindValue(':cubicle', $cubicle, PDO::PARAM_INT);
$sth->execute();

header('Location: /werkplek');