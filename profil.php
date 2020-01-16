<?php
    if($_SESSION['login'] !== null){
        session_start();

        require_once 'bdd.php';
        try
        {
            $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        }
        catch (PDOException $e)
        {
            $_SESSION['message'] = $e->getMessage();
            header('Location: accueil.php');
            exit;
        }

        $p = $db->prepare('SELECT * FROM Utilisateur WHERE Login = :login');
        $p->bindValue(':login', $_SESSION['login'], PDO::PARAM_STR);
        $ok = $p->execute();

        if(!$ok){
            $_SESSION['message'] = "Probleme avec votre login";
            header('Location:connexion.php');
            exit;
        }

        include("header.php");
        include("cote.php");
        include("footer.php");
?>

<!DOCTYPE html>
<html>
        <p>Login : <?php echo $_SESSION['login']; ?> </p>
        <p>Pseudo : <?php echo $p->fetch['Pseudo']; ?> </p>
        <p>Mail : <?php echo $p->fetch['Mail']; ?> </p>
</html>

<?php        
    }
    else{
        header('Location : accueil.php');
    }
?>