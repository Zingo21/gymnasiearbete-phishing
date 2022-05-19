<?php
session_start();
require_once("database_connection.php");

$sign = $_COOKIE['sign'];

$sql = "SELECT id FROM $sign WHERE fooled = :fooled";
$stm = $pdo->prepare($sql);
$stm->execute(array('fooled' => 0));
$unfooledUserArray = $stm->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT id FROM $sign WHERE fooled = :fooled";
$stm = $pdo->prepare($sql);
$stm->execute(array('fooled' => 1));
$fooledUserArray = $stm->fetchAll(PDO::FETCH_ASSOC);


$_SESSION['nextPage'] = 'second.php'; 

if (empty($fooledUserArray)){
    $id = 1;
    $fooled = 1;
    $sql = "UPDATE $sign SET fooled=:fooled WHERE id=:id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(array('fooled' => $fooled,'id' => $id));


    $nextPage = "second.php";
    $_SESSION['nextPage'] = 'second.php'; 

    $fooledCounter = 1;
    $_SESSION['fooledCounter'] = $fooledCounter;
    $_SESSION['chartData'] = '';

    $days = '';
    $_SESSION['days'] = $days;
    header("location: $nextPage");
}

if(empty($unfooledUserArray)){
    header("location:all_fooled.php");
}


$chartData = $_SESSION['chartData'];    

$days = $_SESSION['days'];
$days .= strval(substr_count($chartData, ',') + 1) . ', ';
$_SESSION['days'] = $days;

//Skriv ut rätt meddelande beroende på vilken dag det är. Om användaren har nått sista dagen med meddelanden loopas programmet tills alla är infekterade eller immuna. 

$daysNum = substr_count($days, ',');

switch($daysNum){
    case 1:
        $mess = "<h5>Dag ett. Du har fått ett email från instagram där dem förklarar att någon har försökt ta sig in på ditt konto. De rekommenderar att du klickar på länken nedan och loggar in för att sedan ändra ditt lösenord. Ovetande gav du nyss dina inloggningsuppgifter till bedragare som kommer använde dem för att skicka falska meddelanden från ditt konto till dina vänner. Än så länge är bara du infekterad men sånt här kan dra iväg snabbt.</h5><br>
        <img src=\"phishing-example-riktig.png\"";
        break;
    case 2:
        $mess = "Dag två. Bedragarna använde ditt konto för att skicka falska meddelanden till dina kompisar. Många av dem förstod att ditt konto blivit hackat men en del klickade på länken i meddelandet och följde samma steg som dig. Bedragarna har nu tillgång till deras konton och kommer skicka fler meddelanden från de kontona till deras kompisar. ";
        break;
    case 3:
        $mess = "Dag tre. Exakt samma sak händer denna dag som föregående. Dina vänners vänner får falska meddelanden och trots att många förstår att meddelanden kommer från bedragare kommer en del klicka på dem och bli infekterade. \n
        Det du har blivit utsatt för nu kallas för phishing (svenska: nätfiske) och är ett stort problem för datasäkersvärlden eftersom bedragaren inte försöker hacka in i deras system utan använder den svagaste länken i systemet: människan.";
        break;
    case 4:
        $mess = "Dag fyra. De falska meddelandena sprids mer och mer och allt fler blir infekterade av \"viruset\". \n
        Denna sortens phishing är inte den enda. En av de vanligaste sortens phishing-attacker kallas för spear phishing (svenska: spjutfiske). Som du hör på namnet fokuserar bedragaren i detta fall på en 'fisk' och tar reda på saker om personen i fråga. Saker som namn, arbetsplats, husdjur och hobbies kan användas av bedragaren för att skriva ett meddelande som ser riktigt ut.";
        break;
    case 5:
        $mess = "Dag fem. Meddelandet fortsätter spridas och fler och fler blir infekterade av det. \n
        Nu undrar du säkert vad du kan göra för att motverka phishing och svaret är enkelt: inte jättemycket. Det finns inte jättemycket du kan göra för att förhindra att du får phishingmail. Det du kan göra är att se till att du inte faller för dem genom att kolla igenom meddelandet noga. Oftast har webbsidan de försöker få dig att trycka på en snarlik URL till den riktiga men den kan skilja sig genom en exempelvis använda .nu istället för .se och vice versa. ";
        break;
    case 6:
        $mess = "<h5>Dag sex. Nu påverkas dina vänners vänners vänners vänners vänner, folk du aldrig har träffat av att du valde att trycka på en länk för 6 dagar sen. \n
        De flesta bedragare döljer sina länkar och tänker du tillbaka på meddelandet du fick första dagen ser du att det var precis vad de gjorde då. Detta för att man inte ska se att länken är fel. Genom att hoovra över länken kan du se vart den leder.</h5>\n <a href=\"vecka.nu\">Testlänk</a>";
        break;
    case 7:
        $mess = "Dag sju. Nu har du antagligen fått tillbaka ditt konto med hjälp från instagram men folk fortsätter infekteras.\n
        Phishing mail har oftast en brådskande ton för att få dig att inte tänka igenom dina handlingar. Tänkt på att aldrig klicka på en länk eller ladda ner en fil från en källa du inte litar på!";
        break;
    default:
        while (true){
            $sql = "SELECT id FROM $sign WHERE fooled = :fooled";
            $stm = $pdo->prepare($sql);
            $stm->execute(array('fooled' => 0));
            $unfooledUserArray = $stm->fetchAll(PDO::FETCH_ASSOC);

            if(empty($unfooledUserArray)){
                $nextPage = 'all_fooled.php';
                $_SESSION['nextPage'] = $nextPage;
                break;
            }
            $sql = "SELECT id FROM $sign WHERE fooled = :fooled";
            $stm = $pdo->prepare($sql);
            $stm->execute(array('fooled' => 1));
            $fooledUserArray = $stm->fetchAll(PDO::FETCH_ASSOC);

            $destructionArray = array();
            if (isset($_SESSION['fooledCounter'])){
                $fooledCounter= $_SESSION['fooledCounter'];
            }
            for($i = 0; $i < count($fooledUserArray); $i++)
            {
                for($x = 0; $x < rand(2,6); $x++)
                {
                    $fooledID = $unfooledUserArray[array_rand($unfooledUserArray)];
                    $id = $fooledID['id'];
                    $v = rand(0,4);
                    $_SESSION['id'] = $id;
                    if (in_array($id, $destructionArray)){
                        break;
                    }

                    if ($v%3 == 1)
                    {
                        $fooled = 1;
                        $fooledCounter += 1;
                    } else {
                        $fooled = 2;
                    } 
                    $sql = "UPDATE $sign SET fooled=:fooled WHERE id=:id";
                    $stmt= $pdo->prepare($sql);
                    $stmt->execute(array('fooled' => $fooled,'id' => $id));

                    $destructionArray[] = $id;        
                    
                }
            }

            $chartData = $_SESSION['chartData'];    

            $days = $_SESSION['days'];
            $days .= strval(substr_count($chartData, ',') + 1) . ', ';
            $_SESSION['days'] = $days;

            //Skriv ut rätt meddelande beroende på vilken dag det är. Om användaren har nått sista dagen med meddelanden loopas programmet tills alla är infekterade eller immuna. 

            $daysNum = substr_count($days, ',');

            $chartData = $_SESSION['chartData'];    

            $fooledNum = $fooledCounter;
            $chartData .= $fooledNum . ', ';

            $_SESSION['chartData'] = $chartData;
            $_SESSION['fooledCounter'] = $fooledCounter;
        }
        header("location:$nextPage");
}

$destructionArray = array();
if (isset($_SESSION['fooledCounter'])){
    $fooledCounter= $_SESSION['fooledCounter'];
}   else{
    $fooledCounter = 1;
}
for($i = 0; $i < count($fooledUserArray); $i++)
{
    for($x = 0; $x < rand(2,6); $x++)
    {
        $fooledID = $unfooledUserArray[array_rand($unfooledUserArray)];
        $id = $fooledID['id'];
        $v = rand(0,4);
        $_SESSION['id'] = $id;
        if (in_array($id, $destructionArray)){
            break;
        }

        if ($v%3 == 1)
        {
            $fooled = 1;
            $fooledCounter += 1;
        } else {
            $fooled = 2;
        } 
        $sql = "UPDATE $sign SET fooled=:fooled WHERE id=:id";
        $stmt= $pdo->prepare($sql);
        $stmt->execute(array('fooled' => $fooled,'id' => $id));

        $destructionArray[] = $id;        
        
    }
}




$chartData = $_SESSION['chartData'];    

$fooledNum = $fooledCounter;
$chartData .= $fooledNum . ', ';

$_SESSION['chartData'] = $chartData;
$_SESSION['fooledCounter'] = $fooledCounter;

//Skicka rätt meddelande till sidan.
$_SESSION['mess'] = $mess;

$nextPage = $_SESSION['nextPage'];
header("location: $nextPage");

?>