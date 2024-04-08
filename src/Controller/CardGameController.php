<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route("/session", name: "session")]
    public function home(): Response
    {
        return $this->render('session/home.html.twig');
    }

    #[Route("/session/delete", name: "session_delete")]
    public function session_Delete(): Response
    {
        $die = new Dice();

        $data = [
            "dice" => $die->roll(),
            "diceString" => $die->getAsString(),
        ];
        $this->addFlash(
            'notice',
            'Nu är sessionen raderad!'
        );

        return $this->render('session/delete.html.twig', $data);
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
             'color' => in_array($suit,
            ['hjärter', 'ruter']) ? 'red' : 'black'];
        }
    }
        shuffle($deck); // Blandar kortleken

        $session->set('deck', $deck); // Sparar kortleken i sessionen
            return $this->render('session/shuffle.html.twig', [
                'deck' => $deck,
        ]);
    }

    // Dra kort från samma kortlek till den är tömd.
    #[Route("/card/deck/draw", name: "draw")]
    public function draw(SessionInterface $session): Response
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
        $draw = array_pop($deck); // Drar ett kort från kortleken
        $session->set('deck', $deck); // Sparar kortleken i sessionen

        return $this->render('session/draw.html.twig', [
            'draw' => $draw,
            'deck' => count($deck), // Räknar antalet kort i kortleken
        ]);
    }

    #[Route("/card/deck/draw/{number<\d+>?1}", name: "number")]
        public function number(SessionInterface $session, int $number = 1): Response
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
    } else {
        $deck = $session->get('deck' []);
        $draw = array_splice($deck, 0, min($number, count($deck)));
    }

    // antal kort som kan dras
    $number = $request->query->getInt('number', 2);
    $number = min(5, max(1, $number));

    $draw = [];
    for ($i = 0; $i < $number && !empty($deck); $i++) {
        $draw[] = array_pop($deck);
    }

    $session->set('deck', $deck); // Sparar kortleken i sessionen

    return $this->render('session/draw.html.twig', [
        'draw' => $draw,
        'deck' => count($deck), // Räknar antalet kort i kortleken
    ]);
    }
}
