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
                    <a href="#" class="brand-logo">Gymnasiearbete phishing</a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="index.php">Start</a></li> 
                        <li><a href="teori.php">Teori</a></li> 
                        <li><a href="https://www.github.com/Zingo21/gymnasiearbete-phishing">Github</a></li> <!-- Lägg till länkar vid behov -->
                    </ul>
            
                </div>
            </nav>
        </div>
        <ul class="side-nav" id="mobile-demo">
            <li><a class="waves-effect waves-light btn blue darken-3" href="#"><i class="material-icons left">home</i>Startsida</a></li> 
            <li><a class="waves-effect waves-light btn blue darken-3" href="#">Phishing</a></li> 
            <li><a class="waves-effect waves-light btn blue darken-3">Länk</a></li>
            <li><a class="waves-effect waves-light btn blue darken-3" href="https://www.github.com/Zingo21/gymnasiearbete-phishing">Github</a></li><!-- Lägg till länkar vid behov -->
        </ul>

        <header class="main-text">
            <h1>Phishing</h1>
            <h5>
            Internet växer varje dag och tillsammans med internet växer farorna med det. År 2000 använde 7% av världens befolkning internet, tio år senare har det talet mer än fyrdubblats till 29%. 2020 använde 60% av världens befolkning internet (worldbank.org).  
            </h5>
            <iframe src="https://data.worldbank.org/share/widget?end=2020&indicators=IT.NET.USER.ZS&start=2000&view=chart" width='450' height='300' frameBorder='0' scrolling="no" ></iframe>

            <h5>
            Cyberkriminella har idag över 5 miljarder potentiella offer och därför behövs program som visar vad vanliga människor ska se upp med på internet. Om vi vet vad vi ska leta efter för att ta reda på om det är bedrägeri eller inte kommer bedragare ha mycket svårare att hitta offer. 
            </h5>
            <h5>
            Generella kännetecken av phishing är att meddelandet är stressande och innehåller en
            brådskande ton. Genom att stressa upp offret kan angriparen få denne att begå misstag
            och inte tänka igenom sina beslut. Metoden går ut på att få offret att öppna ett dokument,
            ladda ner en fil eller gå in på en webbplats. Målet med detta är att infektera enheten med
            skadlig kod och/eller komma över höga behörigheter som ett första steg i ett mer
            omfattande angrepp.
            </h5>

            <h5>
            Det finns fyra olika sätt att utföra phishingattacker. Över telefon (vishing, från engelskans voice phishing), över sms (smishing, från engelskans sms phishing), genom söktjänster (SEO phishing) och över email/chattjänster (email phishing). 96% av alla phishingattacker utförs över email, 3% över skadliga webbplatser och endast 1% över mobila enheter, både SMS och telefonsamtal (Data Breach Investigation Report, Verizon 2021).
            </h5>

            <h5>
            Skillnaden mellan smishing och vishing är minimal. Det som skiljer dem åt är vilket medel bedragaren använder för att uppnå sitt mål. Bedragaren kontaktar dig och låtsas vara från banken och berättar att det har skett misstänkt aktivitet på ditt konto. Detta för att stressa upp dig och hindra dig från att tänka igenom dina handlingar. De fortsätter sedan med att be dig logga in på ditt bankkonto genom en falsk länk som de skickar till dig. Sidan kommer se ut precis som din banks sida men när du loggar in skickas dina bankuppgifter till bedragarna. Bedragarna kommer sedan be dig identifiera dig genom bankID vilket ger dem full kontroll över ditt konto
            </h5>

            <h5>
            SEO phishing innebär att bedragaren genom search engine optimisation (svenska: sökmotoroptimering) försöker få sin sida på Googles första sida så att du klickar på den falska sidan istället för den riktiga sidan. Exempelvis om du söker efter Facebook så kommer den falska sidan vara högst upp med en snarlik URL. När du sedan försöker logga in på ditt Facebookkonto kommer din information istället sparas på bedragarnas databas och de kan sedan logga in på ditt konto.
            </h5>

            <h5>
            Email phishing innebär att bedragaren skickar skadliga filer eller hemsidor till dig genom e-post. Bedragaren utger sig ofta för att vara ett företag som du kan lita på. Oftast försöker bedragarna få dig att ladda ner en bilaga som kan vara malware. De kontaktar dig sedan och kräver pengar för att de ska ta bort viruset från din dator.
            </h5>

            <h5>
            Utöver detta går det att dela in phishing i två kategorier, riktat fiske (engelska: spear phishing) och brett nätfiske (engelska: email phishing). Spear phishing går ut på att bedragaren tar reda på saker om just dig och sedan skräddarsyr sin attack för just dig. Ditt namn, din arbetsplats, dina hobbies och dina chefer är saker som bedragaren kan ta reda på och använda för att få attacken att se så riktig ut som möjligt. Brett nätfiske kallas oftast bara email phishing och är ett generellt meddelande som skickas ut till tiotusentals läckta emails samtidigt. 
            </h5>

            
        
            <h5><a href="index.php" class="waves-effect waves-light btn blue darken-1">Gå tillbaks till startsidan</a></h5>
            <br>
            <br>
        </header>
        <br>
    </body>
</html>