<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';

$options = '';
$cohorts = '';
$groups = '';

$sth = $pdo->prepare("SELECT `id`, `level` FROM `levels`;");
$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $options .= <<<EOT
<option value="{$row['id']}">{$row['level']}</option>';
EOT;
}

$sth = $pdo->prepare("SELECT `id`, `name` FROM `cohorts`;");
$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $cohorts .= <<<EOT
<option value="{$row['id']}">{$row['name']}</option>';
EOT;
}

$sth = $pdo->prepare("SELECT `id` FROM `groups`;");
$sth->execute();

$groups .= '<option value="" selected></option>';

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $groups .= <<<EOT
<option value="{$row['id']}">{$row['id']}</option>';
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
                <h1>Leerling Aanmaken</h1>
            </div>
        </div>
        <div class="row">
            <form name="form" action="/leerling/store.php" method="POST" class="col m8 s12 offset-m2">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="name" name="name" type="text" placeholder="Jan">
                        <label for="name">Naam</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="surname" name="surname" type="text" placeholder="Modaal, van">
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
                        <div class="btn waves-effect waves-light right col s12 m2" onclick="document.form.submit();">Aanmaken</div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>