<?php

require_once(__DIR__ . '/controller/User.php');

session_start();

if (isset($_SESSION['user'])) {
    $id_session = $_SESSION['user']['id'];
    $_SESSION['objet_utilisateur'] = new User($id_session);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <link rel="stylesheet" href="public/css/index.css">
    <link rel="stylesheet" href="public/css/root&font.css">
    <title>Memory</title>
</head>
<body>
    <?php require 'view/header-index.php'?>
    <main>
        <h1 class="block-effect" style="--td: 1.2s">
            <div class="block-reveal" style="--bc: var(--HoverVar-); --d: .1s">Welcome</div>
            <div class="block-reveal" style="--bc: var(--BaseVar-); --d: .5s">To <a href="view/jeu.php">Memory</a> </div>
            <?php if (isset($_SESSION['user'])){ ?>
                <div class="block-reveal" style="--bc: var(--HoverVar-); --d: .9s">
                <?php echo $_SESSION['user']['login'];}?> </div>
        </h1>
    </main>
    <?php require 'view/footer-index.php'?>
</body>
</html>