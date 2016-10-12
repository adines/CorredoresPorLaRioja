<?php

namespace CorredoresRiojaBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryOrganizacionRepository;

/**
 * Description of OrganizacionController
 *
 * @author adines
 */
class OrganizacionController{
    
    private $servicio;
    
    function __construct(InMemoryOrganizacionRepository $servicio) {
        $this->servicio = $servicio;
    }
    
    public function showOrganizacionSlugAction($slug)
    {
        $organizacion = $this -> servicio -> buscarOrganizacionSlug($slug);   
    	return new Response($organizacion);
    }  
}
