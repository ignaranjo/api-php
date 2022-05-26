<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
include_once ($_SERVER['DOCUMENT_ROOT'].'/api/producto/dirs.php');
include_once CONTROLLER_PATH.'/productoControlador.php';
$pm = new productoControlador();
//var_dump(isset($_GET['id']));  
if ($method == 'GET' && isset($_GET['id'])) {
    return $pm->getCarritoCotizator($_GET['id']);
}
if ($method == 'DELETE' && isset($_GET['id'])) {
    //echo $_GET['id_producto'];
    //echo intval($_GET['id_producto']);
    return $pm->deleteCarritoCotizator($_GET['id'], intval($_GET['id_producto']));
}

?>
