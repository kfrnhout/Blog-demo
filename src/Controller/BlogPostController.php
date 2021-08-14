<?php

namespace App\Controller;

use App\Entity\BlogPosts;
use Symfony\Bundle\FrameworkBundle\Controller\controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogPostController extends AbstractController {

    /**
    * @Route("/", name="home_page")
    */
    public function blogOverview() {
        return new Response('main page here');
    }

    /**
    * @Route("/{id}", name="view_post")
    */
    public function viewPost(int $id) {
        $post = $this->getDoctrine()
                     ->getRepository(BlogPosts::class)
                     ->find($id);

        return new Response(var_dump($post));
    }
}
