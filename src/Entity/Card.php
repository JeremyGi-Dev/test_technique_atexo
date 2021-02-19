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
    public $colors = [];

    /**
     * @ORM\Column(type="array")
     */
    public $cardValues = [];

    /**
     * Fonction retournant une main contenant 10 carte aléatoire créé dans un deck de 52 cartes
     * @return Array
     */
    public function createHand(){
        $colors = ["Carreaux", "Coeur", "Pique", "Trèfle"];
        $cardValues = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14"];
        $cardGame =  [];

        foreach($colors as $color){
            foreach($cardValues as $values){
                $cardGame[] = [
                    "valeur" => $values, 
                    "couleur" => $color
                ];
            }
        }
        // mélange l'array pour le côté random
        shuffle($cardGame);

        $hand = array_slice($cardGame, 0, 10);

        return $hand;
    }
}
