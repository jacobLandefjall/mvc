<?php

namespace App\Game;

class Hand
{
    private $cards = [];
    // Skapar en metod för att lägga till kort i handen
    public function addCard(Card $card)
    {
        $this->cards[] = $card;
    }
    // Skapar en metod för att räkna ut handens värde
    public function getHandValue()
    {
        $value = 0;
        $aceCount = 0;
        foreach ($this->cards as $card) {
            $value += $card->getValue();
            if ($card->isAce()) {
                $aceCount++;
            }
        }
        // Minskar ESS värde från 11 till1 om handen är över 21
        while ($value > 21 && $aceCount > 0) {
            $value -= 10;
            $aceCount--;
        }
        return $value;
    }

    // Metod för blackjack
    public function hasBlackjack()
    {
        return $this->getHandValue() === 21;
    }
}

