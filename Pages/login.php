<?php
session_start();
require "../Particles/conn.php";
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
                header("Location: ../admin/Homepage.php");
                exit();
            } else {
                $_SESSION["naam"] = $naam;
                $_SESSION["admin"] = false;
                header("Location: ../gebruiker/Homepage.php");
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
    <link rel="stylesheet" href="../Assets/CSS/login.css">
    <link rel="stylesheet" href="../Assets/CSS/index.css">
    <title>Inlog</title>
</head>

<body>
    <div class="container">
        <div class="headerwrapper">
            <h2 class="header">Inloggen</h2>
            <h2 class="header-placeholder">Inloggen</h2>
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
            <button name="submit" type="submit">Inloggen</button>
            <a href="register.php" class="link">Nog geen account? Registreer dan hier!</a>
        </form>
    </div>
</body>

</html>