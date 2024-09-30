<?php
require_once("session.php");
require_once('connexiondb.php');

$requeteDep = "select * from department";
$resultatDep = $pdo->query($requeteDep);

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
        <!--?php include("menu.php"); ?-->

        <!--div class="container"-->
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
                top: calc(50% - 250px);
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
            
        </style>

        <!--img src="../images/logForm.JPG" class="" style=";height:400px;"-->
        <div class="container1 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4" style="margin-left:550px;">
            <div class="panel "style="margin-top:47px;">
                <!--div class="panel panel-primary margetop60"-->
                <a href="employee.php" class="back-icon"><i class="fa fa-arrow-left" style="font-size:20px;"></i></a>
                <div class="header1 ">Employee Informations:</div><br><br><br>
                <div class="panel-body">
                    <form method="post" action="insertEmp.php" class="form" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="fullname">Nom :</label>
                            <input type="text" name="fullname" required="required" placeholder="Nom" class="form-control"
                                style="font-size: 14px;" />
                        </div>
                        <div class="form-group">
                            <label for="gender">Genre :</label>
                            <input type="text" name="gender" required="required" placeholder="gender" class="form-control"
                                style="font-size: 14px;" />
                        </div>
                        <div class="form-group">
                            <label for="dateN">Date Naissance :</label>
                            <input type="Date" name="dateN" required="required" placeholder="date Naissance" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="cne">CIN :</label>
                            <input type="text" name="cne" required="required" placeholder="CIN" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="mobile">Numero de Telephone :</label>
                            <input type="text" name="mobile" required="required" placeholder="Numero de Telephone" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse :</label>
                            <input type="text" name="adresse" required="required" placeholder="Adresse" class="form-control"
                                style="font-size: 14px;" />
                        </div>
                        <div class="form">
                        <div class="form-group">
                            <label for="dateEmbauche">Date Embauche :</label>
                            <input type="Date" name="dateEmbauche" required="required" placeholder="date Embauche" class="form-control" />
                        </div>
                        <div class="form">
                        <div class="form-group">
                            <label for="photo">Photo :</label>
                            <input type="file" required="required" name="photo" />
                        </div>
                        
                        <div class="form-group">
                            <label for="idDepartment">Department:</label>
                            <select name="idDepartment"  class="form-control" id="idDepartment">
                                <?php while ($department = $resultatDep->fetch()) { ?>
                                    <option value="<?php echo $department['idDepartment'] ?>">
                                        <?php echo $department['nomDepartment'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            </div>
                        </div>
                        </div>
                        <button type="submit" class="btn ">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer
                        </button>

                    </form>
                </div>
            </div>
        </div>
      
    </body>

    </HTML>