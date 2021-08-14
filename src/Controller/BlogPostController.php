<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

        return $this->render('home_page.html.twig', [
            'page'       => $page,
            'posts'      => $posts,
            'totalPages' => $totalPages,
        ]);
    }

    /**
    * @Route("/view/{id}", name="view_post")
    */
    public function viewPost(BlogPost $post) {
        return $this->render('view_post.html.twig', [
            'post' => $post,
        ]);
    }
}
