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

    $sql2 = "select id from aktualne where gra=3";
    $sql3 = "select id from ruch where gra=3 and action=4";
    $res2 = mysqli_query($connection, $sql2);
    $res3 = mysqli_query($connection, $sql3);
    if($res3 -> num_rows >0 || $res2 -> num_rows>9) header('Location: transform.php');
    
    //tu już na 100% wchodzimy do gry
    $sql5 = "select kolor.id as id from kolor left join aktualne on kolor.id=aktualne.kolor where aktualne.kolor is NULL limit 1";
    $res = mysqli_query($connection, $sql5);
    $row = mysqli_fetch_row($res);
    $col = $row[0];    

    $nr = $res2 -> num_rows;
    $sql6 = "select id from aktualne where gra=3 and kto=".$id;
    $res6 = mysqli_query($connection, $sql6);
    if($res6 -> num_rows ==0){
        $sql4 = "insert into aktualne(id, gra, kto, alive, in_game, pkt, linie, kolor) values (NULL, 3, ".$id.", 1, 0, 0, 0, ".$col.")";
        mysqli_query($connection, $sql4);
    }

    $sql11 = "select kolor.id as id, kolor.hex as hex, konto.name as name from konto inner join (kolor inner join aktualne on kolor.id=aktualne.kolor) on konto.id=aktualne.kto";
    $res = mysqli_query($connection, $sql11);
    $kolory = [];
    while($row = $res -> fetch_assoc()){
        $kolory[] = array(
            'hex' => $row['hex'],
            'name' => $row['name']
        );
    }

    $sql7 = "select id, name, hex from kolor order by id";
    $res = mysqli_query($connection, $sql7);
    $barwy = [];
    while($row = $res -> fetch_assoc()){
        $barwy[] = array(
            'id' => $row['id'],
            'hex' => $row['hex'],
            'name' => $row['name']
        );
    }



    //twój kolor, ten wygenerowany lub ustalony wcześniej:
    $sql12 = "select kolor.hex as hex from kolor inner join aktualne on kolor.id=aktualne.kolor where aktualne.gra=3 and aktualne.kto=".$id;
    $res = mysqli_query($connection, $sql12);
    $row = mysqli_fetch_row($res);
    $hex = $row[0];

    $spis = [];
    $sql8 = "select konto.name as name from konto inner join aktualne on konto.id=aktualne.kto where aktualne.gra=3 order by aktualne.id";
    $res = mysqli_query($connection, $sql8);
    while($row = $res -> fetch_assoc()){
        $spis[] = $row['name'];
    }
    print_r($spis);

    $dane1 = [
        //'iss' => 'http://zgrajasite.kesug.com',
        'iss' => "http://localhost/mine/zgraja%20site",
        'iat' => time(),
        'exp' => time() + 3600, // Token ważny przez 1 godzinę
        'data' => [
            'name' => $name,
            'id' => $id,
            'hex' => $hex,
            'nr' => $nr,
            'kolory' => $kolory,
            'barwy' => $barwy,
            'spis' => $spis
        ]
    ];
    //print_r($dane1);
    $dane2 = [
        //'iss' => 'http://zgrajasite.kesug.com',
        'iss' => "http://localhost/mine/zgraja%20site",
        'iat' => time(),
        'exp' => time() + 3600, // Token ważny przez 1 godzinę
        'data' => [
            'name' => $name,
            'id' => $id,
            'hex' => $hex,
            'nr' => $nr
        ]
    ];
    
    
    $jwt1 = JWT::encode($dane1, "zgrajasite_snake1", "HS256");
    $jwt2 = JWT::encode($dane2, "zgrajasite_snake2", "HS256");
    ?>
    
    <script>
    // Zapisanie tokenu w localStorage
    localStorage.setItem('snake1_token', '<?= $jwt1 ?>');
    localStorage.setItem('snake2_token', '<?= $jwt2 ?>');
    
    // Przekierowanie do strony z grą
    window.location.href = 'http://localhost/mine/zgrajasite%20node/wonsz3/index.html';
    </script>