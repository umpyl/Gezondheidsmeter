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

    $stmt = $connection->prepare("INSERT INTO `gezond_users` (Name, Mail, Password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $Name, $Mail, $Password);
    $result = $stmt->execute();


    if ($result) {
        $stmt = $connection->prepare("SELECT * FROM `gezond_users` WHERE `Name` = ? AND `Password` = ?");
        $stmt->bind_param("ss", $Name, $Password);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION["naam"] = $Name;
            $_SESSION["admin"] = false;
            $_SESSION["userId"] = $row["idUsers"];
            header("Location: " . $url . "Pages/gebruiker/Homepage.php");
            exit();
        }
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
    <link rel="stylesheet" href="<?= $url ?>Assets/CSS/index.css">
    <link rel="stylesheet" href="<?= $url ?>Assets/CSS/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <?= getScripts() ?>
</head>

<body>
    <div class="container">
        <div class="headerwrapper">
            <h2 class="header">Registeren</h2>
        </div>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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