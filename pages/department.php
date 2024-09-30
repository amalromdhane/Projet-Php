<?php
require_once("session.php");
require_once("connexiondb.php");

$nom = isset($_GET['nom']) ? $_GET['nom'] : "";
$responsable = isset($_GET['responsable']) ? $_GET['responsable']:"all";

$size = isset($_GET['size']) ? $_GET['size'] : 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

if ($responsable == "all") {
    $requete = "select * from department
            where nomDepartment like '%$nom%'
            order by idDepartment     
            limit $size
            offset $offset";
    $requeteCount = "select count(*) countF from department
                where nomDepartment like '%$nom%'";

} else {
    $requete = "select * from department
            where nomDepartment like '%$nom%'and
            responsable='$responsable' 
            order by idDepartment 
            limit $size
            offset $offset";
    $requeteCount = "select count(*) countF from department
            where nomDepartment like '%$nom%'
            and responsable='$responsable' ";

}

$resultatF = $pdo->query($requete);
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrDepartment = $tabCount['countF'];
$reste = $nbrDepartment % $size;
if ($reste === 0)
    $nbrPage = $nbrDepartment / $size;
else
    $nbrPage = floor($nbrDepartment / $size) + 1;
?>

<!DOCTYPE HTML>
<HTML>

<head>
    <meta charset="utf-8">
    <title>Gestion des Departments</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <!--link rel="stylesheet" type="text/css" href="../css/monstyle.css"-->
    <link rel="stylesheet" href="../css/styless.css">
</head>

<body>
    <!--?php include("menu.php"); ?-->
    <?php include("home.php"); ?>
    
    <main class="table"><h1>Liste Des Department</h1> 
	<section class="table__head">
            
                <form method="get" action="department.php" class="form-inline col-md-6">
                    <div class="form-group">
                        <input type="text" name="nom" placeholder="Department Name" class="form-control"
                            value="<?php echo $nom ?>" />
                    <button type="submit" class="btn btn-info"><span
                            class="glyphicon glyphicon-search"></span>Recherche</button>
                            </div>
                </form>

                 <div class="panel-heading col-md-4" style="width: 1235px;">
                        <?php echo $nbrDepartment ?> departments
                </div>
                <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                        <a href="AddDepartment.php"><button class="btn btn-default btn-success " style="margin-left:1000px;"> <span>ADD</span></button>
                                    </span></a>
                    <?php } ?>
                
                        </section>
		                <section class="table__body">
                          <table>
                            <thead>
                                <tr>
                                    <th> Id Department</th>
                                    <th> Nom Department</th>
                                    <th> Responsable Department</th>
                                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                        <th> Option</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($department = $resultatF->fetch()) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $department['idDepartment'] ?>
                                        </td>
                                        <td>
                                            <?php echo $department['nomDepartment'] ?>
                                        </td>
                                        <td>
                                            <?php echo $department['Responsable'] ?>
                                        </td>
                                        <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                            <td>
                                            <a href="EditDepartment.php?idDepartment=<?php echo $department['idDepartment'] ?>">
                                    <button type="button" class="btn btn-primary btn-info">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    </button>
                                    </a>
                                            <a href="DeleteDepartment.php?idDepartment=<?php echo $department['idDepartment'] ?>"><button
                                                        type="button" class="btn btn-default btn-danger">
                                                        <span
                                                            class="glyphicon glyphicon-trash">
                                                        </span>&nbsp;Delete</button>
                                                </a>
                                            </td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
                                    <li class="<?php if ($i == $page)
                                        echo 'active' ?>">
                                            <a
                                                href="department.php?page=<?php echo $i; ?>&nom=<?php echo $nom ?>&responsable=<?php echo $responsable ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</HTML>