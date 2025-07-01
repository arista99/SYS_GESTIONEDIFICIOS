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
                $DEPARTAMENTO->setedificioFK($_POST['denominacion']);
                $DEPARTAMENTO->setnroHabitaciones($_POST['nro_habitaciones']);
                $DEPARTAMENTO->setnroDepartamento($_POST['nro_departamento']);
                $DEPARTAMENTO->setareaM2($_POST['area']);
                $DEPARTAMENTO->settipoDepartamentoFK($_POST['tipo_deparamento']);
                $DEPARTAMENTO->setestadoFK($_POST['estado_deparamento']);
                $DEPARTAMENTO->setautorregistro($_POST['dueno_departamentos']);
                $DEPARTAMENTO->setpiso($_POST['pisos']);
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

}