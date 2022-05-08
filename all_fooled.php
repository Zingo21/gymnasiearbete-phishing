<?php
session_start();
require_once('database_connection.php');

$chartData = $_SESSION['chartData'];
$_SESSION['nextPage'] = 'second.php';
$days = $_SESSION['days'];
?>

<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Skript för för hamburgermeny för mindre skärmar -->
<script>
 $(document).ready(function () {
 $(".button-collapse").sideNav();
});

$(document).ready(function() {
    M.updateTextFields();
  });
</script>


<!-- CSS kod -->
<style type="text/css">
.footer-name2{
    padding-left: 500px;
}

.main-text{
    padding-left: 50px;
    padding-right: 50px;
}
</style>
<title>Gymnasiearbete phishing - Email Phishing</title>
</head>
    <body>
        <div class="navbar-fixed">
            <nav class="blue darken-3">
                <div class="nav-wrapper">
                    <a href="index.php" class="brand-logo">Gymnasiearbete phishing</a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="index.php">Start</a></li> 
                        <li><a href="resetDB.php">Phishing</a></li> 
                        <li><a href="#">Teori</a></li>      <!-- Lägg till länk till teoridelen -->
                        <li><a href="https://www.github.com/Zingo21/gymnasiearbete-phishing">Github</a></li> 
                    </ul>
            
                </div>
            </nav>
        </div>
        <ul class="side-nav" id="mobile-demo">
            <li><a class="waves-effect waves-light btn blue darken-3" href="index.php"><i class="material-icons left">home</i>Startsida</a></li> 
            <li><a class="waves-effect waves-light btn blue darken-3" href="resetDB.php">Phishing</a></li> 
            <li><a class="waves-effect waves-light btn blue darken-3" href="#">Teori</a></li>    <!-- Lägg till länk till teoridelen -->
            <li><a class="waves-effect waves-light btn blue darken-3" href="https://www.github.com/Zingo21/gymnasiearbete-phishing">Github</a></li>
        </ul>

        <header class="main-text">
            <br>
            <br>    
            <div class="container">
                <div class="row">
                    <div class="col s12 teal">
                        <h5>Det tog <?php echo substr_count($days, ',');?> dagar för alla tusen personer i testlistan att bli antingen infekterade eller åtminstone ha sett phishinglänken. Vi som har jobbat på detta projekt hoppas att ni som läser detta inte är en av de personer som faller för phishingförsök. För att lära dig identifiera phishingförsök och lära dig om olika sorters phishing kan du trycka på teoriknappen under. Vill du gå igenom programmet en gång till trycker du på starta om.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                    <h5><a href="teori.php" class="waves-effect waves-light btn blue darken-1">Gå till teorin</a></h5>
                    </div>
                    <div class="col s6">
                    <h5><a href="resetDB.php" class="waves-effect waves-light btn blue darken-1">Starta om</a></h5>
                    </div>
                </div>
            </div>
        
        </header>

    </body>
    
</html>


<!-- Chart.js (tabeller) -->
<script>
  const labels = [
    <?php echo $days;?>
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Antal lurade per dag',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [<?php echo $chartData;?>],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };
</script>

<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>