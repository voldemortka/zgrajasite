<?php
    require 'vendor/autoload.php';
    use \Firebase\JWT\JWT;

session_start();
require_once("connect.php");
$connection = pg_connect("host=$host dbname=$db_name user=$db_user password=$db_password port=$port");

$data = json_decode(file_get_contents('php://input'), true);

$mess_name = $data['name'];
$mess_id = $data['id'];

$name = $_SESSION['username'];
if(!isset($_SESSION['id'])){
    $sql1 = "select id from konto where name='".$name."'";
    $res = pg_query($connection, $sql1);
    $row = pg_fetch_row($res);
    $id = $row[0];
} else $id = $_SESSION['id'];


$dane = [
    'iss' => 'https://zgrajasite.onrender.com',
    //'iss' => "http://localhost/mine/zgraja%20site",
    'iat' => time(),
    'exp' => time() + 3600, // Token ważny przez 1 godzinę
    'data' => [
        'name' => $name,
        'id' => $id,
        'name2' => $mess_name,
        'id2' => $mess_id
    ]
];

$jwt1 = JWT::encode($dane, "zgrajasite_mess", "HS256");
?>

<script>
// Zapisanie tokenu w localStorage
localStorage.setItem('mess_token', '<?= $jwt1 ?>');

// Przekierowanie do strony z grą
//window.location.href = 'http://localhost/mine/zgrajasite%20node/messenger.html';
</script>
