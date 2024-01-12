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
</head>

<body>
    <?php displayHeader() ?>

    <form action="vragen.php" method="get">
        <input type="hidden" name="dataToSend" value="Hello World">
        <input type="submit" name="daily" value="daily">
        <input type="submit" name="weekly" value="weekly">
    </form>
</body>

</html>