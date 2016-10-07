<?php

namespace App\CorredoresRiojaDomain\Model;

class Participante {
    private $corredor;
    private $carrera;
    private $dorsal;
    private $tiempo;
    
    function __construct(Corredor $corredor,Carrera $carrera, $dorsal, $tiempo) {
        $this->corredor = $corredor;
        $this->carrera = $carrera;
        $this->dorsal = $dorsal;
        $this->tiempo = $tiempo;
    }
    
    function getCorredor() {
        return $this->corredor;
    }

    function getCarrera() {
        return $this->carrera;
    }

    function getDorsal() {
        return $this->dorsal;
    }

    function getTiempo() {
        return $this->tiempo;
    }

    function setCorredor($corredor) {
        $this->corredor = $corredor;
    }

    function setCarrera($carrera) {
        $this->carrera = $carrera;
    }

    function setDorsal($dorsal) {
        $this->dorsal = $dorsal;
    }

    function setTiempo($tiempo) {
        $this->tiempo = $tiempo;
    }
    
    

}
