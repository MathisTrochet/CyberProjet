<?php
$serveur = "127.0.0.1";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "informationutilisateurs";

// Établir la connexion
$connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST")  {
    $Nom = $_POST["lastName"];
    $Prenom = $_POST["firstName"];
    $Age = $_POST["age"];
    $Mail = $_POST["mail"];
    $Mdp = $_POST["mdp"];
}

// Requête SQL d'insertion
$sql = "INSERT INTO infoUsers (Nom, Prenom, Age, Mail, Mdp) VALUES ('$Nom', '$Prenom', '$Age', '$Mail', '$Mdp')";

// Exécuter la requête
if ($connexion->query($sql) === TRUE) {
    echo "Enregistrement réussi.";
} else {
    echo "Erreur : " . $sql . "<br>" . $connexion->error;
}

// Fermer la connexion à la base de données
$connexion->close();
?>



<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="0.1;url=http://127.0.0.1/CyberProjet/index.html">
</head>
</html>
