<?php
session_start();
require "../../Particles/conn.php";
include "../../Assets/templates/theader.php";

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
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/index.css">
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/vragenAanmaken.css">
    <title>Vraag aanmaken</title>
</head>

<body>
    <div class="wrapper">
        <?php displayHeader(); ?>
    </div>
    <div class="wrapper">
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" id="question" name="question" placeholder="Question" required>
                <label for="question">Question</label>
                <span class="underline"></span>
            </div>
            <div class="form-group">
                <h2>Herhaling</h2>
                <div class="optionsWrapper">
                    <div class="optionWrapper">
                        <input type="radio" id="daily" value="1" name="daily" checked>
                        <label for="daily">Daily</label>
                    </div>
                    <div class="optionWrapper">
                        <input type="radio" id="weekly" value="0" name="daily">
                        <label for="weekly">Weekly</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h2>Categorie</h2>
                <div class="optionsWrapper">
                    <?php foreach ($rows as $row) {
                        echo '<div class="optionWrapper">
                        <input type="radio" id="' . $row["category"] . '" name="category" value="' . $row["id"] . '">
                    <label for="' . $row["category"] . '">' . ucfirst($row["category"]) . '</label> 
                    </div>
                    ';
                    } ?>
                </div>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>