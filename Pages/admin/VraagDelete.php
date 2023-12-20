<?php
session_start();
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

if (isset($_GET['deleteid'])) {
    $idQuestions = $_GET['deleteid'];

    $sql = "DELETE FROM `gezond_questions` WHERE idQuestions = $idQuestions";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        header("Location: ../admin/Homepage.php");
        exit(); 
    } else {
        die(mysqli_error($connection));
    }
}
?>