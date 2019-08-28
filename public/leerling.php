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
        getLeerling(<?= $_GET['leerling']?>, renderLogs);
    });

    function removeLog(id) {
        $('#log-'+id).remove(); 
    }

    function makeLog(data) {
        $("table").append(`
                
            <div class="row" id = "log-${data.id}">
                <div class="input-field col s10">            
                    <strong>${data.date}: </strong>
                    <textarea class="content materialize-textarea">${data.content}</textarea>
                    <button class="btn waves-effect waves-light red darken-1" onclick="logDelete(${data.id}, removeLog)">DELETE</button>
                    <button class="btn waves-effect waves-light red darken-1" onclick="logUpdate(${data.id}, $('#log-${data.id} textarea').val(), updateLog)">UPDATE</button>
                </div>
            </div>
        `);
        M.textareaAutoResize($('#log-'+data.id+' textarea'));
    }

    function renderLogs(data) {
        for (let i of data) {
            makeLog(i);
        }
    }
</script>
</head>
<body>
    <?php
        //require '../app/connectie.php';

    require_once('../resources/layouts/nav.php');
        $sqlleerlingen = "
        SELECT leerlingen.voornaam, leerlingen.tussenvoegsel, leerlingen.achternaam, leerlingen.Groep_id, leerlingen.Level, cohort.Cohort
        FROM `leerlingen`
        INNER JOIN `cohort` ON leerlingen.Cohort=cohort.Cohort_ID
        WHERE leerlingen.leerling_ID = $_GET[leerling]";

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
                    </tr>
                </thead>";

        $result = $pdo->query($sqlleerlingen);

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $table[] = "<tr>
                        <td>" . $row["voornaam"] . "</td>
                        <td>" . $row["tussenvoegsel"] . "</td>
                        <td>" . $row["achternaam"] . "</td>
                        <td>" . $row["Groep_id"] . "</td>
                        <td>" . $row["Level"] . "</td>
                        <td>" . $row["Cohort"] . "</td>
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
    
</body>
</html>