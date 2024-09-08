<?php

session_start();
require_once("connect.php");
$connection = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_password port=$port");

$sql1 = "delete from ruch where gra=3";
pg_query($connection, $sql1);

$sql2 = "select konto.id from konto inner join aktualne on konto.id=aktualne.kto where aktualne.gra=3 and konto.const=0";
$res = pg_query($connection, $sql2);
while($row = pg_fetch_assoc($res)){
    $sql3 = "delete from konto where id=".$row[0];
    pg_query($connection, $sql3);
}

$sql4 = "delete from aktualne where gra=3";
pg_query($connection, $sql4);

header('Location: transform.php');
