<?php
session_start();
$serveur = "127.0.0.1";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "informationutilisateurs";


$connexion = new PDO ('mysql:host=' . $serveur . ';dbname=' . $baseDeDonnees,  $utilisateur, $motDePasse);

include('php/publicPage.php');

if (!isset($_SESSION['ppAdress'])){

    $requete = $connexion->prepare("SELECT * FROM infousers WHERE identifiant = :identifiant");
    $requete->bindParam(':identifiant', $username);
    $requete->execute();
    $row = $requete->fetch(PDO::FETCH_ASSOC);
    if ($requete){
        if ($requete->rowCount() > 0){
            if ($row['imageData']){
                $_SESSION["ppAdress"] = '/CyberProjet/FichierClient/' . $row['imageData'];
            }
            
        }
    } 
}  




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>La securité  avant tout</title>
    <link rel="stylesheet" type = "text/css" href="Style/index.css"> 
    <link rel="stylesheet" type = "text/css" href="Style/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <script src="Js/fonctionDeBase.js"></script>
    <script src="Js/phpCall.js"></script>

</head>
<body>
    <header>
        <h1>MYPENTESTERLAB</h1>
        
        <div class='profile'>
            <a class = "pitt" href="/CyberProjet/userProfile.php">                                      <!-- HEADER > PROFILE  -->
                
                <img id= "imgProfil" src="<?php if (isset($_SESSION['ppAdress'])) echo $_SESSION['ppAdress']; else echo "/CyberProjet/Image/profil.png"; ?>">
            <?php 
                    echo "<span style='color : grey;'>" . $username . "</span>"; 
            ?>
            </a>
            
        </div>

        <div class='home'>                                                                                  <!-- HEADER > HOME -->
            <a class = "pitthomme" href="/CyberProjet/index.php">
                <img id= "imgProfil" src="/CyberProjet/Image/house.png"> 
                <?php echo "<span style='color : grey;'>" . "Home" . "</span>"; ?>          
            </a>
            
        </div>

        <input class = "pittBottom" type="button" value="Deconnexion" name="deco" onclick="deconnexion()">
        
        
    </header>

    <main>
        <h2>Bienvenue</h2>
    

    <br><br><br><br><br><br><br>
    <p>On est pas bien là?</p>
    <br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br>
    </main>
    <footer>
        <a href="/CyberProjet/Commentaire/commentaire.php">
            <p>Cliquez ici pour ajouter un commentaire à ce site</p>
        </a>
    </footer>
        
</body>
</html>
