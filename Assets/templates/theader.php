<?php

$url =  $_SERVER['REQUEST_URI'];

$position = strpos($url, "Gezondheidsmeter/");

if ($position !== false) {
    $url = substr($url, 0, $position + strlen("Gezondheidsmeter/"));
}
?>

<div class="header">
    <div class="logo"></div>
    <nav class="navbar">
        <ul>
            <li>
                <a href="<?php echo $url . "Pages/gebruiker/Homepage.php" ?>"><?php echo $url . "Pages/gebruiker/Homepage.php" ?></a>
            </li>
            <li>
                <a href="<?php echo $url . "Pages/login.php" ?>"><?php echo $url . "Pages/login.php" ?></a>
            </li>
            <li>
                <a href="<?php echo $url . "Pages/register.php" ?>"><?php echo $url . "Pages/register.php" ?></a>
            </li>
        </ul>
    </nav>
</div>