 <?php
    session_start();
    require "../../Particles/conn.php";
    include "../../Assets/templates/theader.php";

    $connectionClass = new Connection();
    $connection = $connectionClass->setConnection();

    $receivedData;
    if (isset($_POST['dataToSend'])) {
        if (isset($_POST['daily'])) {
            $receivedData = 1;
        } else if (isset($_POST["weekly"])) {
            $receivedData = 0;
        } else {
            $receivedData = "no data received";
        }
    } else {
        echo "No data received. <br>";
    }

    $results;

    if ($receivedData == "1") {
        // Daily
        $selectdaily = $connection->prepare("SELECT * FROM `gezond_questions` WHERE `Daily` = ?");
        $selectdaily->bind_param("i", $receivedData);
        $selectdaily->execute();
        $results = $selectdaily->get_result();
    } else {
        // Weekly
        $selectweekly = $connection->prepare("SELECT * FROM `gezond_questions` WHERE `Daily` = ?");
        $selectweekly->bind_param("i", $receivedData);
        $selectweekly->execute();
        $results = $selectweekly->get_result();
    }

    $questionsArray = $results->fetch_all(MYSQLI_ASSOC);

    $questionsJson = json_encode($questionsArray);

    $userId = $_SESSION["userId"];



    $questionCount = 0;

    foreach ($results as $result) {
        $questionCount++;
    }
    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/vragen.css">
     <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/index.css">
     <script type="text/javascript" src="<?php echo $url ?>Assets/JS/vragen.js" defer></script>
     <script>
         let QuestionCount = <?php echo $questionCount ?>;
         let userId = <?php echo $userId ?>;
         let questionsArray = <?php echo $questionsJson; ?>;
     </script>
 </head>

 <body>
     <div class="container">
         <?php displayHeader() ?>
         <div id="wrapper">
             <div id="topSection">
                 <div id="counter">
                     <span id="currentQuestion">2</span><span> of </span><span id="total">10</span>
                 </div>
                 <h2 id="question">Question placeholder</h2>
             </div>
             <div id="midSection">
                 <label for="yes">
                     <input type="radio" name="yesno" id="yes" value="1">
                     <label for="yes">Yes</label>
                 </label>
                 <label for="no">
                     <input type="radio" name="yesno" id="no" value="0">
                     <label for="no">No</label>
                 </label>
             </div>
             <div id="bottomSection">
                 <div id="buttons">
                     <button onclick="UpdateCurrentQuestion('prev')" id="prev">Prev</button>
                     <button onclick="UpdateCurrentQuestion('next');" id="next">Next</button>
                 </div>
             </div>
         </div>
     </div>
 </body>

 </html>