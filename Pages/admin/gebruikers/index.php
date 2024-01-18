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
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/index.css">
    <link rel="stylesheet" href="<?php echo $url ?>Assets/CSS/gebruikerOverzicht.css">

</head>

<body>
    <div class="container">
        <?php displayHeader() ?>
        <div id="users">
            <?php foreach ($userResult as $user) : ?>
                <div class="card">
                    <h2><?= $user["Name"] ?></h2>
                    <p><?= $user["Mail"] ?></p>
                    <div class="form-group">
                        <div class="optionsWrapper">
                            <div class="dropdown">
                                <label class="filter">admin</label>
                                <ul class="optionWrapper">
                                    <li>
                                        <input type="radio" name="<?= $user["idUsers"] ?>" id="admin" value="1" <?php if ($user["Admin"] == "1") : ?> checked <?php endif ?>>
                                        <label for="admin">Admin</label>
                                    </li>
                                    <li>
                                        <input type="radio" name="<?= $user["idUsers"] ?>" id="user" value="0" <?php if ($user["Admin"] == "0") : ?> checked <?php endif ?>>
                                        <label for="user">User</label>
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

                if (!options.contains(event.target) && !filter.contains(event.target)) {
                    options.style.display = "none";
                }
            }
            LoadUserRole()
        });

        function LoadUserRole() {
            const roles = document.querySelectorAll('.filter');
            for (const role of roles) {
                var options = role.parentNode.querySelector(".optionWrapper").children;
                for (const option of options) {
                    console.log("role")
                    console.log(role.innerHTML)
                    console.log("option")
                    console.log(option.children[1].innerHTML)
                    console.log("checked")
                    console.log(option.children[0].checked == true)

                    if (option.children[0].checked == true) {
                        role.innerHTML = option.children[1].innerHTML;
                    }
                }
            }
        }
    </script>
</body>

</html>