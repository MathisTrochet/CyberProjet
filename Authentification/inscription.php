<?php
session_start();
?>

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
        <input class = "pittBottom" type="button" value="Deconnexion" name="deco" onclick="indexDeconnexion()">
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
            <h2>INSCRIPTION</h2>
            <h3>Rentrez vos coordonnées ici :</h3>
            <br>
             
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

    <footer>
    </footer>
</body>
</html>

<?php

$serveur = "127.0.0.1";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "informationutilisateurs";

// const MOTDEPASSE = 'azerty';

// Établir la connexion


    if (isset($_POST["Enregistrer"]))  {

        $connexion = new PDO ('mysql:host=' . $serveur . ';dbname=' . $baseDeDonnees,  $utilisateur, $motDePasse);

        $Nom = $_POST["lastName"];
        $Prenom = $_POST["firstName"];
        $Age = $_POST["age"];
        $Identifiant = $_POST["identifiant"];
        $MotDePasse = $_POST["motdepasse"];
    
                       
        
        $IDStock = "SELECT identifiant FROM infousers WHERE identifiant = '$Identifiant'";      
        $res1 = $connexion->query($IDStock);

        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //echo "id : $IDStock";
        if (!$connexion) {
        die("Échec de la connexion : " . print_r($connexion->errorInfo(), true));
        }


        
        if ($res1 !== false){
            if ($res1->rowCount() > 0){
                echo 'Nom d\'utilisateur déjà pris';
            }
            else {
                $sql = "INSERT INTO infousers (Nom, Prenom, Age, Identifiant, MotdePasse) VALUES ('$Nom', '$Prenom' , '$Age', '$Identifiant', '$MotDePasse')";
                $res2 = $connexion->query($sql);
    
                if ($res2){
                    echo 'Mission reussie';
                }
                else {
                    echo "Erreur SQL : " . $connexion->errorInfo()[2];
                }
            }
        }
        else echo 'erreur requete ID';
        
        

        
        
        //else echo "Erreur SQL : " . $connexion->errorInfo()[2];

            
        //executer la requete    
    }
// Fermer la connexion à la base de données
$connexion = null;
?>

