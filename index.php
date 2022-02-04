<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Memory</title>
</head>
<body>
    <?php require 'view/header.php'?>
    <main>
        <?php var_dump($_SESSION)?>
    </main>
    <?php require 'view/footer.php'?>
</body>
</html>