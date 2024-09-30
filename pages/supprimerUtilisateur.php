<?php
     session_start();
    if(isset($_SESSION['user'])){
               
            require_once("session.php"); 
                 
            require_once('connexiondb.php');
            
            $idUser=isset($_GET['idUser'])?$_GET['idUser']:0;

            $requete="delete from utilisateur where idUser=?";
            
            $params=array($idUser);
            
            $resultat=$pdo->prepare($requete);
            
            $resultat->execute($params);
            
            header('location:utilisateur.php');   
            
     }else {
                header('location:login.php');
           }
    
?>