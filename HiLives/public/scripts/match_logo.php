<?php
require_once("../connections/connection.php");
$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_GET["jovem"])) {
    $idUser = $_GET["jovem"];
    include "match_uni_login.php";
    header("Location: ../home_people.php");
} else if (isset($_GET["uni"])) {
    $idUser = $_GET["uni"];
    include "match_young_login.php";
    header("Location: ../home_uni.php");
} else if (isset($_GET["emp"])) {
    $idUser = $_GET["emp"];
    $query2 = "SELECT idVacancies FROM vacancies WHERE User_publicou = ?";
    if (mysqli_stmt_prepare($stmt2, $query2)) {
        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_bind_result($stmt2, $idVacancies);
        while (mysqli_stmt_fetch($stmt2)) {
            include "match_comp.php"; 
            header("Location: ../home_companies.php");
        }
        mysqli_stmt_close($stmt2);
        mysqli_close($link2);
    }
   
}
