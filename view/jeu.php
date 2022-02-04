<?php

session_start();

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
    <form action="">
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
        <input type="submit" value="Submit">
    </form>
    </main>
    <?php require('footer.php'); ?>
</body>
</html>