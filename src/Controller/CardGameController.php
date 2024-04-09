<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route("/session", name: "session")]
    public function session(SessionInterface $session): Response
    {
        // Hämtar all sessiondata.
        $sessionData = [];
        foreach ($session->all() as $key => $value) { // Loopar och sparar sessiondata i en array.
            $sessionData[$key] = is_array($value) ? json_encode($value) : $value;
        }
        return $this->render('session/home.html.twig', [
            'sessionData' => $sessionData,
        ]);
    }

    #[Route("/session/delete", name: "session_delete")]
    public function session_Delete(SessionInterface $session): Response
    {
        // Rensar sessionen.
        $session->clear();

        // Skapar ett flashmeddelande.
        $this->addFlash(
            'notice',
            'Sessionen har blivit raderad!'
        );

        return $this->render('session/delete.html.twig');
    }

    #[Route("/card", name: "card")]
    public function card(): Response
    {
        return $this->render('session/card.html.twig');
    }

    #[Route("/card/deck", name: "deck")]
    public function deck(): Response
    {   //Array med de fyra färgerna i en kortlek och symboler är värdena.
        $cards = [
            'spader' => '♠',
            'hjärter' => '♥',
            'ruter' => '♦',
            'klöver' => '♣',
        ];
        // Array med de olika värdena på korten i en kortlek.
        $values = [
            '2', '3', '4', '5', '6', '7', '8', '9', '10', 'knekt', 'kung', 'dam', 'ess'];

        $deck = []; // Tom array som lagrar kortleken.
        foreach ($cards as $suit => $symbol) { // Loopar för att skapa varje möjliga kort i en kortlek.
            foreach ($values as $value) {
                $deck[$suit][] = $symbol .' '. $value;
            }
        }
        return $this->render('session/deck.html.twig', [
            'deck' => $deck,
        ]);

    }
    #[Route("/card/deck/shuffle", name: "shuffle")]
    public function shuffle(SessionInterface $session): Response
    {       //Array med de fyra färgerna i en kortlek och symboler är värdena. suit = färg.
        $cards = [
            'spader' => '♠',
            'hjärter' => '♥',
            'ruter' => '♦',
            'klöver' => '♣',
        ];
        // Array med de olika värdena på korten i en kortlek.
        $values = [ '2', '3', '4', '5', '6', '7', '8', '9', '10', 'knekt', 'kung', 'dam', 'ess'];
        // Tom array som lagrar kortleken.
        $deck = [];
        // Loopar för att skapa varje möjliga kort i en kortlek.
        // För varje färg och värde skapas ett kort.
        foreach ($cards as $suit => $symbol) {
            foreach ($values as $value) {
                // kort med symbol och värde skapas.
                //Färg och texfärg blir rött om det är hjärter eller ruter annars svart.
                $deck[] = ['card' => $symbol . ' ' . $value, 'suit' => $suit,
                 'color' => in_array(
                     $suit,
                     ['hjärter', 'ruter']
                 ) ? 'red' : 'black'];
            }
        }
        shuffle($deck); // Blandar kortleken

        $session->set('deck', $deck); // Sparar kortleken i sessionen
        return $this->render('session/shuffle.html.twig', [
            'deck' => $deck,
        ]);
    }

    // Dra kort från samma kortlek till den är tömd.
    #[Route("/card/deck/draw/{number}", name: "draw", requirements: ['number' => '\d+'])]
    public function draw(SessionInterface $session, int $number = 1): Response
    {

        $cards = [
            'spader' => '♠',
            'hjärter' => '♥',
            'ruter' => '♦',
            'klöver' => '♣',
        ];

        $values = [ '2', '3', '4', '5', '6', '7', '8', '9', '10', 'knekt', 'kung', 'dam', 'ess'];

        // Kontrollerar om kortleken finns i sessionen
        if (!$session->has('deck')) {
            $deck = [];
            foreach ($cards as $suit => $symbol) {
                foreach ($values as $value) {
                    $deck[] = $symbol . ' ' . $value;
                }
            }

            shuffle($deck); // Blandar kortleken
            $session->set('deck', $deck);
        } else {
            $deck = $session->get('deck');
        }

        $draw = array_splice($deck, -$number); // Drar :number från kortleken
        $session->set('deck', $deck); // Sparar kortleken i sessionen

        return $this->render('session/draw.html.twig', [
            'draw' => $draw,
            'deck' => count($deck), // Räknar antalet kort i kortleken
        ]);
    }
}
