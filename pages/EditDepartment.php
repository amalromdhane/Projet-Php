<?php
require_once("session.php");
require_once('connexiondb.php');
$idDepartment = isset($_GET['idDepartment'])?$_GET['idDepartment']:6;
//echo "ID Department: $idDepartment"; 
$requete = "SELECT * FROM department WHERE idDepartment = ?";
$resultat = $pdo->prepare($requete);
$resultat->execute([$idDepartment]);
$department = $resultat->fetch();


if ($department !== false) {
    $nom = $department['nomDepartment'];
    $Responsable = $department['Responsable'];
} else {
    // Handle the case where the department is not found
    /*echo "Department not found for idDepartment: $idDepartment";*/
}
?>

<! DOCTYPE HTML>
    <HTML>

    <head>
        <meta charset="utf-8">
        <title>Edition d'une Departement</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <!--link rel="stylesheet" type="text/css" href="../css/monstyle.css"-->
        <link rel="stylesheet" type="text/css" href="../css/loginStyle.css">
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
                top: calc(50% - 160px);
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
            color: grey;
           }
           .panel-body .form.label{
            color:transparent;
           }
           .form.label{
            font-size: 23px;
           }
</style>
    </head>

    <body>
                <div class="container1 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4" style="margin-left:550px;">
                  <div class="panel "style="margin-top:47px;">
                  <a href="department.php" class="back-icon"><i class="fa fa-arrow-left" style="font-size:20px;"></i></a>
                     <div class="header1">Edition de Departement :</div><br><br><br><br><br><br><br><br><br><br><br>
                       <div class="panel-body">
                           <form method="post" action="updateFiliere.php" class="form">
                              
                                 <label for="idDepartment">id de la Department:
                                     <?php echo $idDepartment?>
                                 </label>
                                <input type="hidden" name="idDepartment" class="form-control" value="<?php echo $idDepartment?>" />
                                <br><br>

                                <div class="form">
                                <label for="nomDepartment">Nom de la Department:</label>
                                <input type="text" name="nomDepartment" placeholder="Nom de la Department" class="form-control" value="<?php echo $nom ?>" />
                                </div><br><br><br><br>
                                <br>
                                <div class="form">
                               <label for="Responsable">Responsable:</label>
                               <input type="text" name="Responsable" placeholder="Nom de Responsable" class="form-control" value="<?php echo $Responsable?>" />
                               </div><br><br><br><br><br><br><br><br>
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