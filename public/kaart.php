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
                box-sizing: border-box;
            }

            h4 {
                text-align: center;
                vertical-align: middle;
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
                position: absolute;
            }
            .room:hover {
                background-color: white;
            }
                .room#room-2-12 {
                    width: 200px;
                    height: 300px;
                    top: 5px;
                    left: 5px;
                }
                .room#room-2-16 {
                    width: 300px;
                    height: 250px;
                    top: 5px;
                    right: 105px;
                }
                .room#room-2-17 {
                    width: 105px;
                    height: 250px;
                    top: 5px;
                    right: 5px;
                }
                .room#room-2-08 {
                    width: 250px;
                    height: 250px;
                    bottom: 5px;
                    left: 5px;
                }
                .room#room-2-07 {
                    width: 350px;
                    height: 400px;
                    bottom: 5px;
                    left: 250px;
                }
                .room#room-2-06 {
                    width: 350px;
                    height: 400px;
                    bottom: 5px;
                    left: calc(250px + 350px - 5px);
                }
                .room#room-2-05 {
                    width: 335px;
                    height: 400px;
                    bottom: 5px;
                    left: calc(250px + 350px + 350px - 10px);
                }
        </style>
	</head>
	<body>
        <div id="background">
            <div id="room-2-12" class="room">
                <h4>2.12</h4>
                <h4>Docentenkamer</h4>
            </div>
            <div id="room-2-16" class="room">
                <h4>2.16</h4>
                <h4>Boardroom</h4>
            </div>
            <div id="room-2-17" class="room">
                <h4>2.17</h4>
                <h4>Spreekkamer</h4>
            </div>
            <div id="room-2-08" class="room">
                <h4>2.08</h4>
                <h4>Theorielokaal</h4>
            </div>
            <div id="room-2-07" class="room">
                <h4>2.07</h4>
                <h4>Werkplekken</h4>
            </div>
            <div id="room-2-06" class="room">
                <h4>2.06</h4>
                <h4>Werkplekken</h4>
            </div>
            <div id="room-2-05" class="room">
                <h4>2.05</h4>
                <h4>Werkplekken</h4>
            </div>
        </div>
	</body>
</html>