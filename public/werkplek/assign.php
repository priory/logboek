<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';

$cubicle = $_GET['cubicle'];
$group = $_GET['group'] ?: null;

$sth = $pdo->prepare("UPDATE `cubicles` SET `group_id` = null WHERE `group_id` = :group;");
$sth->bindValue(':group', $group, PDO::PARAM_INT);
$sth->execute();

$sth = $pdo->prepare("UPDATE `cubicles` SET `group_id` = :group WHERE `id` = :cubicle;");
$sth->bindValue(':group', $group, PDO::PARAM_INT);
$sth->bindValue(':cubicle', $cubicle, PDO::PARAM_INT);
$sth->execute();

$sth = $pdo->prepare("UPDATE `groups` SET `cubicle_id` = :cubicle WHERE `id` = :group;");
$sth->bindValue(':group', $group, PDO::PARAM_INT);
$sth->bindValue(':cubicle', $cubicle, PDO::PARAM_INT);
$sth->execute();

header('Location: /werkplek');