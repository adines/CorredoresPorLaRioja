<?php

namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Repository\ICarreraRepository;
use App\CorredoresRiojaDomain\Model\Organizacion;

class InMemoryCarreraRepository implements ICarreraRepository{
    
    private $carreras;
    
    function __construct() {
        $this->carreras=array();
        $this->carreras[]=new Carrera(1, "nombre1", "una carrera", '13-02-2013', 100, '13-01-2013', 2, "", null);
        $this->carreras[]=new Carrera(2, "nombre2", "una carrera2",'20-02-2017', 100, '13-01-2017', 2, "", null);
        $this->carreras[]=new Carrera(3, "nombre3", "una carrera2",'20-02-2020', 100, '13-01-2020', 2, "", null);
        
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
