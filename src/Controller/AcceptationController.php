<?php

namespace App\Controller;

use App\Entity\Acceptation;
use App\Form\Acceptation1Type;
use App\Repository\AcceptationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/acceptation")
 */
class AcceptationController extends AbstractController
{
    /**
     * @Route("/", name="acceptation_index", methods={"GET"})
     */
    public function index(AcceptationRepository $acceptationRepository): Response
    {
        return $this->render('acceptation/index.html.twig', [
            'acceptations' => $acceptationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="acceptation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $acceptation = new Acceptation();
        $form = $this->createForm(Acceptation1Type::class, $acceptation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($acceptation);
            $entityManager->flush();

            return $this->redirectToRoute('acceptation_index');
        }

        return $this->render('acceptation/new.html.twig', [
            'acceptation' => $acceptation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acceptation_show", methods={"GET"})
     */
    public function show(Acceptation $acceptation): Response
    {
        return $this->render('acceptation/show.html.twig', [
            'acceptation' => $acceptation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="acceptation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Acceptation $acceptation): Response
    {
        $form = $this->createForm(Acceptation1Type::class, $acceptation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acceptation_index', [
                'id' => $acceptation->getId(),
            ]);
        }

        return $this->render('acceptation/edit.html.twig', [
            'acceptation' => $acceptation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acceptation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Acceptation $acceptation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acceptation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($acceptation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('acceptation_index');
    }
}
