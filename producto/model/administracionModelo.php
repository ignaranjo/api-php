<?php
require_once ROOT_PATH.'/mainModel.php';

class administracionModelo extends mainModel
{

    /* ------------- Modelo iniciar session ------------- */
    public static function getDetalleProducto($id)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM producto p WHERE p.id = :ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;//->fetchAll(PDO::FETCH_ASSOC);
    }
    protected static function getTerminationModel($id)
    {
        $query = "SELECT id, nombre
        FROM producto_terminacion_rel ptr 
        LEFT JOIN producto_terminacion pt 
        ON ptr.id_terminacion = pt.id
        WHERE ptr.id_producto = :ID";

        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
        //return $sentencia->fetchAll();

    }
    protected static function getProdcto_imagenes($id)
    {
        $query = "SELECT * FROM producto_imagenes pri WHERE pri.id_producto = :ID";

        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
        //return $sentencia->fetchAll();

    }
    protected static function getProductoDetalle_terminacion($id)
    {
        $query = "SELECT id, nombre
        FROM producto_terminacion_rel ptr LEFT JOIN producto_terminacion pt 
        ON ptr.id_terminacion = pt.id
        WHERE ptr.id_producto = :ID";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }

    protected static function getProductoDetalle_espesor($id)
    {
        $query = "SELECT id, espesor as nombre
        FROM producto_espesor_rel per  LEFT JOIN producto_espesor pe
        ON per.id_espesor = pe.id
        WHERE per.id_producto = :ID";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }

    protected static function getProductoDetalle_cumbrera($id_producto, $id_espesor)
    {
        $query = "SELECT per.id_espesor, pc.opcion, (SELECT pe.espesor FROM producto_espesor pe WHERE pe.id = pc.id_espesor ) as espesor
            FROM producto_cumbrera pc 
            LEFT JOIN producto_espesor_rel per
            ON pc.id_producto = per.id_producto
            AND pc.id_espesor = per.id_espesor
            WHERE pc.id_producto = :ID_PRODUCTO
            AND per.id_espesor = :ID_ESPESOR";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID_PRODUCTO", $id_producto);
        $sql->bindParam(":ID_ESPESOR", $id_espesor);
        $sql->execute();
        return $sql;
    }

    protected static function getProductoDetalle_anticondensante($id_producto, $id_espesor)
    {
        $query = "SELECT per.id_espesor, pa.opcion, (SELECT pe.espesor FROM producto_espesor pe WHERE pe.id = pa.id_espesor ) as espesor
            FROM producto_anticondensante pa 
            LEFT JOIN producto_espesor_rel per
            ON pa.id_producto = per.id_producto
            AND pa.id_espesor = per.id_espesor
            WHERE pa.id_producto = :ID_PRODUCTO
            AND per.id_espesor = :ID_ESPESOR";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID_PRODUCTO", $id_producto);
        $sql->bindParam(":ID_ESPESOR", $id_espesor);
        $sql->execute();
        return $sql;
    }

    protected static function getProductoDetalle_perforable($id_producto, $id_espesor)
    {
        $query = "SELECT per.id_espesor, pp.opcion, (SELECT pe.espesor FROM producto_espesor pe WHERE pe.id = pp.id_espesor ) as espesor
            FROM producto_perforable pp 
            LEFT JOIN producto_espesor_rel per
            ON pp.id_producto = per.id_producto
            AND pp.id_espesor = per.id_espesor
            WHERE pp.id_producto = :ID_PRODUCTO
            AND per.id_espesor = :ID_ESPESOR";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID_PRODUCTO", $id_producto);
        $sql->bindParam(":ID_ESPESOR", $id_espesor);
        $sql->execute();
        return $sql;
    }

    protected static function getProductoDetalle_curvo($id_producto, $id_espesor)
    {
        $query = "SELECT per.id_espesor, pc.opcion, (SELECT pe.espesor FROM producto_espesor pe WHERE pe.id = pc.id_espesor ) as espesor
            FROM producto_curvo pc
            LEFT JOIN producto_espesor_rel per
            ON pc.id_producto = per.id_producto
            AND pc.id_espesor = per.id_espesor
            WHERE pc.id_producto = :ID_PRODUCTO
            AND per.id_espesor = :ID_ESPESOR";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID_PRODUCTO", $id_producto);
        $sql->bindParam(":ID_ESPESOR", $id_espesor);
        $sql->execute();
        return $sql;
    }

    protected static function insertarProducto_cotizacion($data)
    {
        //echo json_encode($data);
        $query = "INSERT INTO carrito_cotizador(
            id_sesion, 
            uuid, 
            producto_id, 
            producto_largo, 
            producto_cantidad, 
            producto_terminacion, 
            producto_espesor, 
            producto_cumbrera_medida, 
            producto_cumbrera, 
            producto_anticondensante, 
            producto_anticondensante_medida, 
            producto_perforable, 
            producto_perforable_medida, 
            producto_curvo, 
            producto_curvo_medida, 
            color
        ) VALUES"; 
        $count = 1;
        foreach ($data as $producto) {
            $query .=  "(".$producto['id_sesion'] .",".
                       $producto['uuid'] .",".
                       $producto['idProducto'] .",".
                       $producto['medida'] .",".
                       $producto['cantidad'] .",".
                       $producto['terminacion'] .",".
                       $producto['espesor'] .",".
                       $producto['cumbreraMedida'] .",".
                       $producto['cumbrera'] .",".
                       $producto['anticondensante'] .",".
                       $producto['anticondensanteMedida'] .",".
                       $producto['perforable'] .",".
                       $producto['perforableMedida'] .",".
                       $producto['curvo'] .",".
                       $producto['curvoMedida'] .",".
                       $producto['color'].")";
            if(count($data) == $count){
                $query.=";";
            }else{
                $query.=",";
            }
            $count++;
        }
        /* $query .= " (
            :id_sesion, 
            :uuid, 
            :producto_id, 
            :largo, 
            :cantidad, 
            :terminacion, 
            :espesor, 
            :cumbrera_medida, 
            :cumbrera, 
            :anticondensante, 
            :anticondensante_medida, 
            :perforable, 
            :perforable_medida, 
            :curvo, 
            :curvo_medida, 
            :color
           )"; */
        $sql = mainModel::conectar()->prepare($query);
       /*  $sql->bindParam(":id_sesion", $data['id_sesion']);
        $sql->bindParam(":uuid", $data['uuid']);
        $sql->bindParam(":producto_id", $data['idProducto']);
        $sql->bindParam(":largo", $data['medida']);
        $sql->bindParam(":cantidad", $data['cantidad']);
        $sql->bindParam(":terminacion", $data['terminacion']);
        $sql->bindParam(":espesor", $data['espesor']);
        $sql->bindParam(":cumbrera_medida", $data['cumbreraMedida']);
        $sql->bindParam(":cumbrera", $data['cumbrera']);
        $sql->bindParam(":anticondensante", $data['anticondensante']);
        $sql->bindParam(":anticondensante_medida", $data['anticondensanteMedida']);
        $sql->bindParam(":perforable", $data['perforable']);
        $sql->bindParam(":perforable_medida", $data['perforableMedida']);
        $sql->bindParam(":curvo", $data['curvo']);
        $sql->bindParam(":curvo_medida", $data['curvoMedida']);
        $sql->bindParam(":color", $data['color']); */
        
        $sql->execute();
        //print_r($sql->errorInfo());
        //print_r($sql);
        return $sql;
    }
    protected static function eliminarProducto_cotizacion($uuid)
    {
        $query = "DELETE FROM carrito_cotizador WHERE uuid = :uuid";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":uuid", $uuid);
        $resp = $sql->execute();
        return $resp;
    }
    protected static function getProducto_cotizacion($idSession)
    {
        $query = "SELECT p.id,
        cc.uuid,
        p.nombre as nombre, 
        p.categoria as descripcion,
        cc.producto_cantidad as cantidad,
        cc.producto_largo as medida,
        (SELECT pt.nombre FROM producto_terminacion pt WHERE cc.producto_terminacion = pt.id) as terminacion,
        (SELECT pe.espesor  FROM producto_espesor pe WHERE cc.producto_espesor  = pe.id) as espesor,
        cc.producto_espesor,
        cc.color,
        cc.producto_cumbrera,
        cc.producto_anticondensante,
        cc.producto_curvo,
        cc.producto_cumbrera_medida,
        cc.producto_anticondensante_medida,
        cc.producto_perforable,
        cc.producto_perforable_medida,
        cc.producto_curvo_medida
        FROM carrito_cotizador cc 
       LEFT JOIN producto p 
       ON p.id = cc.producto_id 
       WHERE cc.id_sesion = :idSession";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":idSession", $idSession);
        $sql->execute();
        return $sql;
    }

    /*
    */

    /* $sentencia = $bd->prepare("INSERT INTO carrito_cotizador(id_sesion, producto_id, producto_largo, producto_cantidad, producto_terminacion, producto_espesor, producto_cumbrera, producto_anticondensante, producto_perforable, producto_curvo, color) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    return $sentencia->execute([$idSesion, $idProducto, $producto_largo, $producto_cantidad, $producto_terminacion, $producto_espesor, $producto_cumbrera, $producto_anticondensante, $producto_perforable, $producto_curvo, $color]);

$sql = $db->prepare("INSERT INTO db_fruit (id, type, colour) VALUES (? ,? ,?)");
$sql->bindParam(1, $newId);
$sql->bindParam(2, $name);
$sql->bindParam(3, $colour);
$sql->execute();
 */

    protected static function getProductoDetalle_color()
    {
        $query = "SELECT * FROM producto_color";
        $sql = mainModel::conectar()->prepare($query);
        $sql->execute();
        return $sql;
    }
}
