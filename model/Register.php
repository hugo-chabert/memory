<?php
require_once(__DIR__ . '/../database/DB_connection.php');
require_once(__DIR__ . '/../controller/Toolbox.php');
require_once(__DIR__ . '/../controller/Securite.php');

class Register
{

    public static function connexion($login, $password)
    {   //secure les post d'injection sql ou script
        $password_secure = Securite::secureHTML($password);

        //verification login déjà existent
        if (Register::info_user_login($login) == true) {
            //requete SQL
            $resultat = Register::info_user_login($login);
            if (password_verify($password_secure, $resultat['password'])) {
                $_SESSION['user']['id'] = $resultat['id'];
                $_SESSION['user']['login'] = $resultat['login'];
                Toolbox::ajouterMessageAlerte("Connexion faite.", Toolbox::COULEUR_VERTE);
                header("Location: ../index.php");
                exit();
            } else {
                Toolbox::ajouterMessageAlerte("Mdp incorrect.", Toolbox::COULEUR_ROUGE);
                header("Location: ./connexion.php");
                exit();
            }
        } elseif (Register::info_user_login($login) == false) {
            Toolbox::ajouterMessageAlerte("Login incorrect.", Toolbox::COULEUR_ROUGE);
            header("Location: ./connexion.php");
            exit();
        }
    }

    public static function register_utilisateur($login, $prenom, $nom, $password)
    {
        //secure les post d'injection sql ou script
        $login_secure = Securite::secureHTML($login);
        $prenom_secure = Securite::secureHTML($prenom);
        $nom_secure = Securite::secureHTML($nom);
        $password_secure = Securite::secureHTML($password);

        if (Register::info_user($login_secure) == false) {
            //Hash password
            $password_hash = password_hash($password_secure, PASSWORD_BCRYPT);

            $req = "INSERT INTO utilisateurs (login, prenom, nom, password) VALUES (:login, :prenom, :nom, :password )";
            $stmt = Database::connect_db()->prepare($req);
            $stmt->execute(array(
                ":login" => $login_secure,
                ":prenom" => $prenom_secure,
                ":nom" => $nom_secure,
                ":password" => $password_hash
            ));
            Toolbox::ajouterMessageAlerte("Le compte est créé!", Toolbox::COULEUR_VERTE);
            header("Location: ../index.php");
            exit();
        }
        if (Register::info_user($login_secure) == true) {
            Toolbox::ajouterMessageAlerte("Login est déjà utilisé !", Toolbox::COULEUR_ROUGE);
            header("Location: ./inscription.php");
            exit();
        }
    }

    public static function info_user($login)
    {
        //secure les post d'injection sql ou script
        $login_secure = Securite::secureHTML($login);

        //requete sql
        $req = "SELECT * FROM utilisateurs WHERE login = :login";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":login" => $login_secure
        ));
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public static function info_user_login($login)
    {

        //requete sql
        $req = "SELECT * FROM utilisateurs WHERE login = :login";
        $stmt = Database::connect_db()->prepare($req);
        $stmt->execute(array(
            ":login" => $login
        ));
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
}