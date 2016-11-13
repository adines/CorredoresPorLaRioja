<?php

namespace CorredoresRiojaBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryOrganizacionRepository;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryCarreraRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Description of OrganizacionController
 *
 * @author adines
 */
class OrganizacionController {
    
    private $servicioOrganizacion;
    private $servicioCarrera;
    private $template;
    private $authorizationChecker;
    private $securityContext;
    
    function __construct(InMemoryOrganizacionRepository $servicioOrganizacion,InMemoryCarreraRepository $servicioCarrera,EngineInterface $template,AuthorizationCheckerInterface $authorizationChecker, SecurityContextInterface $securityContext) {
        $this->servicioOrganizacion = $servicioOrganizacion;
        $this->servicioCarrera = $servicioCarrera;
        $this->template=$template;
        $this->authorizationChecker = $authorizationChecker;
        $this->securityContext = $securityContext;
    }
    
    public function showOrganizacionSlugAction($slug)
    {
        $organizacion = $this -> servicioOrganizacion -> buscarOrganizacionSlug($slug);
        $carreras =$this -> servicioCarrera -> buscarCarrerasOrganizacion($organizacion);
    	return new Response($this->template->render('CorredoresRiojaBundle:Corredores:organizacion.html.twig',array('organizacion'=>$organizacion,'carreras'=>$carreras)));
        //return new Response($organizacion);
    } 
    
    public function showCarrerasOrganizacionAction()
    {
        if (!$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }
        $user = $this->securityContext->getToken()->getUser();
        $organizacion = $this->servicioOrganizacion->buscarOrganizacionEmail($user->getUsername());
        $carrerasDisputadas = $this->servicioCarrera->buscarCarreraOrganizacionDisputadas($organizacion);
        $carrerasNODisputadas = $this->servicioCarrera->buscarCarreraOrganizacionNODisputadas($organizacion);
        return new Response($this->template->render('CorredoresRiojaBundle:Organizaciones:carreras.html.twig', array('carrerasDisputadas' => $carrerasDisputadas, 'carrerasNODisputadas' => $carrerasNODisputadas)));
    }  
}
