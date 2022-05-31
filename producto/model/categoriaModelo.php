<?php
include_once ROOT_PATH . '/mainModel.php';

class categoriaModelo extends mainModel
{

    /* ------------- Modelo iniciar session ------------- */
    protected static function getProductoCategoria_model($categoriaId)
    {
        $query = "SELECT p.* FROM producto p
                LEFT JOIN categoria c ON p.categoria = c.id
            WHERE p.categoria = :CATEGORIA_ID";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":CATEGORIA_ID", $categoriaId);
        $sql->execute();
        return $sql;
    }

    protected static function getDetalleCategoria_model($categoriaId)
    {
        $query = "SELECT * FROM categoria c WHERE c.id = :CATEGORIA_ID";
        $sql = mainModel::conectar()->prepare($query);
        $sql->bindParam(":CATEGORIA_ID", $categoriaId);

        $sql->setFetchMode(PDO::FETCH_CLASS, 'Categoria');
        $sql->execute();
        return $sql->fetch();
    }
}

class Categoria
{
    public $id;
    public $descripcion;
}