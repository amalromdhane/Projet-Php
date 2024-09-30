<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chartJs</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/styless.css">
    
    <style>
    #chartContainer {
        width: 450px;
        height: 550px;
        /* Ajoutez d'autres styles si nécessaire */
    }
    .card{
     border-radius: 20px;
     box-shadow:  3px 6px 9px rgba(0,0,0,.3);
     /*background-color: white;*/
     width:600px;
     height:500px;
     margin-left:789px;
     margin-top:70px;
    background-color: rgba(255, 255, 255, 0.5); 
      }
    .card {
     border-radius: 10px;
     box-shadow:  3px 6px 9px rgba(0,0,0,.3);
     /*background-color: white;*/
     width:450px;
     height:480px;
     margin-left:2px;
     margin-top:50px;
     background-color: rgba(255, 255, 255, 0.5); 
    }
    .card1 {
	  width: 290px;
    height: 110px;
	  border-radius: 0px;
	  box-shadow: 4px 4px 16px rgba(0, 0, 0, .05);
    background-color: rgba(255, 255, 255, 0.5);
    transition: transform 0.3s ease; 
    }
    .card1:hover {
        transform: scale(1.1);
    }
.card:hover {
    background-color: #f0f0f0;
    cursor: pointer; 
}


</style>
    
</head>


<?php 
require_once("session.php");
require_once("connexiondb.php");
$requeteCount = "select count(*) countUser from utilisateur";
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrUser = $tabCount['countUser'];
/********************************************* */


$nom = isset($_GET['nom']) ? $_GET['nom'] : "";
$requeteCount = "select count(*) countF from department
where nomDepartment like '%$nom%'";
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrDepartment = $tabCount['countF'];

$fullname=isset($_GET['fullname'])?$_GET['fullname']:"";
$requeteCount="select count(*) count from employer
where fullname like '%$fullname%'";
$resultatCount=$pdo->query($requeteCount);
    $tabCount=$resultatCount->fetch();
    $nbrEmp=$tabCount['count'];
/********************************************** */
 $pdo = new PDO("mysql:host=localhost;dbname=gestion_stag","root", "");
 $query = $pdo->query("
   SELECT COUNT(e.idEmp) AS totalEmployees, d.nomDepartment
   FROM department AS d
   LEFT JOIN employer AS e ON d.idDepartment = e.idDepartment
   GROUP BY nomDepartment
");
 foreach ($query as $data) {
    $Department[] = $data['nomDepartment'];
    $Employer[] = $data['totalEmployees'];
}
/********pieChart*****************/
// Query to get the count of men and women
$query1 = "SELECT gender, COUNT(*) as count FROM employer GROUP BY gender";
$result = $pdo->query($query1);
$data1 = $result->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for Chart.js
$labels = [];
$counts = [];
$colors = [];

foreach ($data1 as $row) {
    $labels[] = $row['gender'];
    $counts[] = $row['count'];

    // Assign colors based on gender
    $colors[] = ($row['gender'] == 'M') ? 'rgb(54, 162, 235)' : 'rgb(255, 99, 132)';
}
?>

<body>
<?php include("home.php"); ?>
<!-------------------------->
<main>
			<div class="info-data">
				<div class="card1 " style="background-color:paleturquoise;">
					<div class="head" >
						<div>
							<h2>Employees</h2>
             <h2> <?php echo $nbrEmp ?></h2><br>
             
						</div>
            <i class='bx bxs-group'style="font-size:30px;"></i>
           
					</div>
				</div>
				<div class="card1" style=" background-color:rgb(250, 123, 72);">
					<div class="head">
						<div>
							<h2>Department</h2>
							<h2><?php echo $nbrDepartment ?></h2>

						</div>
            <i class='bx bxs-building' style="font-size:30px;"></i>
            
					</div>
				</div>
				<div class="card1"  style=" background-color:rgb(7, 227, 143);">
					<div class="head">
						<div>
            <h2>Utilisateurs</h2>
            <h2> <?php echo $nbrUser ?></h2><br>
						</div>
            <i class='bx bx-group' style="font-size:30px;"></i>
					</div>
				</div>
				<div class="card1"  style=" background-color:rgb(243, 185, 221);">
					<div class="head">
						<div>
            <h2> Date</h2>
            <h4><?php
            function currentDateTime() {
                $dateTime = date('d/m/Y h:i:s a', time());
                echo $dateTime;
            }
            currentDateTime();
            ?></h4>
						</div>
						<i class='bx bxs-calendar' style="font-size:30px;"></i>
					</div>
				</div>
			</div>
			
					
				</div>
				
					
				</div>
			</div>
		</main>
<!------------------------------->
<div class="card col-md-6 " style="width:750px;">   
        <canvas id="myChart"></canvas>
</div>
<div class="card col-md-6" style="">
      <canvas id="piechart" ></canvas>
</div>
</div>  
<script>
const labels = <?php echo json_encode($Department) ?>;
const data = {
  labels: labels,
  datasets: [{
    label: 'Employer par Departement',
    data: <?php echo json_encode($Employer) ?>,
    backgroundColor: [
      'rgba(255, 99, 255, 0.4)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};
const config = {
  type: 'bar',
  data: data,
  options: {
    animation: {
                    duration: 2000, 
                    easing: 'easeInOutQuart', 
                   
                },
    scales: {
      y: {
        beginAtZero: true
      }
    },
    responsive: true,
    maintainAspectRatio: false, 
    width: 450,
    height: 550,
    position: 'right' 
  },
};

var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
  /******pieChart******/
  const pieChartData = {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [{
      label: 'Gender Distribution',
      data: <?php echo json_encode($counts); ?>,
      backgroundColor: <?php echo json_encode($colors); ?>,
      hoverOffset: 4
    }]
  };

  const pieChartConfig = {
    type: 'doughnut',
    data: pieChartData,
  };

  var myPieChart = new Chart(
    document.getElementById('piechart'),
    pieChartConfig
  );
    </script>
</body>
</html>
