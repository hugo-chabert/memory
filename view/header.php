<link rel="stylesheet" href="../public/css/header.css">
<link rel="stylesheet" href="../public/css/root&font.css">
<header>
    <nav>
        <div class="logo">
            <a href="./index.php"><img src=""></a>
        </div>
        <div class="menu">
            <ul class='ul-menu-1'>
                <li> <a href="./index.php">Home</a> </li>
                <li> <a href="memory.php">Memory</a> </li>
                <?php if (isset($_SESSION['user'])) { ?>
                <li> <a href="profil.php">Profil</a> </li>
            </ul>
            <ul class="ul-menu-spe">
                <?php if (isset($_SESSION['user']['id_droits'])) { ?>
                <li> <a href="admin.php">Admin</a> </li>
                <?php } ?>
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