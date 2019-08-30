<?php

$root = __DIR__ . '\..\\..\\';

require_once $root . 'app\\pdo.php';
require_once $root . 'app\\authorize.php';

switch ($_POST['method']) {
    case 'GET':
        if(!isset($_POST['leerling'])) {
            $groep = $_POST['groep'];
            $sth = $pdo->prepare("SELECT * FROM `logs` WHERE group_id = :groep AND student_id is NULL;");
            $sth->bindValue(':groep', $groep, PDO::PARAM_STR);
        } else {
            $leerling = $_POST['leerling'];
            $sth = $pdo->prepare("SELECT * FROM `logs` WHERE student_id = :leerling;");
            $sth->bindValue(':leerling', $leerling, PDO::PARAM_STR);
        }
        
        $sth->execute();

        $logs = [];
        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            
            $logs[] = ['id' => $row['id'],'content' => $row['content'], 'date' => $row['date']];
            
        }
        echo json_encode($logs);

        break;
    case 'STORE':
        $id = $_POST['id'];
        $content = $_POST['content'];

        echo true;

        break;
    case 'UPDATE':
        $id = $_POST['id'];
        $content = $_POST['content'];

        $sth = $pdo->prepare("UPDATE `logs` SET `content` = :content WHERE id = :id;");
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->bindValue(':content', $content, PDO::PARAM_STR);
        $sth->execute();
        echo true;

        break;
    case 'DELETE':
        $id = $_POST['id'];

        $sth = $pdo->prepare("DELETE FROM `logs` WHERE id = :id");
        $sth->bindValue(':id', $id, PDO::PARAM_STR);

        if($sth->execute()) {
            echo $id;
        }

        break;
    case 'INSERT':
        $content = $_POST['content'] ?? null;
        $leerling = $_POST['leerling'] ?? null;
        $groep = $_POST['groep'] ?? null;
        $sth = $pdo->prepare("INSERT INTO `logs` (`content`, `date`, `user_id`, `student_id`, `group_id`) VALUES (:content, NOW(), :session_user, :leerling, :groep)");  
        $sth->bindValue(':session_user', (int) $_SESSION['user'], PDO::PARAM_INT);
        $sth->bindValue(':content', $content, PDO::PARAM_STR);
        $sth->bindValue(':leerling', (int) $leerling ?: null, PDO::PARAM_INT);
        $sth->bindValue(':groep', (int) $groep ?: null, PDO::PARAM_INT);
        $sth->execute();

        $log_id = $pdo->query("SELECT MAX(`id`) as 'id' FROM `logs`;")->fetch(PDO::FETCH_ASSOC)['id'];

        $sth = $pdo->prepare("SELECT `id`, `content`, `date` FROM `logs` WHERE `id` = :id");
        $sth->bindValue(':id', (int) $log_id, PDO::PARAM_INT);
        $sth->execute();

        $log = $sth->fetch(PDO::FETCH_ASSOC);

        echo json_encode($log);
		break;
}
?>
