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


if (empty($unfooledUserArray)){
    header('location:all_fooled.php');
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
        $mess = "Detta är dag ett";
        break;
    case 2:
        $mess = "Detta är dag två";
        break;
    case 3:
        $mess = "Detta är dag tre";
        break;
    case 4:
        $mess = "Dag fyra";
        break;
    case 5:
        $mess = "Och dag fem";
        break;
    default:
        $nextPage = 'fooling.php';
        $_SESSION['nextPage'] = 'fooling.php';
        break;

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