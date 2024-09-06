<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css" type="text/css"/>
        <link rel="website icon" href="Right.jpg" type="jpg"/>
        <meta hettp-equiva="X-UA-Compatible" content="IE-edge.chrome=1" />
        <title>Pacman</title>
    </head>
    <body onload='pacy()'>
        <div id="left">
            <div class="start" onclick='start()'>Start</div>
            <div id="licznik">Eaten fruts count: 0</div>
            <div id="PointsCount">Points: 0</div>
            <div id="finish"></div>
        </div>
        <div id="plansza">
            <?php
                for($i=0;$i<322;$i++)
                    echo "<div class='pole' id='p".$i."'><img src='point.png'></div>";
            ?>
        </div>
        <div style="clear:both;"></div>

        <script src="jquery-3.7.1.min.js"></script>
        <script src="pacman1.js"></script>

    </body>
</html>
