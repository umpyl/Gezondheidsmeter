<?php
session_start();
require "../Particles/conn.php";
include "../Assets/templates/theader.php";

$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

if (isset($_POST["submit"])) {
    $naam = $_POST["username"];
    $hashed_password = hash('sha256', $password = $_POST["password"]);

    $validName = true;
    $validPassword = true;

    $stmt = $connection->prepare("SELECT `idUsers` FROM `gezond_users` WHERE `Name` = ?");
    $stmt->bind_param("s", $naam);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $stmt = $connection->prepare("SELECT * FROM `gezond_users` WHERE `Name` = ? AND `Password` = ?");
        $stmt->bind_param("ss", $naam, $hashed_password);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($row["Admin"] == 1) {

                $_SESSION["naam"] = $naam;
                $_SESSION["admin"] = true;
                header("Location: " . $url . "Pages/admin/Homepage.php");
                exit();
            } else {
                $_SESSION["naam"] = $naam;
                $_SESSION["admin"] = false;
                header("Location: " . $url . "Pages/gebruiker/Homepage.php");
                exit();
            }
        } else {
            $validPassword = false;
        }
    } else {
        $validName = false;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/login.css">
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/index.css">
    <title>Inlog</title>
</head>

<body>
    <div class="container">
        <div class="headerwrapper">
            <svg class="pumping-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 14.25 2 11.28 2 7.5 2 4.42 4.42 2 7.5 2 9.43 2 11.11 3.11 12 4.74 12.89 3.11 14.57 2 16.5 2 19.58 2 22 4.42 22 7.5c0 3.78-3.4 6.75-8.55 12.54L12 21.35z" />
            </svg>
            <h2 class="header">Inloggen</h2>
        </div>
        <form action="" method="post">
            <div class="form-group <?php if (isset($validName)) {
                                        if (!$validName) {
                                            echo "invalide";
                                        } else {
                                            echo "valide";
                                        }
                                    } ?>">
                <input type="text" id="username" name="username" placeholder="Gebruikersnaam" required>
                <label for="username">Gebruikersnaam</label>
                <span class="underline"></span>
            </div>
            <div class="form-group <?php if (isset($validName)) {
                                        if (!$validName || !$validPassword) {
                                            echo "invalide";
                                        } else {
                                            echo "valide";
                                        }
                                    } ?>">
                <input type="password" id="password" name="password" placeholder="Wachtwoord" required>
                <label for="password">Wachtwoord</label>
                <span class="underline"></span>
            </div>
            <button name="submit" type="submit"><b>Inloggen</b></button>
            <a href="<?php echo $url ?>Pages/register.php" class="link">Nog geen account? Registreer dan hier!</a>
        </form>
    </div>
</body>

</html>