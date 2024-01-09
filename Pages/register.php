<?php
session_start();
require "../Particles/conn.php";
include "../Assets/templates/theader.php";

$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

if (isset($_POST["submit"])) {
    $Name = $_POST["Name"];
    $Mail = $_POST["Mail"];
    $Password = hash('sha256', $Password = $_POST["Password"]);

    $sql = "INSERT INTO `gezond_users` (Name, Mail, Password) VALUES ('$Name', '$Mail', '$Password')";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo "<html>
        <head>
        <title>Laden...</title>
        <script>
        setTimeout(function() {
            window.location.href = '" . $url . "Pages/login.php';
        }, 3000); // 3000 milliseconds = 3 seconds
        </script>
        </head>
        <body>
        <div style='text-align: center; padding: 50px;'>
        <h2>Aan het laden...</h2>
        <!-- leuek elemente invoegen -->
        </div>
        </body>
        </html>";
        exit;
    } else {
        echo "Niet gelukt! Raadpleeg ontwikkelaar";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/login.css">
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="headerwrapper">
            <svg class="pumping-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 14.25 2 11.28 2 7.5 2 4.42 4.42 2 7.5 2 9.43 2 11.11 3.11 12 4.74 12.89 3.11 14.57 2 16.5 2 19.58 2 22 4.42 22 7.5c0 3.78-3.4 6.75-8.55 12.54L12 21.35z" />
            </svg>
            <h2 class="header">Registeren</h2>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <input type="text" id="Name" name="Name" placeholder="Naam" autocomplete="off" required />
                <label for="Name">Naam</label>
                <span class="underline"></span>
            </div>
            <div class="form-group">
                <input type="email" id="Mail" name="Mail" placeholder="Email" autocomplete="off" required />
                <label for="Mail">Email</label>
                <span class="underline"></span>
            </div>
            <div class="form-group">
                <input type="Password" id="Password" name="Password" placeholder="Wachtwoord" autocomplete="off" required />
                <label for="Password">Wachtwoord</label>
                <span class="underline"></span>
            </div>
            <button name="submit" type="submit" value="Submit"><b>Registreren</b></button>
            <a href="<?php echo $url ?>Pages/login.php" class="link">Al een account? Log hier dan in!</a>

        </form>
    </div>
</body>

</html>