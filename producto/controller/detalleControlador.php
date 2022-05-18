<?php
require_once MODEL_PATH . "/detalleModelo.php";

class ProductoDetalle
{
    //Predefine Here
    public $id;
    public $nombre;
    public $categoria;
    public $img;

    /* public function profileLink()
    {
         return sprintf('<a href="/profile/%s">%s</a>',$this->id,$this->username);
    } */
}

class Producto
{
    public $detalle;
    public $terminacionList;
    public $espesorList;
    public $imagenesList;
    public $colorList;
}
class Terminacion
{
    public $id;
    public $nombre;
}

class Opcion{
    public $id_espesor;
    public $opcion;
    public $espesor;
}

class detalleControlador extends detalleModelo
{


    public static function getDetalleProducto($id)
    {
        /* $sql = mainModel::conectar()->prepare("SELECT * FROM producto p WHERE p.id = :ID");
        $sql->bindParam(":ID", $id);
        $sql->execute(); */

        $resp = detalleModelo::getDetalleProducto($id);
        $dataParse = $resp->fetchObject('ProductoDetalle');
        //$dataParse = $resp->fetchAll(PDO::FETCH_CLASS, 'ProductoDetalle');

        $terminacionResp = detalleModelo::getProductoDetalle_terminacion($id);
        $terminacionParse = $terminacionResp->fetchAll(PDO::FETCH_CLASS, 'Terminacion');
        
        $imagenesResp = detalleModelo::getProdcto_imagenes($id);
        $imagenesParse = $imagenesResp->fetchAll(PDO::FETCH_ASSOC);

        $espesorResp = detalleModelo::getProductoDetalle_espesor($id);
        $espesorParse = $espesorResp->fetchAll(PDO::FETCH_ASSOC);
        
        $colorResp = detalleModelo::getProductoDetalle_color($id);
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
        $resp = detalleModelo::getTerminationModel($id_producto);
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

        $cumbrera = detalleModelo::getProductoDetalle_cumbrera($id_producto, $id_espesor);
        if ($cumbrera->rowCount() > 0) {
            $cumbreraParse = $cumbrera->fetchObject('Opcion');
        }

        $anticondensante = detalleModelo::getProductoDetalle_anticondensante($id_producto, $id_espesor);
        if ($anticondensante->rowCount() > 0) {
            $anticondensanteParse = $anticondensante->fetchObject('Opcion');
        }

        $perforable = detalleModelo::getProductoDetalle_perforable($id_producto, $id_espesor);
        if ($perforable->rowCount() > 0) {
            $perforableParse = $perforable->fetchObject('Opcion');
        }

        $curvo = detalleModelo::getProductoDetalle_curvo($id_producto, $id_espesor);
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
}
