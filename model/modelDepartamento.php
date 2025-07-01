<?php

include_once('config/conexionMysql.php');

class ModeloDepartamento
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
    public function findDepartamento($nroDepartamento, $estadoDepartamento)
    {
        try {
            $sql = "SELECT de.idDepartamento, ed.denominacion, de.nroHabitaciones, de.nroDepartamento,
                       de.areaM2, td.descripcion AS tipo, edo.descripcion AS estado,
                       u.nombres, de.piso
                FROM departamento AS de
                INNER JOIN edificio AS ed ON ed.idEdificio = de.edificioFK
                INNER JOIN tipodepartamento AS td ON td.idTipo = de.tipoDepartamentoFK
                INNER JOIN estadodepartamento AS edo ON edo.idEstado = de.estadoFK
                INNER JOIN usuario AS u ON u.idUsuario = de.autorregistro";

            $params = [];
            $conditions = [];

            if (!empty($nroDepartamento)) {
                $conditions[] = "LOWER(de.nroDepartamento) LIKE LOWER(?)";
                $params[] = '%' . $nroDepartamento . '%';
            }

            if (!empty($estadoDepartamento)) {
                $conditions[] = "LOWER(edo.descripcion) LIKE LOWER(?)";
                $params[] = '%' . $estadoDepartamento . '%';
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

    /*******************************************Crear Departamento*****************************************/
    public function createDepartamento(Departamento $departamento)
    {
        try {
            $sql = "INSERT INTO departamento (edificioFK,nroHabitaciones,nroDepartamento,areaM2,tipoDepartamentoFK,estadoFK,autorregistro,piso,telefono) values (?,?,?,?,?,?,?,?,?)";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $departamento->getedificioFK(),
                    $departamento->getnroHabitaciones(),
                    $departamento->getnroDepartamento(),
                    $departamento->getareaM2(),
                    $departamento->gettipoDepartamentoFK(),
                    $departamento->getestadoFK(),
                    $departamento->getautorregistro(),
                    $departamento->getpiso(),
                    $departamento->gettelefono()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /********************************************************************************************************/

    /*******************************************Crear Departamento*****************************************/
    public function updateDepartamento(Departamento $departamento)
    {
        try {
            $sql = "UPDATE departamento SET edificioFK =?, nroDepartamento =?,areaM2 =?,tipoDepartamentoFK =?,estadoFK =?,autorregistro =?,piso =?,telefono =? WHERE idDepartamento =?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $departamento->getedificioFK(),
                    $departamento->getnroDepartamento(),
                    $departamento->getareaM2(),
                    $departamento->gettipoDepartamentoFK(),
                    $departamento->getestadoFK(),
                    $departamento->getautorregistro(),
                    $departamento->getpiso(),
                    $departamento->gettelefono(),
                    $departamento->getidDepartamento()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /********************************************************************************************************/

    /*******************************************Cambio de Estado - Departamento*****************************************/
    public function statusDepartamento(Departamento $departamento)
    {
        try {
            $sql = "UPDATE departamento SET estadoFK = ? WHERE idDepartamento = ?";
            $stm = $this->MYSQL->ConectarBD()->prepare($sql)->execute(
                array(
                    $departamento->getestadoFK(),
                    $departamento->getidDepartamento()
                )
            );
            return $stm;
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }
    /********************************************************************************************************/
}
