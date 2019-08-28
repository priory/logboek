<?php
    $root = __DIR__ . '\..\\';

    require_once $root . 'app\authorize.php';
?>

<!DOCTYPE html>
<html>
	<head>
        <style>
            * {
                margin: 0;
                padding: 0;
            }

            #background {
                width: 1280px;
                height: 720px;
                background-color: lightgray;
                position: absolute;
                left: 0px;
                top: 0px;
            }

            .room {
                border: 5px solid black;
                position: relative;
            }
                .room#room-2-12 {
                    width: 150px;
                    height: 100px;
                    top: 5px;
                    left: 5px;
                }
        </style>
	</head>
	<body>
        <div id="background">
            <div id="room-2-12" class="room">
                2.12<br>Docentenkamer
            </div>
        </div>
	</body>
</html>