<?php
require_once(__DIR__ . '/../controller/Card.php');
require_once(__DIR__ . '/../controller/Grille.php');
require_once(__DIR__ . '/../controller/Securite.php');
require_once(__DIR__ . '/../controller/Toolbox.php');
require_once(__DIR__ . '/../database/DB_connection.php');
require_once(__DIR__ . '/../controller/User.php');
require_once(__DIR__ . '/../controller/Score.php');
session_start();

if (!Securite::estConnecte()) {
    header('Location:../index.php');
}

if (isset($_SESSION['profil'])) {
    $id_session = $_SESSION['profil']['id'];
}

if (isset($_POST['top'])) {
    $pair = $_POST['top'];
    $score_top10 = $_SESSION['objet_score']->affiche_score_top10($pair);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../public/css/score.css" rel="stylesheet">
    <title>Table des scores</title>
</head>
<body>
    <?php require 'header.php'?>
    <main>
        <form method='POST' action=''>
            <fieldset>
                <legend>Classement par nombre de paires :</legend>
                <select name="top">
                    <option value="">Choisir vos nombres de paires</option>
                    <?php for ($i = 3; $i <= 12; $i++) {
                    ?>
                        <option value=<?= $i ?>><?= $i ?></option>
                    <?php } ?>
                </select>
                <button type='submit'>
                    Selectionner
                </button>
            </fieldset>
        </form>
        <?php if (isset($_POST['top'])) { ?>
            <section class="section_score">
                <table>
                    <caption>Wall of fame </caption>
                    <tr>
                        <th>Position</th>
                        <th>Pseudo</th>
                        <th>Nombre de pairs</th>
                        <th>Temps</th>
                    </tr>
                    <?php foreach ($score_top10 as $key => $value) { ?>
                        <tr>
                            <td>N° <?= $key + 1 ?></td>
                            <td><?= $value['login'] ?></td>
                            <td><?= $value['nombre_pair'] ?></td>
                            <td><?= $value['score'] ?>s</td>
                        </tr>
                    <?php } ?>
                </table>
            </section>
        <?php } ?>
    </main>
    <?php require 'footer.php'?>
</body>
</html>