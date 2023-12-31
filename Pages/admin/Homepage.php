<?php
session_start();
require "../../Particles/conn.php";
include "../../Assets/templates/theader.php";

$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$sql = "SELECT * FROM `gezond_questions`";
$questionResult = mysqli_query($connection, $sql);

$selectstmt = $connection->prepare("SELECT id, category FROM `gezond_category`");
$selectstmt->execute();
$categoryResult = $selectstmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage admin</title>
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/adminhpg.css">
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/index.css">
    <script type="text/javascript" src="<?php echo $url ?>Assets/JS/adminhpg.js" defer></script>
</head>

<body>
    <div class="container">
        <?php displayHeader() ?>
        <div class="questionWrapper">
            <button class="add-button" onclick="redirectToAddQuestion()">Vraag Toevoegen</button>
            <div class="filterList">
                <h2>Categorie</h2>
                <div id="categoryFilter" class="filters">
                    <button class="filter active" data-category="All">All</button>
                    <?php while ($row = mysqli_fetch_array($categoryResult)) : ?>
                        <button class="filter" data-category="<?php echo ucfirst($row["category"]) ?>"><?php echo ucfirst($row["category"]) ?></button>
                    <?php endwhile; ?>
                </div>
                <h2>Herhaling</h2>
                <div id="recuringFilter" class="filters">
                    <button class="filter active" data-recuring="All">All</button>
                    <button class="filter" data-recuring="Daily">Dagelijks</button>
                    <button class="filter" data-recuring="Weekly">Wekelijks</button>
                </div>
            </div>
            <ul id="questionList">
                <?php
                if ($questionResult) {
                    if ($questionResult->num_rows == 0) : ?>
                        <h2>There are no questions at the moment</h2>
                    <?php endif ?>
                    <?php
                    $index = 0;
                    while ($row = mysqli_fetch_assoc($questionResult)) {
                        $idQuestions = $row['idQuestions'];
                        $Question = $row['Question'];
                        $Daily = $row['Daily'];
                        $category = ucfirst($row["category"]);
                        $index++;
                    ?>
                        <li class="question" data-recuring="<?php if ($Daily == 1) {
                                                                echo "Daily";
                                                            } else {
                                                                echo "Weekly";
                                                            } ?>" data-category="<?php echo $category ?>" style="view-transition-name: conf-<?php echo $index ?>">
                            <div class="details">
                                <span><?php if ($Daily == 1) {
                                            echo "Daily";
                                        } else {
                                            echo "Weekly";
                                        } ?></span>
                                <span><?php echo $category ?></span>
                            </div>
                            <h2><?php echo $Question ?></h2>
                            <div class="action-buttons">
                                <a href="VraagUpdate.php? updateid=<?php echo $idQuestions ?>"><button class="update">Bewerken</button></a>
                                <a href="#" onclick="confirmDelete(<?php echo $idQuestions ?>)"><button class="delete">Verwijderen</button></a>
                            </div>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <script>
        function redirectToAddQuestion() {
            window.location.href = '<?php echo $url ?>Pages/admin/VraagAanmaken.php';
        }

        function confirmDelete(questionId) {
            let confirmDelete = confirm("Weet je zeker dat je deze vraag wilt verwijderen?");
            if (confirmDelete) {
                window.location.href = '<?php echo $url ?>Pages/admin/VraagDelete.php?deleteid=' + questionId;
            }
        }
    </script>
</body>

</html>