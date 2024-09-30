<?php
    require_once("session.php");

    require_once('connexiondb.php');
    $idDepartment=isset($_POST['idDepartment'])?$_POST['idDepartment']:1;
    echo $idDepartment;

    $nom=isset($_POST['nomDepartment'])?$_POST['nomDepartment']:"";
    echo $nom;

    $Responsable=isset($_POST['Responsable'])?($_POST['Responsable']):"";
    echo  $Responsable;
    
    $requete="update department set nomDepartment=?,Responsable=? where idDepartment=?";

    $params=array($nom,$Responsable,$idDepartment);

    $resultat=$pdo->prepare($requete);

    $resultat->execute($params);
    
    header('location:department.php');
?>
