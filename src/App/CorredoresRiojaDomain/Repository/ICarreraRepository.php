<?php

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Organizacion;

interface ICarreraRepository {
    
    public function registrarCarrera(Carrera $carrera);
    public function actualizarInformacionCarrera(Carrera $carrera);
    public function eliminarCarrera(Carrera $carrera);
    public function buscarCarreraSlug($slug);
    public function buscarCarreraOrganizacionDisputadas(Organizacion $organizacion);
    public function buscarCarreraOrganizacionNODisputadas(Organizacion $organizacion);
    public function buscarTodasCarreras();
    public function buscarCarrerasDisputadas();
    public function buscarCarrerasNODisputadas();
    
}
