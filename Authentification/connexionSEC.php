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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet"> 
    <script src="../Js/fonctionDeBase.js"></script>
</head>
<body>
    <header>
        <h1>MYPENTESTERLAB</h1>
        <div class='home'>                                                                                  <!-- HEADER > HOME -->
            <a class = "pitthomme" href="/CyberProjet/index.php">
                <img id= "imgProfil" src="/CyberProjet/Image/house.png"> 
                <?php echo "<span style='color : grey;'>" . "Home" . "</span>"; ?>          
            </a>
                
        </div>
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
            <h2>CONNEXION SECURISE</h2>
            <h3>Rentrez vos coordonnées ici :</h3>
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

            <input id = "save" type="submit" name="enregistrer" value="Enregistrer">
            
         </form>

    </main>



<?php

if (isset($_SESSION["username"])) {
    $Identifiant = $_SESSION["username"]; 
    echo "Etat : connecté" . $Identifiant;
    header('location:../index.php');
} 
else echo "Etat : déconnecté";



$serveur = "127.0.0.1";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "informationutilisateurs";



// Établir la connexion


    if (isset($_POST["enregistrer"]))  {
        $connexion = new PDO ('mysql:host=' . $serveur . ';dbname=' . $baseDeDonnees,  $utilisateur, $motDePasse);

        $Identifiant = $_POST["identifiant"];
        $MotDePasse = $_POST["motdepasse"];
        
        
        //$requete = $connexion->prepare("SELECT motdepasse FROM infousers WHERE identifiant = :Identifiant AND motdepasse = :MotDePasse");
        $requete = $connexion->prepare("SELECT motdepasse FROM infousers WHERE identifiant = :Identifiant");

        $requete->bindParam(':Identifiant', $Identifiant);
        $requete->execute();
        $DataMDP = $requete->fetchColumn();
        

        if ($DataMDP){
                echo "un mot de passe trouvé";
                if (password_verify($MotDePasse, $DataMDP)) {
                    echo "Connexion réussie";
                    $_SESSION['username'] = $Identifiant;   // <-
                    //$_SESSION["temp"] = "../Image/profil.png";
                    header("Location:../index.php");
                    exit();

                }
                else { 
                    echo "<span style='color: red;' >Nom d'utilisateur ou mot de passe incorrect!</style>"; }
            }
            else {
            echo "Nom d'utilisateur ou mot de passe incorrect.<br>";
            }            
    }

// Fermer la connexion à la base de données
$connexion = null;



?>




    
</body>
</html>



