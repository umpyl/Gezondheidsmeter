<?php
session_start();
require "../../Particles/conn.php";

$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postData = file_get_contents("php://input");
    $data = json_decode($postData);

    if ($data) {
        $questionId = $data->questionIds;
        $userId = $data->userIds;
        $answer = $data->answers;

        $checkedanswer = $connection->prepare("SELECT * FROM `gezond_antwoorden` WHERE Questions_idQuestions = ? AND Users_idUsers = ?");
        $checkedanswer->bind_param("ii",$questionId,$userId);
        $checkedanswer->execute();
        $result = $checkedanswer->get_result();

        if($result->num_rows > 0){
            $updateAnswer = $connection->prepare("UPDATE `gezond_antwoorden` SET Antwoord = ? WHERE Questions_idQuestions = ? AND Users_idUsers = ? ");
            $updateAnswer->bind_param("iii",$answer,$questionId,$userId);
            $updateAnswer->execute();

            if ($updateAnswer->error) {
                error_log('Error updating answer: ' . $updateAnswer->error);
            }
            $updateAnswer->close();
        }else{
            $insertAnswer = $connection->prepare("INSERT INTO gezond_antwoorden (Questions_idQuestions, Users_idUsers, Antwoord) VALUES (?, ?, ?)");
            $insertAnswer->bind_param("iii", $questionId, $userId, $answer);
            $insertAnswer->execute();

            if ($insertAnswer->error) {
                error_log('Error inserting answer: ' . $insertAnswer->error);
            }

            $insertAnswer->close();
        }
    }
} else {
    http_response_code(400);
    echo "Invalid request method";
}
?>
