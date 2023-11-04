<?php
session_start();
echo $_SESSION['ppAdress']
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
</head>
<body>
    <header>
        <h1>PAGE DISCUSSION</h1>
        <a class = "pitt" href="../Authentification/userProfile.php">
                <img id= "imgProfil"src="<?php echo $_SESSION['ppAdress'] ?>">
            <?php 
                    if (isset($_SESSION['username'])) {$username = $_SESSION['username']; echo "<span style='color : grey;'>" . $username . "</span>"; }
                    else {header('Location:/Authentification/connexionSEC.php');exit;}
            ?>
            </a>
            
        </div>

        <div class='home'>
            <a class = "pitthomme" href="../index.php">
                <img id= "imgProfil" src="../Image/house.png"> 
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

// on verifie qu'on est bien Connecté ET on recup >username<
if (isset($_SESSION["username"])){
    $username = ($_SESSION["username"]);
    //echo 'salut je suis ' . $username;
    }
else header("location:../Authentification/connexionSEC.php"); // si non connecté ca degage

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