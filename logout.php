<?php
session_start();
$_SESSION['zalogowany']=false;
$_SESSION['username'] = "";
unset($_SESSION['username']);
header('Location: zgraja.php');
