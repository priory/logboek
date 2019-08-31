<?php 
    $root = __DIR__ . '\..\\';

    require_once $root . 'app\\guest.php';
?>

<html>
    <head>
        <?php             
            require_once $root . 'resources\\layouts\\head.php';
        ?>

        <script>
            $(function () {
                $( 'input#user' ).keydown( function (e) {
                    if ( e.keyCode === 13) {
                        $( 'input#password' ).focus();
                    }
                } );

                $( 'input#password' ).keydown( function (e) {
                    if ( e.keyCode === 13) {
                        document.form.submit();
                    }
                } );
            });
        </script>
    </head>
    <body>
        <div class="row">
            <div class="col m6 s12 offset-m3">
                <h1 class="center">Logboek</h1>
            </div>
        </div>
        <div class="row">
            <form class="col m6 s12 offset-m3" name="form" method="POST" action="./login.php" onsubmit="return false;">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="user" name="user" type="text">
                        <label for="user">Gebruiker</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" name="password" type="password">
                        <label for="password">Wachtwoord</label>
                    </div>
                <div class="row">
                    <div class="btn col m6 s12 offset-m3" onclick="document.form.submit();">Login</div>
                </div>
            </form>
        </div>
    </body>
</html>