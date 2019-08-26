<?php 
    session_start();
?>

<html>
    <head>
        <?php 
            $root = __DIR__ . '\..\\';

            require_once $root . 'resources\\layouts\\head.php';
        ?>

        <script>
            $(function () {
                <?php 
                    if (isset($_SESSION['errors'])) {
                        echo 'M.toast({html: \'' . $_SESSION['errors'][0] . '\'});';
                        unset($_SESSION['errors']);
                    }
                ?>
            });
        </script>
    </head>
    <body>
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