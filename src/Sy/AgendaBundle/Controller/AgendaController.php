<?php

namespace Sy\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AgendaController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $classroom = $user->getClassroom();
        $projects = $em->getRepository('SyAgendaBundle:Project')->findBy([
            'classroom' => $classroom
        ]);

        return $this->render('SyAgendaBundle:Default:agenda.html.twig', [
            'projects' => $projects
        ]);
    }
}
