<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test klass för att testa BlackJackGame klassen.
 * BlackJackGame-klass i blackjack spelet.
 */
class BlackJackGameTest extends TestCase
{
    /**
     * Testar påbörjat spel med kort.
     * 2 kort för spelaren och 2 kort för dealern.
     */
    public function testStartGame(): void
    {
        $game = new BlackJackGame();

        // Verifierar att spelarna har skapats rätt och med rätt antal kort.
        $this->assertInstanceOf(Player::class, $game->getPlayer());
        $this->assertInstanceOf(Player::class, $game->getDealer());
        $this->assertEquals(2, count($game->getPlayer()->getCards()));
        $this->assertEquals(2, count($game->getDealer()->getCards()));
    }

    /**
     * Testar om spelaren väljer att "hit".
     * Om spelaren får över 21 poäng så förlorar spelaren.
     */
    public function testPlayerHits(): void
    {
        $game = new BlackJackGame();

        $game->getPlayer()->addCard(new Card('Spader', '3'));
        $countedCards = count($game->getPlayer()->getCards());

        $game->playerHits();

        $this->assertCount($countedCards + 1, $game->getPlayer()->getCards());
        //$this->assertFalse($game->getGameOver());

        $game->getPlayer()->addCard(new Card('Spader', 'K'));
        $game->getPlayer()->addCard(new Card('Spader', 'K'));

        $game->playerHits();


    }

    /**
     * Testar om spelaren väljer att "stand".
     */
    public function testPlayerStands(): void
    {
        $game = new BlackJackGame();
        $game->playerStands();

        $this->assertTrue($game->isGameOver());
        $this->assertNotEmpty($game->getMessage());
    }

    /**
     * Testar dealerns drag
     */
    public function testDealerTurn(): void
    {
        $game = new BlackJackGame();
        $game->dealerTurn();

        $this->assertGreaterThanOrEqual(17, $game->getDealer()->getScore());
    }

    /**
     * Testar att bestämma vinnaren
     *
    public function testDetermineWinner(): void
    {
        $game = new BlackJackGame();

        $game->getPlayer()->addCard(new Card('Spader', 'K'));
        $game->getPlayer()->addCard(new Card('Spader', '5'));
        $game->getDealer()->addCard(new Card('Spader', '4'));
        $game->getDealer()->addCard(new Card('Spader', '7'));

        $expectedMessage = $game->determineWinner();
        $this->assertEquals($expectedMessage, $game->determineWinner());    
    }*/

    /**
     * Test för om spelaren väljer att ge upp.
     */
    public function testPlayerSurrenders(): void
    {
        $game = new BlackJackGame();
        $game->playerSurrenders();

        $this->assertTrue($game->isGameOver());
        $this->assertEquals("Player surrenders! Dealer wins.", $game->getMessage());
    }

    /**
     * Test om spelaren kan "hit".
     */
    public function testCanHit(): void
    {
        $game = new BlackJackGame();

        $this->assertTrue($game->canHit());

        $game->getPlayer()->addCard(new Card('Spader', '10'));
        $game->getPlayer()->addCard(new Card('Hearts', '10'));

        $this->assertFalse($game->canHit());
    }
}
    