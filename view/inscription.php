<?php

require_once(__DIR__ . '/../model/Register.php');
require_once(__DIR__ . '/../controller/Toolbox.php');
require_once(__DIR__ . '/../controller/Securite.php');

session_start();

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
    <link rel="stylesheet" href="../public/css/form.css" >
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/footer.css">
    <link rel="stylesheet" href="../public/css/root&font.css">

    <title>Inscription</title>
</head>

<body>
    <?php require('header.php'); ?>
    <main>
        <div class="container">
            <form action="" method="post">
                <?php require_once(__DIR__ . '/gestion_erreur.php'); ?>

                <fieldset>

                    <legend>Saisir toutes vos informations</legend>

                    <label for ="login">Login :</label>
                    <input id="login" type="text" name="login" placeholder="Login" />

                    <label for ="prenom">Prénom :</label>
                    <input id="prenom" type="text" name="prenom" placeholder="Prenom" autocomplete="off">

                    <label for ="nom">Nom :</label>
                    <input id="nom" type="text" name="nom" placeholder="Nom" autocomplete="off">

                    <label for ="password">  Mot de passe :</label>
                    <input id="password" type="password" name="password" placeholder="Mot de passe" />

                    <label for ="conf-password">Confirmez le mot de passe :</label>
                    <input id="conf-password" type="password" name="Cpassword" placeholder="Confirmez le mot de passe" />

                </fieldset>
                <button type="submit" name="inscription">Creer un compte</button>

                <p class="message">Vous avez déjà un compte ? <br><a class="aa" href="connexion.php">Connectez vous</a></p>
            </form>
        </div>
    </main>
    <?php require('footer.php'); ?>
</body>

</html>