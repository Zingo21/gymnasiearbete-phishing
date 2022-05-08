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
$days .= strval(substr_count($chartData, ',')) . ', ';
$_SESSION['days'] = $days;

//Skriv ut rätt meddelande beroende på vilken dag det är. Om användaren har nått sista dagen med meddelanden loopas programmet tills alla är infekterade eller immuna. 

$daysNum = substr_count($days, ',');

switch($daysNum){
    case 0:
        $mess = "Detta borde inte behövas";
        break;
    case 1:
        $mess = "Detta är dag ett. Tänk att du får en länk genom email från en avsändare som du tror är riktig men denna avsändare har ändrat både bokstav och lagt till nummer och språket i mailet är dålig. Du ombeds att logga in för att slutföra en bekräftelse. Efer det märker du att din enhet har blivit infekterad och det som du fick skickas vidare till dina vänner som du har i kontaktlistan.";
        break;
    case 2:
        $mess = "Detta är dag två. Några av dina vänner har fått den koden som du fick med samma innehåll som du fick. De skriver in sina inloggningsuppgifter och sen skickas det vidare till deras vänner som de har i sina kontaktlistor.";
        break;
    case 3:
        $mess = "Detta är dag tre. De andra vännerna har fått det meddelande som dina vänner har fått innan och klickar på det. Det skickas sedan vidare till deras  vänner som de har i sina kontaklistor.";
        break;
    case 4:
        $mess = "Dag fyra. Detta fortsätter tills alla har blivit infekterade.";
        break;
    case 5:
        $mess = "Och dag fem. Då har alla nu blivit infekterade och hackaren har nu kommit åt alla användares inloggningsuppgifter.";
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
            $days .= strval(substr_count($chartData, ',')) . ', ';
            $_SESSION['days'] = $days;

            //Skriv ut rätt meddelande beroende på vilken dag det är. Om användaren har nått sista dagen med meddelanden loopas programmet tills alla är infekterade eller immuna. 

            $daysNum = substr_count($days, ',');

            $chartData = $_SESSION['chartData'];    

            $fooledNum = $fooledCounter;
            $chartData .= $fooledNum . ', ';

            $_SESSION['chartData'] = $chartData;
            $_SESSION['fooledCounter'] = $fooledCounter;
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