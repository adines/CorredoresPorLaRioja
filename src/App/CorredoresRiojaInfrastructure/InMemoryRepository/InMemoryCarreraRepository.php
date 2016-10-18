<?php

namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Repository\ICarreraRepository;
use App\CorredoresRiojaDomain\Model\Organizacion;

class InMemoryCarreraRepository implements ICarreraRepository{
    
    private $carreras;
    
    function __construct() {
        $this->carreras=array();
        $this->carreras[]=new Carrera(1, "Matutrail", "Carrera por Matute", new \DateTime('2017-02-01'), 100, new \DateTime('2017-02-01'), 2, "matutrail.jpg", new Organizacion(1, "Matute", "desc", "pepe@gmail.com", "pass"));
        $this->carreras[]=new Carrera(2, "nombre2", "una carrera2", new \DateTime('2013-02-01'), 100, new \DateTime('2014-02-01'), 2, "", new Organizacion(1, "org1", "desc", "pepe@gmail.com", "pass"));
        $this->carreras[]=new Carrera(3, "nombre3", "una carrera2", new \DateTime('2015-02-01'), 100, new \DateTime('2017-02-01'), 2, "", new Organizacion(1, "org1", "desc", "pepe@gmail.com", "pass"));
        
    }

        
    public function actualizarInformacionCarrera(Carrera $carrera) {
        foreach ($this->carreras as $key => $value)
        {
            if($value->getId()==$carrera->getId())
            {
                $this->carreras[$key]=$carrera;
            }
        }
    }

    public function buscarCarreraSlug($slug) {
        foreach ($this->carreras as $carrera)
        {
            if($carrera->getSlug()==$slug)
            {
                return $carrera;
            }
        }
        return null;
    }
    
    public function buscarCarreraOrganizacionDisputadas(Organizacion $organizacion) {  
        $aux=array();
        foreach ($this->carreras as $carrera)
        {
            if($carrera->estaDisputada() && $carrera->getOrganizacion()==$organizacion)
            {
                $aux[]= $carrera;
            }
        }
        return $aux;
    }

    public function buscarCarreraOrganizacionNODisputadas(Organizacion $organizacion) {
        $aux=array();
        foreach ($this->carreras as $carrera)
        {
            if(!($carrera->estaDisputada()) && $carrera->getOrganizacion()==$organizacion)
            {
                $aux[]= $carrera;
            }
        }
        return $aux;
    }

    public function buscarCarrerasDisputadas() {
        $aux=array();
        foreach ($this->carreras as $carrera)
        {
            if($carrera->estaDisputada())
            {
                $aux[]= $carrera;
            }
        }
        return $aux;
    }

    public function buscarCarrerasNODisputadas() {
        $aux=array();
        foreach ($this->carreras as $carrera)
        {
            if(!($carrera->estaDisputada()))
            {
                $aux[]= $carrera;
            }
        }
        return $aux;
        
    }

    public function buscarTodasCarreras() {
        return $this->carreras;
    }

    public function eliminarCarrera(Carrera $carrera) {
        foreach ($this->carreras as $key => $value)
        {
            if($value->getId()==$carrera->getId())
            {
                unset($this->carreras[$key]);
            }
        }
    }

    public function registrarCarrera(Carrera $carrera) {
        $this->carreras[]= $carrera;
    }

    public function buscarCarrerasOrganizacion(Organizacion $organizacion) {
        $aux=array();
        foreach ($this->carreras as $carrera)
        {
            if($carrera->getOrganizacion()==$organizacion)
            {
                $aux[]= $carrera;
            }
        }
        return $aux;
    }

}
