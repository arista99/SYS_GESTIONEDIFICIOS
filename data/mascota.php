<?php

class Mascota
{

    private $idMascota;
    private $departamentoFK;
    private $nombre;
    private $especieFK;

    public function __construct()
    {
        $this->idMascota = "";
        $this->departamentoFK = "";
        $this->nombre = "";
        $this->especieFK = "";
    }

    function setidMascota($idMascota)
    {
        $this->idMascota= $idMascota;
    }

    function getidMascota()
    {
        return $this->idMascota;
    }

    function setdepartamentoFK($departamentoFK)
    {
        $this->departamentoFK= $departamentoFK;
    }

    function getdepartamentoFK()
    {
        return $this->departamentoFK;
    }

    function setnombre($nombre)
    {
        $this->nombre= $nombre;
    }

    function getnombre()
    {
        return $this->nombre;
    }

    function setespecieFK($especieFK)
    {
        $this->especieFK= $especieFK;
    }

    function getespecieFK()
    {
        return $this->especieFK;
    }
}
