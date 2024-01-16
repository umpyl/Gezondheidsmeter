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

        $insertAnswer = $connection->prepare("INSERT INTO gezond_antwoorden (Questions_idQuestions, Users_idUsers, Antwoord) VALUES (?, ?, ?)");
        $insertAnswer->bind_param("iis", $questionId, $userId, $answer);
        $insertAnswer->execute();

        if ($insertAnswer->error) {
            error_log('Error: ' . $insertAnswer->error);
        }

        $insertAnswer->close();
    }
} else {
    // Handle other types of requests or provide an error response
    http_response_code(400); // Bad Request
    echo "Invalid request method";
}
?>
