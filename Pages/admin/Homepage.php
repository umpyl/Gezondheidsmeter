<?php
session_start();
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$sql = "SELECT * FROM `gezond_questions`";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage admin</title>
    <link rel="stylesheet" href="../Assets/CSS/adminhpg.css">
</head>

<body>
    <div class="container">
        <button class="add-button" onclick="redirectToAddQuestion()">Vraag Toevoegen</button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vraag</th>
                    <th>Dagelijks</th>
                    <th>Categorie</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $idQuestions = $row['idQuestions'];
                        $Question = $row['Question'];
                        $Daily = $row['Daily'];
                        $category = $row['category'];

                        echo '<tr>
                            <td>' . $idQuestions . '</td>
                            <td>' . $Question . '</td>
                            <td>' . $Daily . '</td>
                            <td>' . $category . '</td>
                            <td class="action-buttons">
                                <button class="update"><a href="VraagUpdate.php? updateid=' . $idQuestions . '">Bewerken</a></button>
                                <button class="delete"><a href="#" onclick="confirmDelete(' . $idQuestions . ')">Verwijderen</a></button>
                            </td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function redirectToAddQuestion() {
            window.location.href = 'VraagAanmaken.php';
        }

        function confirmDelete(questionId) {
            let confirmDelete = confirm("Weet je zeker dat je deze vraag wilt verwijderen?");
            if (confirmDelete) {
                window.location.href = 'VraagDelete.php?deleteid=' + questionId;
            }
        }
    </script>
</body>

</html>