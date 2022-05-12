<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
include_once './controller/detalleControlador.php';
$pm = new detalleControlador();
if ($method == 'GET' && isset($_GET['id'])) {
    return $pm->getTermination_controlador($_GET['id']);
}
?>
