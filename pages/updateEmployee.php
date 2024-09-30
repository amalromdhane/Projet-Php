<?php
    require_once("session.php");
    ini_set('upload_max_filesize', '10M');
    require_once('connexiondb.php');
    $idEmp=isset($_POST['idEmployee'])?$_POST['idEmployee']:0;
    echo $idEmp ;
    $nom=isset($_POST['nom'])?$_POST['nom']:"";
    echo $nom;
    $dateEmbauche=isset($_POST['dateEmbauche'])?$_POST['dateEmbauche']:"";
    echo $dateEmbauche;
    $adresse=isset($_POST['adresse'])?$_POST['adresse']:"";
    echo $adresse;
    $idDepartment=isset($_POST['idDepartment'])?$_POST['idDepartment']:1;
    echo $idDepartment;
   

   /* $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    echo $nomPhoto;
    $imageTemp=$_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../images/".$nomPhoto);*/
    $nomPhoto = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : "";
    $imageTemp = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : "";
    
    echo "Nom de la photo: " . $nomPhoto . "<br>";
    echo "Chemin temporaire: " . $imageTemp . "<br>";
    
    move_uploaded_file($imageTemp, "../images/" . $nomPhoto);
    if ($_FILES['photo']['error'] != UPLOAD_ERR_OK) {
        echo "File upload failed with error code: " . $_FILES['photo']['error'];
    }
    
     
    echo $imageTemp;
    //if(!empty($nomPhoto)){
        $requete="UPDATE employee SET nom=?,dateEmbauche=?,adresse=?,idDepartment=?,photo=? WHERE idEmployee=?";
        $params=array($nom,$dateEmbauche,$adresse,$idDepartment,$nomPhoto,$idEmp);
    /*}else{
        $requete="UPDATE employee SET nom=?,dateEmbauche=?,adresse=?,idDepartment=? WHERE idEmployee=?";
        $params=array($nom,$dateEmbauche,$adresse,$idDep,$idEmp);
    }*/

    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:employee.php');
    

?>
