<?php
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

if (isset($_POST["submit"])) {
    $gelukt = 0;
    if (isset($_POST["daily"])) {
        $checked_daily = $_POST["daily"];
    } else {
        echo "niet gelukt!";
    }

    if (isset($_POST["category"])) {
        $selected_category = $_POST["category"];
        $gelukt = 1;
    } elseif ($gelukt != 1) {
        echo "Je hebt geen category ingevuld";
    }

    $stmt = $connection->prepare("INSERT INTO gezond_questions(`Question`,`Daily`,`category_id`) VALUES (?,?,?)");
    $stmt->bind_param("sii", $_POST["question"], $checked_daily, $selected_category);

    if ($stmt->execute()) {
        header("Location: ../admin/Homepage.php");
        exit();
    } else {
        echo "somehting went wrong";
    }
}
$selectstmt = $connection->prepare("SELECT id, category FROM `gezond_category`");
$selectstmt->execute();
$result = $selectstmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);

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

        <?php foreach ($rows as $row) {
            echo '<input type="radio" id="' . $row["category"] . '" name="category" value="' . $row["id"] . '" onclick="uncheckNoRadio(\'' . $row["category"] . '\')">' . $row["category"] . '</input>';
        } ?>
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