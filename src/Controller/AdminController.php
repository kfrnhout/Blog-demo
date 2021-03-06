<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\String\Slugger\SluggerInterface;
use Monolog\DateTimeImmutable;

class AdminController extends AbstractController {

    /**
    * @Route("/admin/{page}", defaults={"page"=1}, name="admin_overview", requirements={"page"="\d+"})
    */
    public function adminOverview(int $page) {
        $repository = $this->getDoctrine()
                           ->getRepository(BlogPost::class);
        $posts      = $repository->postsByPage($page, 20, true);
        $postCount  = $repository->getPostCount(true);
        $totalPages = ceil($postCount / 20);
        if($totalPages == 0) {$totalPages++;}

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
                     ->add('titel', TextType::class, ['required' => true])
                     ->add('subtitel', TextType::class, ['required' => true])
                     ->add('previewText', CKEditorType::class, ['required' => true, 'constraints'=>[new NotBlank()]])
                     ->add('mainText', CKEditorType::class, ['required' => true, 'constraints'=>[new NotBlank()]])
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

    /**
    * @Route("/admin/toggle/{post}", name="toggle_visibility")
    */
    public function toggleVisibility(BlogPost $post){
        $post->setArchived(!$post->getArchived());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($post);
        $entityManager->flush();

        return $this->redirectToRoute('admin_overview');
    }
}
