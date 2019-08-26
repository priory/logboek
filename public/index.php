<html>
    <head>
        <?php 
            $root = __DIR__ . '\..\\';

            require_once $root . 'resources\\layouts\\head.php';
        ?>
    </head>
    <body>
        <div class="row">
            <form class="col m6 s12 offset-m3" name="form" method="POST" action="./authenticate.php" onsubmit="return false;">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="user" type="text">
                        <label for="user">Gebruiker</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password">
                        <label for="password">Wachtwoord</label>
                    </div>
                <div class="row">
                    <div class="btn col m6 s12 offset-m3" onclick="document.form.submit();">Login</div>
                </div>
            </form>
        </div>
  </div>
    </body>
</html>