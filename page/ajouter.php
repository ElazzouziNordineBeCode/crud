<?php
//vérifier que le bouton ajouter a bien été cliqué
if (isset($_POST['button'])) {
    //extraction des informations envoyé dans des variables par la methode POST
    extract($_POST);

    //verifier que tous les champs ont été remplis
    if (isset($_POST['Date']) && isset($_POST['Nom']) && isset($_POST['Email']) && isset($_POST['Avis']) && isset($_POST['Star'])) {
        $Date = $_POST['Date'];
        $Nom = $_POST['Nom'];
        $Email = $_POST['Email'];
        $Avis = $_POST['Avis'];
        $Star = $_POST['Star'];
        //connexion à la base de donnée
        include_once "connexion.php";
        //requête d'ajout
        $req = mysqli_query($con, "INSERT INTO review VALUES(NULL, '$Date', '$Nom', '$Email', '$Avis', '$Star')");
        if ($req) { //si la requête a été effectuée avec succès , on fait une redirection
            header('Location: ../index.php');
        } else { //si non
            $message = "Avis non ajouté";
        }
    } else {
        //si non
        $message = "Veuillez remplir tous les champs svp !";
    }
}

?>
<div class="form">
    <p class="erreur_message">
        <?php
        // si la variable message existe , affichons son contenu
        if (isset($message)) {
            echo $message;
        }
        ?>

    </p>
    <form action="page/ajouter.php" method="POST">
        <label>Date</label>
        <input type="text" readonly name="Date" value=<?php echo date("Y-m-d"); ?>>
        <label>Nom</label>
        <input type="text" required name="Nom">
        <label>Email</label>
        <input type="text" required name="Email">
        <label>Avis</label>
        <input type="text" required name="Avis">
        <label>Star</label>
        <select name="Star" required>
            <option value="" selected disabled hidden>Choose here</option>
            <option value="1/5">1/5</option>
            <option value="2/5">2/5</option>
            <option value="3/5">3/5</option>
            <option value="4/5">4/5</option>
            <option value="5/5">5/5</option>
        </select>
        <input type="submit" required value="Ajouter" name="button">
    </form>
</div>