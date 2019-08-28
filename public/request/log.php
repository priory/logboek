<?php

$root = __DIR__ . '\..\\..\\';

require_once $root . 'app\\pdo.php';

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

        $query = "UPDATE `logs` SET `bericht` = '$content' WHERE logs_ID = $id";
        $result = $pdo->query($query);
        echo true;

        break;
    case 'DELETE':
        $id = $_POST['id'];
        
        $query = "DELETE FROM `logs` WHERE logs_ID = $id";
        $result = $pdo->query($query);
        if($result) {
            echo $id;
        }
        break;
}
?>
