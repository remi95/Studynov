<?php

namespace Sy\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SyForumBundle:Default:index.html.twig');
    }
}
