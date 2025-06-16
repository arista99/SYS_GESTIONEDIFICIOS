<?php
//MODEL
include_once('model/modelEdificio.php');
include_once('model/modelModelos.php');

//DATA
include_once('data/edificio.php');

class controlEdificio
{

    //VARIABLE MODELO
    public $EDIFICIO;
    public $MODELOS;

    public function __construct()
    {
        $this->EDIFICIO = new ModeloEdificio();
        $this->MODELOS = new ModeloModelos();
    }

    public function EdificioControl()
    {
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['idUsuario'])) {
            // Redirigir al login si no está autenticado
            header("Location: LoginUsuario");
            exit;
        }

        $list_edificio = $this->MODELOS->listEdificio();

        include_once('views/paginas/administrador/edificios/edificio.php');
    }

    public function ListaEdificio()
    {
        // Obtener valores desde la solicitud AJAX
        $denominacion = $_POST['denominacion'] ?? '';

        // Llama al modelo
        $resultados = $this->EDIFICIO->findEdificio($denominacion);

        //Enviar respuesta al frontend
        header('Content-Type: application/json');
        echo json_encode(['data' => $resultados]);
    }

    public function registrarEdificio()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $edificio = new Edificio();
                $edificio->setdenominacion($_POST['condominio']);
                $edificio->setdireccion($_POST['direccion']);
                $edificio->setnroDePisos($_POST['nropiso']);
                $edificio->setnroDeDepartamentos($_POST['nrodepa']);
                $edificio->setestado($_POST['estado_con']);

                //llmando al inser de modelo solicitud
                $create_edificio = $this->EDIFICIO->insertEdificio($edificio);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($create_edificio) {
                    echo json_encode(['success' => true, 'message' => 'Ticket actualizado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar el ticket']);
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

    public function actualizarEdificio()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $errores = [];

if (empty($_POST['idEdificio']) || !is_numeric($_POST['idEdificio'])) {
    $errores[] = "ID inválido";
}
if (empty($_POST['edit_condominio'])) {
    $errores[] = "El campo Condominio es obligatorio.";
}
if (empty($_POST['edit_direccion'])) {
    $errores[] = "El campo Dirección es obligatorio.";
}
if (!is_numeric($_POST['edit_nropiso'])) {
    $errores[] = "Nro de Pisos debe ser numérico.";
}
if (!is_numeric($_POST['edit_nrodepa'])) {
    $errores[] = "Nro de Departamentos debe ser numérico.";
}
if (empty($_POST['edit_estado_con'])) {
    $errores[] = "El campo Estado es obligatorio.";
}

if (!empty($errores)) {
    echo json_encode(['success' => false, 'message' => implode(" | ", $errores)]);
    exit;
}


                error_log(print_r($_POST, true)); 
                $edificio = new Edificio();
                $edificio->setidEdificio($_POST['idEdificio']);
                $edificio->setdenominacion($_POST['edit_condominio']);
                $edificio->setdireccion($_POST['edit_direccion']);
                $edificio->setnroDePisos($_POST['edit_nropiso']);
                $edificio->setnroDeDepartamentos($_POST['edit_nrodepa']);
                $edificio->setestado($_POST['edit_estado_con']);

                // var_dump($edificio);
                //llmando al inser de modelo solicitud
                $update_edificio = $this->EDIFICIO->updateEdificio($edificio);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($update_edificio) {
                    echo json_encode(['success' => true, 'message' => 'Ticket actualizado correctamente']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar el ticket']);
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

    public function eliminarEdificio()
    {

        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idedificio = $_POST['id'] ?? '';

        $resultado = $this->EDIFICIO->deleteEdificio($idedificio);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }
}
