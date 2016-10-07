<?php

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Organizacion;

interface IOrganizacionRepository {
    
    public function registrarOrganizacion(Organizacion $organizacion);
    public function actualizarInformacionOrganizacion(Organizacion $organizacion);
    public function eliminarOrganizacion(Organizacion $organizacion);
    public function buscarOrganizacionSlug($slug);
    public function buscarOrganizacionEmail($email);
    public function buscarTodasOrganizaciones();
    
}
