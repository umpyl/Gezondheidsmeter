<?php
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$idQuestions = $_GET['updateid'];
$sql = "SELECT * FROM `gezond_questions` WHERE idQuestions = $idQuestions";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $Question = $_POST['Question'];
    $Daily = $_POST['Daily'];
    $category = $_POST['category'];

    $sql = "UPDATE `gezond_questions` SET idQuestions = $idQuestions, Question = '$Question', Daily = '$Daily', category = '$category' WHERE idQuestions = $idQuestions ";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        header("Location: ../admin/Homepage.php");
        exit(); 
    } else {
        echo "Fout! Raadpleeg ontwikkelaar";
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
        <input type="text" id="Question" name="Question" value="<?php echo $row['Question']; ?>"><br>
        <input type="radio" id="daily" value="1" name="Daily" <?php echo ($row['Daily'] == 1) ? 'checked' : ''; ?>>daily</input>
        <input type="radio" id="weekly" value="0" name="Daily" <?php echo ($row['Daily'] == 0) ? 'checked' : ''; ?>>weekly</input><br>

        
        <input type="radio" id="work" name="category" value="work" <?php echo ($row['category'] == 'work') ? 'checked' : ''; ?>>Work</input>
        <input type="radio" id="sport" name="category" value="sport" <?php echo ($row['category'] == 'sport') ? 'checked' : ''; ?>>Sport</input>
        <input type="radio" id="diet" name="category" value="diet" <?php echo ($row['category'] == 'diet') ? 'checked' : ''; ?>>Diet</input>
        <input type="radio" id="drugs" name="category" value="drugs" <?php echo ($row['category'] == 'drugs') ? 'checked' : ''; ?>>Drugs</input>
        <input type="radio" id="sleep" name="category" value="sleep" <?php echo ($row['category'] == 'sleep') ? 'checked' : ''; ?>>Sleep</input>
        <input type="radio" id="alcohol" name="category" value="alcohol" <?php echo ($row['category'] == 'alcohol') ? 'checked' : ''; ?>>alcohol</input><br>

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