<?php
        session_start();
        if(isset($_SESSION['user']) ){
            
            //if($_SESSION['user']['role']=='ADMIN'){*/
                //require_once("session.php");

                require_once('connexiondb.php');
                
                $idEmp=isset($_GET['idEmp'])?$_GET['idEmp']:0;

                $requete="delete from employer where idEmp=?";
                
                $params=array($idEmp);
                
                $resultat=$pdo->prepare($requete);
                
                $resultat->execute($params);
                
                header('location:employee.php'); 
                
            /*}else{
                $message="Vous n'avez pas le privilège de supprimer un stagiaire!!!";
                
                $url='stagiaires.php';
                
                header("location:alerte.php?message=$message&url=$url"); 
            }*/
           
        }else {
                header('location:login.php');
        }
?>