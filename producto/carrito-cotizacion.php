<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');
/*header('Authorization: Bearer <token>');*/

include_once ($_SERVER['DOCUMENT_ROOT'].'/api/producto/dirs.php');
include_once CONTROLLER_PATH.'/detalleControlador.php';
$pm = new detalleControlador();

$method = $_SERVER['REQUEST_METHOD'];
//var_dump(isset($_GET['id']));  
/* if ($method == 'GET' && isset($_GET['id'])) {
    //return $pm->getProduct($_GET['id']);
    return $pm->getProduct($_GET['id']);
}
 */
if ($method == 'GET' && isset($_GET['id_sesion'])) {
    return $pm->getProduct($_GET['id_sesion']);
}
//$request = $_SERVER['REQUEST_URI'];
//$arr_request = explode('/', $request);

if ($method == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    //$post = @file_get_contents('php://input');    //Obtenga el solicitante, la función de @ es la advertencia de escudo, eliminando.
    //$post =  json_decode($post, true);            //Análisis de una matriz
    //echo $post;
    //print_r($post);
    //print_r($data);
    //echo json_encode($data); 
    return $pm->insertProduct($data);
    die; // Imprimir datos de resultados
}
if ($method == 'DELETE' && isset($_GET['uuid'])) {
    return $pm->eliminarProduct($_GET['uuid']);
}
