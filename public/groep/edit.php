<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';
$group = [];
$years = '';
$trimesters = '';
$cubicles = '';

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
        ON `years`.id = `groups`.`year_id`
    WHERE `groups`.`id` = :group_id;");
$sth->bindValue(':group_id', $_GET['group_id'], PDO::PARAM_INT);
$sth->execute();

if (! ($group = $sth->fetch(PDO::FETCH_ASSOC))) {
    
}

$sth = $pdo->prepare("SELECT `id`, `year` FROM `years`;");
$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $selected = '';

    if ($row['year'] == $group['year']) {
        $selected = 'selected';
    }

    $years .= <<<EOT
<option value="{$row['id']}" {$selected}>{$row['year']}</option>';
EOT;
}

$sth = $pdo->prepare("SELECT `id`, `trimester` FROM `trimesters`;");
$sth->execute();


while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $selected = '';

    if ($row['trimester'] == $group['trimester']) {
        $selected = 'selected';
    }
    $trimesters .= <<<EOT
<option value="{$row['id']}" {$selected}>{$row['trimester']}</option>';
EOT;
}

$sth = $pdo->prepare("SELECT `id`, `number` FROM `cubicles` WHERE `group_id` IS NULL OR `group_id` = :group_id");
$sth->bindValue(':group_id', $group['group_id'], PDO::PARAM_INT);
$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $selected = '';

    if ($row['number'] == $group['werkplek']) {
        $selected = 'selected';
    }

    $cubicles .= <<<EOT
<option value="{$row['id']}" {$selected}>{$row['number']}</option>';
EOT;
}
?>
<html>
    <head>
        <?php
            require_once $root . 'resources\\layouts\\head.php';
        ?>
        <script>
            $( function () {
                $( 'select' ).formSelect();
            } );
        </script>
    </head>
    <body>
        <?php
            require_once $root . 'resources\\layouts\\nav.php';
        ?>
        <div class="row">
            <div class="col m8 s12 offset-m2 center">
                <h1>Groep Aanmaken</h1>
            </div>
        </div>
        <div class="row">
            <form name="form" action="/groep/update.php?group_id=<?= $_GET['group_id']?>" method="POST" class="col m8 s12 offset-m2">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="name" name="name" type="text" placeholder="Groep naam" value="<?= $group['group_name'] ?>">
                        <label for="name">Naam groep</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <select name="year">
                            <?= $years ?>
                        </select>
                        <label>Jaar</label>
                    </div>
                    <div class="input-field col s4">
                        <select name="trimester">
                            <?= $trimesters ?>
                        </select>
                        <label>Trimester</label>
                    </div>
                    <div class="input-field col s4">
                        <select name="cubicle">
                            <option value=''>Geen</option>";
                            <?= $cubicles ?>
                        </select>
                        <label>Werkplek</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="btn waves-effect waves-light right col s12 m4 l2" onclick="document.form.submit();">Wijzigen</div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>