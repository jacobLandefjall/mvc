<?php

namespace App\Game;

class Player
{
    private $hand;
    private $stand = false;
    private bool $lost = false;
    private $deck;
    private $hitCount = 0;

    // Konstruktor
    public function __construct(Deck $deck)
    {
        $this->hand = new Hand();
        $this->deck = $deck;
    }

    /**
     * @return void
     */
    public function stand()
    {
        $this->stand = true;
    }

    /**
     * @return bool
     */
    public function isStanding()
    {
        return $this->stand;
    }

    /**
     * Metod "hit"
     * @return void
     */
    public function hit()
    {
        if ($this->hitCount < 4 && $this->getScore() < 21) {
            $this->hand->addCard($this->deck->drawCard());
            $this->hitCount++;
            if ($this->getScore() > 21) {
                $this->lost = true;
            }
        }
    }

    /**
     * @return card[]
     */
    public function getCards()
    {
        return $this->hand->getCards();
    }

    /**
     * @return bool
     * Hit för att kunna "hit"
     */
    public function canHit()
    {
        return $this->getScore() < 21;
    }

    /**
     * Uppdaterat namn för att bättre beskriva vad metoden gör memd phpmetrics.
     *  Metod för att ta kort
     * @param Card $card
     * @return void
     */
    public function receiveCard(Card $card)
    {

        $this->hand->addCard($card);
        $tihs->checkIfLost();
    }

    /**
     * @return Hand
     */
    public function getHand()
    {
        return $this->hand;
    }

    /**
     * Metod för att räkna ut handens värde
     * @return int
     */
    public function getScore()
    {
        return $this->hand->getHandValue();
    }

    /**
     * @return bool
     * Ser om handen har blackjack
     */
    public function hasBlackjack()
    {
        return $this->hand->hasBlackjack();
    }

    /**
     * @return bool
     * Checkar om poäng är över 21 och sätter lost till true
     */
    public function addCard(Card $card)
    {
        $this->hand->addCard($card);
        if ($this->getScore() > 21) {
            $this->lost = true;
        }
    }

    /**
     * Kontrollerar om spelaren har förlorat.
     * @return bool
     */
    public function lost()
    {
        // Implementera logiken för att avgöra om spelaren har förlorat.
        // Detta är ett exempel och kan behöva anpassas baserat på hur du hanterar poäng eller andra villkor för förlust.
        return $this->getScore() > 21;
    }

    /**
     * Kontrollerar om poängen är över 21 och sätter lost till true.
     * @return void
     */
    public function checkIfLost()
    {
        if ($this->getScore() > 21) {
            $this->lost = true;
        }
    }

}
