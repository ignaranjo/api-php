<?php
    include_once 'mainModel.php';

    class loginModelo extends mainModel{

        /* ------------- Modelo iniciar session ------------- */
        protected static function getProducto(){
           // $sql=mainModel::conectar()->prepare("SELECT * FROM producto p");
           /*  $sql->bindParam(':Usuario', $datos['Usuario']);
            $sql->bindParam(':Clave', $datos['Clave']); */
            //$sql->execute();
            //$resp = $sql->fetch();
            //return json_encode($resp);
            return __dir__;
        }
    }