<?php
// We need the function!
require_once("../connections/connection.php");
// Create a new DB connection
$link = new_db_connection();
/* create a prepared statement */
$stmt = mysqli_stmt_init($link);
//ID DO USER A FAZER UPLOAD
$idUser = $_GET["xp"];

if(isset($_GET["xp"]) && isset($_POST["nomeVideo"])){
   echo"dou";
   echo"nome vid:". $_POST["nomeVideo"];
   
}else{
    echo"faltam cenas";
}
