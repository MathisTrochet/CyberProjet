<?php
session_start();


//page private (on doit être connecté pour acceder a la page), donc :
include('../php/privatePage.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>La securité avant tout</title>
    <link rel="stylesheet" type = "text/css" href="../Style/header.css"> 
    <link rel="stylesheet" type = "text/css" href="../Style/commentaire.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <script src="../Js/fonctionDeBase.js"></script>
    <script src="../Js/phpCall.js"></script>

</head>
<body>
    <header>
        <h1>PAGE DISCUSSION</h1>
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

<?php

$serveur = "127.0.0.1";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "informationutilisateurs";





$connexion = new PDO ('mysql:host=' . $serveur . ';dbname=' . $baseDeDonnees,  $utilisateur, $motDePasse);


//declaration des variables sauf le texte


// idCommentMax 

if (!isset($_SESSION["id_comment"])){
    $requete= $connexion->prepare("SELECT MAX(idComment) FROM comments");
    //$idCommentMax->bindParam(':idComment', $idCommentMax);
    $requete->execute();
    $idCommentMax= $requete->fetchColumn(0);
    if ($idCommentMax!=0){
        $_SESSION["id_comment"] = $idCommentMax;
    }
    else {
    $_SESSION["id_comment"] = 0;
    }
} 
//echo "l id existe déjà ";

$idComment = $_SESSION["id_comment"] ;
$type = gettype($idComment);


//DATE
$currentDate = date("Y-m-d H:i:s"); // "d" pour le jour, "F" pour le mois, "Y" pour l'année


$requete= $connexion->prepare("SELECT * FROM comments WHERE isPublished = '0' ORDER BY idComment ASC");
//$requete->bindParam(':idComment', $idComment);
$requete->execute();

if ($requete->rowCount()>0){    //alors afficher tous les messages
?>
   
   <div id='bulle'>

<?php
    while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
        // Traiter chaque ligne de résultat
        //echo $row['idComment'];
        echo '<span style="font-style:italic;">' . $row['username'] . '</span>' . ' : ' . $row['content'] . '<br>' ;
    }
}
?>

    </div>  

    <main>
        <form action="" method="post">
            <label>Votre commentaire :</label>
            <input type="text"  name="commentInput">
            <input  type="submit" name="envoyer" value = "Envoyer">
        </form>
    </main>
    

<?php


//ecrire un commentaire

if (isset($_POST["envoyer"])){
    if (!empty($_POST["commentInput"])){

        $idComment ++;

        $content = $_POST["commentInput"];

        $isPublished = 0;


        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $requete = $connexion->prepare("INSERT INTO comments (idComment, username, content, currentDate, isPublished) VALUES (:idComment, :username, :content, :currentDate, :isPublished)");
        $requete->bindParam(':idComment', $idComment);
        $requete->bindParam(':username', $username);
        $requete->bindParam(':content', $content);
        $requete->bindParam(':currentDate', $currentDate);
        $requete->bindParam(':isPublished', $isPublished);
        $requete->execute();
        

                //echo "id : $IDStock";
                if (!$connexion) {
                die("Échec de la connexion : " . print_r($connexion->errorInfo(), true));
                }

        if ($requete){
            echo'Commentaire posté';
            $_SESSION["id_comment"] = $idComment;
            $connexion = null;
            header('location:commentaire.php');
        }
        else echo'commentaire non posté';
    }
    else echo 'Commentaire vide veuillez rentrer une valeur';
}

$_SESSION["id_comment"] = $idComment;

$connexion = null;

?>
    
</body>
        
</body>
</html>