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
            $hands = $card->createHand($card->colors, $card->cardValues, $card->cardNames);

            // on le met en session pour le travailler plus tard
            $this->session->set('PlayerHand', $hands);
        }

        return $this->render('card/index.html.twig');
    }

    /**
     * @Route("/filter/{name}", name="filter")
     */
    public function filter(string $name): Response
    {
        $hands = $this->session->get('PlayerHand');

        if($name == 'couleur'){
            usort($hands, function($a, $b) {
                // on tri d'abord par couleur
                $arraySorted = $a['couleur'] <=> $b['couleur'];
            
                // on tri par valeur ensuite
                if($arraySorted == 0)
                    $arraySorted = $a['valeur'] <=> $b['valeur'];
            
                return $arraySorted;
            });
        }
        else if($name == 'valeur'){
            usort($hands, function($a, $b) {
                // on tri d'abord par couleur
                $arraySorted = $a['valeur'] <=> $b['valeur'];
                return $arraySorted;
            });
        }
        else{
            // si pas de parametre, on ne fait rien
        }
        
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
