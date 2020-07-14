<?php
session_start();
require_once("../connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$id_match = $_POST['id'];

$query = "SELECT favorite FROM user_has_vacancies WHERE id_match_vac = ?";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 'i', $id_match);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $favorite);
    mysqli_stmt_store_result($stmt);
    while (mysqli_stmt_fetch($stmt)) {
        if ($favorite == 0) {
            $query2 = "UPDATE user_has_vacancies
              SET favorite = 1
              WHERE id_match_vac = ?";

            if (mysqli_stmt_prepare($stmt2, $query2)) {
                mysqli_stmt_bind_param($stmt2, 'i', $id_match);

                if (!mysqli_stmt_execute($stmt2)) {
                    //header("Location: ../administradores.php?msg=1");
                } else {
                    $favorito = "<i class='fa fa-heart' aria-hidden='true' style='color: #A31621'></i>";
                    $dados = array('text' => $favorito);
                }

                mysqli_stmt_close($stmt2);
            } else {
                //header("Location: ../administradores.php?msg=1");
            }
        } else {
            $query3 = "UPDATE user_has_vacancies
            SET favorite = 0
            WHERE id_match_vac = ?";
            $stmt2 = mysqli_stmt_init($link2);
            if (mysqli_stmt_prepare($stmt2, $query3)) {
                mysqli_stmt_bind_param($stmt2, 'i', $id_match);

                if (!mysqli_stmt_execute($stmt2)) {
                    //header("Location: ../administradores.php?msg=1");
                } else {
                    $favorito = "<i class='fa fa-heart-o' aria-hidden='true' style='color: #2F2F2F'></i>";
                    $dados = array('text' => $favorito);
                }

                mysqli_stmt_close($stmt2);
            } else {
                //header("Location: ../administradores.php?msg=1");
            }
        }
    }
}

echo json_encode($dados);
