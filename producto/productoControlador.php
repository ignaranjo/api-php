<?php
include_once MODEL_PATH.'/productoModelo.php';

class productoControlador extends loginModelo
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
    /* ------------- Controlador iniciar session ------------- */
    public function getCarritoCotizator($id)
    {

        $query = "SELECT p.id as id, p.nombre as nombre, p.categoria as descripcion, '0' as precio,
            cc.producto_largo as largo,
            cc.producto_cantidad as cantidad,
            (SELECT pt.nombre FROM producto_terminacion pt WHERE cc.producto_terminacion = pt.id) as terminacion,
            (SELECT pe.espesor  FROM producto_espesor pe WHERE cc.producto_espesor  = pe.id) as espesor
        FROM carrito_cotizador cc 
        LEFT JOIN producto p 
        ON p.id = cc.producto_id 
        WHERE cc.id_sesion = :ID";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID", $id);
        $sql->execute();
        //$productos = $sql->fetchAll(PDO::FETCH_CLASS, "fruit");
        $productos = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    } /* ------------- END Controlador iniciar session ------------- */
    /* ------------- Controlador iniciar session ------------- */
    public function deleteCarritoCotizator($id, $producto_id)
    {
        $query = "DELETE FROM carrito_cotizador
        WHERE id_sesion = :ID_SESION AND producto_id = :Producto_id";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":ID_SESION", $id);
        $sql->bindParam(":Producto_id", $producto_id);
        $sql->execute();
        $productos = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    } /* ------------- END Controlador iniciar session ------------- */
    /* ------------- Controlador iniciar session ------------- */
    public function getAllCategoria()
    {
        $query = "SELECT * FROM categoria";
        $sql = mainModel::conectar()->prepare($query);
        $sql->execute();
        $productos = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    } /* ------------- END Controlador iniciar session ------------- */
}
