<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

include_once ($_SERVER['DOCUMENT_ROOT'].'/api/producto/dirs.php');
include_once CONTROLLER_PATH.'/administracionModelo.php';

$method = $_SERVER['REQUEST_METHOD'];

$pm = new detalleControlador();
if ($method == 'GET' && isset($_GET['id'])) {
    //return $pm->getTermination_controlador($_GET['id']);
    return $pm->getDetalleProducto($_GET['id']);
}

if ($method == 'GET') {
    //return $pm->getTermination_controlador($_GET['id']);
    return $pm->getDetalleProducto($_GET['id']);
}

if ($method == 'PUT' && isset($_GET['id'])) {
    //return $pm->getTermination_controlador($_GET['id']);
    return $pm->getDetalleProducto($_GET['id']);
}

if ($method == 'DELETE' && isset($_GET['id'])) {
    //return $pm->getTermination_controlador($_GET['id']);
    return $pm->getDetalleProducto($_GET['id']);
}

if ($method == 'POST' && isset($_GET['id'])) {
    //return $pm->getTermination_controlador($_GET['id']);
    return $pm->getDetalleProducto($_GET['id']);
}
?>