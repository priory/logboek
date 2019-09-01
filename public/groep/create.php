<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';
$years = '';
$trimesters = '';
$cubicles = '';

$sth = $pdo->prepare("SELECT `id`, `year` FROM `years`;");
$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $years .= <<<EOT
<option value="{$row['id']}">{$row['year']}</option>';
EOT;
}

$sth = $pdo->prepare("SELECT `id`, `trimester` FROM `trimesters`;");
$sth->execute();


while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $trimesters .= <<<EOT
<option value="{$row['id']}">{$row['trimester']}</option>';
EOT;
}

$sth = $pdo->prepare("SELECT `id`, `number` FROM `cubicles` WHERE `group_id` IS NULL");
$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $cubicles .= <<<EOT
<option value="{$row['id']}">{$row['number']}</option>';
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
            <form name="form" action="store.php" method="POST" class="col m8 s12 offset-m2">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="name" name="name" type="text" placeholder="Groep naam">
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
                        <div class="btn waves-effect waves-light right" onclick="document.form.submit();">Aanmaken</div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>