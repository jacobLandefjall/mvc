<?php

// kmom05 BiblotekController.php databas ORM

namespace App\Controller;

use App\Bibliotek\CreateBook;
use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    private EntityManagerInterface $entityManager;
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        $this->bookRepository = $bookRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * Route för att visa biblioteket.
     * @Route("/library", namne="library")
     */
    #[Route('/library', name: 'library', methods: ['GET'])]
    public function library(): Response
    {
        $this->bookRepository->removeDuplicateBooks();
        $this->entityManager->flush();

        return $this->renderLibraryIndex();

    }

    /**
     * Route för att skapa en ny bok.
     * @Route("/library/create", namne="library_create")
     */
    #[Route('/library/create', name: 'library_create', methods: ['GET','POST'])]
    public function createBook(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(CreateBook::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveBook($book);
            return $this->redirectToRoute('library_all');
        }

        return $this->renderForm('library/create.html.twig', $form);
    }

    /**
     * Route för att visa en bok med ett specifikt id.
     * @Route("/library/read/{id}", namne="library_read")
     */
    #[Route('/library/read/{id}', name: 'library_read', methods: ['GET','POST'])]
    public function showBookId(int $id): response
    {
        $book = $this->findBookById($id);

        return $this->render('library/read.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * Route för att visa alla böcker.
     * @Route("/library/all", namne="library_all")
     */
    #[Route('/library/all', name: 'library_all', methods: ['GET'])]
    public function showAllBooks(): Response
    {
        $books = $this->bookRepository->findAll();

        return $this->render('library/all.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * Route för att uppdatera en bok med ett specifikt id.
     * @Route("/library/update/{id}", namne="library_update")
     */
    #[Route('/library/update/{id}', name: 'library_update', methods: ['GET','POST'])]
    public function updateBook(Request $request, int $id): Response
    {
        $book = $this->findBookById($id);

        $form = $this->createForm(CreateBook::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return $this->redirectToRoute('library_all');
        }

        return $this->renderForm('library/update.html.twig', $form);
    }

    /**
     * Route för att ta bort en bok med ett specifikt id.
     * @Route("/library/delete/{id}", namne="library_delete")
     */
    #[Route('/library/delete/{id}', name: 'library_delete', methods:['GET','POST'])]
    public function deleteBookId(int $id): Response
    {
        $book = $this->findBookById($id);
        $this->removeBook($book);
        return $this->redirectToRoute('library_all');
    }

    /**
     * Route för att återställa biblioteket.
     * @Route("/library/reset", namne="library_reset")
     */
    #[Route('/library/reset', name: 'library_reset', methods: ['GET','POST'])]
    public function resetLibrary(): Response
    {
        $this->resetBooks();
        return $this->redirectToRoute('library_all');
    }

    /**
     * Skapade funktioner för att bryta ut kod och göra den mer läsbar.
     */
    private function renderLibraryIndex(): Response
    {
        $persistedBooks = $this->bookRepository->findAll();
        return $this->render('library/index.html.twig', [
            'books' => $persistedBooks,
        ]);
    }

    /**
     *
     */
    private function renderForm(string $template, $form): Response
    {
        return $this->render($template, [
            'form' => $form->createView(),
        ]);
    }

    /**
     *
     */
    private function saveBook(Book $book): void
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    /**
     *
     */
    private function findBookById(int $id): Book
    {
        $book = $this->bookRepository->find($id);
        if (!$book) {
            throw $this->createNotFoundException('Hittades ingen bok med id'.$id);
        }
        return $book;
    }

    /**
     *
     */
    private function removeBook(Book $book): void
    {
        $this->entityManager->remove($book);
        $this->entityManager->flush();
    }

    /**
     *
     */
    private function resetBooks(): void
    {
        $books = $this->bookRepository->findAll();
        foreach ($books as $book) {
            $this->entityManager->remove($book);
        }
        $this->entityManager->flush();
    }

}
