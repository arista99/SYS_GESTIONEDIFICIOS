<?php

include_once('config/conexionMysql.php');

class ModeloPropietario
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

    /*******************************************Lista - Busqueda Propietario*****************************************/
    public function findPropietario($nrodni)
    {
        try {
            $sql = "SELECT pd.idPropietario,CONCAT(pd.nombres,' ',pd.apePaterno,' ',pd.apeMaterno) AS propietario,pd.nombres,pd.apePaterno,pd.apeMaterno,pd.dni,pd.celular,pd.correo,sp.descripcion,dp.nroDepartamento,pd.estado,up.nombres AS dueno
                    FROM propietariodep AS pd
                    INNER JOIN sexo AS sp ON sp.idSexo=pd.sexoFK
                    INNER JOIN departamento AS dp ON dp.idDepartamento=pd.departamentoFK
                    INNER JOIN usuario AS up ON up.idUsuario=pd.autorregistro";
            
            if (!empty($nrodni)) {
                $sql .= " WHERE pd.dni = ?";
                $stm = $this->MYSQL->ConectarBD()->prepare($sql);
                $stm->execute([$nrodni]);
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

     /*******************************************Crear Propietario*****************************************/
     public function createPropietario(Propietario $propietario)
     {
         try {
             $sql = "INSERT INTO propietariodep (nombres,apePaterno,apeMaterno,dni,celular,correo,sexoFK,departamentoFK,estado,autorregistro) VALUES (?,?,?,?,?,?,?,?,?,?)";
             $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                 array(
                     $propietario->getnombres(),
                     $propietario->getapePaterno(),
                     $propietario->getapeMaterno(),
                     $propietario->getdni(),
                     $propietario->getcelular(),
                     $propietario->getcorreo(),
                     $propietario->getsexoFK(),
                     $propietario->getdepartamentoFK(),
                     $propietario->getestado(),
                     $propietario->getautorregistro()
                 )
             );
             return $stm;
         } catch (Exception $th) {
             echo $th->getMessage();
         }
     }
     /********************************************************************************************************/

     /*******************************************Crear Departamento*****************************************/
    public function updatePropietario(Propietario $propietario)
    {
        try {
            $sql = "UPDATE propietariodep SET nombres =?, apePaterno =?, apeMaterno =?,dni =?,celular =?,correo =?,sexoFK =?,departamentoFK =?,estado =? , autorregistro  =? WHERE idPropietario =?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $propietario->getnombres(),
                    $propietario->getapePaterno(),
                    $propietario->getapeMaterno(),
                    $propietario->getdni(),
                    $propietario->getcelular(),
                    $propietario->getcorreo(),
                    $propietario->getsexoFK(),
                    $propietario->getdepartamentoFK(),
                    $propietario->getestado(),
                    $propietario->getautorregistro(),
                    $propietario->getidPropietario()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /********************************************************************************************************/

     /*******************************************ELIMINAR USUARIOS********************************************/
     public function deletePropietario($idpropietario)
     {
         try {
             $sql = "DELETE FROM propietariodep WHERE idPropietario = ?";
             $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                 array(
                    $idpropietario
                 )
             );
             return $stm;
         } catch (Exception $th) {
             echo $th->getMessage();
         }
     }
}