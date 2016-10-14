<?php

namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Repository\ICarreraRepository;
use App\CorredoresRiojaDomain\Model\Organizacion;

class InMemoryCarreraRepository implements ICarreraRepository{
    
    private $carreras;
    
    function __construct() {
        $this->carreras=array();
        $this->carreras[]=new Carrera(1, "nom", "", "", 10, "", 3, "", null);
        $this->carreras[]=new Carrera(2, "nom2", "", "", 10, "", 3, "", null);
        
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
        
    }

    public function buscarCarreraOrganizacionNODisputadas(Organizacion $organizacion) {
        
    }

    public function buscarCarrerasDisputadas() {
        
    }

    public function buscarCarrerasNODisputadas() {
        $aux=array();
        
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

}