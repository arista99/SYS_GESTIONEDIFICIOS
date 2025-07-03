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
            $sql = "SELECT pd.idPropietario,CONCAT(pd.nombres,' ',pd.apePaterno,' ',pd.apeMaterno) AS propietario,pd.dni,pd.celular,pd.correo,sp.descripcion,dp.nroDepartamento,pd.estado,up.nombres AS dueno
                    FROM propietariodep AS pd
                    INNER JOIN sexo AS sp ON sp.idSexo=pd.sexoFK
                    INNER JOIN departamento AS dp ON dp.idDepartamento=pd.departamentoFK
                    INNER JOIN usuario AS up ON up.idUsuario=pd.autorregistro";
            
            if (!empty($nrodni)) {
                $sql .= " WHERE dp.dni = ?";
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
}