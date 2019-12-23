<?php

namespace App\Controller;

use App\Entity\PlannedExpense;
use App\Form\PlannedExpenseForm;
use App\Repository\PlannedExpenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/planned_expense")
 */
class PlannedExpenseController extends AbstractController
{
    /**
     * @Route("/", name="plannedExpense_index", methods={"GET"})
     */
    public function index(PlannedExpenseRepository $plannedExpenseRepository): Response
    {
        return $this->render('plannedExpense/index.html.twig', [
            'plannedExpenses' => $plannedExpenseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="plannedExpense_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plannedExpense = new PlannedExpense();
        $form = $this->createForm(PlannedExpenseForm::class, $plannedExpense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $plannedExpense->setCreatedBy($this->getUser());
            $entityManager->persist($plannedExpense);
            $entityManager->flush();

            return $this->redirectToRoute('plannedExpense_index');
        }

        return $this->render('plannedExpense/new.html.twig', [
            'plannedExpense' => $plannedExpense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plannedExpense_show", methods={"GET"})
     */
    public function show(PlannedExpense $plannedExpense): Response
    {
        return $this->render('plannedExpense/show.html.twig', [
            'plannedExpense' => $plannedExpense,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plannedExpense_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlannedExpense $plannedExpense): Response
    {
        $form = $this->createForm(PlannedExpenseForm::class, $plannedExpense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plannedExpense_index');
        }

        return $this->render('plannedExpense/edit.html.twig', [
            'plannedExpense' => $plannedExpense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plannedExpense_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlannedExpense $plannedExpense): Response
    {
        if ($this->isCsrfTokenValid('delete' . $plannedExpense->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plannedExpense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plannedExpense_index');
    }
}
