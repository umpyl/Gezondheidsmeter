<?php
session_start();
include "../../Assets/templates/theader.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Gebruiker</title>
    <link rel="stylesheet" href="<?= $url ?>Assets/CSS/vragen.css">
    <link rel="stylesheet" href="<?= $url ?>Assets/CSS/index.css">
</head>

<body>
    <div class="container">
        <?php displayHeader() ?>

        <div id="wrapper">
            <form action="vragen.php" method="POST">
                <input type="hidden" name="dataToSend" value="">
                <button type="submit" name="daily" value="daily">Dagelijks</button>
                <button type="submit" name="weekly" value="weekly">Wekelijk</button>
            </form>
        </div>
    </div>
</body>

</html>