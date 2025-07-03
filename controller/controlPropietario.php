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

}