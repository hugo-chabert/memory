<?php
require_once(__DIR__ . '/../controller/Card.php');
require_once(__DIR__ . '/../controller/Grille.php');
require_once(__DIR__ . '/../controller/Toolbox.php');
require_once(__DIR__ . '/../controller/Securite.php');
require_once(__DIR__ . '/../controller/User.php');
require_once(__DIR__ . '/../database/DB_connection.php');
session_start();


if (!isset($_SESSION['grille']) && isset($_POST['paires'])) {
    $paires = $_POST['paires'];
    $grille_jeu = new Grille($paires);
    $grille_jeu->melange_cartes_grille();
    $_SESSION['grille_jeu'] = $grille_jeu;
}

if (isset($_POST['relancer_jeu'])) {

    $grille_jeu = new Grille($_POST['relancer_jeu']);
    $grille_melanger = $grille_jeu->reset_session_jeu();
}

if (isset($_POST['submit'])) {

    $test = $_SESSION['grille'][$_POST['position']]->verifier_couple_carte($_SESSION['grille'][$_POST['position']], $_POST['position']);
}

if (isset($_SESSION['grille'])) {
    $_SESSION['grille_jeu']->victoire();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../public/css/temp.css" rel="stylesheet">
    <title>Memory</title>
</head>
<body>
    <?php require('header.php'); ?>
    <main>
        <?php if(!isset($_SESSION['grille'])){?>
        <form action="" method="post">
            <label for="paires">Choisissez le nombre de paires:</label>
            <select name="paires" id="paires">
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <button type="submit" value="submit">Choisir</button>
        </form>
        <?php } ?>
    <?php if (isset($_SESSION['grille'])) { ?>
            <form method='POST' action=''>
                <button type='submit' name='relancer_jeu'>
                    Reinitialiser memory
                </button>
            </form>
        <?php
        }

    if (isset($_SESSION['grille'])) {

        foreach ($_SESSION['grille'] as $key => $value) {

            if ($value->card_status === 1) { ?>
                <form method='post' action=''>
                    <input type="hidden" name="position" value="<?= $key ?>" />
                    <input type="hidden" name="card_id" value="<?= $value->card_id ?>" />
                    <input type="hidden" name="card_status" value="<?= $value->card_status ?>" />
                    <input type="hidden" name="card_face" value="<?= $value->card_face ?>" />
                    <button type='submit' name="submit">
                        <div class="cards cardBack"></div>
                    </button>
                </form>
            <?php }
            elseif ($value->card_status === 0) { ?>
                <div class="cards card<?= $value->card_face ?>"></div>
            <?php }
        }
        if (isset($_SESSION['refresh']) && $_SESSION['refresh'] == 1) {
            $_SESSION['grille'][$_POST['position']]->position_initial_deux_cartesv2($_SESSION['verif']);
            $_SESSION['refresh'] = 0;
            unset($_SESSION['verif']);
        }
    }
    if (isset($_SESSION['victoire']) && isset($_SESSION['chrono_debut_jeu'])) {
        ?>

            <div id="victoire">
                <p><?php $_SESSION['grille_jeu']->temps_realise_victoire() ?> </p>
            </div>
        <?php }
    ?>
    </main>
    <?php require('footer.php'); ?>
</body>
</html>