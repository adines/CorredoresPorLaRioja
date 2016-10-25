<?php

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Participante;
use \App\CorredoresRiojaDomain\Model\Corredor;

interface IParticipanteRepository {
    
    public function inscribirParticipanteCarrera(Corredor $corredor, Carrera $carrera);
    public function actualizarTiempoCorredorCarrera(Corredor $corredor,Carrera $carrera,$tiempo);
    public function eliminarParticipante(Participante $participante);
    public function buscarTodosParticiantes();
    public function buscarParticiantesCarrera(Carrera $carrera);
    public function buscarCarrerasDisputadasCorredor(Corredor $corredor);
    public function buscarCarrerasNODisputadasCorredor(Corredor $corredor);
    public function estaInscritoCorredorCarrera(Corredor $corredor,Carrera $carrera);
    

}
