<?php
require_once "../connections/connection.php";

    $idUser = $_POST['id'];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);
    $query = "SELECT status FROM notifications WHERE User_idUser = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $status);
        mysqli_stmt_store_result($stmt); 
        while (mysqli_stmt_fetch($stmt)) {
            if($status == 1){
                $query2 = "UPDATE notifications
                          SET status = 0
                          WHERE  User_idUser = ?";

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    
                    if (mysqli_stmt_execute($stmt2)) {
                        $notificacao = "<img src=\"img/notif.png\"alt=\"Símbolo de notificações\" title=\"Notificações\" style=\"position:relative; max-width:25px\"><span class=\"nome ml-2\">O que está a acontecer</span>
                                     ";
                        $dados = array('text' => $notificacao);
                    }
                    
                    mysqli_stmt_close($stmt2);
                }
            } else {
                $notificacao = "<img src=\"img/notif.png\"alt=\"Símbolo de notificações\" title=\"Notificações\" style=\"position:relative; max-width:25px\"><span class=\"nome ml-2\">O que está a acontecer</span>";
                $dados = array('text' => $notificacao);

            }
        }
    }

echo json_encode($dados);