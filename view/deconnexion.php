<?php

include('../controller/User.php');
require_once(__DIR__ . '/../controller/Securite.php');
require_once(__DIR__ . '/../model/User_model.php');

session_start();

if (!Securite::estConnecte()) {
    header('Location:../index.php');
    exit();
} else {
    $_SESSION['objet_utilisateur']->deconnexion();
    header('Location:../index.php');
    exit();
}
?>