<?php

// Skapar en class BlackJackGame i filen BlackJackGame.php


namespace App\Game;


class BlackJackGame
{
    private $gameOver = false;
    private $player;
    private $dealer;

    public function __construct() {

        $deck = new Deck();
        $deck->shuffleDeck();

        foreach($deck->getCards() as $card) {
            echo (string)$card;
            echo "<br>";
        }

        $this -> player = new Player($deck);
        $this -> dealer = new Player($deck);
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function getDealer()
    {
        return $this->dealer;
    }

    public function getGameOver()
    {
        return $this->gameOver;
    }

    public function getMessage()
    {
        return $this->message;
    }
    // returnerar 1 om spelet är slut, o om ingen vinst händer
    public function win($player, $dealer, $stand){
        if($player > 21) {
            echo "<div style='background-color:red; text-align:centet; color: Black; font-size: 26px; font-weight: bold;'>You Lose!</div>";
            return 1;
        }
        else if ($dealer > 21){
            echo "<div style='background-color:green; text-align:centet; color: Black; font-size: 26px; font-weight: bold;'>You Win!</div>";
            return 1;

        }
        else if ($stand == 1){
            if ($player > $dealer){
               echo "<div style='background-color:green; text-align:center; color: black; font-size: 26px; font-weight: bold;'>You Win!</div>"; 
                return 1;
            }
            else{
                echo "<div style='background-color:red; text-align:center; color:black; font-size: 26px; font-weight: bold;'>You Lose!</div>";
                return 1;
            }
        }
        return 0;
    }
    public function surrender() {
        $this->gameOver = true;
        echo "<div style='background-color:red; text-align:center; color:black; font-size: 26px; font-weight: bold;'>You Lose!</div>";
    }
}