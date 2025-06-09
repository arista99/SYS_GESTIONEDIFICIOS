<?php

class Propietario
{

    private $idPropietario;
    private $nombres;
    private $apePaterno;
    private $apeMaterno;
    private $dni;
    private $celular;
    private $correo;
    private $sexoFK;
    private $departamentoFK;
    private $fechaRegistro;
    private $estado;
    private $autorregistro;

    public function __construct()
    {
        $this->idPropietario = "";
        $this->nombres = "";
        $this->apePaterno = "";
        $this->apeMaterno = "";
        $this->dni = "";
        $this->celular = "";
        $this->correo = "";
        $this->sexoFK = "";
        $this->departamentoFK = "";
        $this->fechaRegistro = "";
        $this->estado = "";
        $this->autorregistro = "";
    }

    function setidPropietario($idPropietario)
    {
        $this->idPropietario= $idPropietario;
    }

    function getidPropietario()
    {
        return $this->idPropietario;
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

    function setdni($dni)
    {
        $this->dni= $dni;
    }

    function getdni()
    {
        return $this->dni;
    }
    
    function setcelular($celular)
    {
        $this->celular= $celular;
    }

    function getcelular()
    {
        return $this->celular;
    }

    function setcorreo($correo)
    {
        $this->correo= $correo;
    }

    function getcorreo()
    {
        return $this->correo;
    }

    function setsexoFK($sexoFK)
    {
        $this->sexoFK= $sexoFK;
    }

    function getsexoFK()
    {
        return $this->sexoFK;
    }

    function setdepartamentoFK($departamentoFK)
    {
        $this->departamentoFK= $departamentoFK;
    }

    function getdepartamentoFK()
    {
        return $this->departamentoFK;
    }

    function setfechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro= $fechaRegistro;
    }

    function getfechaRegistro()
    {
        return $this->fechaRegistro;
    }

    function setestado($estado)
    {
        $this->estado= $estado;
    }

    function getestado()
    {
        return $this->estado;
    }

    function setautorregistro($autorregistro)
    {
        $this->autorregistro= $autorregistro;
    }

    function getautorregistro()
    {
        return $this->autorregistro;
    }
}
