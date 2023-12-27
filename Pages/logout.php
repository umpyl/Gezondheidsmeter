<?php
session_start();
include "../Assets/templates/theader.php";

session_destroy();

header('location: ' . $url . 'Pages/login.php');
