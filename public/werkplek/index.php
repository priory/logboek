<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
?>
<html>
<head>
    <?php 
        require_once $root . 'resources\\layouts\\head.php';
        require_once $root . 'app\\pdo.php';
    ?>
    <script>
        $( function () {
            $( '.dropdown-trigger' ).dropdown( {
                constrainWidth: false,
            } );
        } );
    </script>
    </head>
    <body>
        <?php
            require_once $root . 'resources\\layouts\\nav.php';
        ?>
        <div class="row">
            <div class="col m8 s12 offset-m2 center">
                <h1>Studenten</h1>
                <a class="btn-floating btn-large waves-effect waves-light right" href="/leerling/create.php"><i class="material-icons">add</i></a>
            </div>
        </div>
        <div class="row">
            <div class="col m8 s12 offset-m2">
                <table class="striped highlight responsive-table">
                    <thead>
                        <tr>
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>Groep</th>
                            <th>Level</th>
                            <th>Cohort</th>
                            <th>Opties</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$table = '';

$sth = $pdo->prepare("
    SELECT 
        `students`.`id`, 
        `students`.`name`, 
        `students`.`surname`, 
        `groups`.`id` as 'group', 
        `levels`.`level`, 
        `cohorts`.`name` as 'cohort'
    FROM `students` 
    LEFT JOIN `groups` 
        ON `groups`.`id` = `students`.`group_id`
    INNER JOIN `levels` 
        ON `levels`.`id` = `students`.`level_id`
    INNER JOIN `cohorts` 
        ON `cohorts`.`id` = `students`.`cohort_id`
");

$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $table .= <<<EOT
<tr>
    <td>{$row['name']}</td>
    <td>{$row['surname']}</td>
    <td>{$row['group']}</td>
    <td>{$row['level']}</td>
    <td>{$row['cohort']}</td>
    <td>
        <a class='dropdown-trigger btn btn-floating btn-small waves-effect waves-light grey' href='#' data-target='dropdown-student-{$row['id']}'><i class="material-icons">more_horiz</i></a>
        <ul id='dropdown-student-{$row['id']}' class='dropdown-content'>
            <li><a class="waves-effect" href="/leerling.php?leerling={$row['id']}">Bekijken</a></li>
            <li><a class="waves-effect" href="/leerling/edit.php?student={$row['id']}">Aanpassen</a></li>
            <li><a class="red white-text waves-effect waves-light" href="/leerling/destroy.php?student={$row['id']}">Verwijderen</a></li>
        </ul>
    </td>
</tr>
EOT;
}

echo $table;
?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>