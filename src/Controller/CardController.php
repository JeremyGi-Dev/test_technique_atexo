<?php

namespace App\Controller;

use App\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/card", name="card")
     */
    public function index(): Response
    {
        if(empty($this->session->get('PlayerHand'))){
            $card = new Card();
            $hands = $card->createHand();

            // on le met en session pour le travailler plus tard
            $this->session->set('PlayerHand', $hands);
        }

        return $this->render('card/index.html.twig');
    }
}
