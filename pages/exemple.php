<?php
require_once("session.php");
require_once("connexiondb.php");



$nom=isset($_GET['nom'])?$_GET['nom']:"";
$idDepartment=isset($_GET['idDepartment'])?$_GET['idDepartment']:0;

$size=isset($_GET['size']) ? $_GET['size']:3;
$page=isset($_GET['page']) ? $_GET['page']:1;
$offset=($page-1)*$size;

$requeteDep="select * from department"; 
if($idDepartment==0){
    $requeteEmp="select e.idEmployee,e.nom,e.dateEmbauche,e.adresse,d.nomDepartment,e.photo 
            from department as d,employee as e
            where d.idDepartment=e.idDepartment
            and nom like '%$nom%'
            order by idEmployee
            limit $size
            offset $offset";//order by idEmployee
    
    $requeteCount="select count(*) count from employee
            where nom like '%$nom%'";
}else{
     $requeteEmp="select e.idEmployee,e.nom,e.dateEmbauche,e.adresse,d.nomDepartment,e.photo 
     from department as d,employee as e
     where d.idDepartment=e.idDepartment
     and nom like '%$nom%'
            and d.idDepartment=$idDepartment
            order by idEmployee
            limit $size
            offset $offset";
    
    $requeteCount="select count(*) count from employee
            where nom like '%$nom%' 
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/styless.css">
	<title>Table</title>
</head>
<body>
<?php include("home.php"); ?>
	<main class="table"><h1>Liste Des Employees</h1> 
	<section class="table__head">
                <form method="get" action="exemple.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nom" placeholder="Employee Name" class="form-control" value="<?php echo $nom ?>"/>
                    </div>
                    <label for="idDepartment">Departement:</label>
                    <select name="idDepartment" class="form-control" id="idDepartment" onchange="this.form.submit()">
                    <option value=0>Toutes les departmentes</option>
                    <?php while ($department = $resultatDep->fetch()) { ?>
                        <option value="<?php echo $department['idDepartment'] ?>"<?php if($department['idDepartment']===$idDepartment) echo "selected" ?>>
                         <?php echo $department['nomDepartment'] ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span>Recherche</button> 
                </form><br>
                <a href="AddEmployee.php"><button type="button" class="btn btn-default btn-success">ADD</span></a>
                    </table>
					</section>
		<section class="table__body">
<table>
	<thead>
		<tr>
			<th>Id Employee</th>
			<th>Nom</th>
			<th>Date Embauche</th>
			<th>Adresse</th>
			<th>Departement</th>
			<th>photo</th>
			<th>option</th>
		</tr>
	</thead>
	<tbody>
	<?php while ($employee=$resultatEmp->fetch()) { ?>
		<tr>
		<td> <?php echo $employee['idEmployee'] ?></td>
		<td> <?php echo $employee['nom'] ?></td>
		<td> <?php echo $employee['dateEmbauche'] ?></td>
		<td><?php echo $employee['adresse'] ?></td>
		<td><?php echo $employee['nomDepartment'] ?></td>
		<td><img src="../images/<?php echo $employee['photo'] ?>"
                                        style="width:50px;height:50px;"></td>
		<td>
		<a href="EditEmployee.php?idEmployee=<?php echo $employee['idEmployee'] ?>"><button type="button" class="btn edit">Edit</button></a>
                                         <a onclick="return confirm('Etes vous sur de vouloir supprimer ce Employee')"
                                        href="DeleteEmployee.php?idEmployee=<?php echo $employee['idEmployee'] ?>"><button type="button" class="btn delete"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</button></a>

		</td>
	</tr>
	<?php } ?>
	</tbody>

</table>
<div>
                   <ul class="pagination">
                        <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
                            <li class="<?php if ($i == $page)
                                echo 'active' ?>">
                                    <a
                                        href="exemple.php?page=<?php echo $i; ?>&nom=<?php echo $nom ?>&idDepartment<?php echo $idDepartment ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    </div>
		</section>
	</main>
	
</body>
</html>