<?php
    require_once("session.php");

    require_once('connexiondb.php');

    $idEmp=isset($_POST['idEmp'])?$_POST['idEmp']:0;

    $montant=isset($_POST['montant'])?$_POST['montant']:"";

    $requete="update salaire set montant=? where idEmp=?";

    $params=array($montant,$idEmp);

    $resultat=$pdo->prepare($requete);

    $resultat->execute($params);
    
    header('location:Salaire.php');
?>