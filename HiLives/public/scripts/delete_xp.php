<?php
session_start();
$id_navegar = $_SESSION["idUser"];
if (isset($_GET['apaga']) && isset($_GET['user'])) {
    
    $idContent = $_GET["apaga"];
    $idUser =  $_GET["user"];

    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query = "DELETE FROM experiences WHERE Content_idContent = ?";
    $query2 = "DELETE FROM content WHERE idContent = ?";
    $query3 = "SELECT content_name FROM content WHERE idContent = ?";

    if (mysqli_stmt_prepare($stmt, $query3)) {

        mysqli_stmt_bind_param($stmt, 'i', $idContent);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $content_name);
        while (mysqli_stmt_fetch($stmt)) {
            $ficheiro = "../../admin/uploads/xp/" . $content_name;
            
            if (!unlink($ficheiro)) {
               
                header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                $_SESSION["xp_jovem"] = 4;
                
            } else {
                
                if (mysqli_stmt_prepare($stmt2, $query)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idContent);
                    if (!mysqli_stmt_execute($stmt2)) {
                       
                        header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                        $_SESSION["xp_jovem"] = 4;
                        
                    }
                    mysqli_stmt_close($stmt2);
                } else {
                   
                    header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                    $_SESSION["xp_jovem"] = 4;
                }
                
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idContent);
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                        $_SESSION["xp_jovem"] = 4;
                        
                    }

                    mysqli_stmt_close($stmt2);
                } else {
                   
                    header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                    $_SESSION["xp_jovem"] = 4;
                }
                
                header("Location: ../profile.php?user=$id_navegar#xp_jovem");
                $_SESSION["xp_jovem"] = 3;
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        
        header("Location: ../profile.php?user=$id_navegar#xp_jovem");
        $_SESSION["xp_jovem"] = 4;
    }
    
    mysqli_close($link);
    mysqli_close($link2);
} else {
        
    header("Location: ../profile.php?user=$id_navegar#xp_jovem");
    $_SESSION["xp_jovem"] = 4;
}
