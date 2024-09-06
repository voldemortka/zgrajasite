<?php
    require 'vendor/autoload.php';
    use \Firebase\JWT\JWT;

    session_start();
    require_once("connect.php");
    $connection = mysqli_connect($host, $db_user, $db_password, $db_name);

    $name = $_SESSION['username'];
    if(!isset($_SESSION['id'])){
        $sql1 = "select id from konto where name=".$name;
        $res = mysqli_query($connection, $sql1);
        $row = mysqli_fetch_row($res);
        $id = $row[0];
    } else $id = $_SESSION['id'];

    $sql2 = "select id from aktualne where gra=7";
    $sql3 = "select id from ruch where gra=7 and action=4";
    $res2 = mysqli_query($connection, $sql2);
    $res3 = mysqli_query($connection, $sql3);
    if($res3 -> num_rows >0 || $res2 -> num_rows>5) header('Location: transform.php');
    
    //tu już na 100% wchodzimy do gry
    $nr = $res2 -> num_rows;
    $sql6 = "select id from aktualne where gra=7 and kto=".$id;
    $res6 = mysqli_query($connection, $sql6);
    if($res6 -> num_rows ==0){
        $sql4 = "insert into aktualne(id, gra, kto, alive, in_game, pkt, linie) values (NULL, 7, ".$id.", 1, 0, 0, 0)";
        mysqli_query($connection, $sql4);
    }

    $tab = [];
    $sql7 = "select konto.name as name from konto inner join aktualne on konto.id=aktualne.kto where aktualne.gra=7 order by aktualne.id";
    $res = mysqli_query($connection, $sql7);
    while($row = $res -> fetch_assoc()){
        $tab[] = $row['name'];
    }

    $dane1 = [
        //'iss' => 'http://zgrajasite.kesug.com',
        'iss' => "http://localhost/mine/zgraja%20site",
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
        //'iss' => 'http://zgrajasite.kesug.com',
        'iss' => "http://localhost/mine/zgraja%20site",
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
    localStorage.setItem('pacy1_token', '<?= $jwt1 ?>');
    localStorage.setItem('pacy2_token', '<?= $jwt2 ?>');
    
    // Przekierowanie do strony z grą
    window.location.href = 'http://localhost/mine/zgrajasite%20node/pacman2/index.html';
    </script>