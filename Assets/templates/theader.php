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
    <script type="text/javascript" src="<?php echo $url ?>Assets/JS/header.js" defer></script>
    <script type="text/javascript" src="<?php echo $url ?>Assets/JS/darkmode.js" defer></script>
    <header id="header" class="header">
        <div class="logo">
        </div>
        <nav class="navbar">
            <input type="checkbox" id="darkmodeToggle">test</input>
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

<?php } ?>