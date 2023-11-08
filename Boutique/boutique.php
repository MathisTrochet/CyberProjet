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
        <h1>MYSHOP</h1>
        
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
        <h2>SHOP<h2>
    <a href="" onclick=""></a>

        <?php
            //if (!isset($_SESSION['idProduct']))
             $_SESSION['idProduct'] = 1; 
            $idProduct = $_SESSION['idProduct'];
            $requete = $connexion->prepare("SELECT * FROM products");
            $requete->bindParam(':id', $idProduct);
            $requete->execute();
            if ($requete){
                if ($requete->rowCount() > 0){
                    while ($row = $requete->fetch(PDO::FETCH_ASSOC)){
                        if ($row['nom'] && $row['prix'] && $row['vendeur'] && $row['description']){
                            
                            echo '<a href="produit.php?id=';
                            echo $idProduct . '">';
                            echo $row["nom"] . ", " . $row["prix"] . "€";
                            echo '</a>';
                            echo "<br>" . "vendu par : " . $row["vendeur"] . "<br>" . $row["description"] . "<br><br>";
                       }
                       $idProduct++;
                    }
                    
                    
                }
            } 
            $_SESSION['idProduct'] = $idProduct;
            
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
