 <?php 
session_start();
require "../../Particles/conn.php";
include "../../Assets/templates/theader.php";

$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$receivedData;
if(isset($_GET['dataToSend'])) {
    if(isset($_GET['daily'])){
        $receivedData = 1;
    }else if(isset($_GET["weekly"])){
        $receivedData = 0;
    }else{
        $receivedData = "no data received";
    }
    
    echo "Received Data: $receivedData";
} else {
    echo "No data received.";
}


if($receivedData == "daily"){
    $selectdaily =  $connection->prepare("SELECT FROM `gezond_questions` WHERE `Daily` = ?");
    $selectdaily->bind_param("i",$receivedData);

}else{
    $selectweekly = $connection->prepare("SELECT FROM `gezond_questions` WHERE `Daily` = ?");
    $selectweekly->bind_param("i",$receivedData);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Assets/CSS/vragen.css">
    <script type="text/javascript" src="../../Assets/JS/vragen.js" defer></script>
</head>

<body>
    <div id="wrapper">
        <div id="topSection">
            <div id="counter">
                <span id="currentQuestion">2</span><span> of </span><span id="total">10</span>
            </div>
            <h2 id="question">Question placeholder</h2>
        </div>
        <div id="midSection">
            <textarea id="questionAnswer"></textarea>
        </div>
        <div id="bottomSection">
            <div id="buttons">
                <button id="prev">Prev</button>
                <button id="next">Next</button>
            </div>
        </div>
    </div>
</body>

</html>