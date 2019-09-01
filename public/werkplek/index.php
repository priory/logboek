<?php
$root = __DIR__ . '\..\\..\\';
require_once $root . 'app\\authorize.php';
require_once $root . 'app\\pdo.php';

$groups = [];

$sth = $pdo->prepare("
    SELECT `id`, `name` FROM `groups`;
");
$sth->execute();

$groups = $sth->fetchAll(PDO::FETCH_ASSOC);

$groups_select = '<option value=""></option>';

foreach ($groups as $v) {
    $groups_select .= "<option value=\"{$v['id']}\">{$v['name']}</option>";
}

error_log(print_r($groups_select, true));
?>
<html>
<head>
    <?php 
        require_once $root . 'resources\\layouts\\head.php';
    ?>
    <style>
        .select-dropdown.dropdown-trigger, .input-field {
            margin: 0 !important;
        }
    </style>
    <script>
        $( function () {
            $( '.cubicle' ).map( (i, v) => { 
                let group = $( v ).data().group;
                
                $('option[value="' + ( group ) + '"]', v ).attr('selected', 'selected');

                $( v ).change( ( e ) => {
                    window.location = '/werkplek/assign.php?cubicle=' + ( $( e.target ).data().cubicle ) + '&group=' + ( $(e.target).val() );
                } );
            } );

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
                <h1>Studenten</h1>
                <a class="btn-floating btn-large waves-effect waves-light right" href="/leerling/create.php"><i class="material-icons">add</i></a>
            </div>
        </div>
        <div class="row">
            <div class="col m8 s12 offset-m2">
                <table class="striped highlight responsive-table">
                    <thead>
                        <tr>
                            <th>Werkplek</th>
                            <th>Groep</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$table = '';

$sth = $pdo->prepare("
    SELECT `id`, `number`, `group_id` FROM `cubicles`;
");

$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $table .= <<<EOT
<tr>
    <td>{$row['number']}</td>
    <td>
        <div class="input-field col s12">
            <select class="cubicle" data-group="{$row['group_id']}" data-cubicle="{$row['id']}">
                {$groups_select}
            </select>
        </div>
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
        <div class="input-field col s12">
    <select>
      <option value="" disabled selected>Choose your option</option>
      <option value="1"><a href="/">test</a></option>
      <option value="2">Option 2</option>
      <option value="3">Option 3</option>
    </select>
    <label>Materialize Select</label>
  </div>
    </body>
</html>