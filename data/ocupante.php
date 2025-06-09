<?php

class Ocupante
{
    private $idOcupante;
    private $departamentoFK;
    private $nombres;
    private $apePaterno;
    private $apeMaterno;
    private $dni;
    private $celular;
    private $sexoFK;
    private $relacionFK;
    private $fechaRegistro;
    private $estado;

    public function __construct()
    {
        $this->idOcupante = "";
        $this->departamentoFK = "";
        $this->nombres = "";
        $this->apePaterno = "";
        $this->apeMaterno = "";
        $this->dni = "";
        $this->celular = "";
        $this->sexoFK = "";
        $this->relacionFK = "";
        $this->fechaRegistro = "";
        $this->estado = "";
    }

    function setidOcupante($idOcupante)
    {
        $this->idOcupante= $idOcupante;
    }

    function getidOcupante()
    {
        return $this->idOcupante;
    }

    function setdepartamentoFK($departamentoFK)
    {
        $this->departamentoFK= $departamentoFK;
    }

    function getdepartamentoFK()
    {
        return $this->departamentoFK;
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

    function setsexoFK($sexoFK)
    {
        $this->sexoFK= $sexoFK;
    }

    function getsexoFK()
    {
        return $this->sexoFK;
    }

    function setrelacionFK($relacionFK)
    {
        $this->relacionFK= $relacionFK;
    }

    function getrelacionFK()
    {
        return $this->relacionFK;
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
}