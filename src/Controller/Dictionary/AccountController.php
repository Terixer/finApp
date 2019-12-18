<?php

namespace App\Controller\Dictionary;

use App\Entity\Dictionary\Account;
use App\Form\Dictionary\AccountType;
use App\Repository\Dictionary\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dictionary/account")
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/", name="dictionary_account_index", methods={"GET"})
     */
    public function index(AccountRepository $accountRepository): Response
    {
        return $this->render('dictionary/index.html.twig', [
            'dictionary' => $accountRepository->findAll(),
            'dictionary_name' => 'account',
            'dictionary_title' => 'konto'
        ]);
    }

    /**
     * @Route("/new", name="dictionary_account_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $account = new Account();
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($account);
            $entityManager->flush();

            return $this->redirectToRoute('dictionary_account_index');
        }

        return $this->render('dictionary/new.html.twig', [
            'dictionary_element' => $account,
            'dictionary_name' => 'account',
            'dictionary_title' => 'konto',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dictionary_account_show", methods={"GET"})
     */
    public function show(Account $account): Response
    {
        return $this->render('dictionary/show.html.twig', [
            'dictionary_element' => $account,
            'dictionary_name' => 'account',
            'dictionary_title' => 'konto',
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dictionary_account_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Account $account): Response
    {
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dictionary_account_index');
        }

        return $this->render('dictionary/edit.html.twig', [
            'dictionary_element' => $account,
            'dictionary_name' => 'account',
            'dictionary_title' => 'konto',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dictionary_account_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Account $account): Response
    {
        if ($this->isCsrfTokenValid('delete' . $account->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($account);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dictionary_account_index');
    }
}
