<?php
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');
/*header('Authorization: Bearer <token>');*/

include_once($_SERVER['DOCUMENT_ROOT'] . '/api/producto/dirs.php');
include_once ROOT_PATH . '/loginControlador.php';

$method = $_SERVER['REQUEST_METHOD'];
$pm = new loginControlador();

if ($method == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    //print_r($data);
    $producto = $data['productos'];
    $contacto = $data['contacto'];

    $to = "ignacio.inl@gmail.com, bastian.garcia@dicoinchile.cl, oscar.novoa@dicoinchile.cl";
    $subject = "Asunto del email";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    //foreach ($terminacionList as $producto)

    $message ="<html>
                <head>
                <title>HTML</title>
                </head>
                <body>
                <h1>Datos de contacto</h1>
                <h4>Nombre: <b>".$contacto['nombre']."</b></h4>
                <h4>Correo: <b>".$contacto['correo']."</b></h4>
                <h4>Telefono: <b>".$contacto['telefono']."</b></h4>";

                if($contacto['rut'] != ""){
                    $message.="<h4>Telefono: <b>".$contacto['rut']."</b></h4>";
                }
                if($contacto['direccion'] != ""){
                    $message.="<h4>Direccion: <b>".$contacto['direccion']."</b></h4>";
                }
                if($contacto['region'] != ""){
                    $message.="<h4>Region: <b>".$contacto['region']."</b></h4>";
                }
                if($contacto['comuna'] != ""){
                    $message.="<h4>Comuna: <b>".$contacto['comuna']."</b></h4>";
                }
                if($contacto['comentario'] != ""){
                    $message.="<h4>Comentario: <b>".$contacto['comentario']."</b></h4>";
                }
                
                $message.="<br>
                <br>
                <h1>Datos de la corizacion</h1>
                <table border='1'>
                <tbody>
                    <tr>
                        <td><strong>Producto</strong></td>
                        <td><strong>Cantidad</strong></td>
                        <td><strong>Largo</strong></td>
                        <td><strong>Terminacion</strong></td>
                        <td><strong>Espesor</strong></td>
                        <td><strong>Color</strong></td>
                        <td colspan='2'><strong>Cumbrera</strong></td>
                        <td colspan='2'><strong>Anticondensante</strong></td>
                        <td colspan='2'><strong>Perforable</strong></td>
                        <td colspan='2'><strong>Curvo</strong></td>
                    </tr>";
                    $variables = array(
                        "--nombre--",
                        "--cantidad--",
                        "--medida--",
                        "--terminacion--",
                        "--espesor--",
                        "--color--",
                        "--producto_cumbrera--",
                        "--producto_cumbrera_medida--",
                        "--producto_anticondensante--",
                        "--producto_anticondensante_medida--",
                        "--producto_perforable--",
                        "--producto_perforable_medida--",
                        "--producto_curvo--",
                        "--producto_curvo_medida--"
                    );

                    foreach ($producto as $prod){
                        $rep = array(
                            $prod['nombre'],
                            $prod['cantidad'],
                            $prod['medida'],
                            $prod['terminacion'],
                            $prod['espesor'],
                            $prod['color'],
                            
                            $prod['producto_cumbrera'],
                            $prod['producto_cumbrera_medida'],
                            $prod['producto_anticondensante'],
                            $prod['producto_anticondensante_medida'],
                            $prod['producto_perforable'],
                            $prod['producto_perforable_medida'],
                            $prod['producto_curvo'],
                            $prod['producto_curvo_medida']
                        );
                        $table="
                        <tr>
                            <td rowspan='2'>--nombre--</td>
                            <td rowspan='2'>--cantidad--</td>
                            <td rowspan='2'>--medida--</td>
                            <td rowspan='2'>--terminacion--</td>
                            <td rowspan='2'>--espesor--</td>
                            <td rowspan='2'>--color--</td>
                            
                            <td>Opcion</td>
                            <td>Medida</td>
                            <td>Opcion</td>
                            <td>Medida</td>
                            <td>Opcion</td>
                            <td>Medida</td>
                            <td>Opcion</td>
                            <td>Medida</td>
                        </tr>
                        <tr>
                            <td>--producto_cumbrera--</td>
                            <td>--producto_cumbrera_medida--</td>
                            <td>--producto_anticondensante--</td>
                            <td>--producto_anticondensante_medida--</td>
                            <td>--producto_perforable--</td>
                            <td>--producto_perforable_medida--</td>
                            <td>--producto_curvo--</td>
                            <td>--producto_curvo_medida--</td>
                        </tr>";
                    $response = str_replace($variables, $rep, $table);
                    $message.=$response;
                    }
                    $message.="</tbody></table>";
//print_r($message);
//$message = str_replace('--cantidad--', $data[0]['cantidad'], $message);
mail($to, $subject, $message, $headers);
echo 'Mail enviado con exito';

    //return $pm->getAllProduct();
}
//$request = $_SERVER['REQUEST_URI'];
//$arr_request = explode('/', $request);
?>