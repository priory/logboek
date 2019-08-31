<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';

$student = [];
$options = '';
$cohorts = '';
$groups = '';


$sth = $pdo->prepare("SELECT `name`, `surname`, `level_id`, `cohort_id`, `group_id` FROM `students` WHERE `id` = :student;");
$sth->bindValue(':student', $_GET['student'], PDO::PARAM_INT);
$sth->execute();

if (! ($student = $sth->fetch(PDO::FETCH_ASSOC))) {
    
}

$sth = $pdo->prepare("SELECT `id`, `level` FROM `levels`;");
$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $selected = '';

    if ($row['id'] == $student['level_id']) {
        $selected = 'selected';
    }

    $options .= <<<EOT
<option value="{$row['id']}" {$selected}>{$row['level']}</option>';
EOT;
}

$sth = $pdo->prepare("SELECT `id`, `name` FROM `cohorts`;");
$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $selected = '';

    if ($row['id'] == $student['cohort_id']) {
        $selected = 'selected';
    }

    $cohorts .= <<<EOT
<option value="{$row['id']}" {$selected}>{$row['name']}</option>';
EOT;
}

$sth = $pdo->prepare("SELECT `id` FROM `groups`;");
$sth->execute();

$groups .= '<option value="" ' . ($student['group_id'] ? '' : 'selected' ) . '></option>';

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $selected = '';

    if ($row['id'] == $student['group_id']) {
        $selected = 'selected';
    }

    $groups .= <<<EOT
<option value="{$row['id']}" {$selected}>{$row['id']}</option>';
EOT;
error_log(print_r($groups, true));
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
                <h1>Leerling Aanmaken</h1>
            </div>
        </div>
        <div class="row">
            <form name="form" action="/leerling/update.php?student=<?= $_GET['student']; ?>" method="POST" class="col m8 s12 offset-m2">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="name" name="name" type="text" placeholder="Jan" value="<?= $student['name'] ?>">
                        <label for="name">Naam</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="surname" name="surname" type="text" placeholder="Modaal, van" value="<?= $student['surname'] ?>">
                        <label for="surname">Achternaam</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <select name="level">
                            <?= $options ?>
                        </select>
                        <label>Level</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="cohort">
                            <?= $cohorts ?>
                        </select>
                        <label>Cohort</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="group">
                            <?= $groups ?>
                        </select>
                        <label>Groep</label>
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