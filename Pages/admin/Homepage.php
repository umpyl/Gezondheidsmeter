<?php
session_start();
require "../../Particles/conn.php";
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$sql = "SELECT * FROM `gezond_questions`";
$result = mysqli_query($connection, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $idQuestions = $row['idQuestions'];
        $Question = $row['Question'];
        $Daily = $row['Daily'];
        $category = $row['category'];

        echo ' <tr> 
        <th scope="row">' . $idQuestions . '</th>
        <td>' . $Question . '</td>
        <td>' . $Daily . '</td>
        <td>' . $category . '</td>
        </tr>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage admin</title>
</head>

<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Vraag</th>
                    <th scope="col">Dagelijks</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Actie</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>

</html>