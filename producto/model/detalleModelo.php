<?php
require_once ROOT_PATH.'/mainModel.php';

class detalleModelo extends mainModel
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
}
