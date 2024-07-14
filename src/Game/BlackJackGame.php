<?php

namespace App\Game;

/**
 * Klass för att hanterar <blackjack-spelet
 */
class BlackJackGame
{
    /**
     * @var bool $gameOver
     */
    private $gameOver = false;

    /**
     * @var Player $player
     */
    private $player;

    /**
     * @var Player $dealer
     */
    private $dealer;

    /**
     * @var Deck $deck
     */
    private $deck;

    /**
     * @var string $message
     */
    private $message;

    public function __construct()
    {

        $this->deck = new Deck();
        $this->deck->shuffleDeck();
        $this->player = new Player($this->deck);
        $this->dealer = new Player($this->deck);
        $this->dealInitialCards();
    }

    /**
     * Uppdaterad efter phpmetrics.
     * Ger spelare och dealer två kort i början.
     * @return void
     */
    public function dealInitialCards(): void
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
        if ($this->gameOver || !$this->player->canHit()) {
            return;
        }
        $this->player->hit();
        $this->checkPlayerBust();
    }

    /**
     * Kontrollerar om spelaren har "bust".
     * Uppdaterad för phpmetrics.
     * @return void
     */
    public function checkPlayerBust(): void
    {
        if ($this->player->getScore() > 21) {
            $this->endGame("Player busts! Dealer wins.");
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
        $this->checkGameResult();
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
     * Bryter ut större metoder till mindre.
     *  private därför att funktionen används i blackJackGame klassen.@
     * @return void
     */
    private function checkGameResult(): void
    {
        $this->message = $this->dealer->getScore() > 21 ? "Dealer busts! Player wins." : $this->determineWinner();
    }

    /**
     * Metod för att bestämma vinnaren.
     *  private därför att funktionen används i blackJackGame klassen.
     * @return string
     */
    private function determineWinner(): string
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
     * Metod för att avsluta spelet
     * private därför att funktionen används i blackJackGame klassen.
     * @param string $message
     * @return void
     */
    private function endGame(string $message): void
    {
        $this->gameOver = true;
        $this->message = $message;
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
        $this->endGame("Player surrenders! Dealer wins.");
    }

}
