<?php
//MODEL
include_once('model/modelMascota.php');
include_once('model/modelModelos.php');

//DATA
include_once('data/ocupante.php');

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
}