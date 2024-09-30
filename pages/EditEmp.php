<?php
require_once("session.php");
require_once('connexiondb.php');

$idEmp = isset($_GET['idEmp']) ? $_GET['idEmp'] : 0;
$requeteEmp = "select * from employer where idEmp=$idEmp";
$resultatEmp = $pdo->query($requeteEmp);
$employer = $resultatEmp->fetch();
$fullname = $employer['fullname'];
$gender = $employer['gender'];
$dateN = $employer['dateN'];
$cne = $employer['cne'];
$mobile = $employer['mobile'];
$adresse = $employer['adresse'];
$dateEmbauche = $employer['dateEmbauche'];
$nomPhoto = $employer['photo'];
$idDepartment = $employer['idDepartment'];
$requeteDep = "select * from department";
$resultatDep = $pdo->query($requeteDep);

?>
<! DOCTYPE HTML>
    <HTML>

    <head>
        <meta charset="utf-8">
        <title>Edition d'un Employee</title>
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
            .header1 {
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-size: 23px;
                color: rgba(47, 217, 240, 0.851);
                position: absolute;
                left: calc(50% - 120px);
                top: calc(50% - 220px);
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
</style>
    </head>

    <body>
       

    <div class="container1 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4" style="margin-left:550px;">
    <div class="panel "style="margin-top:47px;">
    <a href="employee.php" class="back-icon"><i class="fa fa-arrow-left" style="font-size:20px;"></i></a>
                <div class="header1">Edition des Employees :</div><br><br><br><br>
                <div class="panel-body">
                    <form method="post" action="updateEmp.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idEmp">
                                <?php echo $idEmp ?>
                            </label>
                           <h1 class="id"> <input type="hidden" name="idEmp" class="form-control" value="<?php echo $idEmp ?>" /></h1>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Nom :</label>
                            <input type="text" name="fullname" placeholder="Nom" class="form-control"
                                value="<?php echo $fullname ?>" />
                        </div>
                        <div class="form-group">
                            <label for="gender">gender :</label>
                            <input type="text" name="gender" placeholder="gender" class="form-control"
                                value="<?php echo $gender ?>" />
                        </div>
                        <div class="form-group">
                            <label for="dateN">DATE Naissance:</label>
                            <input type="date" name="dateN" placeholder="date Naissance" class="form-control"
                                value="<?php echo $dateN ?>" />
                        </div>
                        <div class="form-group">
                            <label for="cne">CIN :</label>
                            <input type="text" name="cne" placeholder="CIN" class="form-control"
                                value="<?php echo $cne ?>" />
                        </div>
                        
                        <div class="form-group">
                            <label for="mobile">Telephone Number :</label>
                            <input type="text" name="mobile" placeholder="mobile" class="form-control"
                                value="<?php echo $mobile ?>" />
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse :</label>
                            <input type="text" name="adresse" placeholder="adresse" class="form-control"
                                value="<?php echo $adresse ?>" />
                        </div>
                        <div class="form-group">
                            <label for="dateEmbauche">Date Embauche:</label>
                            <input type="Date" name="dateEmbauche" placeholder="Date Embauche" class="form-control"
                                value="<?php echo $dateEmbauche ?>" />
                        </div>
                        <div class="form">
                        <div class="form-group">
                            <label for="photo">Photo :</label>
                            <input type="file" name="photo" />
                        </div>
                        
                        <div class="form-group">
                            <select name="idDepartment" class="form-control" id="idDepartment"
                                onchange="this.form.submit()">
                                <option value=0>Toutes les departmentes</option>
                                <?php while ($department = $resultatDep->fetch()) { ?>
                                    <option value="<?php echo $department['idDepartment'] ?>" <?php if ($department['idDepartment'] == $idDepartment)
                                           echo "selected" ?>>
                                        <?php echo $department['nomDepartment'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                                </div>
                                </div>

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