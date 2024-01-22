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
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/vragen.css">
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/index.css">
</head>

<body>
    <div class="container">
        <?php displayHeader() ?>

<<<<<<< Updated upstream
        <div id="wrapper">
            <form action="vragen.php" method="POST">
                <input type="hidden" name="dataToSend" value="">
                <button type="submit" name="daily" value="daily">Daily</button>
                <button type="submit" name="weekly" value="weekly">Weekly</button>
            </form>
        </div>
    </div>
=======
    <form action="vragen.php" method="GET">
        <input type="hidden" name="dataToSend" value="">
        <input type="submit" name="daily" value="daily">
        <input type="submit" name="weekly" value="weekly">
    </form>
>>>>>>> Stashed changes
</body>

</html>