<?php
print_r($_SERVER);
$allowedOrigins = [
    'https://example.com',
    'https://staging.example.com' ,
    'https://production.example.com' ,
    'http://localhost:4200'
 ];
 $url = 'http://'.$_SERVER['HTTP_HOST'].':4200';
 //echo($url);
 if(in_array($url, $allowedOrigins))
 {
     $http_origin = $url;
 } else {
     $http_origin = "https://example.com";
 }

header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Origin: $http_origin");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

header('Authorization: Bearer <token>');

header("Allow: GET, POST, OPTIONS, PUT, DELETE");
//header('Content-Type: text/html; charset=UTF-8');
header('Content-Type: application/json; charset=utf-8');
//header('Content-Type: application/x-www-form-urlencoded');

$method = $_SERVER['REQUEST_METHOD'];
//$method = $_POST['METHOD'];
//validarBerarToken();
if ($method == 'GET') {
    session_start();
    //echo session_id();
    echo getID();
}

if ($method == 'POST') {
    //$var = filter_input_array(INPUT_POST);
    $post = @file_get_contents('php://input');    //Obtenga el solicitante, la función de @ es la advertencia de escudo, eliminando.
    //$post =  json_decode($post, true);            //Análisis de una matriz
    echo $post;
    die; // Imprimir datos de resultados
}

function getID()
{
    $id = $_GET['id'];
    $nombre = $_GET['nombre'];
    $datos = [];
    $datos['id'] = $id;
    $datos['nombre'] = $nombre;
    //array_push($datos,$id,$nombre);
    $json = json_encode($datos);
    return $json;
}


function validarBerarToken()
{
    define('Bearer', 'Bearer 5dfa8ba01b5bde00019152fa328d1a3902e0462e8afa32c90efcc7b6');
    define('ADMIN_PASSWORD', 'mypass'); // Could be hashed too.
    $headers = getallheaders();
    if (
        !isset($headers['Authorization']) || ($headers['Authorization'] != Bearer)
    ) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Password For Blog"');
        exit("Access Denied: error Authorization. Bearer");
    }
}
