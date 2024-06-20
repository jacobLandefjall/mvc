<?php

// Skapar en class BlackJackGame i filen BlackJackGame.php

namespace App\Game;

class BlackJackGame
{
    private $gameOver = false;
    private $player;
    private $dealer;
    private $deck;
    private $message;

    public function __construct()
    {

        $this->deck = new Deck();
        $this->deck->shuffleDeck();

        $this->player = new Player($this->deck);
        $this->dealer = new Player($this->deck);

        // Ger spelare två kort i början
        $this->player->hit();
        $this->player->hit();
        $this->dealer->hit();
        $this->dealer->hit();
    }

    /**
     * Metod för att hämta spelaren
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Metod för att hämta dealern
     * @return Player
     */
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * Metod för "hit" och om poäng överskrider 21
     * @return void
     */
    public function playerHits()
    {
        if (!$this->gameOver && $this->player->canHit()) {
            $this->player->hit();
            if ($this->player->getScore() > 21) {
                $this->gameOver = true;
                $this->message = "Player busts! Dealer wins.";
            }
        }
    }

    /**
     * Metod för att spelaren står
     * @return void
     */
    public function playerStands()
    {
        $this->gameOver = true;
        $this->dealerTurn();
        if ($this->dealer->getScore() > 21) {
            $this->message = "Dealer busts! Player wins.";
        } else {
            $this->message = $this->determineWinner();
        }
    }

    /**
     * Metod för att köra dealerns tur
     * @return void
     */
    public function dealerTurn()
    {
        while ($this->dealer->getScore() < 17) {
            $this->dealer->hit();
        }
    }

    /**
     * Metod för att bestämma vinnaren
     * @return string
     */
    public function determineWinner()
    {
        $playerScore = $this->player->getScore();
        $dealerScore = $this->dealer->getScore();
        if ($playerScore > $dealerScore) {
            return "Player wins with $playerScore against dealer's $dealerScore!";
        } elseif ($playerScore < $dealerScore) {
            return "Dealer wins with $dealerScore against player's $playerScore!";
        } else {
            return "It's a tie with both scoring $playerScore!";
        }
    }

    /**
     * Metod om spelet är över
     * @return bool
     */
    public function getGameOver()
    {
        return $this->gameOver;
    }

    /**
     * Metod för att hämta meddelande
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Metod för att kolla om spelaren kan "hit"
     * @return bool
     */
    public function canHit()
    {
        return $this->player->canHit();
    }

    /**
     * Metod för om spelaren ger upp
     * @return void
     */
    public function playerSurrenders()
    {
        $this->gameOver = true;
        $this->message = "Player surrenders! Dealer wins.";
    }

}
