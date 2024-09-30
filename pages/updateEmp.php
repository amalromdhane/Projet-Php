<?php
    require_once("session.php");
    ini_set('upload_max_filesize', '10M');
    require_once('connexiondb.php');
    $idEmp=isset($_POST['idEmp'])?$_POST['idEmp']:0;
    echo $idEmp ;
    $fullname = isset($_POST['fullname'])?$_POST['fullname']:"";
    echo $fullname ;
    $gender = isset($_POST['gender'])?$_POST['gender']:"";
    echo $gender ;
    $dateN = isset($_POST['dateN'])?$_POST['dateN']:"";
    echo $dateN ;
    $cne = isset($_POST['cne'])?$_POST['cne']:"";
    echo $cne ;
    $mobile = isset($_POST['mobile'])?$_POST['mobile']:"";
    echo $mobile ;
    $adresse=isset($_POST['adresse'])?$_POST['adresse']:"";
    echo $adresse;
    $dateEmbauche=isset($_POST['dateEmbauche'])?$_POST['dateEmbauche']:"";
    echo $dateEmbauche;
    $nomPhoto = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : "";
    $imageTemp = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : "";
    
    echo "Nom de la photo: " . $nomPhoto . "<br>";
    echo "Chemin temporaire: " . $imageTemp . "<br>";
    
    move_uploaded_file($imageTemp, "../images/" . $nomPhoto);
    if ($_FILES['photo']['error'] != UPLOAD_ERR_OK) {
        echo "File upload failed with error code: " . $_FILES['photo']['error'];
    }
    
     
    echo $imageTemp;

    $idDepartment=isset($_POST['idDepartment'])?$_POST['idDepartment']:1;
    echo $idDepartment;
   

   /* $nomPhoto=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    echo $nomPhoto;
    $imageTemp=$_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../images/".$nomPhoto);*/
   
    //if(!empty($nomPhoto)){
        $requete="UPDATE employer SET fullname=?,gender=?,dateN=?,cne=?,mobile=?,adresse=?,dateEmbauche=?,photo=?,idDepartment=? WHERE idEmp=?";
        $params=array($fullname,$gender,$dateN,$cne,$mobile,$adresse,$dateEmbauche,$nomPhoto,$idDepartment,$idEmp);
    /*}else{
        $requete="UPDATE employee SET nom=?,dateEmbauche=?,adresse=?,idDepartment=? WHERE idEmployee=?";
        $params=array($nom,$dateEmbauche,$adresse,$idDep,$idEmp);
    }*/

    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:employee.php');
    

?>
