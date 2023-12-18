<?php
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$id = $_GET['updateid'];
$sql = "SELECT * FROM `gezond_questions` WHERE id = $id";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $Question = $_POST['Question'];
    $Daily = $_POST['Daily'];
    $category = $_POST['category'];

    $sql = "UPDATE `gezond_questions` SET id = $id, Question = '$Question', Daily = '$Daily', category = '$category' WHERE id = $id ";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo "gelukt";
    } else {
        echo "niet gelukt";
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