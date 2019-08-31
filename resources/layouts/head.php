<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
    var weekdays = ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'];
    function getLeerling(leerling, callback){
        $.ajax({url:'request/log.php', method:'POST', data: { method: 'GET', leerling } }).then(r => callback(JSON.parse(r)));
    }

    function getGroep(groep, callback){
        $.ajax({url:'request/log.php', method:'POST', data: { method: 'GET', groep } }).then(r => callback(JSON.parse(r)));
    }
    function logDelete(id, callback) {
        $.ajax({url:'request/log.php', method:'POST', data: { method: 'DELETE', id } }).then(r => callback(r));
    }

    function logUpdate(id, content ,callback) {
        $.ajax({url:'request/log.php', method:'POST', data: { method: 'UPDATE', id, content } }).then(r => callback(r));
    }
	function logAdd(content, callback, leerling = null, groep = null) {
        $.ajax({url:'request/log.php', method:'POST', data: { method: 'INSERT', content, leerling, groep } }).then(r => callback(JSON.parse(r)));
    }

    $(function () {
        <?php 
            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $v) {
                    echo 'M.toast({html: \'' . $_SESSION['errors'][0] . '\'});';
                }
                unset($_SESSION['errors']);
            }
        ?>

        $('.sidenav').sidenav();
    });
</script>

