<?php
session_start();

require_once(__DIR__ . '/../model/Register.php');
require_once(__DIR__ . '/../controller/Toolbox.php');
require_once(__DIR__ . '/../controller/Securite.php');


if (isset($_POST['inscription'])) {
    if (!empty($_POST['login']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['password']) && !empty($_POST['Cpassword'])) {
        if ($_POST['password'] == $_POST['Cpassword']) {
            Register::register_utilisateur($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['password']);
        } else {
            Toolbox::ajouterMessageAlerte("Mdp non identique", Toolbox::COULEUR_ROUGE);
        }
    } else {
        Toolbox::ajouterMessageAlerte("Remplir tous les champs.", Toolbox::COULEUR_ROUGE);
    }
}

if (Securite::estConnecte()) {
    header('Location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../public/css/form.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">

    <title>Inscription</title>
</head>

<body>
    <?php require('header.php'); ?>
    <main>

        <form action="" method="post">
            <?php require_once(__DIR__ . '/gestion_erreur.php'); ?>
            <label for="login">Login :</label>
            <input type="text" name="login" placeholder="Login" />
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" placeholder="Prenom" autocomplete="off">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" placeholder="Nom" autocomplete="off">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" placeholder="Mot de passe" />
            <label for="Cpassword">Confirmez le mot de passe :</label>
            <input type="password" name="Cpassword" placeholder="Confirmez le mot de passe" />
            <button type="submit" name="inscription">Creer un compte</button>
            <p class="message">Vous avez déjà un compte ? <br><a class="aa" href="connexion.php">Connectez vous</a></p>
        </form>

    </main>
    <?php require('footer.php'); ?>
</body>

</html>