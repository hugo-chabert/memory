<?php

include('../controller/User.php');
require_once(__DIR__ . '/../controller/Toolbox.php');
require_once(__DIR__ . '/../controller/Securite.php');

session_start();


//affiche les infos profil
if (isset($_SESSION['objet_utilisateur'])) {
    $objet_user_info = $_SESSION['objet_utilisateur']->info_user();
}

//modifier les infos profil
if (isset($_POST['submit'])) {
    if (!empty($_POST['login']) && !empty($_POST['prenom']) && !empty($_POST['nom'])) {
        $_SESSION['objet_utilisateur']->modifier_profil_user($_POST['login'], $_POST['prenom'], $_POST['nom']);
    } else {
        Toolbox::ajouterMessageAlerte("Remplir tous les champs.", Toolbox::COULEUR_ROUGE);
        header("Location: ./profil.php");
        exit();
    }
}

//modifier le password
if (isset($_POST['submit_modification_password'])) {
    if (!empty($_POST['password_ancien']) && !empty($_POST['password_nouveau']) && !empty($_POST['password_confirmation'])) {
        if ($_POST['password_nouveau'] == $_POST['password_confirmation']) {
            $_SESSION['objet_utilisateur']->modifier_profil_password($_POST['password_ancien'], $_POST['password_nouveau']);
        }

        if ($_POST['password_nouveau'] !== $_POST['password_confirmation']) {
            Toolbox::ajouterMessageAlerte("Mots de passe différents !", Toolbox::COULEUR_ROUGE);
            header("Location: ./profil.php");
            exit();
        }
    } else {
        Toolbox::ajouterMessageAlerte("Remplir tous les champs.", Toolbox::COULEUR_ROUGE);
        header("Location: ./profil.php");
        exit();
    }
}

if (!Securite::estConnecte()) {
    header('Location:../index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">
    <link rel="stylesheet" href="../public/css/profil.css">

    <title>Profil</title>
</head>

<body>
    <?php require('header.php'); ?>
    <main>

        <section class="section_profil">
            <?php require_once(__DIR__ . '/gestion_erreur.php'); ?>
            <h2 data-aos="zoom-in-down" data-aos-duration="2000" data-aos-anchor-placement="top-center">Mon profil : </h2>
            <form action="profil.php" method="post" data-aos="zoom-out-up" data-aos-duration="2000" data-aos-anchor-placement="center">
                <label for="login"> Login </label>
                <input type="text" name="login" value="<?= $objet_user_info['login'] ?>" autocomplete="off">
                <label for="prenom"> Prenom </label>
                <input type="text" name="prenom" value="<?= $objet_user_info['prenom'] ?>" autocomplete="off">
                <label for="nom"> Nom </label>
                <input type="text" name="nom" value="<?= $objet_user_info['nom'] ?>" autocomplete="off">
                <button type="submit" name="submit">Modifier profil</button>
            </form>
            <form action="profil.php" method="post" data-aos="zoom-out-up" data-aos-duration="2500" data-aos-anchor-placement="center">
                <input type="password" name="password_ancien" value="" autocomplete="off" placeholder="Ancien mot de passe">
                <input type="password" name="password_nouveau" value="" autocomplete="off" placeholder="Nouveau mot de passe">
                <input type="password" name="password_confirmation" value="" autocomplete="off" placeholder="Confirmation mot de passe">
                <button type="submit" name="submit_modification_password">Modifier password</button>
            </form>
        </section>

    </main>
    <?php require('footer.php'); ?>
</body>

</html>