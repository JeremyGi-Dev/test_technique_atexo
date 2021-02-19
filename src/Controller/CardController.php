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
     * @Route("/", name="home")
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

    /**
     * @Route("/filter", name="filter_home")
     */
    public function filter(): Response
    {
        $hands = $this->session->get('PlayerHand');

        usort($hands, function($a, $b) {
            // on tri d'abord par couleur
            $arraySorted = $a['couleur'] <=> $b['couleur'];
        
            // on tri par valeur ensuite
            if($arraySorted == 0)
                $arraySorted = $a['valeur'] <=> $b['valeur'];
        
            return $arraySorted;
        });

        $this->session->set('PlayerHand', $hands);

        return $this->render('card/index.html.twig');
    }

    /**
     * @Route("/reset", name="reset_home")
     */
    public function reset(): Response
    {
        $this->session->clear();

        return $this->index();
    }
}
