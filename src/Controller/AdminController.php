<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\String\Slugger\SluggerInterface;
use Monolog\DateTimeImmutable;

class AdminController extends AbstractController {

    /**
    * @Route("/admin/{page}", defaults={"page"=1}, name="admin_overview", requirements={"page"="\d+"})
    */
    public function adminOverview(int $page) {
        $repository = $this->getDoctrine()
                           ->getRepository(BlogPost::class);
        $posts      = $repository->postsByPage($page, 20);
        $postCount  = $repository->getPostCount();
        $totalPages = ceil($postCount / 20);

        return $this->render('admin_overview.html.twig', [
            'page'       => $page,
            'posts'      => $posts,
            'totalPages' => $totalPages,
        ]);
    }

    /**
    * @Route("/admin/create/{postId}/{state}", defaults={"postId"=0, "state"="new"}, name="create_post")
    */
    public function createPost(int $postId, String $state, Request $request, SluggerInterface $slugger){
        $post = new BlogPost();
        if ($state == "edit"){
            $post = $this->getDoctrine()
                         ->getRepository(BlogPost::class)
                         ->find($postId);
        }

        $form = $this->createFormBuilder($post)
                     ->add('id', IntegerType::class, ['disabled' => true])
                     ->add('titel', TextType::class)
                     ->add('subtitel', TextType::class)
                     ->add('previewText', TextareaType::class)
                     ->add('mainText', TextareaType::class)
                     ->add('image', FileType::class, ['required' => false, 'mapped' => false, 'constraints' => new Image()])
                     ->add('Opslaan', SubmitType::class)
                     ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($state == "new") {
                $post->setPublishedAt(new DateTimeImmutable(time()));
            }

            $image = $form->get('image')->getData();

            if($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
                $image->move('images',$newFilename);
                $post->setImage($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('admin_overview');
        }

        return $this->render('create_post.html.twig', [
            'post'  => $post,
            'state' => $state,
            'form'  => $form->createView(),
        ]);
    }
}
