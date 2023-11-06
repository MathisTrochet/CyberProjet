
<?php

//probleme actuel : le fichier image importé est déplacé a la destination FichierClient avant confirmation,
//                          la variable de session ppAdress a toujours la même destination peut importe la nouvelle image 
//                      donc la page affiche la var de session qui est la meme destination qu'où se trouve la nouvelle image importée


session_start();

include('php/privatePage.php');

$serveur = "127.0.0.1";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "informationutilisateurs";


$connexion = new PDO ('mysql:host=' . $serveur . ';dbname=' . $baseDeDonnees,  $utilisateur, $motDePasse);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>La securité  avant tout</title>
    <link rel="stylesheet" type = "text/css" href="Style/userProfile.css"> 
    <link rel="stylesheet" type = "text/css" href="Style/header.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <script src="Js/fonctionDeBase.js"></script>
    <script src="Js/phpCall.js"></script>
</head>
<body>
    <header>
    <h1>PAGE DISCUSSION</h1>
        <div class='profile'>
            <a class = "pitt" href="userProfile.php">                                      <!-- HEADER > PROFILE  -->
                
                <img id= "imgProfil" src="<?php if (isset($_SESSION['ppAdress'])) echo $_SESSION['ppAdress']; else echo "/CyberProjet/Image/profil.png"; ?>">
            <?php 
                    echo "<span style='color : grey;'>" . $username . "</span>"; 
            ?>
            </a>
            
        </div>

        <div class='home'>                                                                                  <!-- HEADER > HOME -->
            <a class = "pitthomme" href="index.php">
                <img id= "imgProfil" src="Image/house.png"> 
                <?php echo "<span style='color : grey;'>" . "Home" . "</span>"; ?>          
            </a>
            
        </div>
        <input class = "pittBottom" type="button" value="Deconnexion" name="deco" onclick="deconnexion()">
        
    </header>

    <main>
    <br>
    <br>
    <div id="contenant"> 
        <div id ="contenu">
            <h3>Vos informations :</h3>
                <br>
                
                <div class="inputContainer">
                    <label>Nom </label>
                    <?php 
                        $requete = $connexion->prepare("SELECT * FROM infousers WHERE identifiant = :identifiant");
                        $requete->bindParam(':identifiant', $username);
                        $requete->execute();
                        $row = $requete->fetch(PDO::FETCH_ASSOC);
                        if ($requete){
                            if ($requete->rowCount() > 0){
                                echo ' : ' . $row['Nom'];
                            }
                        }                    
                    
                    ?>
                </div>
                <br>
                <div class="inputContainer">
                    <label>Prenom </label>
                    <?php 
                        if ($requete){
                            if ($requete->rowCount() > 0){
                                echo ' : ' . $row['Prenom'];
                            }
                        }                    
                    ?>
                </div>
                <br>
                <div class="inputContainer">
                    <label>Age </label>
                    <?php 
                        if ($requete){
                            if ($requete->rowCount() > 0){
                                echo ' : ' . $row['Age'];
                            }
                        }                    
                    ?>
                </div>
                <br> 
                
                <div class="inputContainer">
                    <label>Identifiant </label>
                    <?php 
                        if ($requete){
                            if ($requete->rowCount() > 0){
                                echo ' : ' . $row['identifiant'];
                            }
                        }                    
                    ?>
                </div>
                <br>
                <br>
                <div>
                    
                    <form action="" method="POST" enctype="multipart/form-data">
                    <label>Ajouter une image de profile : </label>
                    <input id = "fichier" type = "file" name = "fichier">
                    <input type="submit" value="Enregistrer" name="Enregistrer">
                    </form>
                    
                </div>
        

        <?php

        if (isset($_POST['Enregistrer'])){
            if (isset($_FILES['fichier']) && $_FILES["fichier"]["error"] == UPLOAD_ERR_OK){
                $photo = $_FILES["fichier"]["name"];

                $emplTemp = $_FILES["fichier"]["tmp_name"];
                $infosFichier = pathinfo($photo);
                $extension = $infosFichier['extension'];
                $destination = "FichierClient/" . $username . "." . $extension;
                $_SESSION["photo"] = $username . "." . $extension;

                $_SESSION["temp"] = $destination;

                if (file_exists($destination)){
                    if (unlink($destination)) {
                        echo 'Le fichier a été supprimé avec succès.';
                    } else {
                        echo 'Erreur : Impossible de supprimer le fichier.';
                }
                }

                if (move_uploaded_file($emplTemp, $destination)) {
                    // Le fichier a été téléchargé avec succès
                    echo "Le fichier a été téléchargé avec succès : " . $destination;
                    
                } else {
                    // Une erreur s'est produite lors du téléchargement du fichier
                    echo "Une erreur s'est produite lors du téléchargement du fichier.";
                }
            }
        }
        else //echo "Aucun fichier n'a été téléchargé ou une erreur s'est produite.";

        ?>
        
        <img id="visu" src="<?php if (isset($_SESSION["temp"])){echo $_SESSION["temp"];}else{echo "Image/profil.png";} ?>" alt="image">
        <br>

        <form action="" method="POST">
        <input type="submit" name="confirm" value="Confirmer">
        </form>


        <?php
        if (isset($_POST['confirm']) && isset($_SESSION["temp"])){
            echo 'confirm activated';
        $_SESSION["ppAdress"] = $_SESSION["temp"];

        if (isset($_SESSION['photo'])){
            echo $_SESSION['photo'];
        }
        try{
            $requete = $connexion->prepare("UPDATE infousers SET imageData = :imageData WHERE identifiant = :username");
            $requete->bindParam(":imageData", $_SESSION["photo"]);
            $requete->bindParam(":username", $_SESSION["username"]);
    
            $requete->execute();
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
        }
        

        if ($requete){
            echo 'Enregistrement réussi';
            
        }
        else {
            echo "Erreur SQL : " . $connexion->errorInfo()[2];
        }

        unset($_SESSION["photo"]);
        unset($_SESSION["temp"]);
        //header('location:userProfile.php');
        }            
                                                                                                
        ?>
        </div>
    </div> 

    
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
