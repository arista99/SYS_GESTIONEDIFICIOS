<?php

class Usuario
{

    private $idUsuario;
    private $nombres;
    private $apePaterno;
    private $apeMaterno;
    private $usuario;
    private $contrasena;
    private $idRol;


    public function __construct()
    {
        $this->idUsuario = "";
        $this->nombres = "";
        $this->apePaterno = "";
        $this->apeMaterno = "";
        $this->usuario = "";
        $this->contrasena = "";
        $this->idRol = "";
    }

    function setidUsuario($idUsuario)
    {
        $this->idUsuario= $idUsuario;
    }

    function getidUsuario()
    {
        return $this->idUsuario;
    }

    function setnombres($nombres)
    {
        $this->nombres= $nombres;
    }

    function getnombres()
    {
        return $this->nombres;
    }

    function setapePaterno($apePaterno)
    {
        $this->apePaterno= $apePaterno;
    }

    function getapePaterno()
    {
        return $this->apePaterno;
    }

    function setapeMaterno($apeMaterno)
    {
        $this->apeMaterno= $apeMaterno;
    }

    function getapeMaterno()
    {
        return $this->apeMaterno;
    }

    function setusuario($usuario)
    {
        $this->usuario= $usuario;
    }

    function getusuario()
    {
        return $this->usuario;
    }
    
    function setcontrasena($contrasena)
    {
        $this->contrasena= $contrasena;
    }

    function getcontrasena()
    {
        return $this->contrasena;
    }

    function setidRol($idRol)
    {
        $this->idRol= $idRol;
    }

    function getidRol()
    {
        return $this->idRol;
    }
}