<?php //setupusers

require_once('php/login.php');
if($conn->connect_error) die("fatal error");

$query = "CREATE TABLE users (
    forename VARCHAR(32) NOT NULL,
    surname VARCHAR(32) NOT NULL,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

$result = $conn->query($query);
if (!$result) die ("table users creation failed");

$forename   = 'Johan';
$surname    = 'Perks';
$username   = 'LOIDocent';
$password   = 'mysqlphp';
$hash       = password_hash($password, PASSWORD_DEFAULT);

add_user($conn, $forename, $surname, $username, $hash);

function add_user($conn, $forn, $surn, $usern, $passw)
{
    $stmt = $conn->prepare('INSERT INTO users VALUES(?,?,?,?)');
    $stmt->bind_param('ssss', $forn, $surn, $usern, $passw);
    $stmt->execute();
    $stmt->close();
}

?>