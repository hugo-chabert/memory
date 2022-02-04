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
    <title>Memory</title>
</head>
<body>
    <?php require 'view/header-index.php'?>
    <main>
        <?php var_dump($_SESSION)?>
    </main>
    <?php require 'view/footer-index.php'?>
</body>
</html>