<?php
session_start();

include('php/publicPage.php');

$serveur = "127.0.0.1";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "informationutilisateurs";


$connexion = new PDO ('mysql:host=' . $serveur . ';dbname=' . $baseDeDonnees,  $utilisateur, $motDePasse);
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (!isset($_SESSION['ppAdress'])){

    $requete = $connexion->prepare("SELECT * FROM infousers WHERE identifiant = :identifiant");
    $requete->bindParam(':identifiant', $username);
    $requete->execute();
    $row = $requete->fetch(PDO::FETCH_ASSOC);
    if ($requete){
        if ($requete->rowCount() > 0){
            if ($row['imageData']){
                $_SESSION["ppAdress"] = $row['imageData'];
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
    <link rel="stylesheet" type = "text/css" href="Style/admin.css"> 
    <link rel="stylesheet" type = "text/css" href="Style/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <script src="Js/fonctionDeBase.js"></script>
    <script src="Js/phpCall.js"></script>

</head>
<body>
    <header>
        <h1>MYADMIN</h1>
        
        <div class='profile'>
            <a class = "pitt" href="/CyberProjet/admin.php">                                      <!-- HEADER > PROFILE  -->
                
                <img id= "imgProfil" src="<?php if (isset($_SESSION['ppAdress'])) echo "/CyberProjet/" . $_SESSION['ppAdress']; else echo "/CyberProjet/Image/profil.png"; ?>">
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
        <ul>
            <a href = #gestion-util>
                <li>  Gestion utilisateurs </li>
            </a>
            <a href = #gestion-pages>
                <li> Gestion de pages </li>
            </a>
            <a href = #gestion-site>
                <li> Gestion du site </li>
            </a>
            <a href = #gestion-boutique>
                <li> Gestion de la boutique  </li>
            </a>
        </ul>
        <h2 id="gestion-util">Gestion utilisateurs</h2>
        <h2 id="gestion-pages">Gestion de pages</h2>
        <h2 id="gestion-site"> Gestion du site</h2>
        <h2 id="gestion-boutique">Gestion de la boutique</h2>
        <p>Ajouter un produit</p> 
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="send">Importer l'image </label>
            <input type="file" name= "fichier" value="Parcourir">
            <input type="submit" name= "enregistrer" value="enregistrer">
        </form>
        <?php 

        if (isset($_POST['enregistrer'])){
            if (isset($_FILES['fichier']) && $_FILES["fichier"]["error"] == UPLOAD_ERR_OK){
                $imageName = $_FILES["fichier"]["name"];
                $imagetemp = $_FILES["fichier"]["tmp_name"]; // Remplacez par le chemin de votre image
                 

                if (file_exists($imagetemp)) {
                    $imageData = file_get_contents($imagetemp);
                    //echo $imageData;
                    // Connexion à la base de données (à adapter en fonction de votre configuration)

                    // Préparez la requête d'insertion
                    $requete = $connexion->prepare("UPDATE products SET imageNom = :imageNom, imageData = :imageData WHERE id = 2");

                    // Liez les données
                    $requete->bindParam(':imageData', $imageData, PDO::PARAM_LOB);
                    $requete->bindParam(':imageNom', $imageName);
                    

                    // Exécutez la requête
                    if ($requete->execute()) {
                        echo "L'image a été stockée avec succès dans la base de données.";
                    } else {
                        echo "Une erreur s'est produite lors de l'insertion de l'image.";
                    }
                } else {
                    echo "Le fichier d'image n'existe pas.";
                }
            } else echo 'pas de fichier';
        }
        else echo "pas bouton enregistrer";
        
        
            $connexion = null;  
        ?>
    

    <br><br><br><br><br><br><br>
    <p>On est pas bien là?</p>
    <br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br>
    </main>
    <footer>
        <a href="/CyberProjet/Commentaire/commentaire.php">
            <p>Cliquez ici pour ajouter un commentaire à ce site</p>
        </a>
        <a href="/CyberProjet/Boutique/boutique.php">
            <p>Cliquez ici pour commander des produits de notre boutique certifié qualité </p>
        </a>
    </footer>
        
</body>
</html>
