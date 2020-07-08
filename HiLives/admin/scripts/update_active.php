<?php
session_start();
if (isset($_GET["block"]) && isset($_GET["a"])) {
    $idUser = $_GET["block"];
    $active = $_GET["a"];

    require_once("../connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query2 = "SELECT User_type_idUser_type FROM users WHERE idUser = ?";

    if ($active == 1) {
        $query = "UPDATE users
              SET active = 0
              WHERE idUser = ?";
    } else {
        $query = "UPDATE users
              SET active = 1
              WHERE idUser = ?";
    }


    if (mysqli_stmt_prepare($stmt2, $query2)) {
        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_bind_result($stmt2, $type_user);
        if (mysqli_stmt_fetch($stmt2)) {
            if ($type_user == 7) {
                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../users_emp.php");
                        $_SESSION["emp"] = 2;
                    } else {
                        if ($active == 1) {
                            header("Location: ../users_emp.php");
                            $_SESSION["emp"] = 1;
                        } else {
                            header("Location: ../users_emp.php");
                            $_SESSION["emp"] = 3;
                        }
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../users_emp.php");
                    $_SESSION["emp"] = 2;
                }
            } else if ($type_user == 10) {
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../users_jovem.php");
                        $_SESSION["jovem"] = 2;
                    } else {
                        if ($active == 1) {
                            header("Location: ../users_jovem.php");
                            $_SESSION["jovem"] = 1;
                        } else {
                            header("Location: ../users_jovem.php");
                            $_SESSION["jovem"] = 3;
                        }
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../users_jovem.php");
                    $_SESSION["jovem"] = 2;
                }
            } else if ($type_user == 13) {
                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../users_uni.php");
                        $_SESSION["uni"] = 2;
                    } else {
                        if ($active == 1) {
                            header("Location: ../users_uni.php");
                            $_SESSION["uni"] = 1;
                        } else {
                            header("Location: ../users_uni.php");
                            $_SESSION["uni"] = 3;
                        }
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ../users_uni.php");
                    $_SESSION["uni"] = 2;
                }
            } else {
                header("Location: ../index.php");
                $_SESSION["erro"] = 1;
            }
        } else {
            header("Location: ../index.php");
            $_SESSION["erro"] = 1;
        }
    } else {
        header("Location: ../index.php");
        $_SESSION["erro"] = 1;
    }
} else {
    header("Location: ../index.php");
    $_SESSION["erro"] = 1;
}
