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
    // Kmom03 blackjack by Jacob

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
    #[Route("/game/start", name: "start", methods: ["GET"])]
    public function playGame(SessionInterface $session): Response
    {
        $game = new BlackJackGame();
        $session->set('game', $game);

        return $this->render('blackjack/start.html.twig', [
            'game' => $game,
            'playerCards' => $game->getPlayer()->getHand()->getCards(),
            'dealerCards' => $game->getDealer()->getHand()->getCards(),
        ]);
    }
    #[Route("/game/hit", name: "game_hit", methods: ["POST"])]
    public function hit(SessionInterface $session): Response
    {
        $game = $session->get('game');
        if ($game === null) {
            $game = new BlackJackGame();
            $session->set('game', $game);
        }

        if ($game->getPlayer()->canHit() && !$game->isGameOver()) {
            $game->playerHits();
            $session->set('game', $game);
        }

        return $this->render('blackjack/start.html.twig', [
            'game' => $game,
            'playerCards' => $game->getPlayer()->getHand()->getCards(),
            'dealerCards' => $game->getDealer()->getHand()->getCards(),
        ]);
    }

    #[Route("/game/stand", name: "game_stand", methods: ["POST"])]
    public function stand(SessionInterface $session): Response
    {
        $game = $session->get('game');
        if ($game === null) {
            $game = new BlackJackGame();
            $session->set('game', $game);
        }

        if (!$game->isGameOver()) {
            $game->playerStands();
            $session->set('game', $game);
        }

        return $this->render('blackjack/start.html.twig', [
            'game' => $game,
            'playerCards' => $game->getPlayer()->getHand()->getCards(),
            'dealerCards' => $game->getDealer()->getHand()->getCards(),
        ]);
    }

    #[Route("/game/surrender", name: "game_surrender", methods: ["POST"])]
    public function surrender(SessionInterface $session): Response
    {
        $game = $session->get('game');
        if ($game !== null) {
            $game->playerSurrenders();
            $session->set('game', $game);
        }

        return $this->render('blackjack/start.html.twig', [
            'game' => $game,
            'playerCards' => $game->getPlayer()->getHand()->getCards(),
            'dealerCards' => $game->getDealer()->getHand()->getCards(),
        ]);
    }

    #[Route("/game/restart", name: "game_restart", methods: ["POST"])]
    public function restart(SessionInterface $session): Response
    {
        $game = new BlackJackGame();
        $session->set('game', $game);

        return $this->redirectToRoute('start');
    }
}
