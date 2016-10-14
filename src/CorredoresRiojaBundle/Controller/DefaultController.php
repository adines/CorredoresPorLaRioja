<?php

namespace CorredoresRiojaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CorredoresRiojaBundle:Corredores:portada.html.twig');
    }
}
