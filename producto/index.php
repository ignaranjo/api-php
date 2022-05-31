<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');
/*header('Authorization: Bearer <token>');*/

include_once($_SERVER['DOCUMENT_ROOT'] . '/api/producto/dirs.php');
include_once CONTROLLER_PATH . '/categoriaControlador.php';

$method = $_SERVER['REQUEST_METHOD'];
$pm = new categoriaControlador();
//var_dump(isset($_GET['id']));  
if ($method == 'GET' && isset($_GET['id'])) {
    //return $pm->getProduct($_GET['id']);
    return $pm->getProduct($_GET['id']);
}

if ($method == 'GET' && isset($_GET['categoria'])) {
    //return $pm->getProduct($_GET['id']);
    return $pm->getProductCategoria_controller($_GET['categoria']);
}

if ($method == 'GET') {
    return $pm->getAllProduct();
}
//$request = $_SERVER['REQUEST_URI'];
//$arr_request = explode('/', $request);
