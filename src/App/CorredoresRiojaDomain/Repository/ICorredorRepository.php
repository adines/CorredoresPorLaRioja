<?php

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Corredor;

interface ICorredorRepository {
    
    public function registrarCorredor(Corredor $corredor);
    public function actualizarInformacionCorredor(Corredor $corredor);
    public function eliminarCorredor(Corredor $corredor);
    public function buscarCorredor($dni);
    public function buscarTodosCorredores();
    
    
}
