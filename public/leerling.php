<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logboek ROC-MN</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>

    <?php
        require '../app/connectie.php';

        $sqlleerlingen = "
        SELECT leerlingen.voornaam, leerlingen.tussenvoegsel, leerlingen.achternaam, leerlingen.Groep_id, leerlingen.Level, cohort.Cohort
        FROM `leerlingen`
        INNER JOIN `cohort` ON leerlingen.Cohort=cohort.Cohort_ID
        WHERE leerlingen.leerling_ID = $_GET[id]";

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