<?php
    require_once("session.php");
    require_once('connexiondb.php');
    $idDepartment=isset($_POST['idDepartment'])?$_POST['idDepartment']:0;
    echo $idDepartment;

   
    $nomDepartment = isset($_POST['nomDepartment'])?$_POST['nomDepartment']:"";
    echo $nomDepartment ;
    $Responsable = isset($_POST['Responsable'])?$_POST['Responsable']:"";
    echo $Responsable ;
    
    
    $requete="UPDATE department SET nomDepartment=?,Responsable=? WHERE idDepartment=?";
    $params=array($nomDepartment,$Responsable,$idDepartment);
   

    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:departements.php');
    

?>
