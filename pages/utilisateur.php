
<?php
require_once("session.php");
require_once("connexiondb.php");
$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

// Vérifier si l'utilisateur est connecté et a le rôle de visiteur
if ($_SESSION['user']['role'] == 'VISITEUR') {
    // Si c'est un visiteur, modifier la requête pour sélectionner seulement son propre compte
    $requeteUser = "SELECT * FROM utilisateur WHERE login = '{$_SESSION['user']['login']}'";
    $resultatUser = $pdo->query($requeteUser);
} else {
    // Sinon, effectuer la requête normale pour les administrateurs
    $login = isset($_GET['login']) ? $_GET['login'] : "";
    $requeteUser = "SELECT * FROM utilisateur WHERE login LIKE '%$login%'
    limit $size
     offset $offset";
      $resultatUser = $pdo->query($requeteUser);
    $requeteCount = "select count(*) countUser from utilisateur";
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
$nbrUser = $tabCount['countUser'];
$reste = $nbrUser % $size;
   if ($reste === 0)
    $nbrPage = $nbrUser / $size;
   else
    $nbrPage = floor($nbrUser / $size) + 1;
}




?>
<!DOCTYPE HTML>
<HTML>

<head>
    <meta charset="utf-8">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <!--link rel="stylesheet" type="text/css" href="../css/monstyle.css"-->
    <link rel="stylesheet" href="../css/styless.css">
</head>

<body>

    <?php include("home.php"); ?>
    <main class="table"><h1>Liste Des utilisateurs</h1> 
	<section class="table__head">
    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                <form method="get" action="utilisateur.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="login" placeholder="Login" class="form-control"
                            value="<?php echo $login ?>" />
                    
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>
                        Chercher...
                    </button>
                    </div>
                </form>
                
            <div class="panel-heading">
            </div>
            <?php } ?>
            </section>
            <section class="table__body">
                    <table>
                    <thead>
                        <tr>
                            <th>login</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($user = $resultatUser->fetch()) { ?>
                            <tr class="<?php echo $user['etat'] == 1 ? 'success' : 'danger' ?>">
                                <td>
                                    <?php echo $user['login'] ?>
                                </td>
                                <td>
                                    <?php echo $user['email'] ?>
                                </td>
                                <td>
                                    <?php echo $user['role'] ?>
                                </td>
                                <td>
                                <img src="../images/<?php echo $user['img'] ?>"
                                        style="width:20px;height:20px;">
                                </td>

                                
                                <td>
                                <?php if ($_SESSION['user']['role'] == 'VISITEUR') { ?>
                                    <a href="editerUtilisateur.php?iduser=<?php echo $user['iduser'] ?>">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                <?php } ?>    
                                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                                    &nbsp;&nbsp;
                                    <a onclick="return confirm('Etes vous sur de vouloir supprimer cet utilisateur')"
                                        href="supprimerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                    &nbsp;&nbsp;
                                    <a
                                        href="activerUtilisateur.php?idUser=<?php echo $user['iduser'] ?>&etat=<?php echo $user['etat'] ?>">
                                        <?php
                                        if ($user['etat'] == 1)
                                            echo '<span class="glyphicon glyphicon-remove"></span>';
                                        else
                                            echo '<span class="glyphicon glyphicon-ok"></span>';
                                        ?>
                                    </a>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                 </table>
                    <div>
                    <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
                            <li class="<?php if ($i == $page)
                                echo 'active' ?>">
                                    <a href="utilisateur.php?page=<?php echo $i; ?>&login=<?php echo $login ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
                </section> 
            </div>
        </div>
    </div>
    </div>
  </div>
    

   
   
</body>

</HTML>