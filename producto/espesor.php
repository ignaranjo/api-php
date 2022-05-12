<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');
/*
header('Authorization: Bearer <token>');*/

$method = $_SERVER['REQUEST_METHOD'];
include_once './controller/espesorControlador.php';
$pm = new espesorControlador();

if ($method == 'GET') {
    return $pm->getEspesor_controlador();
}