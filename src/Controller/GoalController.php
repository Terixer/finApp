<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Form\GoalType;
use App\Repository\GoalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/goal")
 */
class GoalController extends AbstractController
{
    /**
     * @Route("/", name="goal_index", methods={"GET","POST"})
     */
    public function index(GoalRepository $goalRepository, Request $request): Response
    {
        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($goal);
            $entityManager->flush();

            return $this->redirectToRoute('goal_index');
        }

        return $this->render('goal/index.html.twig', [
            'goal' => $goal,
            'form' => $form->createView(),
            'goals' => $goalRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}", name="goal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Goal $goal): Response
    {
        if ($this->isCsrfTokenValid('delete' . $goal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($goal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('goal_index');
    }
}
