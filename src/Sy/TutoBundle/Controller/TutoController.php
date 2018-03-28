<?php

namespace Sy\TutoBundle\Controller;

use Sy\TutoBundle\Entity\Tutorial;
use Sy\TutoBundle\Form\TutorialType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TutoController extends Controller
{
    public function indexAction(Request $request, $category, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $groups = $user->getGroupClasses();

        $categories = $em->getRepository('SyMainBundle:Category')
            ->findAll();

        $nbPerPage = 7;

        if ($category == 'all') {
            $tutos = $em->getRepository('SyTutoBundle:Tutorial')
                ->findTutos($groups, $page, $nbPerPage);
        }
        else {
            $tutos = $em->getRepository('SyTutoBundle:Tutorial')
                ->findByCategory($groups, $category, $page, $nbPerPage);
        }

        $maxPage = ceil(count($tutos)/$nbPerPage);

        if (count($tutos) < 1){
            $this->addFlash('error', 'Cette catégorie n\'a pas de posts ou n\'existe pas');
            return $this->redirectToRoute('sy_forum');
        }

        if($page < 1 || $page > $maxPage){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        return $this->render('SyTutoBundle:Default:tutos.html.twig', [
            'tutos' => $tutos,
            'categories' => $categories,
            'category' => $category,
            'page' => $page,
            'maxPage' => $maxPage,
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
    
    public function addTutoAction(Request $request)
    {
        $user = $this->getUser();
        $tuto = new Tutorial();
        $tuto->setAuthor($user);
        $groups = $user->getGroupClasses();

        $form = $this->createForm(TutorialType::class, $tuto, ['groups' => $groups]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $addedTuto = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($addedTuto);
            $em->flush();

            return $this->redirectToRoute('sy_tuto', ['slug' => $addedTuto->getSlug()]);
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

        if ($tuto == null) {
            $this->addFlash('error', 'Vous ne pouvez pas modifier un tutoriel qui n\'existe pas');
            return $this->redirectToRoute('sy_tutos');
        }

        $authortuto = $tuto->getAuthor();

        if ($user == $authortuto) {
            $groups = $user->getGroupClasses();
            $form = $this -> createForm(TutorialType::class, $tuto, ['groups' => $groups]);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $editedTuto = $form->getData();
                $editedTuto->setEditDate(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($editedTuto);
                $em->flush();

                return $this->redirectToRoute('sy_tuto', ['slug' => $editedTuto->getSlug()]);
            }

            return $this->render('SyTutoBundle:Default:editTuto.html.twig', array(
                'form' => $form->createView()
            ));
        }
        $this->addFlash('forbidden', 'Vous n\'avez pas le droit de modifier un tutoriel qui n\'est pas le vôtre');
        return $this->redirectToRoute('sy_tuto', ['slug' => $tuto->getSlug()]);

    }
}
