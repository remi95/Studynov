<?php

namespace Sy\TutoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TutoController extends Controller
{
    public function indexAction(Request $request, $category)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('SyMainBundle:Category')
            ->findAll();

        if ($category == 'all') {
            $tutos = $em->getRepository('SyTutoBundle:Tutorial')
                ->findAll();
        }
        else {
            $tutos = $em->getRepository('SyTutoBundle:Tutorial')
                ->findByCategory($category);
        }

        if ($tutos == null){
            $this->addFlash('error', 'Cette catégorie n\'existe pas');
            return $this->redirectToRoute('sy_tutos');
        }

        return $this->render('SyTutoBundle:Default:tutos.html.twig', [
            'tutos' => $tutos,
            'categories' => $categories
        ]);
    }

    public function viewAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $tuto = $em->getRepository('SyTutoBundle:Tutorial')
            ->findOneBy([
                'slug' => $slug
            ]);

        return $this->render('SyTutoBundle:Default:tuto.html.twig', [
            'tuto' => $tuto
        ]);
    }
}
