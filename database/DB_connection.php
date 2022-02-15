<?php

class Database
{
    public static function connect_db(): PDO
    {
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=hugo-chabert_memory;charset=utf8", "hugo-chabertME", "chabertME");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (!$bdd) {
                die("Connexion a la bdd impossible");
            }
            return $bdd;
        } catch (PDOException $e) {

            echo 'echec : ' . $e->getMessage();
            var_dump($e);
        }
    }
}