<?php
    if(!isset($_POST['pass']) && $_POST['kategoria']) header('Location: index.html');

    $password = $_POST['pass'];
    $kat = $_POST['kategoria'];

    //$pass = preg_replace("/[a-zA-Z]/", "<div class='empty'></div>", $password);
    $pass = preg_replace("/[\p{L}]/u", "?", $password);
    $pass = str_replace(" ", "     ", $pass);
    $password = str_replace(" ", "     ", $password);

    $for_js = "'".$password."', '".$pass."'";
?>

<!DOCTYPE html>
    <html lang='pl'>
    <head>
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='style.css' type='text/css'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta hettp-equiva='X-UA-Compatible' content='IE-edge.chrome=1' />
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap' rel='stylesheet'>        
        <link rel='website icon' href='' type='png'/>
        <title>Guess the sentence</title>
    </head>
    <body onload="start(<?=$for_js?>)">
        <div id='go_back'><a href='index.html'>Ustaw nowe hasło</a></div>
        <div id='kat'>Kategoria</div>
        <div id="kategoria"><?=$kat?></div>
        <div id='pass_box'><?=$pass?></div>

        <div id="alfabet"></div>

        <script src="jquery-3.7.1.min.js"></script>
        <script src="game.js"></script>
    </body>
</html>
