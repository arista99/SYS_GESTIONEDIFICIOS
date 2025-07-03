<?php
//MODEL
require_once('model/modelDepartamento.php');
require_once('model/modelUsuario.php');

//DATA


class ControlUsuario
{

    //VARIABLE MODELO
    public $DEPARTAMENTO;
    public $USUARIO;


    public function __construct()
    {
        $this->DEPARTAMENTO = new ModeloDepartamento();
        $this->USUARIO = new ModeloUsuario();
    }

    public function ListaUsuario()
    {
        include_once('views/paginas/usuario/usuario.php');
    }

    public function ListaUsuarios()
    {
    // Obtener valores desde la solicitud AJAX
    $condominio = $_POST['inputCondominio'] ?? '';
    $nrohab = $_POST['inputHabitaciones'] ?? '';

    // Llama al modelo
    $resultados = $this->USUARIO->findUsuario($condominio, $nrohab);

    // Enviar respuesta al frontend
    header('Content-Type: application/json');
    echo json_encode(['data' => $resultados]);
    }

}