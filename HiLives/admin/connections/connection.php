<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
function new_db_connection()
{
    $hostname = 'labmm.clients.ua.pt';
    $username = "deca_18L4_02_dbo";
    $password = "8lEo8c";
    $dbname = "deca_18l4_02";

    $local_link= mysqli_connect($hostname, $username, $password, $dbname);

    if (!$local_link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($local_link, "utf8");

    return $local_link;
}
