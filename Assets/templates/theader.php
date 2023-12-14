<?php

$url =  $_SERVER['REQUEST_URI'];

$position = strpos($url, "assets");

if ($position !== false) {
    $url = substr($url, 0, $position);
} else {
    // echo "Word not found in the string.";
}
?>

<div class="header">
    <div class="logo"></div>
    <nav class="navbar">
        <ul>
            <li>
                <a href="<?php echo $url ?>"><?php echo $url ?></a>
            </li>
        </ul>
    </nav>
</div>