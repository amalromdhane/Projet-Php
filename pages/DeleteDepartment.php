<?php
    /*session_start();
        if(isset($_SESSION['user'])){*/
            require_once("session.php");
            require_once('connexiondb.php');
            $idf=isset($_GET['idDepartment'])?$_GET['idDepartment']:0;
/*
            $requeteStag="select count(*) countStag from stagiaire where idDepatment=$idf";
            $resultatStag=$pdo->query($requeteStag);
            $tabCountStag=$resultatStag->fetch();
            $nbrStag=$tabCountStag['countStag'];
            
            if($nbrStag==0){*/
                $requete="delete from department where idDepartment=?";
                $params=array($idf);
                $resultat=$pdo->prepare($requete);
                $resultat->execute($params);
                header('location:department.php');
          /*  }else{
                $msg="Suppression impossible: Vous devez supprimer tous les employee inscris dans cette Departement";
                header("location:alerte.php?message=$msg");*/
            //}
            
         /*}else {
                header('location:login.php');
        }*/

?>