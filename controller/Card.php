<?php
require_once(__DIR__ . '/../database/DB_connection.php');

class Card{

    //etat 1 = dos - etait 2 = retourner int
    public $card_status;
    // couleur background de face string
    public $card_face;
    //identifiant specifique carte int
    public $card_id;

    public function __construct($card_status, $card_face, $card_id){
        $this->card_status = $card_status;
        $this->card_face = $card_face;
        $this->card_id = $card_id;
    }

    public function verifier_couple_carte($carte_cible, $position_grille){

        $card_id_objet = $carte_cible->card_id;
        $_SESSION['verif']["$card_id_objet"] = $carte_cible;

        $tableau_card_face = [];
        if (count($_SESSION['verif']) == 1) {
            $this->voir_carte($_SESSION['verif'], $card_id_objet);
        }
        elseif (count($_SESSION['verif']) == 2) {
            foreach ($_SESSION['verif'] as $value) {
                array_push($tableau_card_face, $value->card_face);
            }

            if ($tableau_card_face[0] == $tableau_card_face[1]) {
                $_SESSION['verif']["$card_id_objet"]->card_status = 0;
                unset($_SESSION['verif']);
            }
            elseif($tableau_card_face[0] !== $tableau_card_face[1]) {
                $this->voir_carte($_SESSION['grille'], $position_grille);
                $_SESSION['refresh'] = 1;
            }
        }
    }


    public function voir_carte($carte_a_retourner, $position_specifique_grille){
        $carte_a_retourner["$position_specifique_grille"]->card_status = 0;
    }

    public function position_initial_deux_cartesv2($verif){
        foreach ($verif as $value) {
            $verif["$value->card_id"]->card_status = 1;
        }
    }
}