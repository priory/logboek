<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    $root = __DIR__ . '\..\\';

    require_once $root . 'resources\\layouts\\head.php';
?>
<script>
    $(function () {
        getLeerling(<?= $_GET['leerling']?>, renderLogs);
    });

    function removeLog(id) {
        $('#log-'+id).remove(); 
    }

    function renderLogs(data) {
        for (let i of data) {

            $("table").append(
`
<div class="row" id = "log-${i.id}">
    <div class="input-field col s6">            
        <strong>${i.date}: </strong>
        <textarea class="content">${i.content}</textarea>
        <button onclick="logDelete(${i.id}, removeLog)">DELETE</button>
        <button onclick="logDelete(${i.id}, removeLog)">UPDATE</button>
    </div>
</div>
`);

        }
    }
</script>
</head>
<body>

    <?php
        require '../app/connectie.php';

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

        $result = mysqli_query($conn, $sqlleerlingen) or die(mysqli_error($conn));

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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
        } else {
            echo "Error";
        }

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
    <button><a href="javascript:history.back()">Terug</a></button>
    
</body>
</html>