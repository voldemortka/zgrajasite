<?php
session_start();
$name = $_SESSION['username'];
$id = $_SESSION['id'];
require_once("connect.php");
$connection = mysqli_connect($host, $db_user, $db_password, $db_name);

$sql1 = "select konto.name as name, aktualne.pkt as pkt from konto inner join aktualne on konto.id=aktualne.kto order by aktualne.pkt";
$res = mysqli_query($connection, $sql1);
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
        <title>Kropki summary</title>
    </head>
    <body>
    <h1>Podsumowanie</h1>
        <div id='podsumowanie'>
            <?php
                while($row = $res -> fetch_assoc()){
                    echo $row['name']." -> ".$row['pkt']."<br>";
                }
            ?>
        </div>
            <div id='again'><a href='clear_dot.php'>Wróć do gier</a></div>
        </div>
    </body>
</html>