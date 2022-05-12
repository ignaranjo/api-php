<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
include_once './productoControlador.php';
$pm = new productoControlador();
/* if ($method == 'GET' && isset($_GET['id'])) {
    //return $pm->getProduct($_GET['id']);
    return $pm->getProduct($_GET['id']);
}
 */
if ($method == 'GET') {
    return $pm->getAllCategoria();
}
?>
