<?php

include_once('config/conexionMysql.php');

class ModeloEdificio
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

    /*******************************************Lista - Busqueda Edificio*****************************************/
    public function findEdificio($denominacion)
    {
        try {
            $sql = "SELECT idEdificio, denominacion, direccion, nroDePisos, nroDeDepartamentos, estado FROM edificio";
            
            if (!empty($denominacion)) {
                $sql .= " WHERE LOWER(denominacion) LIKE LOWER(?)";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute(['%' . $denominacion . '%']);
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

    /*******************************************Insertar Edificio ********************************************/
    public function insertEdificio(Edificio $edificio)
    {
        try {
            $sql = "INSERT INTO edificio (denominacion,direccion,nroDePisos,nroDeDepartamentos,estado) values (?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $edificio->getdenominacion(),
                    $edificio->getdireccion(),
                    $edificio->getnroDePisos(),
                    $edificio->getnroDeDepartamentos(),
                    $edificio->getestado()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /******************************************************************************************************/

    /*******************************************Insertar Edificio ********************************************/
    public function updateEdificio(Edificio $edificio)
    {
        try {
            $sql = "UPDATE edificio SET denominacion = ? , direccion = ? , nroDePisos = ? , nroDeDepartamentos = ? , estado = ? values idEdificio = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $edificio->getdenominacion(),
                    $edificio->getdireccion(),
                    $edificio->getnroDePisos(),
                    $edificio->getnroDeDepartamentos(),
                    $edificio->getestado(),
                    $edificio->getidEdificio()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /******************************************************************************************************/

    /*******************************************Eliminar Edificio ********************************************/
    public function deleteEdificio($idedificio)
    {
        try {
            $sql = "DELETE FROM edificio WHERE idEdificio = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $idedificio
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /******************************************************************************************************/

}