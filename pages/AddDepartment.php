<?php require_once("session.php"); ?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouvelle Depatment</title>
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
                top: calc(50% - 150px);
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
    </head>
    <body>
        
    <div class="container1 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4" style="margin-left:550px;">
    <div class="panel "style="margin-top:47px;">
    <a href="department.php" class="back-icon"><i class="fa fa-arrow-left" style="font-size:20px;"></i></a>
                <div class="header1">Department Information:</div>
                <div class="panel-body">
                    <form method="post" action="insertDep.php" class="form" style="height:550px;">
						
                        <div class="form" style="margin-top: 200px;">
                             <label for="Responsable">Nom de la Departement</label>
                            <input type="text" name="nom" 
                                   placeholder="Nom de la Departement"
                                   class="form-control" style="margin-top: 15px;"/>
                        </div>
                        
                        <div class="form" style="margin-top: 20px;">
                            <label for="niveau">Responsable:</label>
                            <input type="text" name="Responsable" 
                                   placeholder="Nom de la Responsable"
                                   class="form-control" style="margin-top: 15px;"/>
                        </div>
                       
				        <button type="submit" class="btn btn-success" style="margin-top: 80px;">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer
                        </button> 
                      
					</form>
                </div>
            </div>
            
        </div>      
    </body>
</HTML>