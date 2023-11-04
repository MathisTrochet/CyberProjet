<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>La securité  avant tout</title>
    <link rel="stylesheet" type = "text/css" href="../Style/Authent.css"> 
    <link rel="stylesheet" type = "text/css" href="../Style/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">
    
    <script src="../Js/fonctionDeBase.js"></script>
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
            <h2>INSCRIPTION SECURISE</h2>
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
        $MotDePasseHache = password_hash($MotDePasse, PASSWORD_DEFAULT);
                       
        
        $requete = $connexion->prepare("SELECT identifiant FROM infousers WHERE identifiant = :Identifiant");
        $requete->bindParam(':Identifiant', $Identifiant);      
        $requete->execute();

        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //echo "id : $IDStock";
        if (!$connexion) {
        die("Échec de la connexion : " . print_r($connexion->errorInfo(), true));
        }


        
        if ($requete !== false){
            if ($requete->rowCount() > 0){
                echo 'Nom d\'utilisateur déjà pris';
            }
            else {
                $requete2 = $connexion->prepare("INSERT INTO infousers (Nom, Prenom, Age, Identifiant, MotdePasse) VALUES (:Nom, :Prenom , :Age, :Identifiant, :MotDePasse)"); 
                $requete2->bindParam(':Nom', $Nom);
                $requete2->bindParam(':Prenom', $Prenom);
                $requete2->bindParam(':Age', $Age);
                $requete2->bindParam(':Identifiant', $Identifiant);
                $requete2->bindParam(':MotDePasse', $MotDePasseHache);
                $requete2->execute();
                
    
                if ($requete2){
                    echo 'Enregistrement réussi';
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

