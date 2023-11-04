<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>La securité  avant tout</title>
    <link rel="stylesheet" type = "text/css" href="../Style/Authent.css"> 
    <link rel="stylesheet" type = "text/css" href="../Style/header.css">
    <script src="../Js/fonctionDeBase.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">
    

</head>
<body>
    <header>
    <h1>MYPENTESTERLAB</h1>
    </header>

    <main>

        <ul>
            <a href = "connexion.php">
                <li> Connexion non securisée </li>
            </a>
            <a href = "inscription.php">
                <li> Inscription non securisée </li>
            </a>
            <a href = "connexionSec.php">
                <li> Connexion securisée </li>
            </a>
            <a href = "inscriptionSec.php">
                <li> Inscription securisée </li>
            </a>
        </ul>

        <form  action = "" method="post">
            <h2>CONNEXION</h2>
            <h3>Rentrez vos coordonnées ici :</h3>
            <br>
            <!-- 
            <div class="inputContainer">
                <label>Votre Nom </label>
                <input type = "text" name = "lastName">
            </div>
            <br>
            <div class="inputContainer">
                <label>Votre Prenom </label>
                <input type = "text" name = "firstName">
            </div>
            <br>
            <div class="inputContainer">
                <label>Votre Age </label>
                <input type = "text" name = "age">
            </div>
            <br> 
            -->
            <div class="inputContainer">
                <label>Votre identifiant </label>
                <input type = "text" name = "identifiant">
            </div>
            <br>
            <div class="inputContainer">
                <label>Votre Mot de passe </label>
                <input id = "mdp" type = "password" name = "motdepasse">
                <a href="javascript:void(0);" onmousedown="Show();" onmouseup="Hide();">
                    <img id = "monImage" src="../Image/iconeMdp.png" alt="iconemdp">
                </a>
            </div>

            <br><br>

            <input id = "save" type="submit" name = "Enregistrer" value="Enregistrer">

         </form>

    </main>



<?php

session_start();

if (!isset($_SESSION['$compteur'])){
    $_SESSION['$compteur'] = 0;
}

$serveur = "127.0.0.1";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "informationutilisateurs";

$compteur = $_SESSION['$compteur'];

// const MOTDEPASSE = 'azerty';

// Établir la connexion


    if (isset($_POST["Enregistrer"]))  {

        $connexion = new PDO ('mysql:host=' . $serveur . ';dbname=' . $baseDeDonnees,  $utilisateur, $motDePasse);

        //$Nom = $_POST["lastName"];
        //$Prenom = $_POST["firstName"];
        //$Age = $_POST["age"];
        $Identifiant = $_POST["identifiant"];
        $MotDePasse = $_POST["motdepasse"];
    
        
        
        $mdpCompare = "SELECT motdepasse FROM infousers WHERE identifiant = '$Identifiant' AND motdepasse = '$MotDePasse'";
        $resultat = $connexion->query($mdpCompare);
                //  Si on rentre commeutilisateur ->   user' OR '1'='1   
                // et comme mot de passe ->   password' OR '1'='1    la connexion est reussie
// cmd cmplt : SELECT motdepasse FROM infousers WHERE identifiant = ' user' OR '1'='1 ' AND motdepasse = ' password' OR '1'='1 '";

        if ($resultat){
            if ($resultat->rowCount() > 0) echo "Connexion réussie! <br> Veuillez effectuer une inscription sécurisée puis une connexion sécurisée pour accéder au reste du site.";
            else {
                echo "Nom d'utilisateur ou mot de passe incorrect. <br>";
                $compteur++;
                if ($compteur==3){
                    echo 'Pas encore des notres? Incrit toi ici :';
                    echo '<script> document.addEventListener("DOMContentLoaded", function(){ visibilityOn(); }) ; </script>';    
                $compteur=0;
                }
                
            }
        }
        else echo "Erreur SQL : " . $connexion->errorInfo()[2];

            //$sql = "INSERT INTO infousers (Nom, Prenom, Age, Mail, Mdp) VALUES ('$Nom', '$Prenom' , '$Age', '$Mail', '$Mdp')";
            
        //executer la requete    
    }
// Fermer la connexion à la base de données
$connexion = null;

$_SESSION['$compteur'] = $compteur;



?>




    <footer>
        <a href = inscription.php >
            <p id= "invisible">Inscription</p>
        </a>
    </footer>
</body>
</html>



