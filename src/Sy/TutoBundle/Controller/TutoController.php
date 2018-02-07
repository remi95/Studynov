<?php

namespace Sy\TutoBundle\Controller;

use Sy\TutoBundle\Entity\Tutorial;
use Sy\TutoBundle\Form\TutorialType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TutoController extends Controller
{
    public function indexAction()
    {
        return $this->render('SyTutoBundle:Default:tutos.html.twig');
    }
    
    public function addTutoAction(Request $request)
    {
        $user = $this->getUser();
        $tuto = new Tutorial();
        $tuto->setAuthor($user);

        $form = $this -> createForm(TutorialType::class, $tuto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $prodToSave = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($prodToSave);
            $em->flush();

            return $this->redirectToRoute('sy_tuto');
        }

        return $this -> render ('SyTutoBundle:Default:addTuto.html.twig', array(
            'form' => $form->createView()
        ));
    }
    public function editTutoAction(Request $request, $id)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $tuto = $em->getRepository('SyTutoBundle:Tutorial')->find($id);
        $authortuto = $tuto->getAuthor();

        if ($user == $authortuto) {
            $form = $this->createForm(TutorialType::class, $tuto);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $prodToSave = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($prodToSave);
                $em->flush();

                return $this->redirectToRoute('sy_tuto');
            }

            return $this->render('SyTutoBundle:Default:editTuto.html.twig', array(
                'form' => $form->createView()
            ));
        }
        return $this->redirectToRoute('sy_tuto');

    }
}
