<link rel="stylesheet" href="../public/css/header.css">
<link rel="stylesheet" href="../public/css/root&font.css">
<header>
    <nav>
        <div class="logo">
            <a href="../index.php"><img src="https://img.icons8.com/external-glyph-geotatah/64/ffffff/external-brain-alzheimers-disease-symbol-glyph-glyph-geotatah-3.png" width="50px"></a>
        </div>
        <div class="menu">
            <ul class='ul-menu-1'>
                <li> <a href="../index.php">Home</a> </li>
                <li> <a href="jeu.php">Memory</a> </li>
                <li> <a href="score.php">Table des scores</a> </li>
                <?php if (isset($_SESSION['user'])) { ?>
                <li> <a href="profil.php">Profil</a> </li>
            </ul>
            <ul class="ul-menu-spe">
                <li> <a href="deconnexion.php">Deconnexion</a> </li>
                <?php  } ?>
            </ul>
            <?php
            if (!isset($_SESSION['user'])) { ?>
                <ul class="ul-menu-2">
                    <li> <a href="connexion.php">Connexion</a> </li>
                    <li> <a href="inscription.php">Inscription</a> </li>
                </ul>
            <?php } ?>
        </div>
    </nav>
</header>