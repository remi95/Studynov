<?php

namespace Sy\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SyAgendaBundle:Default:index.html.twig');
    }
}
