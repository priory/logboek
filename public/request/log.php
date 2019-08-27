<?php

switch ($_POST['method']) {
    case 'GET':
        $group = $_POST['groep'];
        $leerling = $_POST['leerling'];
        $id = $_POST['id'];

        $logs = ['id' => 1, 'content' => 'mock', 'date' => '2019-08-27 12:00:00'];

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

        echo true;

        break;
    case 'DELETE':
        $id = $_POST['id'];

        echo true;

        break;
}