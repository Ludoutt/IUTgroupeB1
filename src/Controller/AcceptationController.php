<?php

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\Controller;

use App\Entity\Acceptation;
use App\Entity\Backlog;
use App\Form\AcceptationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Exception\TransitionException;
use Symfony\Component\Workflow\Registry;

/**
 * @Route("/acceptation")
 */
class AcceptationController extends AbstractController
{
    /**
     * @Route("/{id}/new", name="acceptation_new", methods={"GET","POST"})
     */
    public function new(Request $request, Backlog $backlog): Response
    {
        $acceptation = new Acceptation();
        $acceptation->setBacklog($backlog);

        $form = $this->createForm(AcceptationType::class, $acceptation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($acceptation);
            $entityManager->flush();

            return $this->redirectToRoute('backlog_show', [
                'id' => $acceptation->getBacklog()->getId(),
            ]);
        }

        return $this->render('acceptation/new.html.twig', [
            'acceptation' => $acceptation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="acceptation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Acceptation $acceptation): Response
    {
        $form = $this->createForm(AcceptationType::class, $acceptation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backlog_show', [
                'id' => $acceptation->getBacklog()->getId(),
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
        $backlogId = $acceptation->getBacklog()->getId();

        if ($this->isCsrfTokenValid('delete'.$acceptation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($acceptation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backlog_show', [
            'id' => $backlogId,
        ]);
    }

    /**
     * @Route("/apply-transition/{id}", name="acceptation_apply_transition", methods={"POST"})
     */
    public function applyTransitionAction(Request $request, Acceptation $acceptation, Registry $workflows)
    {
        $workflow = $workflows->get($acceptation);

        try {
            $workflow->apply($acceptation, $request->request->get('transition'));

            $this->getDoctrine()->getManager()->flush();
        } catch (TransitionException $exception) {
            $this->addFlash('danger', $exception->getMessage());
        }

        return $this->redirectToRoute('backlog_show', ['id' => $acceptation->getBacklog()->getId()]);
    }
}
