<?php
require_once ROOT_PATH.'/mainModel.php';

class terminacionControlador extends mainModel
{

    /**
     * obtener detalle de los productos por opcion
     */
    /* ---------------- Modelo obtener espesor de productos ---------------- */
    public static function getTermination_controlador()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM producto_terminacion");
        $sql->execute();
        $productos = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    }
}
