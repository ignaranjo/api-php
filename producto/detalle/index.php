<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];

include_once ($_SERVER['DOCUMENT_ROOT'].'/api/producto/dirs.php');
include_once CONTROLLER_PATH.'/detalleControlador.php';
$pm = new detalleControlador();
if ($method == 'GET' && isset($_GET['id'])) {
    //return $pm->getTermination_controlador($_GET['id']);
    return $pm->getDetalleProducto($_GET['id']);
}
?>
