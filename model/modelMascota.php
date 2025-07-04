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

 /*******************************************Crear Ocupante*****************************************/
 public function createMascota(Mascota $mascota)
 {
     try {
         $sql = "INSERT INTO mascotas (departamentoFK,nombre,especieFK) VALUES (?,?,?)";
         $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
             array(
                $mascota->getdepartamentoFK(),
                $mascota->getnombre(),
                $mascota->getespecieFK()
                 )
         );
         return $stm;
     } catch (Exception $th) {
         echo $th->getMessage();
     }
 }
 /********************************************************************************************************/

 /*******************************************Actualizar Mascota*****************************************/
public function updateMascota(Mascota $mascota)
{
    try {
        $sql = "UPDATE mascotas SET departamentoFK =?, nombre =?, especieFK =? WHERE idMascota =?";
        $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
            array(
                $mascota->getdepartamentoFK(),
                $mascota->getnombre(),
                $mascota->getespecieFK(),
                $mascota->getidMascota()
            )
        );
        return $stm;
    } catch (Exception $th) {
        echo $th->getMessage();
    }
}
/********************************************************************************************************/

 /*******************************************ELIMINAR MASCOTA********************************************/
 public function deleteMascota($idmascota)
 {
     try {
         $sql = "DELETE FROM mascotas WHERE idMascota = ?";
         $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
             array(
                $idmascota
             )
         );
         return $stm;
     } catch (Exception $th) {
         echo $th->getMessage();
     }
 }
 /********************************************************************************************************/
}