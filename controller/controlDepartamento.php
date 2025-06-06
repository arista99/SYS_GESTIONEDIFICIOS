<?php
//MODEL

//DATA

class controlDepartamento
{

    //VARIABLE MODELO
    //public $;


    public function __construct()
    {
        
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

        include_once('views/paginas/administrador/departamentos/departamento.php');
    }

}