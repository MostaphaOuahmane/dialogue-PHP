<?php // 2 CONNEXION BDD dialogue
$pdoDIA = new PDO(
    'mysql:host=localhost;dbname=dialogue-php', // hôte nom BDD
    'root', // pseudo 
    // '',// mot de passe
    '', // mdp pour MAC avec MAMP
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // afficher les erreurs SQL dans le navigateur
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // charset des échanges avec la BDD
    )
);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <!-- lin icon boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- custom css file link  -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class=" container">
        <div class="mx-auto  mb-3 text-center shadow p-3 mt-4 bg-white w-50 round">

            <h1> update</h1>
        </div>
        <p> <a href="index.php">Go back to the homepage</a> </p>

        <?php if (isset($_GET['id_commentaires'])) : ?>
            <?php $id_commentaires = $_GET['id_commentaires']; ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                <p>You are updating the idea #<?php echo $id_commentaires; ?></p>
                </div>
            </div>
            <br>
            <hr>
            <?php $connection = $pdoDIA;
            // contacte la base de donnée 
            ?>
            <?php $sql = "SELECT * FROM commentaires where id_commentaires=:id_commentaires"; ?>
            <?php $statement = $connection->prepare($sql); ?>
            <?php $statement->bindValue(":id_commentaires", $id_commentaires); ?>
            <?php $statement->execute(); ?>
            <?php $condidat = $statement->fetch(PDO::FETCH_ASSOC); ?>

            <?php if (isset($_POST['submit'])) : ?>
                <?php $condidat = array(
                    'id_commentaires' => $_POST['id_commentaires'],
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'email' => $_POST['email'],
                    'sexe' => $_POST['sexe'],
                    'message' => $_POST['message'],
                );
                ?>

                <?php $connection = $pdoDIA;
                // contacte la base de donnée 
                ?>
                <?php $sql = "UPDATE commentaires SET nom=:nom, prenom=:prenom,  email=:email, sexe=:sexe, message=:message WHERE id_commentaires=:id_commentaires"; ?>
                <?php $statement = $connection->prepare($sql); ?>
                <?php $statement->execute($condidat); ?>

                <div class=" text-center mx-auto shadow p-3 mb-2 mt-4 bg-white w-50 round">
                    <p class="alert alert-success" role="alert">Your have updated your idea succesfully</p>
                </div>
                <br>
            <?php endif; ?>
            <div class="d-flex  justify-content-center">
                <h2 class=" text-center shadow p-3 mb-2 mt-4 bg-white w-50 round">commentaires</h2>
            </div>

            <div class="container w-50 mx-auto">

                <div class="row mt-5 mb-5   bg-gradient border-primary ">

                    <form method="post" class=" shadow-lg p-3 mb-5 bg-white rounded   rounded-start rounded-bottom">>
                        <?php foreach ($condidat as $key => $value) : ?>
                            <?php
                            if ($key == 'nom') : ?>
                                <div class="mt-3">
                                    <label for="nom"><i class="fas fa-user-tie"></i> </label>
                                    <input type="<?php echo $key; ?>" name="nom" value="<?php echo $value; ?>" id="nom" class="form-control" placeholder="nom">
                                </div>
                            <?php elseif ($key == 'prenom') : ?>
                                <div class="mt-3">
                                    <label for="prenom"><i class="bi bi-person-circle"></i> </label>
                                    <input type="<?php echo $key; ?>" name="prenom" value="<?php echo $value; ?>" id="prenom" class="form-control" placeholder="prénom">
                                </div>

                            <?php elseif ($key == 'email') : ?>

                                <div class="mt-3">
                                    <label for="email"><i class="bi bi-envelope-open-fill"></i></label>
                                    <input type="<?php echo $key; ?>" name="email" value="<?php echo $value; ?>" id="email" class="form-control" placeholder="votre email">
                                </div>
                            <?php elseif ($key == 'sexe') : ?>

                                <div class="mb-3">
                                    <!-- https://getbootstrap.com/docs/5.1/forms/checks-radios/ -->
                                    <label for="sexe" class="form-label">Sexe </label><br>
                                    <input type="radio" name="sexe" value="m" id="sexe" checked> Homme <br>
                                    <input type="radio" name="sexe" value="f" <?php if (isset($key['sexe']) && $key['sexe'] == 'f') echo ' checked'; //le 1er bouton sera checked et le second le sera SI on f depuis $fiche 
                                                                                ?> id="sexe"> Femme
                                </div>


                            <?php elseif ($key == 'message') : ?>
                                <div class="mt-3">
                                    <label for="confmdp"><i class="bi bi-envelope"></i></label>
                                    <textarea <?php echo $key; ?> name="message" value="<?php echo $value; ?>" id="message" class="form-control" placeholder="votre message"></textarea>
                                </div>

                            <?php else : ?>

                                <input type="text" name="<?php echo $key; ?>" value="<?php echo $value; ?>
                        " id_commentaires="<?php echo $key; ?>" <?php if ($key == 'id_commentaires') {
                                                                    echo 'readonly';
                                                                } ?> <?php if ($key == 'date_enregistrement') {
                                                        echo 'readonly';
                                                    } ?>>

                            <?php endif; ?>
                            <br>
                            <br>
                        <?php endforeach; ?>
                        <button onclick="f1()" class="btn btn-outline-secondary bg-success" id="update" type="submit" name="submit" value="Update your idea"> Update your idea</button>
                    </form>
                </div>
            </div>

        <?php endif; ?>

    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="app.js"></script>
</body>

</html>