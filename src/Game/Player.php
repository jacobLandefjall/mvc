<?php

namespace App\Game;

use App\Game\Card;

class Player
{
    /**
     * @var Hand
     */
    private $hand;

    /**
     * @var bool
     */
    private $stand = false;

    /**
     * @var bool
     */
    private $lost = false;

    /**
     * @var Deck
     */
    private $deck;

    /**
     * @var int
     */
    private $hitCount = 0;

    /**
     * @param Deck $deck
     */
    public function __construct(Deck $deck)
    {
        $this->hand = new Hand();
        $this->deck = $deck;
    }

    /**
     * @return void
     */
    public function stand(): void
    {
        $this->stand = true;
    }

    /**
     * @return bool
     */
    public function isStanding(): bool
    {
        return $this->stand;
    }

    /**
     * Metod "hit"
     * @return void
     */
    public function hit(): void
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
    public function getCards(): array
    {
        return $this->hand->getCards();
    }

    /**
     * @return bool
     * Hit för att kunna "hit"
     */
    public function canHit(): bool
    {
        return $this->getScore() < 21;
    }

    /**
     * Uppdaterat namn för att bättre beskriva vad metoden gör memd phpmetrics.
     *  Metod för att ta kort
     * @param Card $card
     * @return void
     */
    public function receiveCard(Card $card): void
    {

        $this->hand->addCard($card);
        $this->checkIfLost();
    }

    /**
     * @return Hand
     */
    public function getHand(): Hand
    {
        return $this->hand;
    }

    /**
     * Metod för att räkna ut handens värde
     * @return int
     */
    public function getScore(): int
    {
        return $this->hand->getHandValue();
    }

    /**
     * @return bool
     * Ser om handen har blackjack
     */
    public function hasBlackjack(): bool
    {
        return $this->hand->hasBlackjack();
    }

    /**
     * @return bool
     * Checkar om poäng är över 21 och sätter lost till true
     */
    public function addCard(Card $card): bool
    {
        $this->hand->addCard($card);
        if ($this->getScore() > 21) {
            $this->lost = true;
            return false;
        }
        return true;
    }

    /**
     * Kontrollerar om spelaren har förlorat.
     * @return bool
     */
    public function lost(): bool
    {
        // Implementera logiken för att avgöra om spelaren har förlorat.
        // Detta är ett exempel och kan behöva anpassas baserat på hur du hanterar poäng eller andra villkor för förlust.
        return $this->getScore() > 21;
    }

    /**
     * Kontrollerar om poängen är över 21 och sätter lost till true.
     * @return void
     */
    public function checkIfLost(): void
    {
        if ($this->getScore() > 21) {
            $this->lost = true;
        }
    }

}
