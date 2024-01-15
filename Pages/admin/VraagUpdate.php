<?php
session_start();
require "../../Particles/conn.php";
include "../../Assets/templates/theader.php";

$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$idQuestions = $_GET['updateid'];
$sql = "SELECT * FROM `gezond_questions` WHERE idQuestions = $idQuestions";
$result = mysqli_query($connection, $sql);
$question = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $Question = $_POST['Question'];
    $Daily = $_POST['Daily'];
    $category = $_POST['category'];

    $sql = "UPDATE `gezond_questions` SET idQuestions = $idQuestions, Question = '$Question', Daily = '$Daily', category_id = '$category' WHERE idQuestions = $idQuestions ";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        header("Location: ../admin/Homepage.php");
        exit();
    } else {
        echo "Fout! Raadpleeg ontwikkelaar";
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
    <script type="text/javascript" src="<?php echo $url ?>Assets/JS/dropdown.js" defer></script>
</head>

<body>
    <?php displayHeader(); ?>
    <div class="wrapper">
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" id="question" name="Question" placeholder="Question" value="<?php echo $question['Question']; ?>" required>
                <label for="question">Question</label>
                <span class="underline"></span>
            </div>
            <div class="form-group">
                <h2>Herhaling</h2>
                <div class="optionsWrapper">
                    <div class="optionWrapper">
                        <input type="radio" id="daily" value="1" name="Daily" <?php echo ($question['Daily'] == 1) ? 'checked' : ''; ?>>
                        <label for="daily">Daily</label>
                    </div>
                    <div class="optionWrapper">
                        <input type="radio" id="weekly" value="0" name="Daily" <?php echo ($question['Daily'] == 0) ? 'checked' : ''; ?>>
                        <label for="weekly">Weekly</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h2>Categorie</h2>
                <div class="optionsWrapper">
                    <div class="dropdown">
                        <input type="text" class="filter" placeholder="Search">
                        <ul class="optionWrapper">
                            <?php foreach ($rows as $row) { ?>
                                <li>
                                    <input type="radio" id="<?= $row["category"] ?>" class="dropdownContent" name="category" value="<?= $row["id"] ?>" <?= ($question["category_id"] == $row["id"]) ? "checked" : "" ?>>
                                    <label for="<?= $row["category"] ?>"><?= ucfirst($row["category"]) ?></label>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
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