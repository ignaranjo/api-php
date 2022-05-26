<?php
require_once ROOT_PATH.'/mainModel.php';

class espesorControlador extends mainModel
{

    /**
     * obtener detalle de los productos por opcion
     */
    /* ---------------- Modelo obtener espesor de productos ---------------- */
    public static function getEspesor_controlador()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM producto_espesor");
        $sql->execute();
        $productos = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    }
}
