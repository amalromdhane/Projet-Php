<?php
require_once("session.php");
require_once('connexiondb.php');

$id = isset($_GET['iduser']) ? $_GET['iduser'] : 0;

$requete = "select * from utilisateur where iduser=$id";

$resultat = $pdo->query($requete);
$utilisateur = $resultat->fetch();
$login = $utilisateur['login'];
$email = $utilisateur['email'];
$role = ($utilisateur['role']);

?>
<! DOCTYPE HTML>
    <HTML>

    <head>
        <meta charset="utf-8">
        <title>Edition d'un utilisateur</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <link rel="stylesheet" type="text/css" href="../css/loginStyle.css">
        <style>
            body {
                background-color: whitesmoke;/*rgb(213, 210, 210) ;*/
                background-image:url("../images/imoo.JPG") ;
                background-repeat: no-repeat;
            }

            .header3 {
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-size: 23px;
                color: rgba(47, 217, 240, 0.851);
                position: absolute;
                left: calc(50% - 120px);
                top: calc(50% - 150px);
            }
            .container1{
                box-shadow: 0 4px 8px rgba(179, 8, 8, 0.1);    
                color: grey;
            }
            
        </style>
    </head>

    <body>
     

        <div class="container1 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">

        <div class="panel panel-primary "style="margin-top:50px;">
                <div class="header3">Edition de l'utilisateur :</div><br><br>
                <a href="utilisateur.php" class="back-icon"><i class="fa fa-arrow-left" style="font-size:20px;"></i></a>
                <div class="panel-body">
                    <form method="post" action="updateUtilisateur.php" class="form"><br><br><br>
                        <div class="form-group">
                            <label for="iduser"></label>
                            <input type="hidden" name="iduser" placeholder="id" class="form-control" value="<?php echo $id ?>" />
                        </div><br>
                        <div class="form-group">
                            <label for="login">Login :</label>
                            <input type="text" name="login" placeholder="Login" class="form-control"
                                value="<?php echo $login ?>" />
                        </div><br>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" name="email" placeholder="email" class="form-control"
                                value="<?php echo $email ?>" />
                        </div><br>
                        <div class="form-group">
                        <label for="role">Role :</label>
                            <select name="role" class="form-control">
                                <option value="ADMIN" <?php if ($role == "ADMIN")
                                    echo "selected" ?>>ADMIN
                                    </option>
                                    <option value="VISITEUR" <?php if ($role == "VISITEUR")
                                    echo "selected" ?>>VISITEUR</option>
                                </select>
                            </div>
                            <br><br><br>
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-save"></span>
                                Enregistrer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </body>

        </HTML>