<?php
    if(isset($_POST['pass'])) $x = $_POST['pass'];
?>

<!DOCTYPE HTML>
<html>
    <head lang="pl">
        <meta charset="utf-8" />
        <title>Wisielec</title>

        <link rel="stylesheet" href="style.css" type="text/css" />
        <script src="szubienica.js"> </script>
    </head>
    <body>
        <div id='back'><a href='index.php'>Ustaw nowe hasło</a></div>
        <div id="pojemnik">
            <div id="plansza"><?php echo $x ?></div>
            <div id="szubienica">
                <img src="s1.jpg" alt="Ny ma obrazka" />
            </div>
            <div id="alfabet"></div>
            <div style="clear:both;"></div>
        </div>
    </body>
</html>
