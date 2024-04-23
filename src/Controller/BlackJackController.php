<?php

namespace App\Controller;

use App\Game\BlackJackGame;
use App\Game\Card;
use App\Game\Deck;
use App\Game\Hand;
use App\Game\Player;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlackJackController extends AbstractController
{
    // Kmom03 blackjack

    // Route för game sidan
    #[Route("/game", name: "game")]
    public function game(): Response
    {
        return $this->render('blackjack/game.html.twig');
    }
    #[Route("/game/doc", name: "game_doc")]
    public function doc(): Response
    {
        return $this->render('blackjack/dokumentation.html.twig');

    }
    // Route för att starta spelet
    #[Route("/game/start", name: "start", methods: ["GET"])]
    public function playGame(): Response
    {
        $deck = new Deck();
        // Create your game object here
        $game = new BlackJackGame();

        return $this->render('blackjack/start.html.twig', [
            'game' => $game,
        ]);
    }
}