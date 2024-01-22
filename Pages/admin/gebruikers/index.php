<?php
session_start();
require "../../../Particles/conn.php";
include "../../../Assets/templates/theader.php";

$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

$sql = "SELECT `idUsers`, `Name`, `Mail`,  `Admin` FROM `gezond_users`";
$userResult = mysqli_query($connection, $sql);
$userResult = $userResult->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikers overzicht</title>
    <link rel="stylesheet" href="<?= $url ?>Assets/CSS/index.css">
    <link rel="stylesheet" href="<?= $url ?>Assets/CSS/gebruikerOverzicht.css">

</head>

<body>
    <div class="container">
        <?php displayHeader() ?>
        <div id="users">
            <?php foreach ($userResult as $user) : ?>
                <div class="card">
                    <h2><?= $user["Name"] ?></h2>
                    <a href="mailto:<?= $user["Mail"] ?>"><?= $user["Mail"] ?></a>
                    <div class="form-group">
                        <div class="optionsWrapper">
                            <div class="dropdown">
                                <label class="filter"><?= $user["Admin"] == "1" ? "Admin" : "Gebruiker" ?></label>
                                <ul class="optionWrapper">
                                    <li>
                                        <input type="radio" name="<?= $user["idUsers"] ?>" id="admin<?= $user["idUsers"] ?>" value="1" <?php if ($user["Admin"] == "1") : ?> checked <?php endif ?>>
                                        <label for="admin<?= $user["idUsers"] ?>">Admin</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="<?= $user["idUsers"] ?>" id="user<?= $user["idUsers"] ?>" value="0" <?php if ($user["Admin"] == "0") : ?> checked <?php endif ?>>
                                        <label for="user<?= $user["idUsers"] ?>">Gebruiker</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <script>
        const filters = document.querySelectorAll('.filter');

        for (const filter of filters) {
            const setOptionsDisplay = () => {
                const options = filter.closest('.optionsWrapper').querySelector(".optionWrapper");

                options.style.display = options.style.display === "block" ? "none" : "block";
            };

            filter.addEventListener("click", setOptionsDisplay);
        }

        document.addEventListener('DOMContentLoaded', LoadUserRole());

        document.addEventListener("click", (event) => {
            for (const filter of filters) {
                const options = filter.closest('.optionsWrapper').querySelector(".optionWrapper");

                if (!filter.contains(event.target)) {
                    options.style.display = "none";
                }
            }
            LoadUserRole();
        });

        function LoadUserRole() {
            const roles = document.querySelectorAll('.filter');
            for (const role of roles) {
                var options = role.parentNode.querySelector(".optionWrapper").children;

                for (const option of options) {
                    if (option.children[0].checked != true) return;

                    role.innerHTML = option.children[1].innerHTML;

                    if (role.innerHTML == option.children[1].innerHTML) return;

                    var data = {
                        id: option.children[0].name,
                        role: option.children[0].value,
                    }
                    fetch("<?= $url ?>Assets/templates/fetch/updateUser.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify(data),
                        })
                        .then((response) => response.json())
                        .then((data) => {

                        })
                }
            }
        }
    </script>
</body>

</html>