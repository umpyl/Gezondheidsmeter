<?php
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

if (isset($_POST["submit"])) {
    $checked_daily = isset($_POST["daily_yes"]) ? 1 : 0;
    $checked_work = isset($_POST["work_yes"]) ? 1 : 0;
    $checked_sport = isset($_POST["sport_yes"]) ? 1 : 0;
    $checked_diet = isset($_POST["diet_yes"]) ? 1 : 0;
    $checked_drugs = isset($_POST["drugs_yes"]) ? 1 : 0;
    $checked_sleep = isset($_POST["sleep_yes"]) ? 1 : 0;
    $checked_alcohol = isset($_POST["alcohol_yes"]) ? 1 : 0;

    $stmt = $connection->prepare("INSERT INTO gezond_questions(`Question`,`Daily`,`work`,`sport`,`diet`,`drugs`,`sleep`,`alcohol`) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("siiiiiii", $_POST["question"], $checked_daily, $checked_work, $checked_sport, $checked_diet, $checked_drugs, $checked_sleep, $checked_alcohol);

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
        <input type="radio" id="daily_yes" name="daily" onclick="uncheckNoRadio('daily')" checked>Ja</input>
        <input type="radio" id="daily" name="daily">Nee</input><br>

        <input type="radio" id="work_yes" name="work" onclick="uncheckNoRadio('work')" checked>Ja</input>
        <input type="radio" id="work" name="work">Nee</input><br>

        <input type="radio" id="sport_yes" name="sport" onclick="uncheckNoRadio('sport')" checked>Ja</input>
        <input type="radio" id="sport" name="sport">Nee</input><br>

        <input type="radio" id="diet_yes" name="diet" onclick="uncheckNoRadio('diet')" checked>Ja</input>
        <input type="radio" id="diet" name="diet">Nee</input><br>

        <input type="radio" id="drugs_yes" name="drugs" onclick="uncheckNoRadio('drugs')" checked>Ja</input>
        <input type="radio" id="drugs" name="drugs">Nee</input><br>

        <input type="radio" id="sleep_yes" name="sleep" onclick="uncheckNoRadio('sleep')" checked>Ja</input>
        <input type="radio" id="sleep" name="sleep">Nee</input><br>

        <input type="radio" id="alcohol_yes" name="alcohol" onclick="uncheckNoRadio('alcohol')" checked>Ja</input>
        <input type="radio" id="alcohol" name="alcohol">Nee</input><br>
        <input type="submit" name="submit">
    </form>

</body>

</html>

<script>
    function uncheckNoRadio(category) {
        // Get the Yes and No radio buttons for the given category
        var yesRadio = document.getElementById(category + "_yes");
        var noRadio = document.getElementById(category);

        // Uncheck the No radio button if Yes is selected
        if (yesRadio.checked) {
            noRadio.checked = false;
        }
    }
</script>