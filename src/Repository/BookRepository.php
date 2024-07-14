<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 * Databasinteraktioner för att hämta, spara, uppdatera och radera böcker.
 * Integrerar med Doctrine ORM. Gör det säkrare och effektivare.
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }
    /**
     * Lägger till en bok i databasen.
     * @return void Returnerar böckerna.
     */
    public function addBook()
    {
        $entityManager = $this->getEntityManager();

        $firstBook = new Book(); // Skapar första boken.
        $firstBook->setTitle('The Hobbit');
        $firstBook->setAuthor('J.R.R. Tolkien');
        $firstBook->setIsbn('9780007458424');
        $firstBook->setImage('hobbit.jpg');
        $entityManager->persist($firstBook);

        $secondBook = new Book(); // Skapar andra boken.
        $secondBook->setTitle('Harry Potter and the prisoner of Azkaban');
        $secondBook->setAuthor('J.K. Rowling');
        $secondBook->setIsbn('9789129723953');
        $secondBook->setImage('harrypotter.jpg');
        $entityManager->persist($secondBook);

        $thirdBook = new Book(); // Skapar tredje boken.
        $thirdBook->setTitle('En man som heter Ove');
        $thirdBook->setAuthor('Fredrik Backman');
        $thirdBook->setIsbn('9789137507477');
        $thirdBook->setImage('ove.jpg');
        $entityManager->persist($thirdBook);

        // Sparar böckerna i databasen.
        $entityManager->flush();
    }
    /**
     * Hämtar en bok från databasen baserat på ISBN.
     * @param string $isbn ISBN-numret för boken.
     */
    public function findOneByIsbn(string $isbn): ?Book
    {
        $result = $this->createQueryBuilder('b')
            ->andWhere('b.isbn = :isbn')
            ->setParameter('isbn', $isbn)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        // $result är null eller en bok.
        return $result instanceof Book ? $result : null;
    }

    /**
     * Tar bort dubbletter av böcker från databasen.
     * @return void Returnerar endast en bok.
     */
    public function removeDuplicateBooks()
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT b.isbn, COUNT(b.id) as num
            FROM App\Entity\Book b
            GROUP BY b.isbn
            HAVING num > 1'
        );
        $duplicates = $query->getResult();

        foreach ($duplicates as $duplicate) {
            $isbn = $duplicate['isbn'];
            $books = $this->findBy(['isbn' => $isbn]);

            // Behåll första boken, ta bort resten
            array_shift($books); // Tar bort och behåller första boken från listan
            foreach ($books as $book) {
                $entityManager->remove($book);
            }
        }
        $entityManager->flush(); // Utför borttagningen från databasen
    }


    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
