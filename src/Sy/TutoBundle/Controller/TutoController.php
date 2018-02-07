<?php

namespace Sy\TutoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TutoController extends Controller
{
    public function indexAction()
    {
        return $this->render('SyTutoBundle:Default:tutos.html.twig');
    }
}
