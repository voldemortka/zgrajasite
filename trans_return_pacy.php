<?php
    session_start();
    $name = $_SESSION['username'];
    $id = $_SESSION['id'];
    require_once("connect.php");
    $connection = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_password port=$port");

    $sql1 = "select konto.name as name, aktualne.pkt as pkt from konto inner join aktualne on konto.id=aktualne.kto where aktualne.gra=7 order by pkt desc limit 1";
    $res = pg_query($connection, $sql1);
    $row = pg_fetch_row($res);
    $max_name = $row[0];
    $max_pkt = $row[1];

    $sql3 = "select id from ruch where gra=7 and action=12";
    $res = pg_query($connection, $sql3);
    if(pg_num_rows($res) ==0){
        $sql2 = "select konto.name as name from konto inner join ruch on konto.id=ruch.kto where ruch.action=6 and ruch.gra=7 order by ruch.id desc limit 1";
        $res = pg_query($connection, $sql2);
        $row = pg_fetch_row($res);
        $last_snake = $row[0];    
    } else $last_snake="Gra przerwana";

?>

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
        <title>Wonsz 3.0 -> podsumowanie</title>
    </head>
    <body>
        <h3>Podsumowanie</h3>
        <div id='podsumowanie'>
            <!-- <div class='pods'>
                <h4>Największa ilość punktów:</h4>
                <?//$max_name.": ".$max_pkt?>
            </div> -->
            <div id='again'><a href='clear_pacy.php'>Wróć do gier</a></div>
        </div>

        <script src="jquery-3.7.1.min.js"></script>
        <script src="wonsz.js"></script>
    </body>
</html>
