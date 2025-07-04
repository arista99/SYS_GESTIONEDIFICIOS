<?php
//MODEL
include_once('model/modelPropietario.php');
include_once('model/modelModelos.php');
//DATA
include_once('data/propietario.php');

class controlPropietario
{

    //VARIABLE MODELO
    public $PROPIETARIO;
    public $MODELOS;


    public function __construct()
    {
        $this->PROPIETARIO = new ModeloPropietario();
        $this->MODELOS = new ModeloModelos();
    }

    public function PropietarioControl()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['idUsuario'])) {
            // Redirigir al login si no está autenticado
            header("Location: LoginUsuario");
            exit;
        }

        //MODELOS
        $lista_usuarios = $this->MODELOS->listUsuario();
        $lista_departamento = $this->MODELOS->listDepartamento();
        $lista_sexo = $this->MODELOS->listSexo();


        include_once('views/paginas/administrador/propietarios/propietario.php');
    }

    public function ListaPropietario()
    {
    // Obtener valores desde la solicitud AJAX
    $nrodni = $_POST['nrodni'] ?? '';

    // Llama al modelo
    $resultados = $this->PROPIETARIO->findPropietario($nrodni);

    // Enviar respuesta al frontend
    header('Content-Type: application/json');
    echo json_encode(['data' => $resultados]);
    }
    
    public function RegistrarPropietario()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $PROPIETARIOD = new Propietario();
                $PROPIETARIOD->setnombres($_POST['nombre_pro']);
                $PROPIETARIOD->setapePaterno($_POST['apep_pro']);
                $PROPIETARIOD->setapeMaterno($_POST['apem_pro']);
                $PROPIETARIOD->setdni($_POST['dni_pro']);
                $PROPIETARIOD->setcelular($_POST['celular_pro']);
                $PROPIETARIOD->setcorreo($_POST['correo_pro']);
                $PROPIETARIOD->setsexoFK($_POST['sexo_pro']);
                $PROPIETARIOD->setdepartamentoFK($_POST['departamento_pro']);
                $PROPIETARIOD->setestado($_POST['estado_pro']);
                $PROPIETARIOD->setautorregistro($_POST['dueno_departamento']);

                //llamando al inser de modelo solicitud
                $createPropietario = $this->PROPIETARIO->createPropietario($PROPIETARIOD);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($createPropietario) {
                    echo json_encode(['success' => true, 'message' => 'Se creo propietario']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al crear propietario']);
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

    public function ActualizarPropietario()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $PROPIETARIOD = new Propietario();
                $PROPIETARIOD->setidPropietario($_POST['idPropietario']);
                $PROPIETARIOD->setnombres($_POST['edit_nombre_pro']);
                $PROPIETARIOD->setapePaterno($_POST['edit_apep_pro']);
                $PROPIETARIOD->setapeMaterno($_POST['edit_apem_pro']);
                $PROPIETARIOD->setdni($_POST['edit_dni_pro']);
                $PROPIETARIOD->setcelular($_POST['edit_celular_pro']);
                $PROPIETARIOD->setcorreo($_POST['edit_correo_pro']);
                $PROPIETARIOD->setsexoFK($_POST['edit_sexo']);
                $PROPIETARIOD->setdepartamentoFK($_POST['edit_departamento']);
                $PROPIETARIOD->setestado($_POST['edit_estado_pro']);
                $PROPIETARIOD->setautorregistro($_POST['edit_nombres']);
                
                //llamando al inser de modelo solicitud
                $updatePropietario = $this->PROPIETARIO->updatePropietario($PROPIETARIOD);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($updatePropietario) {
                    echo json_encode(['success' => true, 'message' => 'Se actualizo propietario']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar propietario']);
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

    public function eliminarPropietario()
    {

        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idpropietario = $_POST['id'] ?? '';

        $resultado = $this->PROPIETARIO->deletePropietario($idpropietario);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }

    //Llamado de vista para actualización

    public function listaSexoP()
    {
        // Simula datos desde la BD
        $sexo_propietario = $this->MODELOS->listSexo(); // Array de objetos con idedificio y edificio

        echo json_encode($sexo_propietario);
    }

    public function listDepartamentoP()
    {
        // Simula datos desde la BD
        $departamento_propietario = $this->MODELOS->listDepartamento(); // Array de objetos con idtipo y tipo

        echo json_encode($departamento_propietario);
    }

    public function listaNombreP()
    {
        // Simula datos desde la BD
        $nombres = $this->MODELOS->listUsuario(); // Array de objetos con idusuario y usuario

        echo json_encode($nombres);
    }
}