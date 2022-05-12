<?php
include_once '../mainModel.php';

class detalleModelo extends mainModel
{

    /* ------------- Modelo iniciar session ------------- */
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
}
