<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$root = __DIR__ . '\..\\';
require_once $root .'app\\pdo.php';
require_once $root . 'app\\authorize.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    require_once $root . 'resources\\layouts\\head.php';
    require_once $root . 'resources\\layouts\\log.php';
?>
<script>
    $( function () {
        getGroep( <?= $_GET['groep']?>, renderLogs );
    } );
</script>
</head>
<body>
    
    <?php

    require_once('../resources/layouts/nav.php');

        $sqlgroepen = "
        SELECT leerlingen.leerling_ID, leerlingen.voornaam, leerlingen.tussenvoegsel, leerlingen.achternaam, leerlingen.Groep_id, leerlingen.Level, cohort.Cohort
        FROM `leerlingen`
        INNER JOIN `cohort` ON leerlingen.Cohort=cohort.Cohort_ID
        WHERE leerlingen.Groep_id = $_GET[groep]";

        $table[] = "
            <h2>Groep ".$_GET['groep']."</h2>
            <table class='striped'>
                <thead>
                    <tr>
                        <th class=' '>Voornaam</th>
                        <th class=' '>Tussenvoegsel</th>
                        <th class=' '>Achternaam</th>
                        <th class=' '>Groep</th>
                        <th class=' '>Level</th>
                        <th class=' '>Cohort</th>
                        <th class=' '>LOG</th>
                    </tr>
                </thead>";

        $result = $pdo->query($sqlgroepen);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $table[] = "<tr>
                        <td>" . $row["voornaam"] . "</td>
                        <td>" . $row["tussenvoegsel"] . "</td>
                        <td>" . $row["achternaam"] . "</td>
                        <td>" . $row["Groep_id"] . "</td>
                        <td>" . $row["Level"] . "</td>
                        <td>" . $row["Cohort"] . "</td>
                        <td><a href='leerling.php?leerling=". $row['leerling_ID']. "'>log</a></td>
                    </tr>";
        }
        

        echo "<div class='row'><div class='col s6'>";
        // Table aanmaken
        if (isset($table)) {
            foreach ($table as $key => $table_done) {
                echo $table_done;

            }
        };
        echo "</table></div></div>";
    ?>
	<textarea id="log-new"></textarea>
	<button id="log-new-button" class="btn grey disabled" onclick="
        $( this ).hasClass( 'disabled' ) ? null : logAdd( $( '#log-new' ).val(), addLog, null, <?= $_GET['groep'] ?> );
    ">toevoegen</button>
    <div id="logboek"></div>
</body>
</html>