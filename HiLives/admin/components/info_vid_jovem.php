<?php
if (isset($_GET["info"])) {
    $idContent = $_GET["info"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT idContent, content_type, content_name, date_content, name_user, profile_img, description, title_exp FROM content 
    INNER JOIN experiences ON content.idContent = experiences.Content_idContent
    Inner JOIN users ON experiences.User_idUser = users.idUser WHERE idContent = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idContent);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idContent, $content_type, $content_name, $date_content, $name_user, $profile_img, $description, $title_exp);

        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Informações da Experiência <?= $title_exp ?></h1>
            <p class="mb-4">Aqui é possível visualizar com mais detalhes o vídeo selecionado anteriormente.</p>
            <div class="card text-center">
                <div class="col-12">
                    <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 mt-5">
                        <video class="embed-responsive-item" src="uploads/xp/<?= $content_name ?>" controls="controls"></video>
                    </div>

                    <div class="text-left mt-3">
                        <div class="row">
                            <?php
                            if (isset($profile_img)) {
                            ?>
                                <img class="col-1 avatar_modal" src="uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" />
                            <?php
                            } else {
                            ?>
                                <img class="col-1 avatar_modal" src="img/no_profile_img.png" alt="sem imagem de perfil" />
                            <?php
                            }
                            ?>
                            <h5 class="col-11 my-auto">Publicado por: <span style="font-size: 16px;"><?= $name_user ?></span></h5>
                        </div>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5>Descrição do vídeo: <span style="font-size: 16px;"><?= $description ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5>Nome do conteúdo: <span style="font-size: 16px;"><?= $content_name ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5>Tipo de conteúdo: <span style="font-size: 16px;"><?= $content_type ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5>Publicado a <span style="font-size: 16px;"><?= substr($date_content, 0, 10) ?></span></h5>
                    </div>
                    <hr>

                    <div class="form-group mt-5">
                        <a class="col-xs-12 col-md-12" href="#" data-toggle="modal" data-target="#deletexp<?= $idContent ?>"> <button class="btn cancel_btn"><i class="fas fa-trash"></i> Apagar Experiência</button></a>
                        <span></span>
                    </div>

                </div>
            </div>

<?php

            include('components/delete_modal.php');
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    include("404.php");
}
?>