<?php
if (isset($_GET["info"])) {
    $idContent = $_GET["info"];
    // We need the function!
    require_once("connections/connection.php");
    // Create a new DB connection
    $link = new_db_connection();
    //create a prepared statement
    $stmt = mysqli_stmt_init($link);
    //ir buscar os dados
    $query = "SELECT idContent, content_type, content_name, date_content, name_user, profile_img, vacancie_name FROM content 
    INNER JOIN vacancies ON content.idContent = vacancies.Content_idContent
    Inner JOIN users ON vacancies.User_publicou = users.idUser WHERE idContent = ?";


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idContent);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idContent, $content_type, $content_name, $date_content, $name_user, $profile_img, $vacancie_name);

        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Informações do vídeo da vaga <?= $vacancie_name ?></h1>
            <p class="mb-4">Aqui é possível visualizar com mais detalhes o vídeo selecionado anteriormente.</p>
            <div class="card text-center">
                <div class="col-12">
                    <!--vídeo-->
                    <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 mt-5">
                        <video class="embed-responsive-item" src="uploads/vid_vac/<?= $content_name ?>" controls="controls"></video>
                    </div>
                    <!----------------------->
                    <!--Nome-->
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
                    <!----------------------->
                    <!--Nome do conteúdo-->
                    <div class="text-left">
                        <h5>Nome do conteúdo: <span style="font-size: 16px;"><?= $content_name ?></span></h5>
                    </div>
                    <hr>
                    <!----------------------->
                    <!--tipo-->
                    <div class="text-left">
                        <h5>Tipo de conteúdo: <span style="font-size: 16px;"><?= $content_type ?></span></h5>
                    </div>
                    <hr>
                    <!----------------------->
                    <!--data-->
                    <div class="text-left">
                        <h5>Publicado a <span style="font-size: 16px;"><?= substr($date_content, 0, 10) ?></span></h5>
                    </div>
                    <hr>
                    <!----------------------->
                    <div class="form-group mt-5">
                        <a class="col-xs-12 col-md-12" href="#" data-toggle="modal" data-target="#delete_emp<?= $idContent ?>"> <button class="btn cancel_btn"><i class="fas fa-trash"></i> Apagar conteúdo</button></a>
                        <span></span>
                    </div>

                </div>
            </div>

<?php
            //Modal de apagar vaga
            include('components/delete_modal.php');
        }
    }
} else {
    include("404.php");
} //fim do else se não existir o GET
?>