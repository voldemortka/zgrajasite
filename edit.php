<?php
    require_once("connect.php");
    $connection = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_password port=$port");

    session_start();
    if(!isset($_SESSION['who'])) header('Location: index.php');
    if(!isset($_SESSION['zalogowany']) || !$_SESSION['zalogowany']) header('Location: logowanie.php');
    $name=$_SESSION['username'];

    $error_edit="none";

    if(isset($_POST['new_name']) && $_POST['new_name']!=""){
        $sql_name = "update konto set name='".$_POST['new_name']."' where name='".$name."';";
        $res_name = pg_query($connection, $sql_name);
        $name=$_POST['new_name'];
        $_SESSION['username']=$_POST['new_name'];
    }

    if(isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['old_pass']) && $_POST['pass1']!=""){
        if($_POST['pass1'] != $_POST['pass2']) $error_edit="hasła nie są takie same";
        $sql_check = "select pass from konto where name='".$name."';";
        $res_baza = pg_query($connection, $sql_check);
        $row_baza = pg_fetch_row($res_baza);
        if(pg_num_rows($res_baza) == 1) {
            $pass_baza = $row_baza[0];
            if(!password_verify($pass_baza, $_POST['old_pass'])) $error_eidt="złe hasło stare";
            $hash = password_hash($_POST['pass1'],PASSWORD_DEFAULT);
            $sql_has = "update konto set pass='".$hash."' where name='".$name."';";
            if($error_edit=="none") $res_has = pg_query($connection, $sql_has);
        }
        else $error_edit = "problem ze starym hasłem";
    }

    $sql1 = "select img from konto where name='".$name."'";
    $res1 = pg_query($connection, $sql1);
    $row1 = pg_fetch_row($res1);
    $img_path = $row1[0];

    $sql = "select statystyki.pkt as pkt, statystyki.zwyciestwa as zw, statystyki.rozgrywki as roz, gry.name as gra from konto inner join (gry inner join statystyki on gry.id=statystyki.gra) on konto.id=statystyki.kto where konto.name='".$name."' order by gry.name";
    $res = pg_query($connection, $sql);
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

        <title>Profil <?=$name?></title>
    </head>
    <body>
    <div class='panel_gorny'>
            <div class='pan_top'><a href='zgraja.php' class='gora_a'>Home</a></div>
            <div class='pan_top' style='border-bottom: 1px solid white;'><a href='edit.php' class='gora_a'>Profil</a></div>
            <div class='pan_top'><a href='mess.php' class='gora_a'>Messages</a></div>
            <div class='pan_top'><a href='transform.php' class='gora_a' id='przekierowanie_str2' onmouseenter='info_przekier()' onmouseleave='info_out()'>Gry multiplayer</a></div>
            <div class='pan_top'><a href='logout.php' class='gora_a'>Log out</a></div>
        </div>

    <div id='left'>
        <div id='prof'>
            <div id='prof_img'><img id='img_on_prof' src='<?= $img_path ?>'></div>
            <div id='prof_name'><?=$name?></div>
        </div>
        <div id='stats'>
            <b>Gra</b>: suma pkt --- zwycięstwa --- odbyte rogrywki</br></br>
            <?php
            while($row = pg_fetch_assoc($res))
            {
                echo "<b>".$row['gra']."</b>: ".$row['pkt']."pkt --- ".$row['zw']." --- ".$row['roz']."</br>";
            }
            ?>
        </div>
    </div>

    <div id='edit'>
        <audio controls><source src='piesn zemsty.mp3' type='audio/mp3'></audio>
        <?php if($error_edit!="none") echo "<div id='edit_ses'>".$error_edit."</div>"; $error_edit="none";?>
        <div class='dopisek' style="margin-top: 15px;";>Polecam <u>NIE</u> zmieniać <b>JEDNOCZEŚNIE</b> i hasła, i nicku</div></br>
        <form action='edit.php' method='post'>
        <div class='editing'>Nowa nazwa użytkownika: <input type='text' name='new_name' placeholder='twoja nowa nazwa'></div>
        <div class='editing'>Nowe hasło: <input type='password' name='pass2' placeholder='nowe hasło'></div>
        <div class='editing'>Potwierdź nowe hasło: <input type='password' name='pass1' placeholder='jeszcze raz to samo hasło'></div>
        <div class='editing'>Stare hasło: <input type='password' id='old_pass' name='old_pass' placeholder='hasło, którego dotychczas używałeś'></div>
        <div class='editing'><input type='submit' value='change'></div>
        </form>
    </div>
    </body>
</html>
