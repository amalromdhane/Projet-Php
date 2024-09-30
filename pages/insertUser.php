<?php
require_once("session.php");
    require_once('connexiondb.php');
    
    $logIn=isset($_POST['login'])?$_POST['login']:"";
    $mail=isset($_POST['email'])?$_POST['email']:"";
    $role=isset($_POST['role'])?$_POST['role']:"";
    $Etat=isset($_GET['etat'])?$_GET['etat']:0;
    $pwd=isset($_POST['etat'])?$_POST['etat']:2;


    $Responsable=isset($_POST['Responsable'])?($_POST['Responsable']):"";
    
    $requete="insert into utilisateur(login,Responsable,role) values(?,?)";
    $params=array($logIn,$mail,$role,$Etat);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:departements.php');
?>