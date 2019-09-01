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

    if (isset($_GET['werkplek'])) {
        $query = $pdo->prepare("SELECT `cubicles`.`group_id` FROM `cubicles` WHERE `cubicles`.`number` = :werkplek");
        $query->bindValue(':werkplek', $_GET['werkplek'], PDO::PARAM_STR);
        $query->execute();
        $group_id = $query->fetch(PDO::FETCH_ASSOC);
        $group_id = $group_id['group_id'];
    }

    if (isset($_GET['group'])) {
        $group_id = $_GET['group'];
    }

    error_log(print_r($group_id, true));
?>
<script>
    $( function () {
        var group_id = '<?php echo $group_id; ?>';
        console.log('group id = ' +group_id);
        getGroep(group_id, renderLogs );
    } );
</script>
</head>
<body>
    <?php
    require_once('../resources/layouts/nav.php');

    $sth = $pdo->prepare("SELECT `groups`.`name` FROM `groups` WHERE `id` = :group");
    $sth->bindValue(':group', $group_id, PDO::PARAM_INT);
    $sth->execute();

    $group = $sth->fetch(PDO::FETCH_ASSOC);

    echo "<h1>Groep: {$group['name']}</h1>";

    if (isset($_GET['werkplek'])) {
        $sth = $pdo->prepare("
        SELECT `students`.`id` as `student_id`, `groups`.`id` as `group_id`, `students`.`name`, `students`.`surname`, `cohorts`.`name` as `cohort`, `levels`.`level`
        FROM `students`
        INNER JOIN `cohorts` ON `students`.`cohort_id`=`cohorts`.`id`
        INNER JOIN `levels` ON `students`.`level_id`=`levels`.`id`
        INNER JOIN `groups` ON `students`.`group_id`=`groups`.`id`
        WHERE `groups`.`id` = (SELECT `cubicles`.`group_id` as `werkplek` FROM `cubicles` WHERE `cubicles`.`number` = :werkplek)");
        $sth->bindValue(':werkplek', $_GET['werkplek'], PDO::PARAM_INT);
    } else {
        $sth = $pdo->prepare("
        SELECT `students`.`id` as `student_id`, `groups`.`id` as `group_id`, `students`.`name`, `students`.`surname`, `cohorts`.`name` as `cohort`, `levels`.`level`
        FROM `students`
        INNER JOIN `cohorts` ON `students`.`cohort_id`=`cohorts`.`id`
        INNER JOIN `levels` ON `students`.`level_id`=`levels`.`id`
        INNER JOIN `groups` ON `students`.`group_id`=`groups`.`id`
        WHERE `groups`.`id` = :group");
        $sth->bindValue(':group', $group_id, PDO::PARAM_INT);
    }

        $table[] = "
            <table class='striped'>
                <thead>
                    <tr>
                        <th class=' '>Voornaam</th>
                        <th class=' '>Achternaam</th>
                        <th class=' '>Cohort</th>
                        <th class=' '>Level</th>
                        <th class=' '>LOG</th>
                    </tr>
                </thead>";

        $sth->execute();

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $table[] = "<tr>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["surname"] . "</td>
                            <td>" . $row["cohort"] . "</td>
                            <td>" . $row["level"] . "</td>
                            <td><a href='/leerling.php?leerling=". $row['student_id']. "'>log</a></td>
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
                $( this ).hasClass( 'disabled' ) ? null : logAdd($('#log-new').val(), addLog, null, <?php echo $group_id; ?>); //logAdd function -> head.php
            ">toevoegen</button>
        </div>
    </div>
    <div id="logboek"></div>
</body>
</html>