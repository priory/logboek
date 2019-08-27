<?php 
    $servername = 'localhost';
    $username = 'admin';
    $password = 'admin';
    $database_name = 'logboek_appl';
    $conn = new mysqli($servername, $username, $password, $database_name);
    if (!$conn) {
        echo('Could not connect: ' . mysql_error());
    }
?>