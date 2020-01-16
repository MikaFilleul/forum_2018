<?php
    session_start();

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

    $p = $db->prepare('SELECT * FROM Utilisateur WHERE Login = :login');
    $p->bindValue(':login', $_SESSION['login'], PDO::PARAM_STR);
    $ok = $p->execute();


    $id_droit = $test->fetch();
    echo '<p>' .$i

 $reponse->closeCursor();
?>

