<?php
    if(!isset($_SERVER['REQUEST_METHOD']) || !is_string($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST')
    {
        header('Location: inscrition.php');
        exit;
    }

session_start();
unset($_SESSION['message']);


if ( isset($_POST['login']) && isset($_POST['pseudo']) && 
isset($_POST['mail']) && isset($_POST['mdp']) &&
isset($_POST['confirm']))
{
    $login = htmlentities($_POST['login']);
    $password = htmlentities($_POST['mdp']);
    $confirm = htmlentities($_POST['confirm']);
    $pseudo = htmlentities($_POST['pseudo']);
    $mail = htmlentities($_POST['mail']);

    if ( $password != $confirm )
    {
        $_SESSION['message'] = "Mot de passe et confirmation sont différents.";
        header('Location: inscription.php');
        exit;
    }

    // Fichier contenant les informations de connexion à la BDD
    require_once 'bdd.php';

    try
    {
        $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    }
    catch (PDOException $e)
    {
        $_SESSION['message'] = $e->getMessage();
        header('Location: inscription.php');
        exit;
    }

    // On essaye d'ajouter le nouvel utilisateur
    $p = $db->prepare('INSERT INTO Droit (Signification) values ("U")'); // cree une nouvelle ligne en mettant les droits à utilisateur par défaut;
    $ok1 = $p->execute();
    $p = $db->prepare('SELECT MAX(ID) FROM Droit'); //recupere la valeur de l'id de la ligne qu'on vient d'ajouter
    $p->execute();
    $donnees=$p->fetch();
    $id_droit = $donnees['ID'];

    $q = $db->prepare('INSERT INTO Utilisateur (Login, Mot_de_passe, Pseudo, Adresse_mail,ID_du_droit) values (:login, :password, :pseudo, :mail, :id_droit)');
    $q->bindValue(':login', $login, PDO::PARAM_STR);
    $q->bindValue(':password', password_hash($password,PASSWORD_DEFAULT), PDO::PARAM_STR);
    $q->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $q->bindValue(':mail', $mail, PDO::PARAM_STR);
    $q->bindValue(':id_droit', $id_droit, PDO::PARAM_STR);
    $ok2 = $q->execute();
    $reponse->closeCursor();

    // Si la requête a été exécutée avec succès
    if ( $ok1 && $ok2 )
    {
        $_SESSION['message'] = 'Félicitations '.$login. ', compte créé avec succès !<br>';
        $_SESSION['login'] = $login;
        header('Location:connexion.php');
    }
    else
    // Si la requête a échoué, c'est que le login existe déjà
    {
        $_SESSION['message'] = "Le login '". $login ."' existe déjà. Essayer de vous connectez.";
        header('Location : inscription.php');
    }

    header('Location: accueil.php');
    exit;
}

header('Location: contact.php');
exit;
?>