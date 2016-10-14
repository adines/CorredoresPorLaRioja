<?php

namespace CorredoresRiojaBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryCarreraRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Description of CarrerasController
 *
 * @author adines
 */
class CarrerasController {
    
    private $servicio;
    private $template;
    
    function __construct(InMemoryCarreraRepository $servicio,EngineInterface $template) {
        $this->servicio = $servicio;
        $this->template=$template;
    }

    
    
    public function showAllAction()
    {
        $carreras = $this -> servicio -> buscarTodasCarreras(); 
        return new Response($this->template->render('CorredoresRiojaBundle:Corredores:carreras.html.twig',array('carrerasPorDisputar'=>$carreras,'carrerasDisputadas'=>$carreras)));
    	//return new Response(implode("<br/>", $carreras));
    }
    
    public function showCarreraSlugAction($slug)
    {
        $carrera = $this -> servicio -> buscarCarreraSlug($slug);   
    	return new Response($carrera);
    }   
}
