<?php

require_once("connexiondb.php");
require_once("../les_fonctions/fonction.php");


$validationErrors = array();
/***** **/

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $login = $_POST['login'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $email = $_POST['email'];
    // Récupère les données de l'image téléchargée
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];
    
    // Déplace le fichier téléchargé vers un emplacement final sur le serveur
    $destination = '../images/' . $file_name;
    if (move_uploaded_file($file_tmp, $destination)) {
        // Le déplacement du fichier a réussi, vous pouvez maintenant stocker le chemin de l'image dans la base de données
        $image_path = $destination;
   
    if (isset($login)) {
        $filtredLogin = filter_var($login, FILTER_SANITIZE_STRING);

        if (strlen($filtredLogin) < 4) {
            $validationErrors[] = "Erreur!!! Le login doit contenir au moins 4 caratères";
        }
    }

    if (isset($pwd1) && isset($pwd2)) {

        if (empty($pwd1)) {
            $validationErrors[] = "Erreur!!! Le mot ne doit pas etre vide";
        }

        if (md5($pwd1) !== md5($pwd2)) {
            $validationErrors[] = "Erreur!!! les deux mot de passe ne sont pas identiques";

        }
    }

    if (isset($email)) {
        $filtredEmail = filter_var($login, FILTER_SANITIZE_EMAIL);

        if ($filtredEmail != true) {
            $validationErrors[] = "Erreur!!! Email  non valid";

        }
    }

    if (empty($validationErrors)) {
        if (rechercher_par_login($login) == 0 & rechercher_par_email($email) == 0) {
            $requete = $pdo->prepare("INSERT INTO utilisateur(login,email,pwd,role,etat,img) 
                                        VALUES(:plogin,:pemail,:ppwd,:prole,:petat,:pimg)");

            $requete->execute(
                array(
                    'plogin' => $login,
                    'pemail' => $email,
                    'ppwd' => md5($pwd1),
                    'prole' => 'VISITEUR',
                    'petat' => 0,
                    'pimg' => $image_path));

            $success_msg = "Félicitation, votre compte est crée, mais temporairement inactif jusqu'a activation par l'admin";
        } else {
            if (rechercher_par_login($login) > 0) {
                $validationErrors[] = 'Désolé le login exsite deja';
            }
            if (rechercher_par_email($email) > 0) {
                $validationErrors[] = 'Désolé cet email exsite deja';
            }
        }

    }

}}

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />

    <title> Nouvel utilisateur </title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <!--link rel="stylesheet" type="text/css" href="../css/monstyle.css"-->
    <link rel="stylesheet" type="text/css" href="../css/registre.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">

</head>

<body>

    <div class="container col-md-4 col-md-offset-3" style="margin-top:150px;margin-left:500px;">
    <a href="login.php" class="back-icon"><i class="fa fa-arrow-left"></i></a>  
    <h1 class="text-center"> Nouveau compte utilisateur</h1><br>
        <form class="form" method="post" enctype="multipart/form-data">

            <div class="input-container">

                <input type="text" required="required" minlength="4"
                    title="Le login doit contenir au moins 4 caractères..." name="login"
                    placeholder="Taper votre nom d'utilisateur" autocomplete="off" class="form-control">
            </div><br>

            <div class="input-container">
                <input type="password" required="required" minlength="3"
                    title="Le Mot de passe doit contenir au moins 3 caractères..." name="pwd1"
                    placeholder="Taper votre mot de passe" autocomplete="new-password" class="form-control">
            </div><br>

            <div class="input-container">
                <input type="password" required="required" minlength="3" name="pwd2"
                    placeholder="retaper votre mot de passe pour le confirmer" autocomplete="new-password"
                    class="form-control">
            </div><br>

            <div class="input-container">

                <input type="email" required="required" name="email" placeholder="Taper votre email" autocomplete="off"
                    class="form-control">
            </div><br>

            <div class="input-container">
                <input type="file" required="required" name="file" placeholder="Profile Image" autocomplete="off"
                    class="form-control">
            </div><br>
            <input type="submit" class="btn btn-primary" value="Enregistrer" style="margin-left: 180px;">
        </form>
        <br>
        <?php

        if (isset($validationErrors) && !empty($validationErrors)) {
            foreach ($validationErrors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
        }


        if (isset($success_msg) && !empty($success_msg)) {
            echo '<div class="alert alert-success">' . $success_msg . '</div>';

            header('refresh:5;url=login.php');
        }

        ?>
        

    </div>

</body>

</html>