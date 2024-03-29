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
    var_dump($_POST);
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
    <script type="text/javascript" src="<?php echo $url ?>Assets/JS/dropdown.js" defer></script>
</head>

<body>
    <?php displayHeader(); ?>
    <div class="wrapper">
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" id="question" name="question" placeholder="Vraag" required>
                <label for="question">Vraag</label>
                <span class="underline"></span>
            </div>
            <div class="form-group">
                <h2>Herhaling</h2>
                <div class="optionsWrapper">
                    <div class="optionWrapper">
                        <input type="radio" id="daily" value="1" name="daily" checked>
                        <label for="daily">Dagelijks</label>
                    </div>
                    <div class="optionWrapper">
                        <input type="radio" id="weekly" value="0" name="daily">
                        <label for="weekly">Wekelijks</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h2>Categorie</h2>
                <div class="optionsWrapper">
                    <div class="dropdown">
                        <input type="text" class="filter" placeholder="Zoek">
                        <ul class="optionWrapper">
                            <?php foreach ($rows as $row) {
                                echo '<li>
                            <input type="radio" id="' . $row["category"] . '" class="dropdownContent" name="category" value="' . $row["id"] . '">
                        <label for="' . $row["category"] . '">' . ucfirst($row["category"]) . '</label>
                        </li>
                        ';
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit">Vraag aanmaken</button>
        </form>
    </div>
</body>

</html>