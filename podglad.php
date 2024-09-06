<?php
    session_start();
    require_once("connect.php");
    $connection = mysqli_connect($host, $db_user, $db_password, $db_name);
?>

<!DOCTYPE html>
<html lang='pl'>
    <head>
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='style.css' type='text/css'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta hettp-equiva='X-UA-Compatible' content='IE-edge.chrome=1' />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Tiny5&display=swap" rel="stylesheet">        <link rel='website icon' href='' type='png'/>
        <title>Podgląd na zgraję</title>
    </head>
    <body style='background-color: black;'>
        <div class='back_ja'><a href='zgraja.php' style='color: #00ff00;'>Back</a></div>
        <div id='selection__ja'>
            <div class='podglad'><a href='pod1.php' style='color: #00ff00;'>> Aktalnie prowadzone gry</a></div>
            <div class='podglad'><a href='pod2.php' style='color: #00ff00;'>> Zmiana haseł</a></div>
            <div class='podglad'><a href='pod2.php' style='color: #00ff00;'>> Konta !const z datą</a></div>
            <div class='podglad'><a href='pod2.php' style='color: #00ff00;'>> Skargi i zażalenia XD *</a></div>
        </div>
    </body>
</html>