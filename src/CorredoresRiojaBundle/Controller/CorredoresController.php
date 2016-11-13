<?php

namespace CorredoresRiojaBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryParticipanteRepository;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryCorredorRepository;
use App\CorredoresRiojaInfrastructure\InMemoryRepository\InMemoryCarreraRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use App\CorredoresRiojaDomain\Model\Participante;

/**
 * Description of CorredoresController
 *
 * @author adines
 */
class CorredoresController {

    private $servicioParticipante;
    private $servicioCorredor;
    private $servicioCarrera;
    private $template;
    private $authorizationChecker;
    private $securityContext;

    function __construct(InMemoryParticipanteRepository $servicioParticipante, InMemoryCorredorRepository $servicioCorredor, InMemoryCarreraRepository $servicioCarrera, EngineInterface $template, AuthorizationCheckerInterface $authorizationChecker, SecurityContextInterface $securityContext) {
        $this->servicioParticipante = $servicioParticipante;
        $this->servicioCorredor = $servicioCorredor;
        $this->servicioCarrera=$servicioCarrera;
        $this->template = $template;
        $this->authorizationChecker = $authorizationChecker;
        $this->securityContext = $securityContext;
    }

    public function showCarrerasCorredorAction() {
        if (!$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }
        $user = $this->securityContext->getToken()->getUser();
        $corredor = $this->servicioCorredor->buscarCorredor($user->getUsername());
        $carrerasDisputadas = $this->servicioParticipante->buscarCarrerasDisputadasCorredor($corredor);
        $carrerasNODisputadas = $this->servicioParticipante->buscarCarrerasNODisputadasCorredor($corredor);
        return new Response($this->template->render('CorredoresRiojaBundle:Corredores:misCarreras.html.twig', array('carrerasDisputadas' => $carrerasDisputadas, 'carrerasNODisputadas' => $carrerasNODisputadas,'nombre'=>$corredor->getNombre())));
    }
    
    public function desapuntarCarreraAction($slug)
    {
        if (!$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }
        $user = $this->securityContext->getToken()->getUser();
        $corredor = $this->servicioCorredor->buscarCorredor($user->getUsername());
        $carrera=$this->servicioCarrera->buscarCarreraSlug($slug);
        $this->servicioParticipante->eliminarParticipante(new Participante($corredor, $carrera, 0, 0));
        return new Response($this->template->render('CorredoresRiojaBundle:Corredores:portada.html.twig'));
    }
    
    public function apuntarCarreraAction($slug)
    {
        if (!$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }
        $user = $this->securityContext->getToken()->getUser();
        $corredor = $this->servicioCorredor->buscarCorredor($user->getUsername());
        $carrera=$this->servicioCarrera->buscarCarreraSlug($slug);
        $this->servicioParticipante->inscribirParticipanteCarrera($corredor, $carrera);
        return new Response($this->template->render('CorredoresRiojaBundle:Corredores:portada.html.twig'));
    }

}
