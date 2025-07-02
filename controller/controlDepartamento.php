<?php
//MODEL
include_once('model/modelDepartamento.php');
include_once('model/modelModelos.php');

//DATA
include_once('data/departamento.php');

class controlDepartamento
{

    //VARIABLE MODELO
    public $DEPARTAMENTO;
    public $MODELOS;

    public function __construct()
    {
        $this->DEPARTAMENTO = new ModeloDepartamento();
        $this->MODELOS = new ModeloModelos();
    }

    public function DepartamentoControl()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['idUsuario'])) {
            // Redirigir al login si no está autenticado
            header("Location: LoginUsuario");
            exit;
        }

        $lista_usuarios = $this->MODELOS->listUsuario();
        $lista_edificios = $this->MODELOS->listEdificio();
        $listTipoDepartamentos = $this->MODELOS->listTipoDepartamento();
        $listEstadoDepartamentos = $this->MODELOS->listEstadoDepartamento();


        include_once('views/paginas/administrador/departamentos/departamento.php');
    }

    public function ListaDepartamento()
    {
    // Obtener valores desde la solicitud AJAX
    $nroDepartamento = $_POST['nroDepartamento'] ?? '';
    $estadoDepartamento = $_POST['estadoDepartamento'] ?? '';

    // Llama al modelo
    $resultados = $this->DEPARTAMENTO->findDepartamento($nroDepartamento, $estadoDepartamento);

    // Enviar respuesta al frontend
    header('Content-Type: application/json');
    echo json_encode(['data' => $resultados]);
    }

    public function RegistrarDepartamento()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $DEPARTAMENTO = new Departamento();
                $DEPARTAMENTO->setedificioFK($_POST['edificio']);
                $DEPARTAMENTO->setnroHabitaciones($_POST['nro_habitaciones']);
                $DEPARTAMENTO->setnroDepartamento($_POST['nro_departamento']);
                $DEPARTAMENTO->setareaM2($_POST['aream2']);
                $DEPARTAMENTO->settipoDepartamentoFK($_POST['tipo_departamento']);
                $DEPARTAMENTO->setestadoFK($_POST['estado_departamento']);
                $DEPARTAMENTO->setautorregistroFK($_POST['dueno_departamento']);
                $DEPARTAMENTO->setpiso($_POST['piso_departamento']);
                $DEPARTAMENTO->settelefono($_POST['dueno_telefono']);

                //llamando al inser de modelo solicitud
                $createDepartamento = $this->DEPARTAMENTO->createDepartamento($DEPARTAMENTO);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($createDepartamento) {
                    echo json_encode(['success' => true, 'message' => 'Se creo departamento']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear departamento']);
                }
            } else {
                // Si no es una solicitud POST, enviar un mensaje de error
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            }
        } catch (Exception $th) {
            // Manejo de excepciones: devolver el mensaje de error
            echo json_encode(['success' => false, 'message' => $th->getMessage()]);
            // echo $th->getMessage();
        }
    }

    public function actualizarDepartamento()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $DEPARTAMENTO = new Departamento();
                $DEPARTAMENTO->setidDepartamento($_POST['idDepartamento']);
                $DEPARTAMENTO->setedificioFK($_POST['edit_denominacion']);
                $DEPARTAMENTO->setnroHabitaciones($_POST['edit_nroHabitaciones']);
                $DEPARTAMENTO->setnroDepartamento($_POST['edit_nroDepartamento']);
                $DEPARTAMENTO->setareaM2($_POST['edit_areaM2']);
                $DEPARTAMENTO->settipoDepartamentoFK($_POST['edit_tipo']);
                $DEPARTAMENTO->setestadoFK($_POST['edit_estado']);
                $DEPARTAMENTO->setautorregistroFK($_POST['edit_nombres']);
                $DEPARTAMENTO->setpiso($_POST['edit_piso']);
                $DEPARTAMENTO->settelefono($_POST['edit_telefono']);
            
                // echo "<pre>";
                // var_dump($DEPARTAMENTO);
                // echo "</pre>";
                $update_departamento = $this->DEPARTAMENTO->updateDepartamento($DEPARTAMENTO);
                // echo "<pre>";
                // var_dump($update_departamento);
                // echo "</pre>";
                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_departamento) {
                    echo json_encode(['success' => true, 'message' => 'Departamento actualizado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar departamento']);
                }
            } else {
                // Si no es una solicitud POST, enviar un mensaje de error
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            }
        } catch (Exception $th) {
            // Manejo de excepciones: devolver el mensaje de error
            echo json_encode(['success' => false, 'message' => $th->getMessage()]);
            // echo $th->getMessage();
        }
    }

    public function eliminarDepartamento()
    {

        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $iddepartamento = $_POST['id'] ?? '';

        $resultado = $this->DEPARTAMENTO->deleteDepartamento($iddepartamento);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }





    //Llamado de vista para actualización

    public function listaEdificioD()
    {
        // Simula datos desde la BD
        $edificios = $this->MODELOS->listEdificio(); // Array de objetos con idedificio y edificio

        echo json_encode($edificios);
    }

    public function listaTipoD()
    {
        // Simula datos desde la BD
        $tipo_departamento = $this->MODELOS->listTipoDepartamento(); // Array de objetos con idtipo y tipo

        echo json_encode($tipo_departamento);
    }

    public function listaEstadoD()
    {
        // Simula datos desde la BD
        $estado_departamento = $this->MODELOS->listEstadoDepartamento(); // Array de objetos con idestado y estado

        echo json_encode($estado_departamento);
    }

    public function listaNombreD()
    {
        // Simula datos desde la BD
        $nombres = $this->MODELOS->listUsuario(); // Array de objetos con idusuario y usuario

        echo json_encode($nombres);
    }

}