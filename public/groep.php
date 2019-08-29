<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$root = __DIR__ . '\..\\';
require $root.'app/pdo.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    

    require_once $root . 'resources\\layouts\\head.php';
?>
<script>
    $( function () {
        getGroep( <?= $_GET['groep']?>, renderLogs );

        $(' #log-new' ).on( 'input', function () {
            $e = $( this );

            if ( $( this ).val().length == 0 ) {
                $( '#log-new-button' ).addClass( 'disabled' );
            } else {
                $( '#log-new-button' ).removeClass( 'disabled' );
            }
        } );
    } );

    function removeLog(id) {
        $('#log-'+id).remove();
    }

    function updateLog(id) {
        alert('Succesvol geüpdatet')
    }
	
	function addLog(data) {
        makeLog(data);
        $('#log-new').val('');
    }

    /**
     * Renders a new log
     *
     * @param {object} data {id, content, date}
     */
    function makeLog(data) {
        $("#logboek").prepend(`
                
        <div class="row" id = "log-${data.id}">
                <div class="input-field col s10">            
                    <strong>${data.date}: </strong>
                    <textarea class="content materialize-textarea">${data.content}</textarea>
                    
                </div>
                <div class="input-field col s2">
                    <a class='dropdown-trigger btn btn-floating btn-large waves-effect waves-light grey' href='#' data-target='dropdown-log-${data.id}'><i class="material-icons">more_horiz</i></a>

                    <ul id='dropdown-log-${data.id}' class='dropdown-content'>
                        <li><a onclick="logUpdate(${data.id}, $('#log-${data.id} textarea').val(), updateLog)">UPDATE</a></li>
                        <li><a class="red white-text" onclick="logDelete(${data.id}, removeLog)">DELETE</a></li>
                    </ul>
                </div>
            </div>
        `);
        M.textareaAutoResize($('#log-'+data.id+' textarea'));
        $('#log-'+data.id+' a.dropdown-trigger').dropdown();
    }

    function renderLogs(data) {
        for (let i of data) {
            makeLog(i);
        }
    }

</script>
</head>
<body>
    
    <?php

    require_once('../resources/layouts/nav.php');

        $sqlgroepen = "
        SELECT leerlingen.leerling_ID, leerlingen.voornaam, leerlingen.tussenvoegsel, leerlingen.achternaam, leerlingen.Groep_id, leerlingen.Level, cohort.Cohort
        FROM `leerlingen`
        INNER JOIN `cohort` ON leerlingen.Cohort=cohort.Cohort_ID
        WHERE leerlingen.Groep_id = $_GET[groep]";

        $table[] = "
            <h2>Groep ".$_GET['groep']."</h2>
            <table class='striped'>
                <thead>
                    <tr>
                        <th class=' '>Voornaam</th>
                        <th class=' '>Tussenvoegsel</th>
                        <th class=' '>Achternaam</th>
                        <th class=' '>Groep</th>
                        <th class=' '>Level</th>
                        <th class=' '>Cohort</th>
                        <th class=' '>LOG</th>
                    </tr>
                </thead>";

        $result = $pdo->query($sqlgroepen);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $table[] = "<tr>
                        <td>" . $row["voornaam"] . "</td>
                        <td>" . $row["tussenvoegsel"] . "</td>
                        <td>" . $row["achternaam"] . "</td>
                        <td>" . $row["Groep_id"] . "</td>
                        <td>" . $row["Level"] . "</td>
                        <td>" . $row["Cohort"] . "</td>
                        <td><a href='leerling.php?leerling=". $row['leerling_ID']. "'>log</a></td>
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
	<textarea id="log-new"></textarea>
	<button id="log-new-button" class="btn grey disabled" onclick="
        $( this ).hasClass( 'disabled' ) ? null : logAdd( $( '#log-new' ).val(), addLog, null, <?= $_GET['groep'] ?> );
    ">toevoegen</button>
    <div id="logboek"></div>
</body>
</html>