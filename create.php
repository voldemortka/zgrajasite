<?php
//print_r($_POST);
//print_r($_FILES);

    session_start();
    if(!isset($_SESSION['who'])) header('Location: index.php');
    if($_SESSION['who']!='zgraja') header('Location: zgraja.php');

    if(isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['robot']) && isset($_POST['organ']) && isset($_POST['name']))
    {
        require_once("connect.php");
       $connection = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_password port=$port");
    
        $name = $_POST['name']; unset($_POST['name']);
        $pass1 = $_POST['pass1']; unset($_POST['pass1']);
        $pass2 = $_POST['pass2']; unset($_POST['pass2']);

        $OK=true;

        if($pass1!=$pass2) $OK=false;
        
        $hash = password_hash($pass1,PASSWORD_DEFAULT);
/*
        if(!getimagesize($_FILES['zdj']['tmp_name'])) $OK=false;
        else{
            //$name_prof = uniquid('',true).".".pathinfo($_FILES['zdj']['name'],PATHINFO_EXTENSION);
            //echo $name_prof."</br>";
            $path_prof = 'profilowe/'.$_FILES['zdj']['name'];

            if(!move_uploaded_file($_FILES['zdj']['tmp_name'],$path_prof)) $OK=false;
        }
*/
        
        if($OK)
        {
            $sql = "insert into konto(id, name, pass, img, const) VALUES (NULL, '".$name."', '".$hash."','',1)";
            $res = pg_query($connection, $sql);
            $done=true;
        }
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

        <title>Tworzenie konta</title>
    </head>
    <body>
        <h3>Witam wśród nas...</h3>
        <div class='logg_panel'>
            <?php
                if(!isset($done) || !$done){
                    echo"
                        <form action='create.php' method='post' enctype='multipart/form-data'>
                        <div class='pan_log'><label>Nazwa użytkownika:<input type='text' placeholder='wprowadź nazwę' name='name'></label></div>
                        <div class='dopisek'>Ta nazwa będzie wyświetlana innym użytkownikom podczas grania w gry sieciowe, a także posłuży przy logowaniu</div>
                        <div class='pan_log'><label>Hasło<input type='password' placeholder='wprowadź hasło' name='pass1'></label></div>
                        <div class='pan_log'><label>Powtórz hasło<input type='password' placeholder='jeszcze raz hasło' name='pass2'></label></div>
                        
                        <div class='pan_log'><label><input type='radio' name='robot'>Nie jestem robotem XDD</label></div>
                        <div class='pan_log'><label><input type='radio' name='organ'>Wyrażam zgodę na sprzedanie moich organów</label></div>
                        <div class='pan_log'><input type='submit' value='send'></div>
                        </form>
                        <div id='log-create'><a href='logowanie.php'>Masz już konto?</a></div>
                    ";
                }
                else{
                    echo"
                        <p>Wpisany succesfully, ".$name.", możesz się zalogować</p>
                        <div id='log-create'><a href='logowanie.php'>Idź do logowania</a></div>
                    ";
                    $done=false;
                }
            ?>
        </div>
    </body>
</html>
