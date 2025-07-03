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
        $lista_listRelacionPropietario = $this->MODELOS->listRelacionPropietario();

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

}