<?php
//MODEL
include_once('model/modelOcupante.php');
include_once('model/modelModelos.php');

//DATA
include_once('data/propietario.php');

class controlOcupante
{

    //VARIABLE MODELO
    public $OCUPANTE;
    public $MODELOS;


    public function __construct()
    {
        $this->OCUPANTE = new ModeloOcupante();
        $this->MODELOS = new ModeloModelos();
    }

    public function OcupanteControl()
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
        $lista_departamento = $this->MODELOS->listDepartamento();
        $lista_sexo = $this->MODELOS->listSexo();
        $lista_relacion= $this->MODELOS->listRelacionPropietario();

        include_once('views/paginas/administrador/ocupantes/ocupante.php');
    }

    public function ListaOcupante()
    {
        // Obtener valores desde la solicitud AJAX
        $nrodni = $_POST['nrodni'] ?? '';

        // Llama al modelo
        $resultados = $this->OCUPANTE->findOcupante($nrodni);

        // Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function RegistrarOcupante()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $OCUPANTED = new Ocupante();
                $OCUPANTED->setdepartamentoFK($_POST['departamento_ocu']);
                $OCUPANTED->setnombres($_POST['nombre_ocu']);
                $OCUPANTED->setapePaterno($_POST['apep_ocu']);
                $OCUPANTED->setapeMaterno($_POST['apem_ocu']);
                $OCUPANTED->setdni($_POST['dni_ocu']);
                $OCUPANTED->setcelular($_POST['celular_ocu']);
                $OCUPANTED->setsexoFK($_POST['sexo_ocu']);
                $OCUPANTED->setrelacionFK($_POST['relacion_ocu']);
                $OCUPANTED->setestado($_POST['estado_ocu']);

                //llamando al inser de modelo solicitud
                $createOcupante = $this->OCUPANTE->createOcupante($OCUPANTED);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($createOcupante) {
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

    public function ActualizarOcupante()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $OCUPANTED = new Ocupante();
                $OCUPANTED->setdepartamentoFK($_POST['edit_departamento_ocu']);
                $OCUPANTED->setnombres($_POST['edit_nombre_ocu']);
                $OCUPANTED->setapePaterno($_POST['edit_apep_ocu']);
                $OCUPANTED->setapeMaterno($_POST['edit_apem_ocu']);
                $OCUPANTED->setdni($_POST['edit_dni_ocu']);
                $OCUPANTED->setcelular($_POST['edit_celular_ocu']);
                $OCUPANTED->setsexoFK($_POST['edit_sexo_ocu']);
                $OCUPANTED->setrelacionFK($_POST['edit_relacion_ocu']);
                $OCUPANTED->setestado($_POST['edit_estado_ocu']);
                $OCUPANTED->setidOcupante($_POST['idOcupante']);

                //llamando al inser de modelo solicitud
                $updateOcupante = $this->OCUPANTE->updateOcupante($OCUPANTED);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($updateOcupante) {
                    echo json_encode(['success' => true, 'message' => 'Se actualizo ocupante']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar ocupante']);
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

    public function eliminarOcupante()
    {

        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idocupante = $_POST['id'] ?? '';

        $resultado = $this->OCUPANTE->deleteOcupante($idocupante);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }


    //Llamado de vista para actualización

    public function listaDepartamentoO()
    {
        // Simula datos desde la BD
        $departamento_ocupante = $this->MODELOS->listDepartamento(); // Array de objetos con idedificio y edificio

        echo json_encode($departamento_ocupante);
    }

    public function listaSexoO()
    {
        // Simula datos desde la BD
        $sexo_ocupante = $this->MODELOS->listSexo(); // Array de objetos con idedificio y edificio

        echo json_encode($sexo_ocupante);
    }

    public function listRelacionO()
    {
        // Simula datos desde la BD
        $relacion_ocupante = $this->MODELOS->listRelacionPropietario(); // Array de objetos con idtipo y tipo

        echo json_encode($relacion_ocupante);
    }
}
