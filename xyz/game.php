<?php
    if(!isset($_POST['pass1']) && $_POST['kategoria1']) header('Location: index.html');

    $password = $_POST['pass1'];
    $kat = $_POST['kategoria1'];

    $passes = [$_POST['pass1'], $_POST['pass2'], $_POST['pass3'], $_POST['pass4'], $_POST['pass5'], $_POST['pass6'], $_POST['pass7'], $_POST['pass8'], $_POST['pass9'], $_POST['pass10']];
    $kats = [$_POST['kategoria1'], $_POST['kategoria2'], $_POST['kategoria3'], $_POST['kategoria4'], $_POST['kategoria5'], $_POST['kategoria6'], $_POST['kategoria7'], $_POST['kategoria8'], $_POST['kategoria9'], $_POST['kategoria10']];

    //$pass = preg_replace("/[a-zA-Z]/", "<div class='empty'></div>", $password);
   // $pass = preg_replace("/[\p{L}]/u", "?", $password);
    //$pass = str_replace(" ", "     ", $pass);
    //$password = str_replace(" ", "     ", $password);

   // $for_js = "'".$password."', '".$pass."'";
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
        <link rel='website icon' href='' type='png'/>
        <title>Guess the sentence</title>
    </head>
    <body onload='start(<?php echo json_encode(["passes" => $passes, "kats" => $kats]); ?>)'>
        <div id='go_back'><a href='index.html'>Ustaw nowe hasło</a></div>
        <div id='go_back' onclick='next()'>POKAŻ HASŁO</div>
        <div id='nr'>1</div>
        <div id='kat'>Kategoria</div>
        <div id="kategoria"><?=$kat?></div>
        <div id='pass_box'></div>

        <div id="alfabet"></div>

        <script src="jquery-3.7.1.min.js"></script>
        <script src="game.js"></script>
    </body>
</html>
