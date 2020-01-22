<?php

namespace App;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nixon_custom";

global $conn;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//wpDB Connection
$servernameWP = "localhost";
$usernameWP = "root";
$passwordWP = "";
$dbnameWP = "nixon";

global $connWP;

// Create connection
$connWP = mysqli_connect($servernameWP, $usernameWP, $passwordWP, $dbnameWP);
// Check connection
if (!$connWP) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
?>
