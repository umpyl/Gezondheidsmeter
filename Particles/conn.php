<?php
class Connection
{
    public function setConnection() {
        include 'config.php';
        $con = mysqli_connect($dbhost,$user,$pass,$dbname);
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        else {
        }
        return $con;
    }
}