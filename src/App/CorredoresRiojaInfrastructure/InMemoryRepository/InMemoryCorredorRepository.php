<?php

namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;
use App\CorredoresRiojaDomain\Model\Corredor;
use App\CorredoresRiojaDomain\Repository\ICorredorRepository;

class InMemoryCorredorRepository implements ICorredorRepository{
    
    private $corredores;

    function __construct() {
        $this->corredores=array();
        $this->corredores[]=new Corredor('1234', 'pepe', 'a', 'a@a.com', '1234', 'a',new \DateTime());
    }

    public function actualizarInformacionCorredor(Corredor $corredor) {
        foreach ($this->corredores as $key => $value)
        {
            if($value->getDni()==$corredor->getDni())
            {
                $this->corredores[$key]=$corredor;
            }
        }
    }

    public function buscarCorredor($dni) {
        foreach ($this->corredores as $corredor)
        {
            if($corredor->getDni()==$dni)
            {
                return $corredor;
            }
        }
        return null;
    }

    public function buscarTodosCorredores() {
        return $this->corredores;
        
    }

    public function eliminarCorredor(Corredor $corredor) {
        foreach ($this->corredores as $key => $value)
        {
            if($value->getDni()==$corredor->getDni())
            {
                unset($this->corredores[$key]);
            }
        }
    }

    public function registrarCorredor(Corredor $corredor) {
        $this->corredores[]= $corredor;
    }

}
