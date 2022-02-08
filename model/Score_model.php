<?php

class Score_model
{

    public function sql_envoyer_score($id, $score, $nb_pair)
    {
        $req = "INSERT INTO scores (id_utilisateur, score, nombre_pair, date) VALUES (:id_utilisateur, :score, :nombre_pair, CURRENT_TIMESTAMP  )";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id_utilisateur" => $id,
            ":score" => $score,
            ":nombre_pair" => $nb_pair,
        ));
    }

    public function sql_afficher_score_user($id)
    {
        $req = "SELECT * FROM scores WHERE id_utilisateur = :id ORDER BY date DESC";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id" => $id
        ));
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function sql_dashboard_user($id)
    {
        $req = "SELECT MIN(score) as min, nombre_pair,  AVG(score) as moyenne FROM  scores WHERE id_utilisateur = :id GROUP BY nombre_pair";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":id" => $id
        ));
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function sql_affiche_score_top10($pair)
    {
        $req = "SELECT DISTINCT scores.score, scores.nombre_pair, utilisateurs.login FROM scores INNER JOIN utilisateurs ON scores.id_utilisateur = utilisateurs.id WHERE scores.nombre_pair = :pair GROUP BY scores.score, scores.id_utilisateur   ORDER BY scores.score ASC LIMIT 0, 10;";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":pair" => $pair
        ));
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }
}