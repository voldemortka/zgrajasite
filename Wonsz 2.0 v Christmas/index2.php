<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <link rel="website icon" href="head.png" type="png"/>
        <meta hettp-equiva="X-UA-Compatible" content="IE-edge.chrome=1" />
        <title>Snake game</title>
    </head>
    <body onload='wonsz()'>

        <div id='start' onclick='start()'>Start</div>
        <div id='count'>Eaten bugs count: 0</div>
        <div id='main'>
            <?php
                for($i=0;$i<187;$i++){
                    $x=$i%17; echo "<div class='pole' id='p".$i."'><img src='pusty2.png'></div>";
                }
                    
            ?>
        </div>
        <div style="clear:both;"></div>

        <script src="jquery-3.7.1.min.js"></script>
        <script src="wonsz.js"></script>
    </body>
</html>
