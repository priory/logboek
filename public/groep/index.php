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
                <h1>Groepen</h1>
                <a class="btn-floating btn-large waves-effect waves-light right" href="/groep/create.php"><i class="material-icons">add</i></a>
            </div>
        </div>
        <div class="row">
            <div class="col m8 s12 offset-m2">
                <table class="striped responsive-table">
                    <thead>
                        <tr>
                            <th>Groep</th>
                            <th>Werkplek</th>
                            <th>Trimester</th>
                            <th>Jaar</th>                            
                        </tr>
                    </thead>
                    <tbody>
<?php
$table = '';

$sth = $pdo->prepare("
    SELECT 
        `groups`.`id` AS group_id,
        `groups`.`cubicle_id` as `werkplek`,
        `years`.`year`, 
        `trimesters`.`trimester`,
        `groups`.`name` as `group_name`
    FROM `groups` 

    INNER JOIN `trimesters` 
        ON `trimesters`.id = `groups`.`trimester_id`
    INNER JOIN `years` 
        ON `years`.id = `groups`.`year_id`");

$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $table .= <<<EOT
<tr>
    <td>{$row['group_name']}</td>
    <td>{$row['werkplek']}</td>
    <td>{$row['trimester']}</td>
    <td>{$row['year']}</td>
    <td>
        <a class='dropdown-trigger btn btn-floating btn-small waves-effect waves-light grey' href='#' data-target='dropdown-group-{$row['group_id']}'><i class="material-icons">more_horiz</i></a>
        <ul id='dropdown-group-{$row['group_id']}' class='dropdown-content'>
            <li><a class="waves-effect" href="/groep.php?group={$row['group_id']}">Bekijken</a></li>
            <li><a class="waves-effect" href="/groep/edit.php?group_id={$row['group_id']}">Aanpassen</a></li>
            <li><a class="red white-text waves-effect waves-light" href="/groep/destroy.php?group_id={$row['group_id']}">Verwijderen</a></li>
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