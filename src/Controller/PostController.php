<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class PostController extends AbstractController
{
    public function __construct(PostRepository $postRepository,
                            FormFactoryInterface $formFactory,
                            EntityManagerInterface $entityManager,
                            RouterInterface $router)
    {
        $this->postRepository = $postRepository;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }
    /**
     * @Route("/post", name="post_page")
     */
    public function post(Request $request)
    {
        $post = new Post();
        $post -> setTime(new \DateTime());

        $form = $this->formFactory->create(PostType::class, $post);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($post);
            $this->entityManager->flush();

            return new RedirectResponse(
                $this->router->generate('post_page')
            );
        }
        /* return $this->render(view: "post/index.html.twig", [
            'posts' => $this->postRepository->findAll()
        ]); */
        return $this-> render("post/index.html.twig", [
            "form" => $form->createView(),
            "posts" => $this->postRepository->findAll()
            /* "posts" => $this->postRepository->findBy([], ["time" => "DESC"]) */
        ]);
    }
}

