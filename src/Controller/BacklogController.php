<?php

namespace App\Controller;

use App\Entity\Backlog;
use App\Form\BacklogType;
use App\Repository\BacklogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backlog")
 */
class BacklogController extends AbstractController
{
    /**
     * @Route("/", name="backlog_index", methods={"GET"})
     */
    public function index(BacklogRepository $backlogRepository): Response
    {
        return $this->render('backlog/index.html.twig', [
            'backlogs' => $backlogRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="backlog_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $backlog = new Backlog();
        $form = $this->createForm(BacklogType::class, $backlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($backlog);
            $entityManager->flush();

            return $this->redirectToRoute('backlog_index');
        }

        return $this->render('backlog/new.html.twig', [
            'backlog' => $backlog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backlog_show", methods={"GET"})
     */
    public function show(Backlog $backlog): Response
    {
        return $this->render('backlog/show.html.twig', [
            'backlog' => $backlog,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="backlog_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Backlog $backlog): Response
    {
        $form = $this->createForm(BacklogType::class, $backlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backlog_index', [
                'id' => $backlog->getId(),
            ]);
        }

        return $this->render('backlog/edit.html.twig', [
            'backlog' => $backlog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backlog_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Backlog $backlog): Response
    {
        if ($this->isCsrfTokenValid('delete'.$backlog->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($backlog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backlog_index');
    }
}
