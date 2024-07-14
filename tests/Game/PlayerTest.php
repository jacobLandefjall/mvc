<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test klass för att testa Player klassen.
 * Player-klass i blackjack spelet.
 */
class PlayerTest extends TestCase
{
    /**
     * Testa att stand-funktionen fungerar.
     */
    public function testStand(): void
    {
        $deck = $this->createMock(Deck::class);
        $player = new Player($deck);

        $this->assertFalse($player->isStanding());
        $player->stand();
        $this->assertTrue($player->isStanding());
    }
    /**
     * Testa att hit-funktionen fungerar.
     * CreateMock = isolera test från beroenden. För att testa utan att använda riktig klass.
     */
    public function testHit(): void
    {
        $deck = $this->createMock(Deck::class);
        $deck->method('drawCard')
            ->willReturn(new Card('Spader', 'K')); // Returnerar kortet spader kung.
        $player = new Player($deck);

        $this->assertEquals(0, count($player->getCards())); // verifiera att spelaren har 0 kort.
        $player->hit();
        $this->assertEquals(1, count($player->getCards())); // verifiera att spelaren har 1 kort.
        $this->assertEquals(10, $player->getScore()); // verifiera att spelaren har 10 poäng.
    }

    /**
     * Test för att verifiera att spelaren kan förlora med hit.
     */
    public function testHitLimit(): void
    {
        $deck = $this->createMock(Deck::class);

        $deck->method('drawCard')
            ->willReturn(new Card('Spader', '10')); // Returnerar kortet spader 10.
        $player = new Player($deck);
        $player->addCard(new Card('Spader', '10'));
        $player->addCard(new Card('Spader', '10'));

        $this->assertFalse($player->lost());
        $player->hit();
        $this->assertTrue($player->lost());
    }

    /**
     * Test för att verifiera att spelaren kan "hit"
     */
    public function testCanHit(): void
    {
        $deck = $this->createMock(Deck::class);
        $player = new Player($deck);

        $this->assertTrue($player->canHit());
        $player->addCard(new Card('Spader', '10'));
        $player->addCard(new Card('Spader', 'K'));

    }

    /**
     * Test för att se spelarens hand.
     */
    public function testGetHand(): void
    {
        $deck = $this->createMock(Deck::class);
        $player = new Player($deck);

        $this->assertInstanceof(Hand::class, $player->getHand());
    }

    /**
     * Test för att se poängen.
     */
    public function testGetScore(): void
    {
        $deck = $this->createMock(Deck::class);
        $player = new Player($deck);

        $this->assertEquals(0, $player->getScore());
        $player->addCard(new Card('Spader', '10'));
        $this->assertEquals(10, $player->getScore());
    }

    /**
     * Test för att se spelaren har Blackjack
     */
    public function testHasBlackjack(): void
    {
        $deck = $this->createMock(Deck::class);
        $player = new Player($deck);

        $this->assertFalse($player->hasBlackjack());
        $player->addCard(new Card('Hearts', 'K'));
        $player->addCard(new Card('Spader', 'A'));
        $this->assertTrue($player->hasBlackjack());
    }

    /**
     * Test för att lägga till kort.
     */
    public function testAddCard(): void
    {
        $deck = $this->createMock(Deck::class);
        $player = new Player($deck);

        $this->assertEquals(0, count($player->getCards()));
        $player->addCard(new Card('Spader', '10'));
        $this->assertEquals(1, count($player->getCards()));
        $this->assertEquals(10, $player->getScore());
    }
}

