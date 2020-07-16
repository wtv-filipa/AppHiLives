<?php
$servername ="labmm.clients.ua.pt";
$username ="deca_18L4_02_dbo";
$password ="8lEo8c";
$dbname ="deca_18l4_02";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>