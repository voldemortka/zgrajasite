<?php
echo json_encode(["message" => "I'm here"]);
require_once("../connect.php");
$connection = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_password port=$port");

session_start();
$name = $_SESSION['username'];

$data = json_decode(file_get_contents("php://input"));

if($data){
    $pkt = $data -> pkt;

    $sql_check = "select Statystyki.id from Konto inner join ( Gry inner join Statystyki on Gry.id = Statystyki.gra ) on Konto.id = Statystyki.kto where Gry.name='Wonsz 1.0' and Konto.name = '".$name."';";
    $res_check = pg_query($connection, $sql_check);
    if(pg_num_rows($res_check) >0)
    {
        $sql = "update Konto inner join ( Gry inner join Statystyki on Gry.id = Statystyki.gra ) on Konto.id = Statystyki.kto set Statystyki.pkt = ".$pkt.", Statystyki.rozgrywki=Statystyki.rozgrywki+1 where Gry.name='Wonsz 1.0' and Konto.name = '".$name."';";
        $res = pg_query($connection, $sql);
    }
    else
    {
        $sql_kto = "select id from Konto where name='".$name."'";
        $res_kto = pg_query($connection, $sql_kto);
        $row_kto = pg_fetch_row($res_kto);
        $kto = $row_kto[0];

        $sql_gra = "select id from Gry where name='Wonsz 1.0';";
        $res_gra = pg_query($connection, $sql_gra);
        $row_gra = pg_fetch_row($res_gra);
        $gra = $row_gra[0];

        $sql = "insert into Statystyki (id,gra,kto,pkt,zwyciestwa,rozgrywki) values (NULL, ".$gra.", ".$kto.",".$pkt.", -1, 1);";
        $res = pg_query($connection, $sql);
    }

}
