<?php
include_once MODEL_PATH . '/categoriaModelo.php';

class categoriaControlador extends categoriaModelo
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
    public function getProductCategoria_controller($categoriaId)
    {
        $productosList = categoriaModelo::getProductoCategoria_model($categoriaId);
        //if ($productosList->rowCount()) {
            $categoria = categoriaModelo::getDetalleCategoria_model($categoriaId);

            $productos = new Productos();
            $productos->categoria = $categoria;
            $productos->productoList = $productosList->fetchAll(PDO::FETCH_ASSOC);

            header("HTTP/1.1 200 OK");
            echo json_encode($productos);
       /*  }else{
            header("HTTP/1.1 404 Not Found");
            $errorResponse = new ErrorResponse();
            $errorResponse->msg = "no se encontraron productos";
            echo json_encode($errorResponse);
        } */

    } /* ------------- END Controlador iniciar session ------------- */
}

/* class Categoria
{
    public $id;
    public $descripcion;
} */

class Productos
{
    public $categoria;
    public $productoList;
}

class ErrorResponse{
    public $msg;
    public $code;
}