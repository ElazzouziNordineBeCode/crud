<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden book</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <!-- Tableau multi-onglet -->


    <div class="container">
        <div class="container-onglets">
            <div class="onglets active" data-anim="1">REVIEW</div>
            <div class="onglets" data-anim="2">ADD REVIEW</div>
            <div class="onglets" data-anim="3">GALERIE</div>
        </div>

        <div class="contenu activeContenu" data-anim="1">


            <table>
                <tr id="items">
                    <th>Date</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Avis</th>
                    <th>Star</th>
                    <th>Supprimer</th>
                </tr>
                <?php
                //inclure la page de connexion
                include_once "connexion.php";

                //requête pour afficher la liste des avis
                $req = mysqli_query($con, "SELECT * FROM review");
                if (mysqli_num_rows($req) == 0) {
                    //s'il n'existe pas d'avis dans la base de donné , alors on affiche ce message :
                    echo "Il n'y a pas encore d'avis ajouter !";
                } else {
                    //si non , affichons la liste de tous les avis
                    while ($row = mysqli_fetch_assoc($req)) {
                ?>
                        <tr>
                            <td><?= $row['Date'] ?></td>
                            <td><?= $row['Nom'] ?></td>
                            <td><?= $row['Email'] ?></td>
                            <td><?= $row['Avis'] ?></td>
                            <td><?= $row['Star'] ?></td>
                            <!--Nous alons mettre l'id de chaque avis dans ce lien -->
                            <td><a href="supprimer.php?id=<?= $row['id'] ?>"><img src="images/trash.png"></a></td>
                        </tr>
                <?php
                    }
                }
                ?>

            </table>



        </div>

        <div class="contenu" data-anim="2">
            <p><?php include('ajouter.php'); ?></p>
        </div>

        <div class="contenu" data-anim="3">
            <h3>Lorem ipsum dolor sit amet. 3</h3>
            <hr>
            <p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet it amet Lorem ipsum dolor sit amet </p>
        </div>
    </div>

    <!-- Animation des onglets du tableau -->
    <script>
        // Recuperer les element du DOM
        const onglets = document.querySelectorAll('.onglets');
        const contenu = document.querySelectorAll('.contenu');
        let index = 0;
        // Au clic ajouter la classe active a l'onglet
        onglets.forEach(onglet => {
            onglet.addEventListener('click', () => {
                if (onglet.classList.contains('active')) {
                    return;
                } else {
                    onglet.classList.add('active');
                }
                // Si un onglet a la classe active la suprimer en cliquant sur un autre onglets
                index = onglet.getAttribute('data-anim');

                for (i = 0; i < onglets.length; i++) {

                    if (onglets[i].getAttribute('data-anim') != index) {
                        onglets[i].classList.remove('active');
                    }
                }

                // Animation du contenu des onglets au clic
                for (j = 0; j < contenu.length; j++) {
                    if (contenu[j].getAttribute('data-anim') == index) {
                        contenu[j].classList.add('activeContenu');
                    } else {
                        contenu[j].classList.remove('activeContenu');
                    }
                }
            })
        })
    </script>
</body>


</html>