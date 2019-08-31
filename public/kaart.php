<?php
    $root = __DIR__ . '\..\\';

    require_once $root . 'app\authorize.php';
?>

<!DOCTYPE html>
<html>
	<head>
        <?php          
            require_once $root . 'resources\\layouts\\head.php';
        ?>

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            #map-container {
                width: 100%; 
                height: 720px; 
                overflow-x: scroll;
            }

            #background {
                width: 1280px;
                height: 720px;
                background-color: lightgray;
                position: relative;
            }

            .room, .cubicle {
                text-align: center;
                word-wrap: break-word;
                overflow-wrap: break-word;
                hyphens: auto;
            }

            .room {
                border: 5px solid black;
                position: absolute;
            }
                .room#room-2-12 {
                    width: 200px; height: 300px; top: 5px; left: 5px;
                }
                .room#room-2-16 {
                    width: 300px; height: 250px; top: 5px; right: 105px;
                }
                .room#room-2-17 {
                    width: 105px; height: 250px; top: 5px; right: 5px;
                }
                .room#room-2-08 {
                    width: 250px; height: 250px; bottom: 5px; left: 5px;
                }
                .room#room-2-07 {
                    width: 350px; height: 400px; bottom: 5px; left: 250px;
                }
                .room#room-2-06 {
                    width: 350px; height: 400px; bottom: 5px; left: calc(250px + 350px - 5px);
                }
                .room#room-2-05 {
                    width: 335px; height: 400px; bottom: 5px; left: calc(250px + 350px + 350px - 10px);
                }

            .cubicle {
                border: 5px solid brown;
                position: absolute;
                color: brown;
            }
                .cubicle:hover {
                    background-color: white;
                    cursor: pointer;
                }

                .cubicle#cubicle-1 {
                    width: 100px; height: 100px; bottom: 15px; left: 260px;
                }
                .cubicle#cubicle-2 {
                    width: 100px; height: 100px; bottom: 155px; left: 260px;
                }
                .cubicle#cubicle-3 {
                    width: 100px; height: 100px; bottom: 15px; left: 490px;
                }
                .cubicle#cubicle-4 {
                    width: 100px; height: 100px; bottom: 155px; left: 490px;
                }
                .cubicle#cubicle-5 {
                    width: 100px; height: 100px; bottom: 15px; left: 605px;
                }
                .cubicle#cubicle-6 {
                    width: 100px; height: 100px; bottom: 155px; left: 605px;
                }
                .cubicle#cubicle-7 {
                    width: 100px; height: 100px; bottom: 15px; left: 835px;
                }
                .cubicle#cubicle-8 {
                    width: 100px; height: 100px; bottom: 155px; left: 835px;
                }
                .cubicle#cubicle-9 {
                    width: 100px; height: 100px; bottom: 15px; left: 950px;
                }
                .cubicle#cubicle-10 {
                    width: 100px; height: 100px; bottom: 155px; left: 950px;
                }
                .cubicle#cubicle-11 {
                    width: 100px; height: 100px; bottom: 15px; left: 1165px;
                }
                .cubicle#cubicle-12 {
                    width: 100px; height: 100px; bottom: 155px; left: 1165px;
                }
                .cubicle#cubicle-13 {
                    width: 100px; height: 100px; top: 5px; right: 430px;
                }
                .cubicle#cubicle-14 {
                    width: 100px; height: 100px; top: 5px; right: 560px;
                }
                .cubicle#cubicle-15 {
                    width: 100px; height: 100px; top: 5px; right: 690px;
                }
                .cubicle#cubicle-16 {
                    width: 100px; height: 100px; top: 5px; right: 820px;
                }
                .cubicle#cubicle-17 {
                    width: 100px; height: 100px; top: 5px; right: 950px;
                }
        </style>

        <script>
            function link( id ) {
                window.location = 'groep.php?werkplek=' + id;
            }
        </script>
	</head>
	<body>
        <?php 
            require_once $root . 'resources\\layouts\\nav.php';
        ?>
        <div id="map-container">
            <div id="background" class="center">
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
                <div id="cubicle-1" class="cubicle" onclick="link(1);">
                    <h3>1</h3>
                </div>
                <div id="cubicle-2" class="cubicle"  onclick="link(2);">
                    <h3>2</h3>
                </div>
                <div id="cubicle-3" class="cubicle"  onclick="link(3);">
                    <h3>3</h3>
                </div>
                <div id="cubicle-4" class="cubicle"  onclick="link(4);">
                    <h3>4</h3>
                </div>
                <div id="cubicle-5" class="cubicle"  onclick="link(5);">
                    <h3>5</h3>
                </div>
                <div id="cubicle-6" class="cubicle"  onclick="link(6);">
                    <h3>6</h3>
                </div>
                <div id="cubicle-7" class="cubicle"  onclick="link(7);">
                    <h3>7</h3>
                </div>
                <div id="cubicle-8" class="cubicle"  onclick="link(8);">
                    <h3>8</h3>
                </div>
                <div id="cubicle-9" class="cubicle"  onclick="link(9);">
                    <h3>9</h3>
                </div>
                <div id="cubicle-10" class="cubicle"  onclick="link(10);">
                    <h3>10</h3>
                </div>
                <div id="cubicle-11" class="cubicle"  onclick="link(11);">
                    <h3>11</h3>
                </div>
                <div id="cubicle-12" class="cubicle"  onclick="link(12);">
                    <h3>12</h3>
                </div>
                <div id="cubicle-13" class="cubicle"  onclick="link(13);">
                    <h3>13</h3>
                </div>
                <div id="cubicle-14" class="cubicle"  onclick="link(14);">
                    <h3>14</h3>
                </div>
                <div id="cubicle-15" class="cubicle"  onclick="link(15);">
                    <h3>15</h3>
                </div>
                <div id="cubicle-16" class="cubicle"  onclick="link(16);">
                    <h3>16</h3>
                </div>
                <div id="cubicle-17" class="cubicle"  onclick="link(17);">
                    <h3>17</h3>
                </div>
            </div>
        </div>
	</body>
</html>