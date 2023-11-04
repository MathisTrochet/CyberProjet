<?php 
session_start();
if (isset($_SESSION['username'])) $_SESSION['ppAdress'] = "../FichierClient/" . $username;

if (!isset($_SESSION['ppAdress'])){
    $requete = $connexion->prepare("SELECT * FROM infousers WHERE identifiant = :identifiant");
    $requete->bindParam(':identifiant', $username);
    $requete->execute();
    $row = $requete->fetch(PDO::FETCH_ASSOC);
    if ($requete){
        if ($requete->rowCount() > 0){
            $_SESSION["ppAdress"] = 'FichierClient/' . $row['imageData'];
            echo $_SESSION["ppAdress"];
        }
    } 
}


?>

