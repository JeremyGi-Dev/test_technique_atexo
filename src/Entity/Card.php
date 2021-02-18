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
    public $CardValues = ["AS", "5", "10", "8", "6", "5", "7", "4", "2", "3", "9", "Dame", "Roi", "Valet"];

    /**
     * Fonction retournant une main contenant 10 carte aléatoire créé dans un deck de 52 cartes
     * @return Array
     */
    public function createHand(){
        $colors = ["Carreaux", "Coeur", "Pique", "Trèfle"];
        $CardValues = ["AS", "2", "3", "4", "5", "6", "7", "8", "9", "10", "Valet", "Dame", "Roi"];
        $CardGame =  [];

        foreach($colors as $color){
            foreach($CardValues as $values){
                $CardGame[] = [$values,$color];
            }
        }
        // mélange l'array pour le côté random
        shuffle($CardGame);

        $hand = array_slice($CardGame, 0, 10);

        return $hand;
    }
}
