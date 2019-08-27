<?php
switch ($_POST['method']) {
    case 'GET':
        $group = $_POST['groep'];
        $leerling = $_POST['leerling'];
        $id = $_POST['id'];

        break;
    case 'STORE':
        $id = $_POST['id'];
        $content = $_POST['content'];

        break;
    case 'UPDATE':
        $id = $_POST['id'];
        $content = $_POST['content'];

        break;
    case 'DELETE':
        $id = $_POST['id'];
        
        break;
}