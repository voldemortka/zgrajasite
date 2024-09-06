<?php
    session_start();
    if(!isset($_SESSION['who'])) header('Location: index.php');
    if($_SESSION['who']!='zgraja') header('Location: zgraja.php');
    
    if(isset($_POST['pass']) && isset($_POST['name']))
    {
        require_once("connect.php");
        $connection = mysqli_connect($host, $db_user, $db_password, $db_name);

        $pass = $_POST['pass']; unset($_POST['pass']);
        $un = $_POST['name']; unset($_POST['name']);
        echo $un."</br>";
        
        $sql_check = "select pass, id from konto where name='".$un."';"; //wypierz hasło z takim nickiem
        $res_baza = mysqli_query($connection, $sql_check);
        $row_baza = mysqli_fetch_row($res_baza);

        $OK=true;
        if($res_baza->num_rows == 1) $pass_baza = $row_baza[0]; else $OK=false;
        if($OK && password_verify($pass, $pass_baza)){
            $_SESSION['zalogowany']=true;
            $_SESSION['username'] = $un;
            $_SESSION['id']=$row_baza[1];
            header('Location: zgraja.php');
        }
        else echo "Error";
    
    }
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

        <title>Logowanie</title>
    </head>
    <body>
        <h3>Witam ponownie!</h3>
        <div class='logg_panel'>
            <form action='logowanie.php' method='post'>
                <div class='pan_log'><label>Username<input type='text' placeholder='wprowadź nazwę' name='name'></label></div>
                <div class='pan_log'><label>Password<input type='password' placeholder='wprowadź hasło' name='pass'></label></div>
                <div class='pan_log'><input type='submit' value='send'></div>
            </form>
            <div id='log-create'><a href='create.php'>Nie masz konta?</a></div>
        </div>
    </body>
</html>