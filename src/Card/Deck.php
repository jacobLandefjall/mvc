<?php

namespace App\Card;

use App\Card\CardGraphic;

class Deck
{
    private $deck;

    public function __construct()
    {
        $this->deck = $this->createDeck();
    }

    private function createDeck()
    {
        $suits = ['hearts', 'diamonds', 'clubs', 'spades'];
        $values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
        $deck = [];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $deck[] = new CardGraphic($suit, $value);
            }
        }

        return $deck;
    }

    public function getDeck()
    {
        return $this->deck;
    }

    public function setDeck($deck)
    {
        $this->deck = $deck;
    }

    public function shuffleDeck()
    {
        shuffle($this->deck);
    }

    public function drawCards($number)
    {
        return array_splice($this->deck, 0, $number);
    }
}