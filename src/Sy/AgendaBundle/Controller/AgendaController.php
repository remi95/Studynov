<?php

namespace Sy\AgendaBundle\Controller;

use Sy\AgendaBundle\Entity\Project;
use Sy\AgendaBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $classroom = $user->getClassroom();

        $project = new Project();
        $project->setAuthor( $user )
            ->setClassroom( $classroom );

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $projectToSave = $form->getData();

            $em->persist($projectToSave);
            $em->flush();

            return $this->redirectToRoute("sy_agenda");
        }

        return $this->render('SyAgendaBundle:Default:agenda_add.html.twig', [
            'form' => $form->createView(),
            'classroom' => $classroom
        ]);
    }
}
