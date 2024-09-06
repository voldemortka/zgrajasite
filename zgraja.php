<?php
    session_start();
    if(!isset($_SESSION['who'])) header('Location: index.php');
    if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']) {$log=true; $name=$_SESSION['username'];} else $log=false;
    $who = $_SESSION['who'];
    if($who == 'ja') {$log=true; $name='Admin';}


    //        <div class='komunikat'>Na razie mamy tutaj tylko te gry, które miałam już wcześniej. Gry, które są w trakcie tworzenia, bedą umożliwiały granie tutaj, każdy z innego komputera, na wielu graczy</br>Miłej zabawy XD<div onclick='changeL()' id='change'>Eng</div></div>

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
            <div class='pan_top' style='border-bottom: 1px solid white;'><a href='zgraja.php' class='gora_a'>Home</a></div>
            <?= $log ? "<div class='pan_top'><a href='edit.php' class='gora_a'>Profil</a></div>
                        <div class='pan_top'><a href='mess.php' class='gora_a'>Messages</a></div>
                        <div class='pan_top'><a href='transform.php' class='gora_a' id='przekierowanie_str2' onmouseenter='info_przekier()' onmouseleave='info_out()'>Gry multiplayer</a></div>
                        <div class='pan_top'><a href='logout.php' class='gora_a'>Log out</a></div>"
            : "<div class='pan_top'><a href='logowanie.php' class='gora_a'>Log in</a></div>
            <div class='pan_top'><a href='transform.php' class='gora_a' id='przekierowanie_str2' onmouseenter='info_przekier()' onmouseleave='info_out()'>Gry multiplayer</a></div>
            " ?>
        </div>
        <div id='przekier_info'>Tutaj są te gry do grania w więcej osób, każdy z innego komputera, like kropki i Pacman2</div>
        <h2 style='float: left;'>Witammm</h2> <?php 
        if(($who =='ja')) echo "<div id='do_logowania'><a href='podglad.php'>Panel admina</a></div>"; 
        ?> <div style="clear:both;"></div>
        <audio controls style='margin-bottom: 25px; margin-left: 8%;'><source src='piesn zemsty.mp3' type='audio/mp3'></audio>
        <div class='komunikat'>Przed wami kilka gier mojej produkcji do grania na jednym komputerze w jedną lub dwie osoby. Na górze mamy zakładkę z grami do grania w kilka osób, każdy z innego komputera. Jasne, można grać w nie w pojedynkę, ale nie ma to za bardzo sensu XD Anyway, miłego grania <div id='change' onclick='changeL()'>Eng</div></div>
        <div id='choose_list'>
            <p>Single player</p>
            <div class='choosing_game_out'><a href='wonsz/index.php'><div class='choosing_game'>Wonsz 1.0</div></a><a href='wonsz/infos.html'>rules</a></div>
            <div class='choosing_game_out'><a href='Pacman/index.php'><div class='choosing_game'>Pacman 1.0</div></a><a href='Pacman/infos.html'>rules</a></div>
            <p>Two players with one device</p>
            <div class='choosing_game_out'><a href='Wonsz 2.0 v Christmas/index.html'><div class='choosing_game'>Wonsz 2.0 v Christmas</div></a><a href='Wonsz 2.0 v Christmas/info_w2.html'>rules</a></div>
            <div class='choosing_game_out'><a href='Wisielec/index.php'><div class='choosing_game'>Wisielec</div></a></div>
            <div class='choosing_game_out'><a href='Tic Tac Toe/index.html'><div class='choosing_game'>Kółko i krzyżyk</div></a></div>
            <p>Będą jak skończę:</br>They don't exist</p>
            <div class='choosing_game_out'><a href=''><div class='choosing_game'>Tetris (ostatnia gra na tej stronie ig. Reszta na tej u góry)</div></a></div>
            <div class='choosing_game_out'><a href='Wonsz 3.0/zasady.php'><div class='choosing_game'>Wonsz 3.0 v multi-komputer</div></a></div>
            <div class='choosing_game_out'><a href=''><div class='choosing_game'>Pacman 3.0 v 3D</div></a></div>
        </div>

        <script src="jquery-3.7.1.min.js"></script>
        <script src="zgraja.js"></script>
    </body>
</html>