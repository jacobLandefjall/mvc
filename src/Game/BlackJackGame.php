<?php

namespace App\Game;

/**
 * Klass för att hanterar <blackjack-spelet
 */
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

        $this->dealCards();
    }

    /**
     * Uppdaterad efter phpmetrics.
     * Ger spelare och dealer två kort i början.
     * @return void
     */
    public function dealCards(): void
    {
        for ($i = 0; $i < 2; $i++) {
            $this->player->hit();
            $this->dealer->hit();
        }
    }

    /**
     * Metod för att hämta spelaren
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * Metod för att hämta dealern
     * @return Player
     */
    public function getDealer(): Player
    {
        return $this->dealer;
    }

    /**
     * Metod för "hit" och om poäng överskrider 21
     * @return void
     */
    public function playerHits(): void
    {
        if (!$this->gameOver && $this->player->canHit()) {
            $this->player->hit();
            $this->checkPlayerBust();
        }
    }

    /**
     * Kontrollerar om spelaren har "bust".
     * Uppdaterad för phpmetrics.
     * @return void
     */
    public function checkPlayerBust(): void
    {
        if ($this->player->getScore() > 21) {
            $this->gameOver = true;
            $this->message = "Player busts! Dealer wins.";
        }
    }

    /**
     * Metod för att spelaren står
     * @return void
     */
    public function playerStands(): void
    {
        $this->gameOver = true;
        $this->dealerTurn();
        $this->gameResult();
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
     * Metod för att se resultatet av spelet.
     * Uppdaterad för phpmetrics.
     * Bryter ut större metoder till mindre.
     * @return void
     */
    public function gameResult(): void
    {
        if($this->dealer->getScore() > 21) {
            $this->message = "Dealer busts! Player wins.";
        } else {
            $this->message = $this->determineWinner();
        }
    }

    /**
     * Metod för att bestämma vinnaren
     * @return string
     */
    public function determineWinner(): string
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
    public function isGameOver(): bool
    {
        return $this->gameOver;
    }

    /**
     * Metod för att hämta meddelande
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Metod för att kolla om spelaren kan "hit"
     * @return bool
     */
    public function canHit(): bool
    {
        return $this->player->canHit();
    }

    /**
     * Metod för om spelaren ger upp
     * @return void
     */
    public function playerSurrenders(): void
    {
        $this->gameOver = true;
        $this->message = "Player surrenders! Dealer wins.";
    }

}
