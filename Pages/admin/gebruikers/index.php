<?php
session_start();
require "../../../Particles/conn.php";
include "../../../Assets/templates/theader.php";

$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$sql = "SELECT `Name`, `Mail`,  `Admin`,  `DailyNotification` FROM `gezond_users`";
$userResult = mysqli_query($connection, $sql);
$userResult = $userResult->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikers overzicht</title>
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/index.css">
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/gebruikerOverzicht.css">
</head>

<body>
    <div class="container">
        <?php displayHeader();
        var_dump($userResult); ?>
    </div>
</body>

</html>