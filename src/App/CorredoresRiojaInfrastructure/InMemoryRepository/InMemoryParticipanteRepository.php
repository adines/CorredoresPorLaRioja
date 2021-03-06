<?php


namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;
use App\CorredoresRiojaDomain\Model\Participante;
use App\CorredoresRiojaDomain\Repository\IParticipanteRepository;
use App\CorredoresRiojaDomain\Model\Corredor;
use App\CorredoresRiojaDomain\Model\Carrera;

class InMemoryParticipanteRepository implements IParticipanteRepository{
    
    private $participantes;
    
    function __construct() {
        $this->participantes=array();
    }
    
    public function actualizarTiempoCorredorCarrera(Corredor $corredor, Carrera $carrera, $tiempo) {
        foreach ($this->participantes as $participante)
        {
            if($participante->getCorredor()->getDni()==$corredor->getDni() && $participante->getCarrera()->getId()==$carrera->getId())
            {
                $participante->setTiempo($tiempo);
            }
        }
    }

    public function buscarCarrerasDisputadasCorredor(Corredor $corredor) {
        $aux=array();
        foreach ($this->participantes as $participante)
        {
            if($participante->getCorredor()==$corredor && $participante->getCarrera()->estaDisputada())
            {
                $aux[]= $participante->getCarrera();
            }
        }
        return $aux;
    }

    public function buscarCarrerasNODisputadasCorredor(Corredor $corredor) {
        $aux=array();
        foreach ($this->participantes as $participante)
        {
            if($participante->getCorredor()==$corredor && !($participante->getCarrera()->estaDisputada()))
            {
                $aux[]= $participante->getCarrera();
            }
        }
        return $aux;
    }

    public function buscarParticiantesCarrera(Carrera $carrera) {
        $aux=array();
        foreach ($this->participantes as $participante)
        {
            if($participante->getCarrera()==$carrera)
            {
                $aux[]= $participante;
            }
        }
        return $aux;
    }

    public function buscarTodosParticiantes() {
        return $this->participantes;
    }

    public function eliminarParticipante(Participante $participante) {
        foreach ($this->participantes as $key => $value)
        {
            if($value->getCorredor()->getDni()==$participante->getCorredor()->getDni() && $value->getCarrera()->getId()==$participante->getCarrera()->getId())
            {
                unset($this->participantes[$key]);
            }
        }
    }

    public function estaInscritoCorredorCarrera(Corredor $corredor, Carrera $carrera) {
        foreach ($this->participantes as $key => $value)
        {
            if($value->getCorredor()->getDni()==$corredor->getDni() && $value->getCarrera()->getId()==$carrera->getId())
            {
                return true;
            }
        }
        return false;
    }

    public function inscribirParticipanteCarrera(Corredor $corredor, Carrera $carrera) {
        $this->participantes[]=new Participante($corredor, $carrera, 0, 0);
    }

}
