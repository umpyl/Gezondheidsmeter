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
     <link rel="stylesheet" href="<?= $url ?>Assets/CSS/index.css">
     <link rel="stylesheet" href="<?= $url ?>Assets/CSS/vragen.css">
     <script type="text/javascript" src="<?= $url ?>Assets/JS/vragen.js" defer></script>
     <script>
         let QuestionCount = <?= $questionCount ?>;
         let userId = <?= $userId ?>;
         let questionsArray = <?= $questionsJson; ?>;
     </script>
 </head>

 <body>
     <div class="container">
         <?php displayHeader() ?>
         <div id="wrapper">
             <div id="topSection">
                 <div id="counter">
                     <span id="currentQuestion">2</span><span> van </span><span id="total">10</span>
                 </div>
                 <h2 id="question">Question placeholder</h2>
             </div>
             <div id="midSection">
                 <div class="form-group">
                     <div class="optionsWrapper">
                         <div class="optionWrapper">
                             <input type="radio" name="yesno" id="yes" value="1">
                             <label for="yes">Ja</label>
                         </div>
                         <div class="optionWrapper">
                             <input type="radio" name="yesno" id="no" value="0">
                             <label for="no">Nee</label>
                         </div>
                     </div>
                 </div>
             </div>
             <div id="bottomSection">
                 <div id="buttons">
                     <button onclick="UpdateCurrentQuestion('prev')" id="prev">Vorige</button>
                     <button onclick="UpdateCurrentQuestion('next');" id="next">Volgende</button>
                 </div>
             </div>
         </div>
     </div>
 </body>

 </html>