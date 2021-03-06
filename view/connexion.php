<?php

require_once(__DIR__ . '/../model/Register.php');
require_once(__DIR__ . '/../controller/Toolbox.php');
require_once(__DIR__ . '/../controller/Securite.php');

session_start();

if (isset($_POST['connexion'])) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        Register::connexion($_POST['login'], $_POST['password']);
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

    <title>Connexion</title>
</head>

<body>
    <?php require('header.php'); ?>
    <main>
        <div class="container">
            <form action="" method="post">
                <fieldset>
                    <legend>Connectez-vous juste ici</legend>
                    <?php require_once(__DIR__ . '/gestion_erreur.php'); ?>

                    <label>Login :</label>
                    <input type="text" name="login" placeholder="login" autocomplete="off">

                    <label>Mot de passe :</label>
                    <input type="password" name="password" placeholder="Mot de passe" />
                </fieldset>
                    <button type="submit" name="connexion">Connexion</button>

                    <p class="message">Vous n'avez pas de compte? <br><a class="aa" href="inscription.php">Creez un compte</a></p>
                
            </form>
        </div>
    </main>
    <?php require('footer.php'); ?>
</body>

</html>