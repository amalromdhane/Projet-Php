<?php
require_once("session.php");
    require_once('connexiondb.php');
    
    $nom=isset($_POST['nom'])?$_POST['nom']:"";
    $Responsable=isset($_POST['Responsable'])?strtoupper($_POST['Responsable']):"";
    
    $requete="insert into department(nomDepartment,Responsable) values(?,?)";
    $params=array($nom,$Responsable);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:department.php');
?>