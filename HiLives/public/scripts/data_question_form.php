<?php

    if(isset($_POST['btn_enviar'])){

        $nome_user = $_POST['nome_user'];
        $mail_user = $_POST['mail_user'];
        $assunto = $_POST['assunto'];
        $sugestao = $_POST['sugestao'];

        if(empty($nome_user) || empty($mail_user) || empty($assunto) || empty($sugestao)){

            header('location:../question_form.php?error');
        }
        else{

            $para = "eduardosoeiro@ua.pt";

            if(mail($para,$assunto,$sugestao,$mail_user)){

                header('location:../question_form.php?success');
            }
        }
    }
?>