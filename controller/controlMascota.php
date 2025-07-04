<?php
//MODEL
include_once('model/modelMascota.php');
include_once('model/modelModelos.php');

//DATA
include_once('data/mascota.php');

class controlMascota
{
    //VARIABLE MODELO
    public $MASCOTA;
    public $MODELOS;

    public function __construct()
    {
        $this->MASCOTA = new ModeloMascota();
        $this->MODELOS = new ModeloModelos();
    }

    public function MascotaControl()
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
        $lista_especiemascota = $this->MODELOS->listEspecieMascota();


        include_once('views/paginas/administrador/mascotas/mascota.php');
    }

    public function ListaMascota()
    {
    // Obtener valores desde la solicitud AJAX
    $mascota = $_POST['mascota'] ?? '';

    // Llama al modelo
    $resultados = $this->MASCOTA->findMascota($mascota);

    // Enviar respuesta al frontend
    header('Content-Type: application/json');
    echo json_encode(['data' => $resultados]);
    }

    public function RegistrarMascota()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $MASCOTAP = new Mascota;
                $MASCOTAP->setdepartamentoFK($_POST['dep_mascota']);
                $MASCOTAP->setnombre($_POST['nom_mascota']);
                $MASCOTAP->setespecieFK($_POST['esp_mascota']);

                //llamando al inser de modelo solicitud
                $createMascota = $this->MASCOTA->createMascota($MASCOTAP);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($createMascota) {
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

    public function ActualizarMascota()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $MASCOTAP = new Mascota();
                $MASCOTAP->setdepartamentoFK($_POST['edit_dep_mascota']);
                $MASCOTAP->setnombre($_POST['edit_nom_mascota']);
                $MASCOTAP->setespecieFK($_POST['edit_esp_mascota']);
                $MASCOTAP->setidMascota($_POST['idMascota']);

                //llamando al inser de modelo solicitud
                $updateMascota = $this->MASCOTA->updateMascota($MASCOTAP);

                // Responder con JSON para que AJAX pueda manejar la respuesta
                if ($updateMascota) {
                    echo json_encode(['success' => true, 'message' => 'Se actualizo mascota']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al actualizar mascota']);
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

    public function eliminarMascota()
    {

        // Obtener valores desde la solicitud AJAX
        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $idmascota = $_POST['id'] ?? '';

        $resultado = $this->MASCOTA->deleteMascota($idmascota);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'No se pudo eliminar']);
        }
    }


    //Llamado de vista para actualización

    public function listaDepartamentoM()
    {
        // Simula datos desde la BD
        $departamento_mascota = $this->MODELOS->listDepartamento(); // Array de objetos con idedificio y edificio

        echo json_encode($departamento_mascota);
    }

    public function listEspecieM()
    {
        // Simula datos desde la BD
        $especie_mascota = $this->MODELOS->listEspecieMascota(); // Array de objetos con idtipo y tipo

        echo json_encode($especie_mascota);
    }
}