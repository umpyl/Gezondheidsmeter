<?php
session_start();
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$stmt = $connection->prepare("SELECT * FROM `gezond_questions`");
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows >= 1){
    $row = $result->fetch_assoc();
    $question = $row["Questions"];
}else {
    $question = "No questions found"; 
}

//Vraag aanmaken
//alle vragen zien / bewerken
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage admin</title>
</head>
<body>
<div id="header">
    <button name="button_vraag_aanmaken">Vraag aanmaken</button>
</div>
<div class="styling">
    <?php echo $question;?>
</div>
    
</body>
</html>