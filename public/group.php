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
        INNER JOIN `cohort` ON leerlingen.Cohort=cohort.Cohort_ID";

        $table[] = "
            <table class='striped'>
                <thead>
                    <tr>
                        <th class='col m6 s12 offset-m3'>Voornaam</th>
                        <th class='col m6 s12 offset-m3'>Tussenvoegsel</th>
                        <th class='col m6 s12 offset-m3'>Achternaam</th>
                        <th class='col m6 s12 offset-m3'>Groep</th>
                        <th class='col m6 s12 offset-m3'>Level</th>
                        <th class='col m6 s12 offset-m3'>Cohort</th>
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

        echo "<div class='row'>";
        // Table aanmaken
        if (isset($table)) {
            foreach ($table as $key => $table_done) {
                echo $table_done;
            }
        };
        echo "</div>";
    ?>
</body>
</html>