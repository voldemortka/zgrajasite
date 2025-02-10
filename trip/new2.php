<?php
$OK=false;
    if(isset($_POST['inp'])){
        require_once("connect.php");
        $connection = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_password");

        $sql = "INSERT INTO trip (pyt, xxx) VALUES ($1, 1)";
        pg_query_params($connection, $sql, [$_POST['inp']]);
        $OK=true;
    }
?>

<!DOCTYPE html>
<html lang='pl'>
    <head>
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='style.css' type='text/css'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta hettp-equiva='X-UA-Compatible' content='IE-edge.chrome=1' />
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap' rel='stylesheet'>        
        <title>Kraczek</title>
    </head>
    <body>

        <a id="back" href="index.html">Do głównej stronki</a>

        <p>Tutaj lecą pytania o odpowiedzi długiej i złożonej XD</p>

        <?= $OK ? "<p>Ta, dodało</p>" : ""?>

        <form action="new2.php" method="post">
            <input type=1 name='inp' size=70>
            <input type='submit' value='send'>
        </form>

    </body>
</html>