<?php

$root = __DIR__ . '\..\\..\\';

require_once $root . 'app\\pdo.php';
require_once $root . 'app\\authorize.php';

switch ($_POST['method']) {
    case 'GET':
        if(!isset($_POST['groep'])) {
            $leerling = $_POST['leerling'];
            $sth = $pdo->prepare("SELECT * FROM `logs` WHERE voor_leerling = :leerling;");
            $sth->bindValue(':leerling', $leerling, PDO::PARAM_STR);
        } else {
            $groep = $_POST['groep'];
            $sth = $pdo->prepare("SELECT * FROM `logs` WHERE voor_groep = :groep;");
            $sth->bindValue(':groep', $groep, PDO::PARAM_STR);
        }

        
        $sth->execute();
        

        $logs = [];
        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            
            $logs[] = ['id' => $row['logs_ID'],'content' => $row['bericht'], 'date' => $row['datum']];
            
            
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

        $sth = $pdo->prepare("UPDATE `logs` SET `bericht` = :content WHERE logs_ID = :id;");
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->bindValue(':content', $content, PDO::PARAM_STR);
        $sth->execute();
        echo true;

        break;
    case 'DELETE':
        $id = $_POST['id'];

        echo $id; die;
        
        $sth = $pdo->prepare("DELETE FROM `logs` WHERE logs_ID = :id");
        $sth->bindValue(':id', $id, PDO::PARAM_STR);

        if($sth->execute()) {
            echo $id;
        }

        break;
    case 'INSERT':
        $content = $_POST['content'] ?? null;
        $leerling = $_POST['leerling'] ?? null;
        $groep = $_POST['groep'] ?? null;

        $sth = $pdo->prepare("INSERT INTO `logs`(`bericht`, `datum`, `user_id`, `voor_leerling`, `voor_groep`) VALUES (:content, NOW(), :session_user, :leerling, :groep);");  
        $sth->bindValue(':session_user', (int) $_SESSION['user'], PDO::PARAM_INT);
        $sth->bindValue(':content', $content, PDO::PARAM_STR);
        $sth->bindValue(':leerling', (int) $leerling ?: null, PDO::PARAM_INT);
        $sth->bindValue(':groep', (int) $groep ?: null, PDO::PARAM_INT);
        $sth->execute();

        $log_id = $pdo->query("SELECT MAX(`logs_ID`) as 'logs_ID' FROM `logs`;")->fetch(PDO::FETCH_ASSOC)['logs_ID'];

        $sth = $pdo->prepare("SELECT `logs_ID` as 'id', `bericht` as 'content', `datum` as 'date' FROM `logs` WHERE `logs_ID` = :id");
        $sth->bindValue(':id', (int) $log_id, PDO::PARAM_INT);
        $sth->execute();

        $log = $sth->fetch(PDO::FETCH_ASSOC);

        echo json_encode($log);
		
		break;
}
?>
