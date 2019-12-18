<?php

namespace App\Controller\Dictionary;

use App\Entity\Dictionary\IncomeType;
use App\Form\Dictionary\IncomeTypeType;
use App\Repository\Dictionary\IncomeTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dictionary/income_type")
 */
class IncomeTypeController extends AbstractController
{
    /**
     * @Route("/", name="dictionary_income_type_index", methods={"GET"})
     */
    public function index(IncomeTypeRepository $incomeTypeRepository): Response
    {
        return $this->render('dictionary/index.html.twig', [
            'dictionary' => $incomeTypeRepository->findAll(),
            'dictionary_name' => 'income_type',
            'dictionary_title' => 'typ przychodu'
        ]);
    }

    /**
     * @Route("/new", name="dictionary_income_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $incomeType = new IncomeType();
        $form = $this->createForm(IncomeTypeType::class, $incomeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($incomeType);
            $entityManager->flush();

            return $this->redirectToRoute('dictionary_income_type_index');
        }

        return $this->render('dictionary/new.html.twig', [
            'dictionary_element' => $incomeType,
            'form' => $form->createView(),
            'dictionary_name' => 'income_type',
            'dictionary_title' => 'typ przychodu'
        ]);
    }

    /**
     * @Route("/{id}", name="dictionary_income_type_show", methods={"GET"})
     */
    public function show(IncomeType $incomeType): Response
    {
        return $this->render('dictionary/show.html.twig', [
            'dictionary_element' => $incomeType,
            'dictionary_name' => 'income_type',
            'dictionary_title' => 'typ przychodu'
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dictionary_income_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IncomeType $incomeType): Response
    {
        $form = $this->createForm(IncomeTypeType::class, $incomeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dictionary_income_type_index');
        }

        return $this->render('dictionary/edit.html.twig', [
            'dictionary_element' => $incomeType,
            'form' => $form->createView(),
            'dictionary_name' => 'income_type',
            'dictionary_title' => 'typ przychodu'
        ]);
    }

    /**
     * @Route("/{id}", name="dictionary_income_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IncomeType $incomeType): Response
    {
        if ($this->isCsrfTokenValid('delete' . $incomeType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($incomeType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dictionary_income_type_index');
    }
}
