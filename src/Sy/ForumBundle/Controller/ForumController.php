<?php

namespace Sy\ForumBundle\Controller;

use Sy\ForumBundle\Entity\Comment;
use Sy\ForumBundle\Entity\Vote;
use Sy\ForumBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ForumController extends Controller
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
            $posts = $em->getRepository('SyForumBundle:Post')
                ->findPosts($page, $nbPerPage);
        }
        else {
            $posts = $em->getRepository('SyForumBundle:Post')
                ->findByCategory($category, $page, $nbPerPage);
        }

        $maxPage = ceil(count($posts)/$nbPerPage);

        if($page < 1 || $page > $maxPage){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        if ($posts == null){
            $this->addFlash('error', 'Cette catégorie n\'existe pas');
            return $this->redirectToRoute('sy_forum');
        }

        return $this->render('SyForumBundle:Default:posts.html.twig', [
            'posts' => $posts,
            'categories' => $categories,
            'category' => $category,
            'page' => $page,
            'maxPage' => $maxPage,
        ]);
    }

    public function viewAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('SyForumBundle:Post')
            ->findOneBy([
                'slug' => $slug
            ]);

        $user = $this->getUser();
        $comment = new Comment();
        $comment->setAuthor($user);
        $comment->setPost($post);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $addedComment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($addedComment);
            $em->flush();

            return $this->redirectToRoute('sy_post', ['slug' => $post->getSlug()]);
        }

        return $this->render('SyForumBundle:Default:post.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }

    public function voteAction(Request $request)
    {
        if($request->request->get('commentId') && $request->request->get('like')){
            $commentId = $request->request->get('commentId');
            $like = $request->request->get('like') == "true" ? true : false;

            $em = $this->getDoctrine()->getManager();
            $comment = $em->getRepository('SyForumBundle:Comment')->find($commentId);

            $vote = new Vote();
            $vote->setUser($this->getUser())
                ->setComment($comment)
                ->setVote($like);

            $em->persist($vote);
            $em->flush();

            $arrData = ['output' => $like];
            return new JsonResponse($arrData);
        }
        return $this->render('SyForumBundle:Default:post.html.twig');
    }
}