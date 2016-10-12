<?php

namespace CorredoresRiojaBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryCarreraRepository;

/**
 * Description of CarrerasController
 *
 * @author adines
 */
class CarrerasController {
    
    private $servicio;
    
    function __construct(InMemoryCarreraRepository $servicio) {
        $this->servicio = $servicio;
    }

    
    
    public function showAllAction()
    {
        $carreras = $this -> servicio -> buscarTodasCarreras();   
    	return new Response(implode("<br/>", $carreras));
    }
    
    public function showCarreraSlugAction($slug)
    {
        $carrera = $this -> servicio -> buscarCarreraSlug($slug);   
    	return new Response($carrera);
    }   
}
