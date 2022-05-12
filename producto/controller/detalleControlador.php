<?php
include_once "../model/detalleModelo.php";

class detalleControlador extends detalleModelo
{

    /**
     * obtener detalle de los productos por opcion
     */
    /* ---------------- Modelo obtener espesor de productos ---------------- */
    public static function getTermination_controlador($id_producto)
    {
        $resp = detalleModelo::getTerminationModel($id_producto);
        $dataParse = $resp->fetchAll();
        return json_encode($dataParse);
    }
}
