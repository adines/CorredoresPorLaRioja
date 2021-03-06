<?php

namespace CorredoresRiojaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CorredoresRiojaBundle\Form\CorredorType;
use CorredoresRiojaBundle\Form\OrganizacionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('CorredoresRiojaBundle:Corredores:portada.html.twig');
    }

    public function adminAction() {
        return new Response('Página de administración');
    }

    public function registroAction(Request $peticion) {
        $form = $this->createForm(CorredorType::class);
        $form->add('registro', SubmitType::class, array('label' => 'Registro'));
        $form->handleRequest($peticion);
        if ($form->isValid()) {
            // Recogemos el corredor que se ha registrado
            $corredor = $form->getData();
// Codificamos la contraseña del corredor
            $encoder = $this->get('security.encoder_factory')->getEncoder($corredor);
            //$password = $encoder->encodePassword($corredor->getPassword(), $corredor->getSalt());
            //$corredor->saveEncodedPassword($password);
            // Lo almacenamos en nuestro repositorio de corredores
            $this->get('corredoresrepository')->registrarCorredor($corredor);
            // Creamos un mensaje flash para mostrar al usuario que 
            // se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena, ' . $corredor->getNombre() . ' te has registrado en CorredoresPorLaRioja!');
            // Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('corredores_rioja_homepage'));
        }
        return $this->render("CorredoresRiojaBundle:Default:registro.html.twig", array('formulario' => $form->createView()));
    }

    public function cambiarCorredorAction(Request $peticion) {

        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->getUser();
        $corredorAnt=$this->get('corredoresrepository')->buscarCorredor($user->getUsername());

        $form = $this->createForm(CorredorType::class,$corredorAnt);
        $form->add('registro', SubmitType::class, array('label' => 'Guardar cambios'));
        $form->handleRequest($peticion);
        if ($form->isValid()) {
            // Recogemos el corredor que se ha registrado
            $corredor = $form->getData();
// Codificamos la contraseña del corredor
            $encoder = $this->get('security.encoder_factory')->getEncoder($corredor);
            //$password = $encoder->encodePassword($corredor->getPassword(), $corredor->getSalt());
            //$corredor->saveEncodedPassword($password);
            // Lo almacenamos en nuestro repositorio de corredores
            $this->get('corredoresrepository')->actualizarInformacionCorredor($corredor);
            // Creamos un mensaje flash para mostrar al usuario que 
            // se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena, ' . $corredor->getNombre() . ' has modificado tus datos!');
            // Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('corredores_rioja_homepage'));
        }
        return $this->render("CorredoresRiojaBundle:Default:registro.html.twig", array('formulario' => $form->createView()));
    }

    public function loginAction(Request $request) {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
                        'CorredoresRiojaBundle:Corredores:login.html.twig', array(
                    // last username entered by the user
                    'last_username' => $lastUsername,
                    'error' => $error,
                        )
        );
    }
    
    public function loginOrganizacionAction(Request $request) {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
                        'CorredoresRiojaBundle:Organizaciones:login.html.twig', array(
                    // last username entered by the user
                    'last_username' => $lastUsername,
                    'error' => $error,
                        )
        );
    }
    
    public function registroOrganizacionAction(Request $peticion) {
        $form = $this->createForm(OrganizacionType::class);
        $form->add('registro', SubmitType::class, array('label' => 'Registro'));
        $form->handleRequest($peticion);
        if ($form->isValid()) {
            // Recogemos el corredor que se ha registrado
            $organizacion = $form->getData();
// Codificamos la contraseña del corredor
            //$encoder = $this->get('security.encoder_factory')->getEncoder($organizacion);
            //$password = $encoder->encodePassword($corredor->getPassword(), $corredor->getSalt());
            //$corredor->saveEncodedPassword($password);
            // Lo almacenamos en nuestro repositorio de corredores
            $this->get('organizacionrepository')->registrarOrganizacion($organizacion);
            // Creamos un mensaje flash para mostrar al usuario que 
            // se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena, ' . $organizacion->getNombre() . ' te has registrado en CorredoresPorLaRioja!');
            // Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('corredores_rioja_homepage'));
        }
        return $this->render("CorredoresRiojaBundle:Default:registroOrganizacion.html.twig", array('formulario' => $form->createView()));
    }
    
    
    public function modificarOrganizacionAction(Request $peticion) {
        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->getUser();
        $organizacionAnt=$this->get('organizacionrepository')->buscarOrganizacionEmail($user->getUsername());
        
        $form = $this->createForm(OrganizacionType::class,$organizacionAnt);
        $form->add('registro', SubmitType::class, array('label' => 'Guardar cambios'));
        $form->handleRequest($peticion);
        if ($form->isValid()) {
            // Recogemos el corredor que se ha registrado
            $organizacion = $form->getData();
// Codificamos la contraseña del corredor
            //$encoder = $this->get('security.encoder_factory')->getEncoder($organizacion);
            //$password = $encoder->encodePassword($corredor->getPassword(), $corredor->getSalt());
            //$corredor->saveEncodedPassword($password);
            // Lo almacenamos en nuestro repositorio de corredores
            $this->get('organizacionrepository')->registrarOrganizacion($organizacion);
            // Creamos un mensaje flash para mostrar al usuario que 
            // se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena, ' . $organizacion->getNombre() . ' has modificado tus datos!');
            // Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('corredores_rioja_homepage'));
        }
        return $this->render("CorredoresRiojaBundle:Default:registroOrganizacion.html.twig", array('formulario' => $form->createView()));
    }

}
