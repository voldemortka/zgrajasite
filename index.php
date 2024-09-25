<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <meta hettp-equiva="X-UA-Compatible" content="IE-edge.chrome=1" />
        <link rel="website icon" href="zenszen.jpg" type="png"/>
        <title>Verification</title>
    </head>
    <body>
        <h1>Enter code - if u're one of us, u must know it</h1>
        <form method='post' action='check.php'>
            <div id='entercode'><input id='code_start' type='password' name='entercode' placeholder='Type the code here and hit ENTER'></div>
            <input type='submit' value='check'>
        </form>

        <a href='xyz/index.html'>Dla Mamy Karoliny</a>

        <?php
            
            if(isset($_SESSION['error_entered_code'])) {echo "<div id='error_index'>".$_SESSION['error_entered_code']."</div>"; unset($_SESSION['error_entered_code']);}
        ?>

    </body>
</html>
