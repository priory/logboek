<?php 
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
        getLeerling( <?= $_GET['leerling']?>, renderLogs );
    } );
</script>
</head>
<body>
    <?php
    require_once('../resources/layouts/nav.php');
    $sth = $pdo->prepare("
        SELECT `students`.`id`, `students`.`name`, `students`.`surname`, `students`.`group_id`, `cohorts`.`name` as `cohort`, `levels`.`level`
        FROM `students`
        INNER JOIN `cohorts` ON `students`.`cohort_id`=`cohorts`.`id`
        INNER JOIN `levels` ON `students`.`level_id`=`levels`.`id`
        WHERE `students`.`id` = :leerling");
        $sth->bindValue(':leerling', $_GET['leerling'], PDO::PARAM_STR);

        $table[] = "
            <table class='striped'>
                <thead>
                    <tr>
                        <th class=' '>Voornaam</th>
                        <th class=' '>Achternaam</th>
                        <th class=' '>Cohort</th>
                        <th class=' '>Level</th>
                        <th class=\"center\">Aanpassen</th>
                    </tr>
                </thead>";

        $sth->execute();

        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $table[] = "<tr>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["surname"] . "</td>
                            <td>" . $row["cohort"] . "</td>
                            <td>" . $row["level"] . "</td>
                            <td class=\"center\">
                                <a class='dropdown-trigger btn btn-floating btn-small waves-effect waves-light grey' href='/leerling/edit.php?student={$_GET['leerling']}'><i class=\"material-icons\">edit</i></a>
                            </td>
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
    <div class="row">
        <div class="col s6">
        <textarea id="log-new" class="materialize-textarea" onkeydown="console.log(1)"></textarea>
            <button id="log-new-button" class="btn grey disabled" onclick="
                $( this ).hasClass( 'disabled' ) ? null : logAdd($('#log-new').val(), addLog, <?= $_GET['leerling'] ?>, <?= $_GET['groep'] ?>); //logAdd function -> head.php
            ">toevoegen</button>
        </div>
    </div>
    <div id="logboek"></div>
</body>
</html>