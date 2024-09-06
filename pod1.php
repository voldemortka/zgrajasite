<?php
    session_start();
    if($_SESSION['who']!='ja') header('Location: zgraja.php');
    require_once("connect.php");
    $connection = mysqli_connect($host, $db_user, $db_password, $db_name);

    if(isset($_POST['ids'])){
        
    }
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
        <title>Podgląd (rozgrywki)</title>
    </head>
    <body style='background-color: black;'>
        <div class='back_ja'><a href='podglad.php' style='color: #00ff00;'>Back</a></div>
        <div id='selection__ja'>
            <div class='podglad'>gra - in_game? - czas gry - kto: id-nazwa-const?</div></br>
            <?php
                $sql = "select gry.name as gra, konto.id as kto_id, konto.name as kto, aktualne.czas as time, aktualne.in_game as czy, konto.const as const from gry inner join (konto inner join aktualne on konto.id=aktualne.kto) on gry.id=aktualne.gra order by gra, czy, time;";
                $res = mysqli_query($connection, $sql);
                while($row = $res -> fetch_assoc()){
                    echo "<div class='podglad'>".$row['gra']." - ".$row['czy']." - ".$row['time']." - ".$row['kto_id']." - ".$row['kto']." - ".$row['const']."</div>";
                }
            ?>
            </br>
            <form action='pod1.php' method='post'>
                <div class='podglad'><input type='text' name='ids'><input type='submit' value='send'></div>
            </form>
        </div>
    </body>
</html>