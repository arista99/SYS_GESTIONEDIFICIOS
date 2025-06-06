<?php
//MODEL

//DATA

class controlMascota
{

    //VARIABLE MODELO
    //public $;


    public function __construct()
    {
        
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

        include_once('views/paginas/administrador/mascotas/mascota.php');
    }

}