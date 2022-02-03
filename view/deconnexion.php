<?php
session_start();

require_once(__DIR__ . '/../controller/Securite.php');

if (!Securite::estConnecte()) {
    header('Location:../index.php');
    exit();
} else {
    $_SESSION['objet_utilisateur']->deconnexion();
    header('Location:../index.php');
    exit();
}
?>