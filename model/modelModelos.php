<?php

include_once('config/conexionMysql.php');

class ModeloModelos
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

    
    /*******************************************Lista Usuario********************************************/
    public function listUsuario()
    {
        try {
            $sql = "SELECT * FROM usuario WHERE idRol = 4";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista Edificio********************************************/
    public function listEdificio()
    {
        try {
            $sql = "SELECT * FROM edificio";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista Departamento********************************************/
    public function listDepartamento()
    {
        try {
            $sql = "SELECT * FROM departamento";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

    /*******************************************Lista propietario********************************************/
    public function listPropietario()
    {
        try {
            $sql = "SELECT * FROM propietariodep";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /*********************************************************************************************************/

     /*******************************************Lista Ocupantes********************************************/
     public function listOcupantes()
     {
         try {
             $sql = "SELECT * FROM ocupantes";
             $stm = $this->MYSQL->ConectarBD()->prepare($sql);
             $stm->execute();
             return $stm->fetchAll(PDO::FETCH_OBJ);
         } catch (Exception $th) {
             echo $th->getMessage();
         }
     }
     /*********************************************************************************************************/

      /*******************************************Lista Mascotas********************************************/
      public function listMascotas()
      {
          try {
              $sql = "SELECT * FROM mascotas";
              $stm = $this->MYSQL->ConectarBD()->prepare($sql);
              $stm->execute();
              return $stm->fetchAll(PDO::FETCH_OBJ);
          } catch (Exception $th) {
              echo $th->getMessage();
          }
      }
      /*********************************************************************************************************/

      /*******************************************Lista Tipo departamento********************************************/
      public function listTipoDepartamento()
      {
          try {
              $sql = "SELECT * FROM tipodepartamento";
              $stm = $this->MYSQL->ConectarBD()->prepare($sql);
              $stm->execute();
              return $stm->fetchAll(PDO::FETCH_OBJ);
          } catch (Exception $th) {
              echo $th->getMessage();
          }
      }
      /*********************************************************************************************************/

      /*******************************************Lista Tipo departamento********************************************/
      public function listEstadoDepartamento()
      {
          try {
              $sql = "SELECT * FROM estadodepartamento";
              $stm = $this->MYSQL->ConectarBD()->prepare($sql);
              $stm->execute();
              return $stm->fetchAll(PDO::FETCH_OBJ);
          } catch (Exception $th) {
              echo $th->getMessage();
          }
      }
      /*********************************************************************************************************/

}