<?php
include_once ROOT_PATH.'/loginModelo.php';

class loginControlador extends loginModelo
{
    /* ------------- Controlador iniciar session ------------- */
    public function getAllProduct()
    {
        //$datos_cuenta = loginModelo::getProducto();
        //return $datos_cuenta->fetch();
        $query = "SELECT * FROM producto p";
        $conexion = mainModel::conectar();
        $sql = $conexion->prepare($query);
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($datos);
    } /* ------------- END Controlador iniciar session ------------- */

    /* ------------- Controlador iniciar session ------------- */
    public function getProduct($id)
    {
       /*  $query = 'SELECT * FROM producto p WHERE p.id = :ID';
        $sql = mainModel::conectar()->prepare($query);
        //$conexion = mainModel::conectar();
        //$sql = $conexion->prepare($query);*/

        $sql = mainModel::conectar()->prepare("SELECT * FROM producto p WHERE p.id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        //$productos = $sql->fetchAll(PDO::FETCH_CLASS, "fruit");
        $productos = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    } /* ------------- END Controlador iniciar session ------------- */
}
