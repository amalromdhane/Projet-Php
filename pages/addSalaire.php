<?php
require_once("session.php");
require_once('connexiondb.php');

$idEmp = isset($_GET['idEmp']) ? $_GET['idEmp'] : 0;
$idDepartment = isset($_GET['idDepartment']) ? $_GET['idDepartment'] : 0;

$requete = "select * from salaire where idEmp=$idEmp ";

$resultat = $pdo->query($requete);
$salaire= $resultat->fetch();
$salaire = $resultat->fetch();

?>
<! DOCTYPE HTML>
    <HTML>

    <head>
        <meta charset="utf-8">
        <title>Nouveau Employee</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <link rel="stylesheet" type="text/css" href="../css/loginStyle.css">

    </head>

    <body>
        <style>
            body {
               
               background-color: whitesmoke;/*rgb(213, 210, 210) ;*/
               background-image:url("../images/imoo.JPG") ;
               background-repeat: no-repeat;
                
              
            }
            .header1 {
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-size: 23px;
                color: rgba(47, 217, 240, 0.851);
                position: absolute;
                left: calc(50% - 120px);
                top: calc(50% - 180px);
            }
            .container1 .panel-body .form{
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                box-shadow: whitesmoke;
            
            }
            .container1{
            box-shadow: 0 4px 8px rgba(179, 8, 8, 0.1);  
            background-color:;  
            }
            .placeholder {
             font-size: 20px; /* Modifier la taille de la police selon vos besoins */
            }
            
        </style>

        <!--img src="../images/logForm.JPG" class="" style=";height:400px;"-->
        <div class="container1 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4" style="margin-left:550px;">
            <div class="panel "style="margin-top:47px;">
                <!--div class="panel panel-primary margetop60"-->
                <a href="Salaire.php" class="back-icon"><i class="fa fa-arrow-left" style="font-size:20px;"></i></a>
                <div class="header1 ">Ajouter une Salaire:</div>
                <div class="panel-body">
                    <form method="post" action="insertSalaire.php" class="form">
                    <div class="form-group">
                            <label for="idEmp" style="margin-top:200px;">Id Employee :</label>
                            <input type="text" name="idEmp" placeholder="" class="form-control" value="<?php echo $idEmp; ?>" style="font-size: 20px;"/>
                        </div>
                        <div class="form">
                            <label for="idDepartment" style="margin-top:30px;">Id Department :</label>
                            <input type="text" name="idDepartment" placeholder="id Department" class="form-control placeholder" value="<?php echo $idDepartment; ?>"/>
                        </div>
                        <div class="form">
                            <label for="montant" style="margin-top:30px;">montant :</label>
                            <input type="text" name="montant" placeholder="montant" class="form-control placeholder"/>
                        </div>
                        
                            <button type="submit" class="btn btn-success" style="margin-top:50px;">
                                <span class="glyphicon glyphicon-save"></span>
                                Enregistrer
                            </button>
                            
                        </form>
                     
                </div>
            </div>
        </div>
    </body>

    </HTML>