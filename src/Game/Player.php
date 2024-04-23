<?php

namespace App\Game;

class Player
{
    private $hand;
    private $stand = false;

    // Konstruktor
    public function __construct(Deck $deck)
    {
        $this->hand = new Hand();
       }

    // Metod för "Stand" 
    public function stand()
    {
        $this->stand = true;
    }

    public function isStanding()
    {
        return $this->stand;
    }

    // Metod för "Hit"
    public function hit(Deck $deck)
    {
        if ($this->stand) {
            throw new \Exception("Cannot hit after standing.");
        }
        $this->hand->addCard($deck->drawCard());
    }

    // Metod för att ta kort
    public function getCard($card){

        $this->hand->addCard($card);
    }

    // Metod för att räkna ut handens värde
    public function getScore(){
        return $this->hand->getHandValue();
    }

}