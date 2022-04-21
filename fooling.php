<?php 
require_once("database_connection.php");
session_start();

$sql = "SELECT id FROM MOCK_DATA WHERE fooled = :fooled";
$stm = $pdo->prepare($sql);
$stm->execute(array('fooled' => 0));
$unfooledUserArray = $stm->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT id FROM MOCK_DATA WHERE fooled = :fooled";
$stm = $pdo->prepare($sql);
$stm->execute(array('fooled' => 1));
$fooledUserArray = $stm->fetchAll(PDO::FETCH_ASSOC);

if (empty($fooledUserArray)){
    $id = 1;
    $fooled = 1;
    $sql = "UPDATE MOCK_DATA SET fooled=:fooled WHERE id=:id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(array('fooled' => $fooled,'id' => $id));
    $nextPage = "first.php";
    $_SESSION['nextPage'] = 'first.php'; 

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
$fooledCounter= $_SESSION['fooledCounter'];
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
        $sql = "UPDATE MOCK_DATA SET fooled=:fooled WHERE id=:id";
        $stmt= $pdo->prepare($sql);
        $stmt->execute(array('fooled' => $fooled,'id' => $id));

        $destructionArray[] = $id;        
        
    }
}

$chartData = $_SESSION['chartData'];
$days = $_SESSION['days'];

$fooledNum = $fooledCounter;
$chartData .= $fooledNum . ', ';

$_SESSION['chartData'] = $chartData;
$_SESSION['fooledCounter'] = $fooledCounter;

$days .= strval(substr_count($chartData, ',')) . ', ';
$_SESSION['days'] = $days;
$nextPage = $_SESSION['nextPage'];
header("location: $nextPage");

?>