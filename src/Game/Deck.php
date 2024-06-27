<?php

namespace App\Game;

$deck = new Deck();
$cards = $deck->getCards();

require_once("Card.php"); // inkluderar Card.php

class Deck
{
    private $cards = [];

    /**
     * @return void
     * Skapar en konstruktor som skapar en kortlek och blandar den
     */
    public function __construct()
    {
        $this->CreateDeck();
        $this->ShuffleDeck();
    }

    /**
     * @return void
     * Skapar en metod för att skapa en kortlek
     */
    private function createDeck()
    {
        $suits = ['hearts', 'diamonds', 'clubs', 'spades'];
        $values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
        $deck = [];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }
    }

    /**
     * @return void
     * Blandar kortleken
     */
    public function shuffleDeck()
    {
        shuffle($this->cards);
    }

    // Skapar en metod för att dra kort till spelare
    public function drawCard()
    {
        return array_shift($this->cards);
    }

    /**
     * @return Card[]
     * Skapar en metod för att hämta kortleken
    */
    public function getCards()
    {
        return $this->cards;
    }
}
