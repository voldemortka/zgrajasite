<?php
 require_once("connect.php");
    $connection = mysqli_connect($host, $db_user, $db_password, $db_name);

    $sql = "select pyt from trip where xxx=0";
    $res = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_row($res)){
        $tab[]=$row[0];
    }

    while(count($tab)!=0){
        $i = random_int(0, count($tab)-1);
        $pytanie = $tab[$i];
        unset($tab[$i]);
        $tab = array_values($tab);
        $array[]=$pytanie;
    }

?>

<!DOCTYPE html>
<html lang='pl'>
    <head>
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='style.css' type='text/css'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta hettp-equiva='X-UA-Compatible' content='IE-edge.chrome=1' />
        <title>Kraczek</title>
    </head>
    <body>

        <div id="yyy">
            <div id="pytanka"></div>
            <button onclick='x()'>Next question</button>
        </div>

        <script src='jquery-3.7.1.min.js'></script>

        <script>
            var i=0;

            function x(){
               var tab2 = <?=json_encode($array)?>;
               
               $('#pytanka').html(tab2[i]);
               i++;
               if(i>tab2.length) $('#yyy').html("Pytania się skończyły");
               
            }
        </script>

    </body>
</html>