<?php

namespace App\Card;

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
        $values = range(1, 13);
        $deck = [];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $deck[] = new Card($suit, $value);
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