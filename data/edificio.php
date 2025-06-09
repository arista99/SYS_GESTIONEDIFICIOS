<?php

class Edificio
{

    private $idEdificio;
    private $denominacion;
    private $nroDePisos;
    private $fechaRegistro;
    private $estado;

    public function __construct()
    {
        $this->idEdificio = "";
        $this->denominacion = "";
        $this->nroDePisos = "";
        $this->fechaRegistro = "";
        $this->estado = ""; "";
    }

    function setidEdificio($idEdificio)
    {
        $this->idEdificio= $idEdificio;
    }

    function getidEdificio()
    {
        return $this->idEdificio;
    }

    function setdenominacion($denominacion)
    {
        $this->denominacion= $denominacion;
    }

    function getdenominacion()
    {
        return $this->denominacion;
    }

    function setnroDePisos($nroDePisos)
    {
        $this->nroDePisos= $nroDePisos;
    }

    function getnroDePisos()
    {
        return $this->nroDePisos;
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
