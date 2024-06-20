<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\Deck;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function card(): Response
    {
        return $this->render('session/card.html.twig');
    }

    #[Route("/card/deck", name: "deck")]
    public function deck(SessionInterface $session): Response
    {
        $deck = $session->get('deck', []);

        if (empty($deck)) {
            $cardGame = new Deck();
            $deck = $cardGame->getDeck();
            $session->set('deck', $deck);
            $session->set('originalDeck', $deck);
        }
        $cardGraphic = new CardGraphic('hearts', 'A');
        $graphic = $cardGraphic->getGraphic();

        return $this->render('session/deck.html.twig', [
            'deck' => $deck,
            'cardGraphic' => $graphic
        ]);
    }

    #[Route("/card/deck/shuffle", name: "shuffle")]
    public function shuffle(SessionInterface $session): Response
    {
        // Get the original deck from the session
        $originalDeck = $session->get('originalDeck', []);
        $cardGame = new Deck();
        $cardGame->setDeck($originalDeck);
        $cardGame->shuffleDeck();

        $shuffledDeck = $cardGame->getDeck();
        $session->set('deck', $shuffledDeck);

        $cardGraphic = new CardGraphic('hearts', 'A');
        $graphic = $cardGraphic->getGraphic();
        return $this->render('session/shuffle.html.twig', [
            'deck' => $shuffledDeck,
        ]);
    }

    #[Route("/card/deck/draw/{number}", name: "draw", requirements: ['number' => '\d+'])]
    public function draw(SessionInterface $session, int $number = 1): Response
    {
        $deck = $session->get('deck', []);
        $cardGame = new Deck();
        $cardGame->setDeck($deck);
        $drawnCards = $cardGame->drawCards($number);

        // Update the deck in the session after drawing cards
        $session->set('deck', $cardGame->getDeck());

        return $this->render('session/draw.html.twig', [
            'drawnCards' => $drawnCards,
            'deck' => count($cardGame->getDeck()),
        ]);
    }

    #[Route("/session", name: "session")]
    public function session(SessionInterface $session): Response
    {
        $sessionData = [];
        $originalDeck = $session->get('originalDeck', []);
        $currentDeck = $session->get('deck', []);

        $removedCards = array_udiff($originalDeck, $currentDeck, function ($a, $b) {
            // Compare the suit and value properties of the Card objects
            if ($a->getSuit() !== $b->getSuit()) {
                return $a->getSuit() <=> $b->getSuit();
            }

            return $a->getValue() <=> $b->getValue();
        });
        foreach ($session->all() as $key => $value) { // Loopar och sparar sessiondata i en array.
            if ($key == 'deck') {
                $sessionData['removedCards'] = $removedCards;
                $sessionData[$key] = count($value);
            } else {
                $sessionData[$key] = is_array($value) ? json_encode($value) : $value;
            }
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
}
