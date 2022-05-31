<?php
require_once MODEL_PATH . "/administracionModelo.php";

class administracionControlador extends administracionModelo
{


    public static function getDetalleProducto($id)
    {
        /* $sql = mainModel::conectar()->prepare("SELECT * FROM producto p WHERE p.id = :ID");
        $sql->bindParam(":ID", $id);
        $sql->execute(); */

        $resp = administracionModelo::getDetalleProducto($id);
        $dataParse = $resp->fetchObject('ProductoDetalle');
        //$dataParse = $resp->fetchAll(PDO::FETCH_CLASS, 'ProductoDetalle');

        $terminacionResp = administracionModelo::getProductoDetalle_terminacion($id);
        $terminacionParse = $terminacionResp->fetchAll(PDO::FETCH_CLASS, 'Terminacion');

        $imagenesResp = administracionModelo::getProdcto_imagenes($id);
        $imagenesParse = $imagenesResp->fetchAll(PDO::FETCH_ASSOC);

        $espesorResp = administracionModelo::getProductoDetalle_espesor($id);
        $espesorParse = $espesorResp->fetchAll(PDO::FETCH_ASSOC);

        $colorResp = administracionModelo::getProductoDetalle_color($id);
        $colorParse = $colorResp->fetchAll(PDO::FETCH_ASSOC);

        $producto = new Producto();
        $producto->detalle = $dataParse;
        $producto->terminacionList = $terminacionParse;
        $producto->espesorList = $espesorParse;
        $producto->imagenesList = $imagenesParse;
        $producto->colorList = $colorParse;
        echo json_encode($producto);
    }

    /**
     * obtener detalle de los productos por opcion
     */
    /* ---------------- Modelo obtener espesor de productos ---------------- */
    public static function getTermination_controlador($id_producto)
    {
        $resp = administracionModelo::getTerminationModel($id_producto);
        //$dataParse = $resp->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($resp);
    }



    public static function getDetalleProducto_terminacion($id)
    {
        $query = "SELECT id, nombre
        FROM producto_terminacion_rel ptr LEFT JOIN producto_terminacion pt 
        ON ptr.id_terminacion = pt.id
        WHERE ptr.id_producto = :ID";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID", $id);
        $sql->execute();
        $productos = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    }

    public static function getDetalleOpciones($id_producto, $id_espesor)
    {
        $cumbreraParse = null;
        $anticondensanteParse = null;
        $perforableParse = null;
        $curvoParse = null;

        $cumbrera = administracionModelo::getProductoDetalle_cumbrera($id_producto, $id_espesor);
        if ($cumbrera->rowCount() > 0) {
            $cumbreraParse = $cumbrera->fetchObject('Opcion');
        }

        $anticondensante = administracionModelo::getProductoDetalle_anticondensante($id_producto, $id_espesor);
        if ($anticondensante->rowCount() > 0) {
            $anticondensanteParse = $anticondensante->fetchObject('Opcion');
        }

        $perforable = administracionModelo::getProductoDetalle_perforable($id_producto, $id_espesor);
        if ($perforable->rowCount() > 0) {
            $perforableParse = $perforable->fetchObject('Opcion');
        }

        $curvo = administracionModelo::getProductoDetalle_curvo($id_producto, $id_espesor);
        if ($curvo->rowCount() > 0) {
            $curvoParse = $curvo->fetchObject('Opcion');
        }


        //echo $cumbrera->rowCount();
        $obj = [];
        $obj['cumbrera'] = $cumbreraParse;
        $obj['anticondensante'] = $anticondensanteParse;
        $obj['perforable'] = $perforableParse;
        $obj['curvo'] = $curvoParse;


        echo json_encode($obj);
    }
    public static function eliminarProduct($uuid)
    {
        $resp = administracionModelo::eliminarProducto_cotizacion($uuid);
        if ($resp) {
            echo 'insertado con existo';
        } else {
            echo 'fallo el insert' . $uuid;
        }
    }
    public static function getProduct($idSesion)
    {
        $resp = administracionModelo::getProducto_cotizacion($idSesion);
        $respParse = $resp->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($respParse);
    }
}
