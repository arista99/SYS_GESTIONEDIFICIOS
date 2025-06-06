<?php
//MODEL
require_once('model/modelLogin.php');

//DATA
require_once('data/usuario.php');

class ControlIndex
{

    //VARIABLE MODELO
    public $LOGIN;


    public function __construct()
    {
        $this->LOGIN = new ModeloLogin();
    }
    public function Index()
    {
        include_once('views/paginas/login/login.php');
    }

    public function LoginUsuario()
    {
        try {
            $login = new Usuario();
            $login->setusuario($_POST['usuario']);
            $login->setcontrasena($_POST['contrasena']);

            $acceso = $this->LOGIN->logeo($login);

            if ($acceso) {
                session_start();
                $_SESSION["idUsuario"] = $acceso->idUsuario;
                $_SESSION["usuario"] = $acceso->usuario;
                $_SESSION["idRol"] = $acceso->idRol;

                // Definir la URL de redirección según el rol
                $redirectUrl = "";

                if ($_SESSION["idRol"] == 4) {
                    $redirectUrl = "DashboardControl"; // Administrador
                } elseif ($_SESSION["idRol"] == 5) {
                    $redirectUrl = "DashboardControl"; // Soporte
                } else {
                    $redirectUrl = "DashboardControl"; // Usuario general
                }

                // Devolver respuesta JSON para AJAX
                echo json_encode([
                    "status" => "success",
                    "redirect" => $redirectUrl
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Credenciales incorrectas"
                ]);
            }
        } catch (Exception $th) {
            echo $th->getMessage();
        }
    }

    public function Close()
    {
        try {
            // Iniciar sesión
            session_start();

            // Destruir todas las variables de sesión
            $_SESSION = [];

            // Destruir la sesión
            session_destroy();


            // Eliminar la cookie de sesión si se usa
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            }

            // Redirigir al usuario a la página de login
            header("Location: Index");
            exit;
        } catch (Exception $th) {
            throw $th->getMessage();
        }
    }
}