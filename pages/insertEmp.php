<?php
require_once("session.php");
require_once('connexiondb.php');

// Récupération des données du formulaire
$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : "";
$gender = isset($_POST['gender']) ? $_POST['gender'] : "";
$dateN = isset($_POST['dateN']) ? $_POST['dateN'] : "";
$cne = isset($_POST['cne']) ? $_POST['cne'] : "";
$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : "";
$adresse = isset($_POST['adresse']) ? $_POST['adresse'] : "";
$dateEmbauche = isset($_POST['dateEmbauche']) ? $_POST['dateEmbauche'] : "";
$nomPhoto = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : "";
$imageTemp = $_FILES['photo']['tmp_name'];
move_uploaded_file($imageTemp, "../images/" . $nomPhoto);
$idDepartment = isset($_POST['idDepartment']) ? $_POST['idDepartment'] : 1;


    $requete = "INSERT INTO employer (fullname, gender, dateN, cne, mobile, adresse, dateEmbauche, photo, idDepartment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params = array($fullname, $gender, $dateN, $cne, $mobile, $adresse, $dateEmbauche, $nomPhoto, $idDepartment);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('location:employee.php');

?>