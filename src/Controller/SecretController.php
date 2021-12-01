<?php

namespace App\Controller;

use App\Entity\Secret;
use App\Form\SecretType;
use App\Repository\SecretRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class SecretController extends AbstractController
{
    public function __construct(SecretRepository $secretRepository,
                            FormFactoryInterface $formFactory,
                            EntityManagerInterface $entityManager,
                            RouterInterface $router)
    {
        $this->secretRepository = $secretRepository;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }
    /**
     * @Route("/", name="secret_index")
     */
    public function secret(Request $request)
    {
        $secret = new Secret();
        $secret -> setTime(new \DateTime());

        $form = $this->formFactory->create(SecretType::class, $secret);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($secret);
            $this->entityManager->flush();

            return new RedirectResponse(
                $this->router->generate('secret_index')
            );
        }
        /* return $this->render(view: "secret/index.html.twig", [
            'posts' => $this->postRepository->findAll()
        ]); */
        return $this-> render("secret/index.html.twig", [
            "form" => $form->createView(),
            "secrets" => $this->secretRepository->findBy([], ["time" => "DESC"])
            /* "secrets" => $this->secretRepository->findAll() */
        ]);
    }
    /**
     * @Route("/detail/{id}", name="detail_secret")
     */
    public function show(Secret $secret)
    {
        // en vez de $id como parametro arriba 
        // $secret = $this->secretRepository->find($id);

        return $this->render('secret/secretDetail/detail.html.twig', [
            'secret' => $secret
        ]);
    }
    /**
     * @Route("/edit/{id}", name="edit_secret")
     */
    public function edit(Secret $secret, Request $request)
    {
        $form = $this->formFactory->create(SecretType::class, $secret);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->flush();

            return new RedirectResponse(
                $this->router->generate('secret_index')
            );
        }
        return $this-> render('secret/secretDetail/edit.html.twig', [
            "form" => $form->createView(),
        ]);

    }
}
