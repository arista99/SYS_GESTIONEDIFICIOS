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
            $sql = "SELECT oc.idOcupante,od.nroDepartamento,CONCAT(oc.nombres,' ',oc.apePaterno,' ',oc.apeMaterno) AS ocupante,oc.dni,oc.celular,os.descripcion AS sexoo,orp.descripcion AS relacion,oc.estado
                    FROM ocupantes AS oc
                    INNER JOIN departamento AS od ON od.idDepartamento=oc.departamentoFK
                    INNER JOIN sexo AS os ON os.idSexo=oc.sexoFK
                    INNER JOIN relacionconpropietario AS orp ON orp.idRelacion=oc.relacionFK";
            
            if (!empty($nrodni)) {
                $sql .= " WHERE pd.dni LIKE ?";
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