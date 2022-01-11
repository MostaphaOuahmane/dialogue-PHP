<?php require_once'config.php'; 
    require_once'fonction.php';
?>
<?php
if ( !empty( $_POST )) { // est-ce que $_POST n'est pas vide
$_POST['nom'] = htmlspecialchars($_POST['nom']);// pour se prémunir des failles et des injections SQL
$_POST['prenom'] = htmlspecialchars($_POST['prenom']);
  $_POST['email'] = htmlspecialchars($_POST['email']);
$_POST['sexe'] = htmlspecialchars($_POST['sexe']);
  $_POST['message'] = htmlspecialchars($_POST['message']);

$insertion = $pdoDIA->prepare( " INSERT INTO commentaires (nom,prenom,email,sexe ,message, date_enregistrement)
   VALUES ( :nom, :prenom, :email, :sexe, :message, NOW()) ");// requete préparée avec des marqueurs

$insertion->execute( array(
  ':nom' => $_POST['nom'],
  ':prenom' => $_POST['prenom'],
    ':email' => $_POST['email'],
  ':sexe' => $_POST['sexe'],
  ':message' => $_POST['message'],
));
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,600;0,700;1,200;1,300;1,400;1,600&family=Orelega+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,600;0,700;1,200;1,300;1,400;1,600&family=Orelega+One&family=The+Nautigal:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="stayle.css">
    <title>form!</title>
</head>

<body class="bg-white text-dark ">

     <?php ?>
    <div class="d-flex  justify-content-center">
        <h1 class=" text-center shadow p-3 mb-2 mt-4 bg-white w-50 round">commentaires</h1>
    </div>

    <div class="container w-50 mx-auto">
        <div class="row mt-5 mb-5   bg-gradient border-primary ">
            <form action="" method="POST" class=" shadow-lg p-3 mb-5 bg-white rounded   rounded-start rounded-bottom">
                <div class="mb-3 font ">
                    <label for="nom" class="form-label"><i class="bi bi-people-fill"></i></label>
                    <input type="text" name="nom" id="pseudo" class="form-control" placeholder="votre nom" required>
                </div>
                <div class="mb-3 font">
                    <label for="prenom" class="form-label"><i class="bi bi-person-circle"></i></label>
                    <input type="text" name="prenom" id="pseudo" class="form-control" placeholder=" votre prenom" required>
                </div>
                <div class="mb-3 font">
                    <label for="" class="form-label"><i class="bi bi-envelope-open-fill"></i></label>
                    <input type="email" name="email" id="pseudo" class="form-control" placeholder="votre email" required>
                </div>
                <div class="mb-3 font">
                    <!-- https://getbootstrap.com/docs/5.1/forms/checks-radios/ -->
                    <label for="sexe" class="form-label">Sexe </label><br>
                    <input type="radio" name="sexe" value="m" id="sexe" checked> Homme <br>
                    <input type="radio" name="sexe" value="f" id="sexe"> Femme
                </div>
                <div class="mb-3 font">
                    <label for="message" class="form-label"><i class="bi bi-envelope"></i></label>
                    <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Écrivez votre message ici s'il vous plaît" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary mb-4">Envoyer votre message</button>

            </form>
        </div>
       <div class="row">
       <?php
			// 3 affichage de données 
              $resultat = $pdoDIA->query( " SELECT * FROM commentaires " );
              // debug($resultat);
              $nbr_commentaires = $resultat->rowCount();
              // debug($nbr_commentaires);
            ?>
       <table class="table table-primary shadow-lg p-3 mb-5 bg-white rounded  ">
             <thead>
               <tr>
                 <th>ID</th>
                 <th>Nom</th>
                 <th>Prenom</th>
                 <th>Email</th>
                 <th>Sexe</th>
                 <th>Message</th>
                 <th>Date d'enregistrement</th>
                 <th>Delete</th>
               </tr>
             </thead>
             <tbody>
				 <!-- ouverture de la boucle while -->
               <?php while ( $commentaire = $resultat->fetch( PDO::FETCH_ASSOC )) { ?>
			   <tr>
                    <td class="bg-light"> <a href="update.php?id_commentaires=<?php echo $commentaire['id_commentaires']; ?>">#<?php echo $commentaire['id_commentaires']; ?></a></td>
				   <td class="bg-success"><?php echo $commentaire['nom']; ?></td>
                   <td class="bg-info"><?php echo $commentaire['prenom']; ?></td>
                   <td class="bg-warning"><?php echo $commentaire['email']; ?></td>
                   <td class="bg-info"><?php echo $commentaire['sexe']; ?></td>
				   <td class="bg-light"><?php echo $commentaire['message']; ?></td>
				   <td class="bg-secondary"><?php echo $commentaire['date_enregistrement']; ?></td>
                   <td class="bg-danger"><a href="delete.php? id_commentaires=<?php echo $commentaire['id_commentaires']?>" style="color:black;"><i class="bi bi-trash-fill"></i></a></td>
			   </tr>
			   <!-- fermeture de la boucle -->
			   <?php } ?>
             </tbody>
       </table>
       </div>
        
       
    </div>




    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>