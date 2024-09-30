<?php
require_once("session.php");
require_once('connexiondb.php');

$idEmp = isset($_GET['idEmp']) ? $_GET['idEmp'] : 0;

$requete = "select * from salaire where idEmp=$idEmp";

$resultat = $pdo->query($requete);
$salaire= $resultat->fetch();
$montant = $salaire['montant'];
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
               
                background-color:rgb(219, 231, 229);
                
              
            }
            .header1 {
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-size: 23px;
                color: rgba(47, 217, 240, 0.851);
                position: absolute;
                left: calc(50% - 55px);
                top: calc(50% - 70px);
            }
            .container1 .panel-body .form{
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                box-shadow: whitesmoke;
                
            
            }
            .container1{
                box-shadow: 0 4px 8px rgba(247, 247, 247, 0.978);  
         
            }
            .placeholder {
             font-size: 20px; /* Modifier la taille de la police selon vos besoins */
            }
            
        </style>
    </head>

    <body>
    <div class="container1 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4" style="margin-left:550px;margin-top:150px;">
            <div class="panel "style="margin-top:47px;">
            <a href="Salaire.php" class="back-icon"><i class="fa fa-arrow-left" style="font-size:20px;"></i></a>
                <div class="header1">Salaire</div>
                <div class="panel-body">
                    <form  id="editForm_<?php echo $idEmp; ?>" method="post" action="updateSalaire.php" class="form"><br><br><br>
                        <div class="form" style="margin-top:50px;">
                            <label for="idEmp"></label>
                            <input type="hidden" name="idEmp" placeholder="id" class="form-control placeholder" value="<?php echo $idEmp ?>" />
                        </div>
                        
                        <div class="form">
                            <label for="montant" style="margin-top:120px;margin-left:100px;">montant :</label>
                            <input type="text" name="montant" placeholder="montant" class="form-control "
                                value="<?php echo $montant ?>" />
                        </div>
                        <div class="form">
                            <button type="submit" class="btn btn-success" style="margin-top:30px;">
                                <span class="glyphicon glyphicon-save"></span>
                                Enregistrer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </body>

        </HTML>