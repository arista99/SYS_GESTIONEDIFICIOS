<?php

class Departamento
{

    private $idDepartamento;
    private $edificioFK;
    private $nroDepartamento;
    private $areaM2;
    private $tipoDepartamentoFK;
    private $estadoFK;
    private $fechaRegistro;
    private $autorregistro;
    private $piso;
    private $telefono;

    public function __construct()
    {
        $this->idDepartamento = "";
        $this->edificioFK = "";
        $this->nroDepartamento = "";
        $this->areaM2 = "";
        $this->tipoDepartamentoFK = "";
        $this->estadoFK = "";
        $this->fechaRegistro = "";
        $this->autorregistro = "";
        $this->piso = "";
        $this->telefono = "";
    }

    function setidDepartamento($idDepartamento)
    {
        $this->idDepartamento= $idDepartamento;
    }

    function getidDepartamento()
    {
        return $this->idDepartamento;
    }

    function setedificioFK($edificioFK)
    {
        $this->edificioFK= $edificioFK;
    }

    function getedificioFK()
    {
        return $this->edificioFK;
    }

    function setnroDepartamento($nroDepartamento)
    {
        $this->nroDepartamento= $nroDepartamento;
    }

    function getnroDepartamento()
    {
        return $this->nroDepartamento;
    }

    function setareaM2($areaM2)
    {
        $this->areaM2= $areaM2;
    }

    function getareaM2()
    {
        return $this->areaM2;
    }

    function settipoDepartamentoFK($tipoDepartamentoFK)
    {
        $this->tipoDepartamentoFK= $tipoDepartamentoFK;
    }

    function gettipoDepartamentoFK()
    {
        return $this->tipoDepartamentoFK;
    }
    
    function setestadoFK($estadoFK)
    {
        $this->estadoFK= $estadoFK;
    }

    function getestadoFK()
    {
        return $this->estadoFK;
    }

    function setfechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro= $fechaRegistro;
    }

    function getfechaRegistro()
    {
        return $this->fechaRegistro;
    }

    function setautorregistro($autorregistro)
    {
        $this->autorregistro= $autorregistro;
    }

    function getautorregistro()
    {
        return $this->autorregistro;
    }

    function setpiso($piso)
    {
        $this->piso= $piso;
    }

    function getpiso()
    {
        return $this->piso;
    }

    function settelefono($telefono)
    {
        $this->telefono= $telefono;
    }

    function gettelefono()
    {
        return $this->telefono;
    }
}
