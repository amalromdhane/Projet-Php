
<?php

require_once("session.php");
require_once("connexiondb.php");

$idEmp = isset($_POST['idEmp']) ? $_POST['idEmp'] : 0;
$idDepartment = isset($_POST['idDepartment']) ? $_POST['idDepartment'] : 0;

    $montant = isset($_POST['montant']) ? $_POST['montant'] : 0;

    if (!empty($montant)) {
       
        $requete = "INSERT INTO salaire (idEmp,idDepartment,montant) VALUES (?,?,?)";
        $params = array($idEmp,$idDepartment,$montant);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

       
        header('location:Salaire.php');
        exit();
    } else {
        
        $erreur = "Veuillez saisir un montant de salaire.";
    }
?>