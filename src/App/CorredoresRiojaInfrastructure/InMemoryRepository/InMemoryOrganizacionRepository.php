<?php

namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;
use App\CorredoresRiojaDomain\Model\Organizacion;
use App\CorredoresRiojaDomain\Repository\IOrganizacionRepository;

class InMemoryOrganizacionRepository implements IOrganizacionRepository{
    
    private $organizaciones;
    
    function __construct() {
        $this->organizaciones=array();
    }

    
    public function actualizarInformacionOrganizacion(Organizacion $organizacion) {
        foreach ($this->organizaciones as $key => $value)
        {
            if($value->getId==$organizacion->getId())
            {
                $this->organizaciones[$key]=$organizacion;
            }
        }
        
    }

    public function buscarOrganizacionEmail($email) {
        foreach ($this->organizaciones as $organizacion)
        {
            if($organizacion->getEmail()==$email)
            {
                return $organizacion;
            }
        }
        return null;
    }

    public function buscarOrganizacionSlug($slug) {
        foreach ($this->organizaciones as $organizacion)
        {
            if($organizacion->getSlug()==$slug)
            {
                return $organizacion;
            }
        }
        return null;
    }

    public function buscarTodasOrganizaciones() {
        return $this->organizaciones;
    }

    public function eliminarOrganizacion(Organizacion $organizacion) {
        foreach ($this->organizaciones as $key => $value)
        {
            if($value->getId()==$organizacion->getId())
            {
                unset($this->organizaciones[$key]);
            }
        }
    }

    public function registrarOrganizacion(Organizacion $organizacion) {
        $this->organizaciones[]= $organizacion;
    }
}
