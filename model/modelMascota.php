<?php

include_once('config/conexionMysql.php');

class ModeloMascota
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

    /*******************************************Lista - Busqueda Ocupante*****************************************/
    public function findMascota($mascota)
    {
        try {
            $sql = "SELECT ma.idMascota,md.nroDepartamento,ma.nombre,me.descripcion
                    FROM mascotas AS ma
                    INNER JOIN departamento AS md ON md.idDepartamento=ma.departamentoFK
                    INNER JOIN especiemascota AS me ON me.idEspecie=ma.especieFK";
            
            if (!empty($mascota)) {
                $sql .= " WHERE LOWER(ma.nombre) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' .$mascota . '%']);
            } else {
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute();
            }

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    /******************************************************************************************************/
}