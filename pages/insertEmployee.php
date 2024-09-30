<?php
    require_once("session.php");
    require_once('connexiondb.php');
    $nom=isset($_POST['nom'])?$_POST['nom']:"";
    $dateEmbauche=isset($_POST['dateEmbauche'])?$_POST['dateEmbauche']:"";
    $adresse=isset($_POST['adresse'])?$_POST['adresse']:"";
    $idDepartment=isset($_POST['idDepartment'])?$_POST['idDepartment']:1;

    $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTemp=$_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../images/".$nomPhoto);

    $requete="insert into employee(nom,dateEmbauche,adresse,idDepartment,photo) values(?,?,?,?,?)";
    $params=array($nom,$dateEmbauche,$adresse,$idDepartment,$nomPhoto);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:employee.php');

?>