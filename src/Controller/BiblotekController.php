<?php

// kmom05 BiblotekController.php databas ORM

namespace App\Controller;

use App\Bibliotek\CreateBook;
use App\Entity\Book;
use App\Repository\ProductRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Biblioteket fungerar tillsammans som en applikation.
 * Routsen sköter CRUD-funktionalitet för böcker och visar de i twig-filer.
 * Koden har sammankopplande applikationer med formulär, länkar och databas.
 */
class BiblotekController extends AbstractController
{
    private  EntityManagerInterface $entityManager;
    private BookRepository $bookRepository;

    public function __construct(EntityManagerInterface $entityManager, BookRepository $bookRepository)
    {
        $this->entityManager = $entityManager;
        $this->bookRepository = $bookRepository;
    }

    #[Route('/library', name: 'library', methods: ['GET'])]
    public function library(): Response
    {
        $this->bookRepository->removeDuplicateBooks();

        $books = [
            ['The Hobbit', 'J.R.R. Tolkien', '9780007458424', 'hobbit.jpg'],
            ['Harry Potter and the prisoner of Azkaban', 'J.K. Rowling', '9789129723953', 'harrypotter.jpg'],
            ['En man som heter Ove', 'Fredrik Backman', '9789137507477', 'ove.jpg'],
        ];

        $this->entityManager->flush();
        $persistedBooks = $this->bookRepository->findAll();
        return $this->render('library/index.html.twig', [
            'books' => $persistedBooks,
        ]);
    }


    #[Route('/library/create', name: 'library_create', methods: ['GET','POST'])]
    public function createBook(Request $request): Response
    {

        $book = new Book();
        $form = $this->createForm(CreateBook::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($book);
            $this->entityManager->flush();
            return $this->redirectToRoute('library_all');
        }

        return $this->render('library/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/library/read/{id}', name: 'library_read', methods: ['GET','POST'])]
    public function showBookId(int $id): response
    {
        $book = $this->bookRepository->find($id);
        if (!$book) {
            throw $this->createNotFoundException('Hittades ingen bok med id'.$id);
        }
        return $this->render('library/read.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/library/all', name: 'library_all', methods: ['GET'])]
    public function showAllBooks(): Response
    {
        $books = $this->bookRepository->findAll();
        return $this->render('library/all.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/library/update/{id}', name: 'library_update', methods: ['GET','POST'])]
    public function updateBook(Request $request, int $id): Response
    {
        $book = $this->bookRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Hittades ingen bok med id'.$id);
        }

        $form = $this->createForm(CreateBook::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return $this->redirectToRoute('library_all');
        }

        return $this->render('library/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/product/delete/{id}', name: 'library_delete', methods:['GET','POST'])]
    public function deleteBookId(int $id): Response
    {
        $book = $this->bookRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Hittades ingen bok med id'.$id);
        }

        $this->entityManager->remove($book);
        $this->entityManager->flush();

        return $this->redirectToRoute('library_all');
    }

    #[Route('/library/reset', name: 'library_reset', methods: ['GET','POST'])]
    public function resetLibrary(): Response
    {
        $books = $this->bookRepository->findAll();
        foreach ($books as $book) {
            $this->entityManager->remove($book);
        }
        $this->entityManager->flush();
        return $this->redirectToRoute('library_all');
    }

}
