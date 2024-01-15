<?php

$oUrl =  $_SERVER['REQUEST_URI'];
$user = "gebruiker";
$position = strrpos($oUrl, "Gezondheidsmeter/");

if ($position !== false) {
    $url = substr($oUrl, 0, $position + strlen("Gezondheidsmeter/"));
}

if (str_contains($oUrl, "login.php") && isset($_SESSION["naam"])) {
    if (!str_contains($oUrl, "/gebruiker/") && !$_SESSION["admin"]) {
        header('location: ' . $url . 'Pages/gebruiker/Homepage.php');
    }

    if (!str_contains($oUrl, "/admin/") && $_SESSION["admin"]) {
        header('location: ' . $url . 'Pages/admin/Homepage.php');
    }
}

if (!str_contains($oUrl, "login.php") && !str_contains($oUrl, "register.php")) {
    if (!isset($_SESSION["naam"])) {
        header('location: ' . $url . 'Pages/login.php');
    }
    if (!str_contains($oUrl, "/gebruiker/") && !$_SESSION["admin"]) {
        header('location: ' . $url . 'Pages/gebruiker/Homepage.php');
    }

    if (!str_contains($oUrl, "/admin/") && $_SESSION["admin"]) {
        header('location: ' . $url . 'Pages/admin/Homepage.php');
    }
    if ($_SESSION["admin"]) {
        $user = "admin";
    }
}


function displayHeader()
{
    global $url, $oUrl, $user;
?>
    <header id="header" class="header">
        <?php GetScripts(); ?>
        <div class="logo">
        </div>
        <nav class="navbar">
            <label class="checkbox">
                <input type="checkbox" id="darkmodeToggle">
                <div class="toggle">
                    <div class="sun">
                        <svg viewbox="0 0 24 24">
                            <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <circle cx="12" cy="12" r="5"></circle>
                                <path d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="toggleButton">
                        <svg viewbox="0 0 24 24">
                            <path stroke-width="4" d="M 11.22 3 A 9 9 0 1 1 11.21 3" />
                        </svg>
                    </div>
                    <div class="moon">
                        <svg viewbox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1 1 11.21 3A7 7 0 0 0 21 12.79"></path>
                        </svg>
                    </div>
                </div>
            </label>
            <ul>
                <li>
                    <a href="<?php echo $url . "Pages/" . $user . "/Homepage.php" ?>"><button <?php if ($oUrl == ($url . "Pages/" . $user . "/Homepage.php")) : ?> class="active" <?php endif ?>>Dashboard</button></a>
                </li>
                <li>
                    <a href="<?php echo $url . "Pages/logout.php" ?>"><button>Logout</button></a>
                </li>
            </ul>
        </nav>
    </header>

<?php }

function GetScripts()
{
    global $url;
?>
    <script type="text/javascript" src="<?php echo $url ?>Assets/JS/header.js" defer></script>
    <script type="text/javascript" src="<?php echo $url ?>Assets/JS/darkmode.js" defer></script>
<?php
}

?>