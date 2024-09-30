<?php
require_once("session.php");
require_once("connexiondb.php");

$fullname = isset($_GET['fullname']) ? $_GET['fullname'] : "";
$idDepartment = isset($_GET['idDepartment']) ? $_GET['idDepartment'] : 0;

$size = isset($_GET['size']) ? $_GET['size'] : 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

if ($_SESSION['user']['role'] == 'VISITEUR') {
    // Si c'est un visiteur, modifier la requête pour sélectionner seulement son propre compte
    $requeteUser = "SELECT e.fullname, d.nomDepartment, s.montant
    FROM employer e
    LEFT JOIN department d ON e.idDepartment = d.idDepartment
    LEFT JOIN salaire s ON e.idEmp = s.idEmp
    WHERE e.fullname = '{$_SESSION['user']['login']}'";
    $resultatUser = $pdo->query($requeteUser);
    $sal = $resultatUser->fetch();
}

$requeteDep = "SELECT * FROM department";
$resultatDep = $pdo->query($requeteDep);
if($idDepartment == 0) {
$requeteS = "SELECT e.idEmp, e.fullname, d.nomDepartment, d.idDepartment, s.montant
            FROM department AS d
            INNER JOIN employer AS e ON d.idDepartment = e.idDepartment
            LEFT JOIN salaire AS s ON e.idEmp = s.idEmp
            WHERE e.fullname LIKE '%$fullname%'
            ORDER BY e.fullname
            LIMIT $size
            OFFSET $offset";}
            else{
                $requeteS = "SELECT e.idEmp, e.fullname, d.nomDepartment, d.idDepartment, s.montant
                FROM department AS d
                INNER JOIN employer AS e ON d.idDepartment = e.idDepartment
                LEFT JOIN salaire AS s ON e.idEmp = s.idEmp
                WHERE e.fullname LIKE '%$fullname%'
                and  d.idDepartment = '$idDepartment'
                ORDER BY e.fullname
                LIMIT $size
                OFFSET $offset";   
            }
$resultatS = $pdo->query($requeteS);



$requeteCount = "SELECT COUNT(*) AS count FROM employer WHERE fullname LIKE '%$fullname%'";
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrEmp = $tabCount['count'];
$reste = $nbrEmp % $size;
$nbrPage = ($reste === 0) ? $nbrEmp / $size : floor($nbrEmp / $size) + 1;
?>

<!DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Gestion des Salaires</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/styless.css">
</head>

<body>
    <?php include("home.php"); ?>
    <main class="table">
        <h1>Liste Des Salaires</h1>
        <section class="table__head">
            <form method="get" action="Salaire.php" class="form-inline">
                <div class="form-group">
                    <label for="idDepartment">Departement: &nbsp;</label>
                    <select name="idDepartment" class="form-control" id="idDepartment" onchange="this.form.submit()">
                        <option value=0>Toutes les départements</option>
                        <?php while ($department = $resultatDep->fetch()) { ?>
                            <option value="<?php echo $department['idDepartment'] ?>"<?php if ($department['idDepartment'] === $idDepartment) echo "selected" ?>>
                                <?php echo $department['nomDepartment'] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span>Recherche</button>
                </div>
            </form>
            <br>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Nom Employé</th>
                        <th> Nom département</th>
                        <th> Salaire</th>
                        <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                            <th> Option</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($_SESSION['user']['role'] == 'VISITEUR') { ?>
                        <?php while ($sal = $resultatUser->fetch()) { ?>
                        <tr>
                            <td><?php echo $sal['fullname']; ?></td>
                            <td><?php echo $sal['nomDepartment']; ?></td>
                            <td><?php echo $sal['montant']; ?></td>
                        </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <?php while ($salaire = $resultatS->fetch()) { ?>
                            <tr>
                                <td><?php echo $salaire['fullname'] ?></td>
                                <td><?php echo $salaire['nomDepartment'] ?></td>
                                <td><?php echo $salaire['montant'] ?></td>
                                <td>
                                    <?php if ($_SESSION['user']['role'] == 'ADMIN' && !empty($salaire['montant'])) { ?>
                                        <a href="EditSalaire.php?idEmp=<?php echo $salaire['idEmp'] ?>">
                                            <button type="button" class="btn btn-primary btn-info">
                                                <span class="glyphicon glyphicon-edit"></span>&nbsp;Edit
                                            </button>
                                        </a>
                                    <?php } ?>
                                    <?php if (empty($salaire['montant'])) { ?>
                                        <a href="addSalaire.php?idEmp=<?php echo $salaire['idEmp'] ?>&idDepartment=<?php echo $salaire['idDepartment'] ?>">
                                            <button type="button" class="btn btn-primary btn-success">
                                                <span class="glyphicon glyphicon-plus"></span>&nbsp;ADD
                                            </button>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
            <div>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
                        <li class="<?php if ($i == $page) echo 'active' ?>">
                            <a href="Salaire.php?page=<?php echo $i; ?>&fullname=<?php echo $fullname ?>&idDepartment=<?php echo $idDepartment ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </section>
    </main>
</body>
</HTML>
