<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php

    //connexion à la base de donnée
    include_once "connexion.php";
    //on récupère le id dans le lien
    $id = $_GET['id'];
    //requête pour afficher les infos d'un avis
    $req = mysqli_query($con, "SELECT * FROM review WHERE id = $id");
    $row = mysqli_fetch_assoc($req);


    //vérifier que le bouton ajouter a bien été cliqué
    if (isset($_POST['button'])) {
        //extraction des informations envoyé dans des variables par la methode POST
        extract($_POST);

        //verifier que tous les champs ont été remplis
        if (isset($Date) && isset($Nom) && isset($Email) && isset($Avis)) {
            //requête de modification
            $req = mysqli_query($con, "UPDATE review SET Date = '$Date' , Nom = '$Nom' , Email = '$Email', Avis = '$Avis' WHERE id = $id");
            if ($req) { //si la requête a été effectuée avec succès , on fait une redirection
                header("location: index.php");
            } else { //si non
                $message = "Avis non modifié";
            }
        } else {
            //si non
            $message = "Veuillez remplir tous les champs !";
        }
    }

    ?>

    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png">Retour</a>
        <h2>Modifier l'avis : <?= $row['Date'] ?> </h2>
        <p class="erreur_message">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Date</label>
            <input type="date" name="Date" value="<?= $row['Date'] ?>">
            <label>Nom</label>
            <input type="text" name="Nom" value="<?= $row['Nom'] ?>">
            <label>Email</label>
            <input type="text" name="Email" value="<?= $row['Email'] ?>">
            <label>Avis</label>
            <input type="text" name="Avis" value="<?= $row['Avis'] ?>">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>

</html>