<?php
session_start();
$id_navegar = $_SESSION["idUser"];
if (isset($_GET['apaga'])) {

    echo "estou a apagar um vídeo de uma empresa";
    $idUser = $_SESSION["idUser"];
    $idContent = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query = "UPDATE vacancies SET Content_idContent = Null WHERE Content_idContent = ?";
    $query2 = "DELETE FROM content WHERE idContent = ?";
    $query3 = "SELECT content_name FROM content WHERE idContent = ?";

    if (mysqli_stmt_prepare($stmt, $query3)) {

        mysqli_stmt_bind_param($stmt, 'i', $idContent);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $content_name);
        while (mysqli_stmt_fetch($stmt)) {
            $ficheiro = "../../admin/uploads/vid_vac/" . $content_name;
            
            if (!unlink($ficheiro)) {
               
                header("Location: ../profile.php?user=$id_navegar#xp_vac");
                $_SESSION["xp_vac"] = 2;
            } else {
               
                if (mysqli_stmt_prepare($stmt2, $query)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idContent);
                    if (!mysqli_stmt_execute($stmt2)) {
                       
                        header("Location: ../profile.php?user=$id_navegar#xp_vac");
                        $_SESSION["xp_vac"] = 2;
                    }
                    
                    mysqli_stmt_close($stmt2);
                } else {
                   
                    header("Location: ../profile.php?user=$id_navegar#xp_vac");
                    $_SESSION["xp_vac"] = 2;
                }
               
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idContent);
                    if (!mysqli_stmt_execute($stmt2)) {
                        
                        header("Location: ../profile.php?user=$id_navegar#xp_vac");
                        $_SESSION["xp_vac"] = 2;
                       
                    }
                    mysqli_stmt_close($stmt2);
                } else {
                    
                    header("Location: ../profile.php?user=$id_navegar#xp_vac");
                    $_SESSION["xp_vac"] = 2;
                }
                
                header("Location: ../profile.php?user=$id_navegar#xp_vac");
                $_SESSION["xp_vac"] = 1;
            }
        }
        
        mysqli_stmt_close($stmt);
    } else {
       
        header("Location: ../profile.php?user=$id_navegar#xp_vac");
        $_SESSION["xp_vac"] = 2;
    }
    
    mysqli_close($link);
    mysqli_close($link2);
} else {
 
    header("Location: ../profile.php?user=$id_navegar#xp_vac");
    $_SESSION["xp_vac"] = 2;
}
