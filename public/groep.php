<?php 
$root = __DIR__ . '\..\\';
require $root.'app/pdo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    

    require_once $root . 'resources\\layouts\\head.php';
?>
<script>
    $(function () {
        getGroep(<?= $_GET['groep']?>, renderLogs);
    });

    function removeLog(id) {
        $('#log-'+id).remove();
        console.log('DOETEHEIT');
    }

    function updateLog(id) {
        alert('Succesvol geüpdatet')
    }

    function renderLogs(data) {
        for (let i of data) {

            $("table").append(`
                
            <div class="row" id = "log-${i.id}">
                <div class="input-field col s6">            
                    <strong>${i.date}: </strong>
                    <textarea class="content">${i.content}</textarea>
                    <button onclick="logDelete(${i.id}, removeLog)">DELETE</button>
                    <button onclick="logUpdate(${i.id}, $('#log-${i.id} textarea').val(), updateLog)">UPDATE</button>
                </div>
            </div>
            `);
        }
    }
</script>
</head>
<body>

    <?php

        $sqlgroepen = "
        SELECT leerlingen.leerling_ID, leerlingen.voornaam, leerlingen.tussenvoegsel, leerlingen.achternaam, leerlingen.Groep_id, leerlingen.Level, cohort.Cohort
        FROM `leerlingen`
        INNER JOIN `cohort` ON leerlingen.Cohort=cohort.Cohort_ID
        WHERE leerlingen.Groep_id = $_GET[groep]";

        $table[] = "
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
        echo "</table>";
         

        echo "<div class='row'><div class='col s6'>";
        // Table aanmaken
        if (isset($table)) {
            foreach ($table as $key => $table_done) {
                echo $table_done;
            }
        };
        echo "</div></div>";
    ?>
    <button><a href="kaart.php">Kaart</a></button>
</body>
</html>