<?php
require_once("session.php");
require_once('connexiondb.php');

$login = isset($_GET['login']) ? $_GET['login'] : "";
$requeteUser = "select * from utilisateur where login like '%$login%'";
$resultatUser = $pdo->query($requeteUser);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/chatstyle.css">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
        <section class="users">
            <header>
            <div class="content">
            <img src="<?php echo $_SESSION['user']['img'] ?>">
            <div class="details">
			<span><?php echo  ' '.$_SESSION['user']['login']?> </span>
                    <p>Active Now</p>
                </div>
                </div>
                <a href="chartjs.php" class="logout">logout</a>
            </header>
           
            <div class="search">
            <span class="text">Select user to start chat</span>
            <input type="text" class="input" placeholder="Enter Name..">
            <i class="fa fa-search"></i>
            </div>
         <div class="users-list">
        
         </div> 
         <script src="../js/search.js">  </script>  
</body>
</html>