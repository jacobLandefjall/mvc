<?php

namespace App\Game;

/**
 * Hand class
* @property array $cards metod för att lägga till kort i handen

 */
class Hand
{
    /**
     * @var Card[]
     */
    private $cards = [];

    /**
     * @param Card $card
     * @return void
     */
    public function addCard(Card $card)
    {
        $this->cards[] = $card;
    }

    /**
     * @return Card[]
     */
    public function getCards()
    {
        return $this->cards;
    }

    // Skapar en metod för att räkna ut handens värde
    public function getHandValue(): int
    {
        $sum = 0;
        foreach ($this->cards as $card) {
            $value = $card->getValue();
            switch($value) {
                case "A":
                    $value = 11;
                    break;
                case "K":
                case "Q":
                case "J":
                    $value = 10;
                    break;
                default:
                    $value = (int) $value;
            }
            $sum += $value;
        }
        return $sum;
    }

    /**
     * @return bool
     * Check om handen har blackjack
     */
    public function hasBlackjack()
    {
        return $this->getHandValue() === 21;
    }
}
