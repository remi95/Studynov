<?php

namespace Sy\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AgendaController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('SyAgendaBundle:Project')->findAll();

        return $this->render('SyAgendaBundle:Default:agenda.html.twig', [
            'projects' => $projects
        ]);
    }
}
