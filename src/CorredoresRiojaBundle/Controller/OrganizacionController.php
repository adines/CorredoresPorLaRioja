<?php

namespace CorredoresRiojaBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryOrganizacionRepository;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryCarreraRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Description of OrganizacionController
 *
 * @author adines
 */
class OrganizacionController{
    
    private $servicioOrganizacion;
    private $servicioCarrera;
    private $template;
    
    function __construct(InMemoryOrganizacionRepository $servicioOrganizacion,InMemoryCarreraRepository $servicioCarrera,EngineInterface $template) {
        $this->servicioOrganizacion = $servicioOrganizacion;
        $this->servicioCarrera = $servicioCarrera;
        $this->template=$template;
    }
    
    public function showOrganizacionSlugAction($slug)
    {
        $organizacion = $this -> servicioOrganizacion -> buscarOrganizacionSlug($slug);
        $carreras =$this -> servicioCarrera -> buscarCarreraOrganizacion($organizacion);
    	return new Response($this->template->render('CorredoresRiojaBundle:Corredores:organizacion.html.twig',array('organizacion'=>$organizacion,'carreras'=>$carreras)));
        //return new Response($organizacion);
    }  
}
