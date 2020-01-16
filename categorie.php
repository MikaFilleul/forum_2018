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

$categorie = $db->prepare('SELECT Intitule FROM Categorie');
$ok = $categorie->execute();

if(!$ok){
    unsset($categorie);
}
?>