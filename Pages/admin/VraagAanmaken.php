<?php
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

if (isset($_POST["submit"])) {
    $gelukt = 0;
    if(isset($_POST["daily"])){
        $checked_daily = $_POST["daily"];
        echo $checked_daily;
    }else{
        echo "niet gelukt!";
    }

    

    if(isset($_POST["category"])){
        $selected_category = $_POST["category"];
        $gelukt = 1;
    }elseif($gelukt != 1){
        echo "Je hebt geen category ingevuld";
    }

    $stmt = $connection->prepare("INSERT INTO gezond_questions(`Question`,`Daily`,`category`) VALUES (?,?,?)");
    $stmt->bind_param("sis", $_POST["question"], $checked_daily, $selected_category);

    if ($stmt->execute()) {
        echo "Its worked";
    } else {
        echo "somehting went wrong";
    }

    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vraag aanmaken</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" id="question" name="question"><br>
        <input type="radio" id="daily" value="1" name="daily" onclick="uncheckNoRadio('daily')" checked>daily</input>
        <input type="radio" id="weekly" value="0" name="daily">weekly</input><br>

        <input type="radio" id="work" name="category" value="work" onclick="uncheckNoRadio('work')" checked>Work</input>
        <input type="radio" id="sport" name="category" value="sport" onclick="uncheckNoRadio('sport')">Sport</input>
        <input type="radio" id="diet" name="category" value="diet" onclick="uncheckNoRadio('diet')">Diet</input>
        <input type="radio" id="drugs" name="category" value="drugs" onclick="uncheckNoRadio('drugs')">Drugs</input>
        <input type="radio" id="sleep" name="category" value="sleep" onclick="uncheckNoRadio('sleep')">Sleep</input>
        <input type="radio" id="alcohol" name="category" value="alcohol" onclick="uncheckNoRadio('alcohol')">alcohol</input><br>
        <input type="submit" name="submit">
    </form>
</body>

</html>

<script>
    function uncheckNoRadio(category) {
        var yesRadio = document.getElementById(category + "_yes");
        var noRadio = document.getElementById(category);

        if (yesRadio.checked) {
            noRadio.checked = false;
        }
    }
</script>