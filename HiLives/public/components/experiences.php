<?php
include "navbar_2.php";

require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"]) && isset($_SESSION["type"])) {
    $id_navegar = $_SESSION["idUser"];
    $User_type = $_SESSION["type"];
?>
    <div class="mx-auto w-75">
        <div class="mt-5">
            <?php
            if ($User_type == 10) {
            ?>
                <h3>Experiências</h3>
                <p style="opacity:0.8; font-size: 14px;">Aqui, vais encontrar vídeos que demonstram como foram as experiências académicas e profissionais de outros utilizadores da HiLives. Podes também encontrar vídeos que mostram os ambientes das empresas ou universidades.Qualquer jovem consegue publicar uma experiência.<a href="upload_xp.php" title="Clica para adicionar" target="_blank"> Adiciona a tua aqui.<a></p>
            <?php
            } else if ($User_type == 7 || $User_type == 13){
            ?>
                <h3>Experiências</h3>
                <p style="opacity:0.8; font-size: 14px;">Aqui, vai encontrar vídeos que demonstram como foram as experiências académicas e profissionais de outros utilizadores da HiLives. Pode também encontrar vídeos que mostrar os ambientes das empresas ou universidades. Estas experiências apenas são publicadas por jovens.</p>
            <?php
            }
            ?>
        </div>

        <div class="row mt-5">
            <?php
            $query = "SELECT idExperiences, title_exp, description, date, content_name, name_user, profile_img 
                        FROM experiences 
                        INNER JOIN content ON experiences.Content_idContent=content.idContent 
                        INNER JOIN users ON experiences.User_idUser=users.idUser";
            $array_val = mysqli_query($link, $query);

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $idExperiences, $title_exp, $description, $date, $content_name, $name_user, $profile_img);
                mysqli_stmt_store_result($stmt); 
                if (mysqli_stmt_num_rows($stmt) > 0) { 
                    while ($row_vid = mysqli_fetch_assoc($array_val)) {
            ?>
                        <div class="col-md-6 col-lg-4 mb-4 pb-2">
                            <a href="#" data-toggle="modal" data-target="#modalvid<?= $row_vid['idExperiences'] ?>">
                                <video class="img-fluid z-depth-1 p-0 m-0 vid_tamanho" alt="vídeo da experiência <?= $row_vid['title_exp'] ?>" type="video" data-toggle="modal" data-target="#modal1">
                                    <source src="../admin/uploads/xp/<?= $row_vid['content_name']; ?>">
                                    Your browser does not support the video tag.
                                </video>

                                <div class="row mt-2 p-0">
                                    <?php
                                    if (isset($row_vid['profile_img'])) {
                                    ?>
                                        <img alt="Imagem de perfil <?= $row_vid['name_user']; ?>" class=" rounded-circle avatar col-3" src="../admin/uploads/img_perfil/<?= $row_vid['profile_img'] ?>">
                                    <?php
                                    } else {
                                    ?>
                                        <img alt="Imagem de perfil padrão" class=" rounded-circle avatar col-3" src="img/no_profile_img.png">
                                    <?php
                                    }
                                    ?>
                                    <div class="col-9">
                                        <p class="xp_titulo m-0"><?= $row_vid['title_exp'] ?></p>
                                        <p class="username"><?= $row_vid['name_user'] ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                     
                        include('components/modal_vid.php');
                    }
                    
                    mysqli_stmt_close($stmt);
                } else {
                    ?>
                    <p class="mx-auto mt-5 mb-5" style="font-size: 1rem; padding-bottom: 30%;">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                        </svg>
                        Ainda não existe nenhuma experiência publicada.
                    </p>
            <?php
                }
            }
            ?>
           
        </div>
    </div>
<?php

} else {
    include("404.php");
}

mysqli_close($link);
?>