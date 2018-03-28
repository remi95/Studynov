<?php

namespace Sy\ForumBundle\Controller;

use Sy\ForumBundle\Entity\Comment;
use Sy\ForumBundle\Entity\Post;
use Sy\ForumBundle\Entity\Vote;
use Sy\ForumBundle\Form\CommentType;
use Sy\ForumBundle\Form\PostType;
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

        if (count($posts) < 1){
            $this->addFlash('error', 'Cette catégorie n\'a pas de posts ou n\'existe pas');
            return $this->redirectToRoute('sy_forum');
        }

        if($page < 1 || $page > $maxPage){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
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

        $comments = $em->getRepository('SyForumBundle:Comment')
            ->getCommentsByPost($post);

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
            'comments' => $comments,
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    public function addAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $post= new Post();
        $post->setAuthor($user);

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $addedPost = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($addedPost);
            $em->flush();

            return $this->redirectToRoute('sy_post', ['slug' => $addedPost->getSlug()]);
        }

        return $this->render('SyForumBundle:Default:addPost.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function editAction(Request $request, $id){
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('SyForumBundle:Post')->find($id);

        if ($post == null) {
            $this->addFlash('error', 'Vous ne pouvez pas modifier un post qui n\'existe pas');
            return $this->redirectToRoute('sy_forum');
        }

        $authorPost = $post->getAuthor();

        if ($user == $authorPost) {
            $form = $this->createForm(PostType::class, $post);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $editedPost = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($editedPost);
                $em->flush();

                return $this->redirectToRoute('sy_post', ['slug' => $editedPost->getSlug()]);
            }

            return $this->render('SyForumBundle:Default:editPost.html.twig', array(
                'form' => $form->createView()
            ));
        }
        $this->addFlash('forbidden', 'Vous n\'avez pas le droit de modifier un post qui n\'est pas le vôtre');
        return $this->redirectToRoute('sy_post', ['slug' => $post->getSlug()]);
    }

    public function voteAction(Request $request)
    {
        if($request->request->get('commentId') && $request->request->get('like')){
            $commentId = $request->request->get('commentId');
            $like = $request->request->get('like') == "true" ? true : false;

            $em = $this->getDoctrine()->getManager();
            $comment = $em->getRepository('SyForumBundle:Comment')->find($commentId);

            $alreadyVoted = $em->getRepository('SyForumBundle:Vote')
                ->findOneBy(
                    ['comment' => $comment,
                    'user' => $this->getUser()]
                );

            $vote = $alreadyVoted != null ? $alreadyVoted : new Vote();
            $vote->setUser($this->getUser())
                ->setComment($comment)
                ->setVote($like);

            $em->persist($vote);
            $em->flush();

            $arrData = ['output' => "refresh"];
            return new JsonResponse($arrData);
        }
        return $this->render('SyForumBundle:Default:post.html.twig');
    }
}