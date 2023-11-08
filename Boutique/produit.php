<?php
session_start();

include('../php/publicPage.php');

$serveur = "127.0.0.1";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "informationutilisateurs";


$connexion = new PDO ('mysql:host=' . $serveur . ';dbname=' . $baseDeDonnees,  $utilisateur, $motDePasse);



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


if (isset($_GET['id'])) {
    $idProduct = $_GET['id'];
} else {
    // Gérer le cas où l'ID n'est pas présent dans l'URL.
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>La securité  avant tout</title>
    <link rel="stylesheet" type = "text/css" href="../Style/boutique.css"> 
    <link rel="stylesheet" type = "text/css" href="../Style/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <script src="../Js/fonctionDeBase.js"></script>
    <script src="../Js/phpCall.js"></script>

</head>
<body>
    <header>
        <h1>MYPRODUCT</h1>
        
        <div class='profile'>
            <a class = "pitt" href="/CyberProjet/userProfile.php">                                      <!-- HEADER > PROFILE  -->
                
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
        <h2>Page Produit</h2>


        <?php
            //if (!isset($_SESSION['idProduct'])){ $_SESSION['idProduct'] = 1; }
            $requete = $connexion->prepare("SELECT * FROM products WHERE id = :idProduct");
            $requete->bindParam(':idProduct', $idProduct);
            $requete->execute();
            $row = $requete->fetch(PDO::FETCH_ASSOC);
            if ($requete){
                if ($requete->rowCount() > 0){
                        if ($row['nom'] && $row['prix'] && $row['vendeur'] && $row['description']){
                            
                            echo $row["nom"] . ", " . $row["prix"] . "€";
                            echo "<br>" . "vendu par : " . $row["vendeur"] . "<br>" . $row["description"] . "<br>";
                            echo "quantité restante : " . $row["nbStock"] . "<br>" ;
                       }
                       
                }
                    
                    
            }
            
            
        ?>
    

    <br><br><br><br><br><br><br>
    <p>On est pas bien là?</p>
    <br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br>
    </main>
    <footer>
    </footer>
        
</body>
</html>