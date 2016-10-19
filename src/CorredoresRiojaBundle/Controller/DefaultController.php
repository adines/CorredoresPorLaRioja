<?php

namespace CorredoresRiojaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('CorredoresRiojaBundle:Corredores:portada.html.twig');
    }

    public function adminAction() {
        return new Response('Página de administración');
    }

    public function registroAction(Request $peticion) {
        $form = $this->createForm(CorredorType::class);
        $form->handleRequest($peticion);
        if ($form->isValid()) {
            // Recogemos el corredor que se ha registrado
            $corredor = $form->getData();
// Codificamos la contraseña del corredor
            $encoder = $this->get('security.encoder_factory')->getEncoder($corredor);
            $password = $encoder->encodePassword($corredor->getPassword(), $corredor->getSalt());
            $corredor->saveEncodedPassword($password);
            // Lo almacenamos en nuestro repositorio de corredores
            $this->get('corredoresrepository')->registraCorredor($corredor);
            // Creamos un mensaje flash para mostrar al usuario que 
            // se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena, ' . $corredor->getName() . ' te has registrado en CorredoresPorLaRioja!');
            // Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('portada'));
        }
        return $this->render("CorredoresRiojaBundle:Default:registro.html.twig", array('formulario' => $form->createView()));
    }

}
