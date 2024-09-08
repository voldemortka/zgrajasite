<?php
    session_start();
    if(!isset($_SESSION['who'])) header('Location: index.php');
    if(!isset($_SESSION['zalogowany']) || !$_SESSION['zalogowany']) header('Location: zgraja.php');
        
    require_once("connect.php");
    $connection = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_password port=$port");

    $name=$_SESSION['username'];
    
    if(isset($_SESSION['id'])) $id = $_SESSION['id'];
    else{
        $sql1 = "select id from konto where name='".$name."'";
        $res = pg_query($connection, $sql1);
        $row = pg_fetch_row($res);
        $id = $row[0];
        $_SESSION['id']=$id;
    }
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <meta hettp-equiva="X-UA-Compatible" content="IE-edge.chrome=1" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jacquard+12&display=swap" rel="stylesheet">        <title>Verification</title>
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">        
        <link rel="website icon" href="zenszen.jpg" type="png"/>
        <title>Wiadomości</title>
    </head>
    <body>
    <div class='panel_gorny'>
            <div class='pan_top'><a href='zgraja.php' class='gora_a'>Home</a></div>
            <div class='pan_top'><a href='edit.php' class='gora_a'>Profil</a></div>
            <div class='pan_top' style='border-bottom: 1px solid white;'><a href='mess.php' class='gora_a'>Messages</a></div>
            <div class='pan_top'><a href='transform.php' class='gora_a' id='przekierowanie_str2' onmouseenter='info_przekier()' onmouseleave='info_out()'>Gry multiplayer</a></div>
            <div class='pan_top'><a href='logout.php' class='gora_a'>Log out</a></div>
        </div>

                <div class='komunikat'>W tym miejscu kiedyś pojawi się taki czat do pisania ze sobą. Jest w przygotowaniu, pierwszy w kolejności do dokończenia ze wszystkich tych rzeczy, których nie skończyłam na tej stronie ig</div>

        <script src="jquery-3.7.1.min.js"></script>
        <script src="zgraja.js"></script>
    </body>
</html>
