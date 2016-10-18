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
        
    }

    public function estaInscritoCorredorCarrera(Corredor $corredor, Carrera $carrera) {
        
    }

    public function inscribirParticipanteCarrera(Participante $participante, Carrera $carrera) {
        
    }

}
