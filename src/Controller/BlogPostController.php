<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\PostComment;
use Symfony\Bundle\FrameworkBundle\Controller\controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Monolog\DateTimeImmutable;

class BlogPostController extends AbstractController {

    /**
    * @Route("/{page}", defaults={"page"=1}, name="home_page")
    */
    public function blogOverview(int $page) {
        $repository = $this->getDoctrine()
                           ->getRepository(BlogPost::class);
        $posts      = $repository->postsByPage($page, 5);
        $postCount  = $repository->getPostCount();
        $totalPages = ceil($postCount / 5);
        if($totalPages == 0) {$totalPages++;}

        return $this->render('home_page.html.twig', [
            'page'       => $page,
            'posts'      => $posts,
            'totalPages' => $totalPages,
        ]);
    }

    /**
    * @Route("/view/{post}/{page}", defaults={"page"=1}, name="view_post")
    */
    public function viewPost(BlogPost $post, int $page, Request $request) {
        $comment = new PostComment();
        $form    = $this->createFormBuilder($comment)
                         ->add('username', TextType::class, ['required' => true])
                         ->add('text', CKEditorType::class, ['required' => true, 'constraints'=>[new NotBlank()]])
                         ->add('Comment', SubmitType::class)
                         ->getForm();

         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $comment->setTimestamp(new DateTimeImmutable(time()));
             $comment->setPostId($post->getId());

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($comment);
             $entityManager->flush();

             return $this->redirectToRoute('view_post', ['post' => $post->getId()]);
         }

        $repository = $this->getDoctrine()
                            ->getRepository(PostComment::class);
        $comments     = $repository->commentsByPageAndPost($page, 5, $post->getId());
        $commentCount = $repository->getCommentCountByPost($post->getId());
        $totalPages   = ceil($commentCount / 5);
        if($totalPages == 0) {$totalPages++;}

        return $this->render('view_post.html.twig', [
            'post'       => $post,
            'form'       => $form->createView(),
            'page'       => $page,
            'comments'   => $comments,
            'totalPages' => $totalPages,
        ]);
    }
}
