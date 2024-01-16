 <?php
    session_start();
    require "../../Particles/conn.php";
    include "../../Assets/templates/theader.php";

    $connectionClass = new Connection();
    $connection = $connectionClass->setConnection();

    $receivedData;
    if (isset($_GET['dataToSend'])) {
        if (isset($_GET['daily'])) {
            $receivedData = 1;
        } else if (isset($_GET["weekly"])) {
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
                 <button onclick="UpdateCurrentQuestion('prev')" id="prev">Prev</button>
                 <button onclick="UpdateCurrentQuestion('next')" id="next">Next</button>
             </div>
         </div>
     </div>
 </body>

 </html>

 <script>
     let QuestionCount = <?php echo $questionCount ?>;
     let userId = <?php echo $userId ?>;
     let questionsArray = <?php echo $questionsJson; ?>;
     let currentQuestion = 1;
     document.getElementById("currentQuestion").innerText = currentQuestion;
     document.getElementById("total").innerText = QuestionCount;
     document.getElementById("question").innerText = questionsArray[currentQuestion - 1].Question;
     let answer = document.getElementById("questionAnswer").value;
     console.log(answer);

     function UpdateCurrentQuestion(action) {
         if (action === 'prev' && currentQuestion > 1) {
             currentQuestion--;
         }

         if (action === 'next' && currentQuestion < QuestionCount) {
             currentQuestion++;

             let questionId = questionsArray[currentQuestion - 1].idQuestions;

             

             

             sendAnswerToServer(questionId, userId, answer);
         }

         document.getElementById("question").innerText = questionsArray[currentQuestion - 1].Question;
         document.getElementById("currentQuestion").innerText = currentQuestion;

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