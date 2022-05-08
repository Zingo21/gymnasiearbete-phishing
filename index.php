<?php
session_start();
$mess=isset($_GET["mess"]) ? "<p class='text-error'>".$_GET['mess']. "</p>" : "";
if(!isset($_COOKIE['sign'])) {
    header("location:firsttime.php");
}
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
                        <li><a href="second.php">Phishing</a></li>
                        <li><a href="#">Teori</a></li> <!-- Lägg till länk till teoridelen -->
                        <li><a href="https://www.github.com/Zingo21/gymnasiearbete-phishing">Github</a></li>
                    </ul>
            
                </div>
            </nav>
        </div>
        <ul class="side-nav" id="mobile-demo">
            <li><a class="waves-effect waves-light btn blue darken-3" href="index.php"><i class="material-icons left">home</i>Startsida</a></li> 
            <li><a class="waves-effect waves-light btn blue darken-3" href="second.php">Phishing</a></li> 
            <li><a class="waves-effect waves-light btn blue darken-3" href="#">Teori</a></li>   <!-- Lägg till länk till teoridelen -->
            <li><a class="waves-effect waves-light btn blue darken-3" href="https://www.github.com/Zingo21/gymnasiearbete-phishing">Github</a></li>
        </ul>

        <header class="main-text">
            <h1>Phishing</h1>
            
        
            <h5><a href="fooling.php" class="waves-effect waves-light btn blue darken-1">Gå till applikationen</a></h5>
            <h5><a href="theory.php" class="waves-effect waves-light btn blue darken-1">Läs teorin</a></h5>         <!-- Lägg till länk till teoridelen -->

            <?php
            
            echo $mess; 
            ?>
            <br>
            <br>
        </header>
        <br>
    </body>
</html>