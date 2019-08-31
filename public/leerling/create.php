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
            <div class="col m8 s12 offset-m2">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="name" name="name" type="text" placeholder="Jan">
                        <label for="name">Naam</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="surname" name="surname" type="text" placeholder="Modaal, van">
                        <label for="surname">Achternaam</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m8 s12 offset-m2">
                <div class="row">
                    <div class="input-field col s4">
                        <select>
                            <?= $options ?>
                        </select>
                        <label>Level</label>
                    </div>
                    <div class="input-field col s4">
                        <select>
                            <?= $cohorts ?>
                        </select>
                        <label>Level</label>
                    </div>
                    <div class="input-field col s4">
                        <select>
                            <?= $groups ?>
                        </select>
                        <label>Level</label>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>