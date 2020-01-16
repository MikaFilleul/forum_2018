<?php

    if(!isset($_SERVER['REQUEST_METHOD']) || !is_string($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST')
    {
        header('Location: connexion.php');
        exit;
    }

    session_start();
    unset($_SESSION['message']);

    require_once 'bdd.php';

    try
    {
        $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    }
    catch (PDOException $e)
    {
        $_SESSION['message'] = $e->getMessage();
        header('Location: connexion.php');
        exit;
    }

    if(isset($_POST['login'], $_POST['mdp']) && is_string($_POST['login']) && is_string($_POST['mdp']))
    {
        $identifiant = htmlentities($_POST['login']);
        $password = htmlentities($_POST['mdp']);

        $q = $db->prepare('SELECT Mot_de_passe FROM Utilisateur WHERE Login =:login');
        $q->bindValue(':login', $identifiant, PDO::PARAM_STR);
        $ok = $q->execute();
        $reponse->closeCursor();

        if($ok){
            $pwd = $q->fetch()['Mot_de_passe'];

            if(!password_verify($password, $pwd)){
                $_SESSION['message'] = "Le mot de passe est incorrect";
                header('Location: connexion.php'); 
                exit;
            }
            else{
                $_SESSION['login'] = $identifiant;
                header('Location:accueil.php');
                exit;
            }



        }
        else{
            $_SESSION['message'] = "Le login est incorrect";
            header('Location: connexion.php');        
            exit;    
        }
    }
    else{
        header('Location: connexion.php');        
        exit;     
    }
    

?>
