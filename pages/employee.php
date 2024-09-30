<?php
require_once("session.php");
require_once("connexiondb.php");

$fullname=isset($_GET['fullname'])?$_GET['fullname']:"";
$idDepartment=isset($_GET['idDepartment'])?$_GET['idDepartment']:0;

$size=isset($_GET['size']) ? $_GET['size']:3;
$page=isset($_GET['page']) ? $_GET['page']:1;
$offset=($page-1)*$size;

$requeteDep="select * from department"; 
if($idDepartment==0){
    $requeteEmp="select e.idEmp,e.fullname,e.gender,e.dateN,e.cne,e.mobile,e.adresse,e.dateEmbauche,e.photo,d.nomDepartment
            from department as d,employer as e
            where d.idDepartment=e.idDepartment
            and fullname like '%$fullname%'
            order by idEmp
            limit $size
            offset $offset";
    
    $requeteCount="select count(*) count from employer
            where fullname like '%$fullname%'";
}else{
     $requeteEmp="select e.idEmp,e.fullname,e.gender,e.dateN,e.cne,e.mobile,e.adresse,e.dateEmbauche,e.photo,d.nomDepartment
     from department as d,employer as e
     where d.idDepartment=e.idDepartment
     and fullname like '%$fullname%'
            and d.idDepartment=$idDepartment
            order by idEmp
            limit $size
            offset $offset";
    
    $requeteCount="select count(*) count from employer
            where fullname like '%$fullname%' 
            and idDepartment=$idDepartment";
}
$resultatDep = $pdo->query($requeteDep);
$resultatEmp=$pdo->query($requeteEmp);
$resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrEmp=$tabCount['count'];
    $reste=$nbrEmp % $size;   
if($reste===0) 
$nbrPage=$nbrEmp/$size;   
else
$nbrPage=floor($nbrEmp/$size)+1;
?>

<!DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Gestion des Employees</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/styless.css">
</head>

<body>
    <?php include("home.php"); ?>
    
  <main class="table"><h1>Liste Des Employees</h1> 
	<section class="table__head">
                <form method="get" action="employee.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="fullname" placeholder="Employee Name" class="form-control" value="<?php echo $fullname?>"/>
                    
                    <label for="idDepartment">Departement:</label>
                    <select name="idDepartment" class="form-control" id="idDepartment" onchange="this.form.submit()">
                    <option value=0>Toutes les departmentes</option>
                    <?php while ($department = $resultatDep->fetch()) { ?>
                        <option value="<?php echo $department['idDepartment'] ?>"<?php if($department['idDepartment']===$idDepartment) echo "selected" ?>>
                         <?php echo $department['nomDepartment'] ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span>Recherche</button>
                    </div>
                    
                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                    <a href="AddEmp.php"><button type="button" class="btn btn-success" style="height:30px;">ADD</span></a> </button>&nbsp;
                    <a href="export.php" style="color:black;"><button type="button" class="btn btn-default " style="height:30px;background-color:rgb(250, 123, 72);">Export Exel</span></a>  </button>     
                    <?php } ?>
                    
                </form>
                <div class="panel-heading col-md-4" style="width: 1235px;font-size:20px;"> <?php echo $nbrEmp ?>employes
                </div>
                </table>
					</section>
		<section class="table__body">
                    <table>
                        <thead>
                            <tr>
                            <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                <th> Id Employee</th>
                                <?php } ?>
                                <th> Nom </th>
                                <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                <th> Gender</th>
                                <th> Date Naissance</th>
                                <th> CIN </th>
                                <th> Telephone </th>
                                <th> Adresse</th>
                                <th> Date Embauche</th>
                                <?php } ?>
                                <th> Photo</th>
                                <th> Department</th>
                                <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                        <th> Option</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           while ($employer=$resultatEmp->fetch()) { ?>
                                <tr><?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                    <td>
                                        <?php echo $employer['idEmp'] ?>
                                    </td>
                                    <?php } ?>
                                    <td>
                                        <?php echo $employer['fullname'] ?>
                                    </td>
                                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                    <td>
                                        <?php echo $employer['gender'] ?>
                                    </td>
                                    <td>
                                        <?php echo $employer['dateN'] ?>
                                    </td>
                                    <td>
                                        <?php echo $employer['cne'] ?>
                                    </td>
                                    <td>
                                        <?php echo $employer['mobile'] ?>
                                    </td>
                                    <td>
                                        <?php echo $employer['adresse'] ?>
                                    </td>
                                    <td>
                                        <?php echo $employer['dateEmbauche'] ?>
                                    </td>
                                    <?php } ?>
                                    <td>
                                        <img src="../images/<?php echo $employer['photo'] ?>"
                                        style="width:50px;height:50px;">
                                    </td>
                                    <td>
                                        <?php echo $employer['nomDepartment'] ?>
                                    </td>
                                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                    <td>
                                    <div class="btn-group" role="group" aria-label="Actions">
                                    <a href="EditEmp.php?idEmp=<?php echo $employer['idEmp'] ?>">
                                    <button type="button" class="btn btn-primary btn-info">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    </button>
                                    </a>
                                    <a onclick="return confirm('Etes vous sur de vouloir supprimer ce Employee')"
                                     href="DeleteEmp.php?idEmp=<?php echo $employer['idEmp'] ?>">
                                    <button type="button" class="btn btn-secondary btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                    </a>
                                   </div>
                                   </td>
                                   <?php } ?>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table >
                    
                    <div>
                   <ul class="pagination">
                        <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
                            <li class="<?php if ($i == $page)
                                echo 'active' ?>">
                                    <a
                                        href="employee.php?page=<?php echo $i; ?>&fullname=<?php echo $fullname ?>&idDepartment<?php echo $idDepartment ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    </div>
                    </section>
                
        </div>
        </div>
        </div>
    </div>
                        </div >
</body>

</HTML>