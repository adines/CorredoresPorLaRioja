<?php

namespace CorredoresRiojaBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryCarreraRepository;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryParticipanteRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Description of CarrerasController
 *
 * @author adines
 */
class CarrerasController{
    
    private $servicioCarrera;
    private $servicioParticipante;
    private $template;
    
    function __construct(InMemoryCarreraRepository $servicioCarrera, InMemoryParticipanteRepository $servicioParticipante,EngineInterface $template) {
        $this->servicioCarrera = $servicioCarrera;
        $this->servicioParticipante = $servicioParticipante;
        $this->template=$template;
    }

    
    
    public function showAllAction()
    {
        $carrerasDisp = $this -> servicioCarrera ->buscarCarrerasDisputadas(); 
        $carrerasNoDisp=$this -> servicioCarrera ->buscarCarrerasNODisputadas();
        return new Response($this->template->render('CorredoresRiojaBundle:Corredores:carreras.html.twig',array('carrerasPorDisputar'=>$carrerasNoDisp,'carrerasDisputadas'=>$carrerasDisp)));
    	//return new Response(implode("<br/>", $carreras));
    }
    
    public function showCarreraSlugAction($slug)
    {
        $carrera = $this -> servicioCarrera -> buscarCarreraSlug($slug);
        $participantes=$this -> servicioParticipante -> buscarParticiantesCarrera($carrera);
    	return new Response($this->template->render('CorredoresRiojaBundle:Corredores:carrera.html.twig',array('carrera'=>$carrera,'participantes'=>$participantes)));
        //return new Response($carrera);
    }   
}
