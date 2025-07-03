<?php

include_once('config/conexionMysql.php');

class ModeloUsuario
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

    /*******************************************Busqueda Departamento*****************************************/
    public function findUsuario($condominio, $nrohab)
    {
        try {
            $sql = "SELECT d.idDepartamento,
                    CONCAT('Denominación: ', ed.denominacion) AS 'denominacion',
                    CONCAT('Habitaciones: ', d.nroHabitaciones) AS 'nroHabitaciones',
                    CONCAT('Departamento: ', d.nroDepartamento) AS 'nroDepartamento',
                    CONCAT('Tipo: ', td.descripcion) AS 'tipo',
                    CONCAT('Estado: ', edd.descripcion) AS 'descripcion'
                    FROM departamento AS d
                    INNER JOIN edificio AS ed ON ed.idEdificio=d.edificioFK
                    INNER JOIN tipodepartamento AS td ON td.idTipo=d.tipoDepartamentoFK
                    INNER JOIN estadodepartamento AS edd ON edd.idEstado=d.estadoFK
                    WHERE edd.descripcion = 'Desocupado'";

            $params = [];
            $conditions = [];

            if (!empty($condominio)) {
                $conditions[] = "LOWER(ed.denominacion) LIKE LOWER(?)";
                $params[] = '%' . $condominio . '%';
            }

            if (!empty($nrohab)) {
                $conditions[] = "d.nroHabitaciones = ?";
                $params[] = $nrohab;
            }

            if (count($conditions) > 0) {
                $sql .= " WHERE " . implode(" OR ", $conditions);
            }

            $stm = $this->MYSQL->ConectarBD()->prepare($sql);
            $stm->execute($params);

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $th) {
            echo "Error: " . $th->getMessage();
        }
    }

    /********************************************************************************************************/
}