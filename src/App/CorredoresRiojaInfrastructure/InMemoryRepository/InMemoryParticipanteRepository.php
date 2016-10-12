<?php


namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;
use App\CorredoresRiojaDomain\Model\Participante;
use App\CorredoresRiojaDomain\Repository\IParticipanteRepository;
use App\CorredoresRiojaDomain\Model\Corredor;
use App\CorredoresRiojaDomain\Model\Carrera;

class InMemoryParticipanteRepository implements IParticipanteRepository{
    //put your code here
    public function actualizarTiempoCorredorCarrera(Corredor $corredor, Carrera $carrera, $tiempo) {
        
    }

    public function buscarCarrerasDisputadasCorredor(Corredor $corredor) {
        
    }

    public function buscarCarrerasNODisputadasCorredor(Corredor $corredor) {
        
    }

    public function buscarParticiantesCarrera(Carrera $carrera) {
        
    }

    public function buscarTodosParticiantes() {
        
    }

    public function eliminarParticipante(Participante $participante) {
        
    }

    public function estaInscritoCorredorCarrera(Corredor $corredor, Carrera $carrera) {
        
    }

    public function inscribirParticipanteCarrera(Participante $participante, Carrera $carrera) {
        
    }

}
