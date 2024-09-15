<?php
    require 'vendor/autoload.php';
    use \Firebase\JWT\JWT;

    session_start();
    require_once("connect.php");
    $connection = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_password port=$port");

    $name = $_SESSION['username'];
    if(!isset($_SESSION['id'])){
        $sql1 = "select id from konto where name='$name'";
        $res = pg_query($connection, $sql1);
        $row = pg_fetch_row($res);
        $id = $row[0];
    } else $id = $_SESSION['id'];

    $sql2 = "select id from aktualne where gra=7";
    $sql3 = "select id from ruch where gra=7 and action=4";
    $res2 = pg_query($connection, $sql2);
    $res3 = pg_query($connection, $sql3);
    if(pg_num_rows($res3) >0 || pg_num_rows($res2)>5) header('Location: transform.php');
    
    //tu już na 100% wchodzimy do gry
    $nr = pg_num_rows($res2);
    $sql6 = "select id from aktualne where gra=7 and kto=".$id;
    $res6 = pg_query($connection, $sql6);
    if(pg_num_rows($res6) ==0){
        $sql4 = "insert into aktualne(gra, kto, alive, in_game, pkt, linie) values (7, ".$id.", 1, 0, 0, '{}')";
        pg_query($connection, $sql4);
    }

    $tab = [];
    $sql7 = "select konto.name as name from konto inner join aktualne on konto.id=aktualne.kto where aktualne.gra=7 order by aktualne.id";
    $res = pg_query($connection, $sql7);
    while($row = pg_fetch_assoc($res)){
        $tab[] = $row['name'];
    }

    $dane1 = [
        'iss' => 'https://zgrajasite.onrender.com',
        //'iss' => "http://localhost/mine/zgraja%20site",
        'iat' => time(),
        'exp' => time() + 3600, // Token ważny przez 1 godzinę
        'data' => [
            'name' => $name,
            'id' => $id,
            'nr' => $nr,
            'tab' => $tab
        ]
    ];
    $dane2 = [
        'iss' => 'https://zgrajasite.onrender.com',
        //'iss' => "http://localhost/mine/zgraja%20site",
        'iat' => time(),
        'exp' => time() + 3600, // Token ważny przez 1 godzinę
        'data' => [
            'id' => $id,
        ]
    ];
    
    
    $jwt1 = JWT::encode($dane1, "zgrajasite_pacy1", "HS256");
    $jwt2 = JWT::encode($dane2, "zgrajasite_pacy2", "HS256");
    ?>
    
    <script>
    // Zapisanie tokenu w localStorage
    // localStorage.setItem('pacy1_token', '<? $jwt1 ?>');
   // localStorage.setItem('pacy2_token', '<? $jwt2 ?>'); 

    document.cookie = "pacy1_token=" + $jwt1 + "; SameSite=None; Secure; path=/";
    document.cookie = "pacy2_token=" + $jwt2 + "; SameSite=None; Secure; path=/";

    
    // Przekierowanie do strony z grą
    window.location.href = 'https://zgrajasitenode.onrender.com/pacman2/';
    </script>
