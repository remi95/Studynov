<?php

namespace Sy\TutoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SyTutoBundle:Default:index.html.twig');
    }
}
