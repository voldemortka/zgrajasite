<?php
    session_start();
    require_once("connect.php");
    $connection = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_password port=$port");

    if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']){
        $name = $_SESSION['username'];
        $id = $_SESSION['id'];
        $log=true;
    } else $log=false;


    if(isset($_POST['name'])){
        $sql1 = "insert into konto(name,const) values ('".$_POST['name']."', 0)";
        pg_query($connection, $sql1);
        $name = $_POST['name'];
        $_SESSION['username'] = $name;
        $log=true;
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
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">        
        <link rel="website icon" href="zenszen.jpg" type="png"/>
        <title>Zgraja site</title>
    </head>
    <body>
        <div class='panel_gorny'>
            <div class='pan_top'><a href='zgraja.php' class='gora_a'>Home</a></div>
            <?= $log ? "<div class='pan_top'><a href='edit.php' class='gora_a'>Profil</a></div><div class='pan_top'><a href='mess.php' class='gora_a'>Messages</a></div>" : ""?>
            <div class='pan_top' style='border-bottom: 1px solid white;'><a href='transform.php' class='gora_a' id='przekierowanie_str2' onmouseenter='info_przekier()' onmouseleave='info_out()'>Gry multiplayer</a></div>
        </div>

        <div class='komunikat'>NA RAZIE NIE DZIAŁA! Prawie, prawie, jak znajdę ze 2 wieczory wolnego czasu, to to dokończę</div>

        <h5>Your name:</h5>
        <div id='name_tans'>
            <?= $log ? $name : "
                <form action='transform.php' method='post'>
                    <input name='name' type='text' placeholder='enter your nickname here'>
                    <input type='submit'>
                </form>
            " ?>
            <?= !$log ? "<div class='dopisek'>Chociaż zdecydowanie polecam stworzyć sobie konto/zalogować się (u góry na głównej stronie)</div>" : ""?>
        </div>

        <div class='choosing_game_out'><a href='<?= $log ? "trans_snake.php" : "" ?>' style='width: 600px;'><div class='choosing_game'>Wonsz 3.0</div></a></div>
        <div class='choosing_game_out'><a href='<?= $log ? "trans_pacy.php" : "" ?>' style='width: 600px;'><div class='choosing_game'>Pacman 2.0</div></a></div>
        <div class='choosing_game_out'><a href='<?= $log ? "trans_dot.php" : "" ?>' style='width: 600px;'><div class='choosing_game'>Kropki</div></a></div>
    </body>
</html>
