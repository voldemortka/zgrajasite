<?php

session_start();
require_once("connect.php");
$connection = mysqli_connect($host, $db_user, $db_password, $db_name);

$sql1 = "delete from ruch where gra=7";
mysqli_query($connection, $sql1);

$sql2 = "select konto.id from konto inner join aktualne on konto.id=aktualne.kto where aktualne.gra=7 and konto.const=0";
$res = mysqli_query($connection, $sql2);
while($row = $res -> fetch_assoc()){
    $sql3 = "delete from konto where id=".$row[0];
    mysqli_query($connection, $sql3);
}

$sql4 = "delete from aktualne where gra=7";
mysqli_query($connection, $sql4);

header('Location: transform.php');