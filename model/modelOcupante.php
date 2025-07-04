<?php

include_once('config/conexionMysql.php');

class ModeloOcupante
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
    public function findOcupante($nrodni)
    {
        try {
            $sql = "SELECT oc.idOcupante,od.nroDepartamento,CONCAT(oc.nombres,' ',oc.apePaterno,' ',oc.apeMaterno) AS ocupante,oc.nombres,oc.apePaterno,oc.apeMaterno,oc.dni,oc.celular,os.descripcion AS sexoo,orp.descripcion AS relacion,oc.estado
                    FROM ocupantes AS oc
                    INNER JOIN departamento AS od ON od.idDepartamento=oc.departamentoFK
                    INNER JOIN sexo AS os ON os.idSexo=oc.sexoFK
                    INNER JOIN relacionconpropietario AS orp ON orp.idRelacion=oc.relacionFK";
            
            if (!empty($nrodni)) {
                $sql .= " WHERE oc.dni LIKE ?";
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

    /*******************************************Crear Ocupante*****************************************/
    public function createOcupante(Ocupante $ocupante)
    {
        try {
            $sql = "INSERT INTO ocupantes (departamentoFK,nombres,apePaterno,apeMaterno,dni,celular,sexoFK,relacionFK,estado) VALUES (?,?,?,?,?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $ocupante->getdepartamentoFK(),
                    $ocupante->getnombres(),
                    $ocupante->getapePaterno(),
                    $ocupante->getapeMaterno(),
                    $ocupante->getdni(),
                    $ocupante->getcelular(),
                    $ocupante->getsexoFK(),
                    $ocupante->getrelacionFK(),
                    $ocupante->getestado()
                    )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /********************************************************************************************************/

    /*******************************************Actualizar Ocupante*****************************************/
   public function updateOcupante(Ocupante $ocupante)
   {
       try {
           $sql = "UPDATE ocupantes SET departamentoFK =?, nombres =?, apePaterno =?, apeMaterno =?, dni =?, celular =?, sexoFK =?, relacionFK =?, estado =? WHERE idOcupante =?";
           $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
               array(
                   $ocupante->getdepartamentoFK(),
                   $ocupante->getnombres(),
                   $ocupante->getapePaterno(),
                   $ocupante->getapeMaterno(),
                   $ocupante->getdni(),
                   $ocupante->getcelular(),
                   $ocupante->getsexoFK(),
                   $ocupante->getrelacionFK(),
                   $ocupante->getestado(),
                   $ocupante->getidOcupante()
               )
           );
           return $stm;
       } catch (Exception $th) {
           echo $th->getMessage();
       }
   }
   /********************************************************************************************************/

    /*******************************************ELIMINAR OCUPANTE********************************************/
    public function deleteOcupante($idocupante)
    {
        try {
            $sql = "DELETE FROM ocupantes WHERE idOcupante = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                   $idocupante
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /********************************************************************************************************/
}