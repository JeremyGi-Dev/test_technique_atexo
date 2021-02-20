<?php

namespace App\Entity;

class Card
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="array")
     */
    public $colors = ["Carreaux", "Coeur", "Pique", "Trèfle"];

    /**
     * @ORM\Column(type="array")
     */
    public $cardValues = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14"];

    /**
     * @ORM\Column(type="array")
     */
    public $cardNames = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "Valet", "Dame", "Roi", "As"];

    /**
     * Fonction retournant une main contenant 10 carte aléatoire créé dans un deck de 52 cartes
     * @return Array
     */
    public function createHand($colors, $cardValues, $cardNames){
        $cardGame =  [];

        foreach($colors as $color){
            foreach($cardValues as $id => $values){
                $cardGame[] = [
                    "valeur" => $values, 
                    "couleur" => $color,
                    "nom" => $cardNames[$id]
                ];
            }
        }
        // mélange l'array pour le côté random
        shuffle($cardGame);

        $hand = array_slice($cardGame, 0, 10);

        return $hand;
    }
}
