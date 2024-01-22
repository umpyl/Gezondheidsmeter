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
<<<<<<< Updated upstream
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
=======
             <h2 id="question">Question placeholder</h2>
         </div>
         <div id="midSection">
             <input type="radio" name="yesno" id="ja" value="1">Yes
             <input type="radio" name="yesno" id="nee" value="0">No
         </div>

         <div id="bottomSection">
             <div id="buttons">
                 <button onclick="UpdateCurrentQuestion('prev')" id="prev">Prev</button>
                 <button onclick="UpdateCurrentQuestion('next');" id="next">Next</button>
>>>>>>> Stashed changes
             </div>
         </div>
     </div>
 </body>

<<<<<<< Updated upstream
 </html>
=======
 </html>

 <script>
     let QuestionCount = <?php echo $questionCount ?>;
     let userId = <?php echo $userId ?>;
     let questionsArray = <?php echo $questionsJson; ?>;
     let currentQuestion = 1;
     let answer = 0;

     function loadQuestion() {
         document.getElementById("currentQuestion").innerText = currentQuestion;
         document.getElementById("total").innerText = QuestionCount;
         document.getElementById("question").innerText = questionsArray[currentQuestion - 1].Question;
     }

     function checkanswer() {
         let buttons = document.getElementsByName("yesno");

         for (i = 0; i < buttons.length; i++) {
             if (buttons[i].checked) {
                 answer = buttons[i].value;
                 buttons[i].checked = false;
                 break;
             }
         }

     }


     function UpdateCurrentQuestion(action) {
         if (action === 'prev' && currentQuestion > 1) {
             currentQuestion--;
         }

         if (action === 'next') {
             let questionId = questionsArray[currentQuestion - 1].idQuestions;
             console.log(questionId);
             checkanswer();
             sendAnswerToServer(questionId, userId, answer);

             if (currentQuestion < QuestionCount) {
                 currentQuestion++;
             } else {
                 console.log("Last question");
             }
         }
         loadQuestion();
     }

     function sendAnswerToServer(questionId, userId, answer) {
         fetch('Save_answer.php', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                 },
                 body: JSON.stringify({
                     'questionIds': questionId,
                     'userIds': userId,
                     'answers': answer,
                 }),
             })
             .then(response => response.text())
             .then(data => {
                 console.log(data);
             })
             .catch(error => {
                 console.error('Error:', error);
             });
     }
 </script>
>>>>>>> Stashed changes
