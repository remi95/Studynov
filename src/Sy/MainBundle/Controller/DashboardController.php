<?php

namespace Sy\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $groups = $user->getGroupClasses();
        $lastProjects = $em->getRepository('SyAgendaBundle:Project')
            ->findLastProjects($groups);
        $lastTutos = $em->getRepository('SyTutoBundle:Tutorial')
            ->findTutos($groups, 1, 3);
        $lastPosts = $em->getRepository('SyForumBundle:Post')
            ->findPosts(1, 3);

        return $this->render('SyMainBundle:Default:index.html.twig', [
            'projects' => $lastProjects,
            'tutos' => $lastTutos,
            'posts' => $lastPosts,
        ]);
    }
}
