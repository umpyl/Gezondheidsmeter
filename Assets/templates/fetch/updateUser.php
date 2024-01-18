<?php
session_start();
require "../../../Particles/conn.php";

$DATA = json_decode(file_get_contents('php://input'), true);
$connectionClass = new Connection();
$connection = $connectionClass->setConnection();

echo json_encode($DATA);
