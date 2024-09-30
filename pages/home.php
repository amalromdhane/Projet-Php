<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/style.css">
	<title>AdminSite</title>
    <style>
        .logo {
            margin-top: 30px;
			margin-left: 70px;
            width: 120px;
            height:120px ;
            border-radius: 50%;
            overflow: hidden;
            margin-right:20px;
           }
  </style>
</head>
<body>
	<section id="sidebar">
		<a href="#" > <img src="../images/logi.JPG" class="logo"></img></a>
		<ul class="side-menu">
			<li><a href="#" class="active"><i class='bx bxs-dashboard icon' ></i>Gestion Des Employes</a></li>
			<li class="divider" ></li>
			<li>
				<a href="chartjs.php"><i class='bx bxs-inbox icon' ></i>Home <i class='bx bx-chevron-right icon-right' ></i></a>
				
			</li>
			<li><a href="employee.php"><i class='bx bxs-chart icon' ></i>Employes</a></li>
			<li><a href="department.php"><i class='bx bxs-widget icon' ></i>Department</a></li>
			<!--?php if ($_SESSION['user']['role'] == 'ADMIN') { ?-->
				<li><a href="Salaire.php"><i class='bx bxs-dashboard icon' ></i>Salaires</a></li>
			<li><a href="utilisateur.php"><i class='bx bx-table icon' ></i>Utilisateur</a></li>  
			<li><a href="userChatApp.php"><i class='bx bx-table icon' ></i>chat</a></li>                   
            <!--?php } ?-->
			<li><a href="logout.php"><i class='bx bx-log-in'></i> Logout</a></li>
		</ul>
	</section>
	
	<section id="content">
		<nav>
			<span class="divider"></span>
			<div class="profile">
    <ul class=" navbar-nav navbar-right" style="margin-left:1120px;">	
			   <li >
			        <img src="<?php echo $_SESSION['user']['img'] ?>"style="height:20px;width:20px;">
					<?php echo  ' '.$_SESSION['user']['login']?>
					
				</a > 
			  </li>
		</ul>
			</div>
		</nav>
		
		
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="../js/script.js"></script>
</body>
</html>