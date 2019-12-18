<?php

namespace App\Controller\Dictionary;

use App\Entity\Dictionary\ExpenseType;
use App\Form\Dictionary\ExpenseTypeType;
use App\Repository\Dictionary\ExpenseTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dictionary/expense_type")
 */
class ExpenseTypeController extends AbstractController
{
    /**
     * @Route("/", name="dictionary_expense_type_index", methods={"GET"})
     */
    public function index(ExpenseTypeRepository $expenseTypeRepository): Response
    {
        return $this->render('dictionary/index.html.twig', [
            'dictionary' => $expenseTypeRepository->findAll(),
            'dictionary_name' => 'expense_type',
            'dictionary_title' => 'typ wydatku'
        ]);
    }

    /**
     * @Route("/new", name="dictionary_expense_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $expenseType = new ExpenseType();
        $form = $this->createForm(ExpenseTypeType::class, $expenseType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($expenseType);
            $entityManager->flush();

            return $this->redirectToRoute('dictionary_expense_type_index');
        }

        return $this->render('dictionary/new.html.twig', [
            'dictionary_element' => $expenseType,
            'form' => $form->createView(),
            'dictionary_name' => 'expense_type',
            'dictionary_title' => 'typ wydatku'
        ]);
    }

    /**
     * @Route("/{id}", name="dictionary_expense_type_show", methods={"GET"})
     */
    public function show(ExpenseType $expenseType): Response
    {
        return $this->render('dictionary/show.html.twig', [
            'dictionary_element' => $expenseType,
            'dictionary_name' => 'expense_type',
            'dictionary_title' => 'typ wydatku'
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dictionary_expense_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ExpenseType $expenseType): Response
    {
        $form = $this->createForm(ExpenseTypeType::class, $expenseType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dictionary_expense_type_index');
        }

        return $this->render('dictionary/edit.html.twig', [
            'dictionary_element' => $expenseType,
            'form' => $form->createView(),
            'dictionary_name' => 'expense_type',
            'dictionary_title' => 'typ wydatku'
        ]);
    }

    /**
     * @Route("/{id}", name="dictionary_expense_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ExpenseType $expenseType): Response
    {
        if ($this->isCsrfTokenValid('delete' . $expenseType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($expenseType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dictionary_expense_type_index');
    }
}
