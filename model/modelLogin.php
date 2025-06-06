<?php

include_once('config/conexionMysql.php');

class ModeloLogin
{

    public $MYSQL;

    public function __construct()
    {
        try {
            $this->MYSQL = new ClassConexion(); //INICIANDO LA CONEXION A LA BD
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /*******************************************LOGEO DEL USUARIO********************************************/
    public function logeo(Usuario $usuario)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE usuario=? AND contrasena=?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute(array($usuario->getusuario(), $usuario->getcontrasena()));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

}