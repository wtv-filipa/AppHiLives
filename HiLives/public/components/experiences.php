<?php
include "navbar_2.php";
if (isset($_SESSION["idUser"])) {
    $id_navegar = $_SESSION["idUser"];
?>
    <!--Vídeos-->
    <div class="mx-auto w-75">
        <div class="mt-5">
            <h3>Experiências</h3>
        </div>

        <div class="row mt-5">
            <?php
            require_once("connections/connection.php");
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            $query = "SELECT idExperiences, title_exp, description, date, content_name, name_user, profile_img FROM experiences INNER JOIN content ON experiences.Content_idContent=content.idContent INNER JOIN users ON experiences.User_idUser=users.idUser";
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $idExperiences, $title_exp, $description, $date, $content_name, $name_user, $profile_img);
                while (mysqli_stmt_fetch($stmt)) {
            ?>
                    <div class="col-md-6 col-lg-4 mb-4 pb-2">
                        <a>
                            <video class="img-fluid z-depth-1 p-0 m-0 vid_tamanho" alt="vídeo da experiência <?= $title_exp ?>" type="video" data-toggle="modal" data-target="#modal1">
                                <source src="../admin/uploads/xp/<?= $content_name ?>">
                                Your browser does not support the video tag.
                            </video>
                        </a>
                        <div class="row mt-2 p-0">
                            <img class="avatar col-3" src="../admin/uploads/img_perfil/<?=$profile_img?>" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                            <div class="col-9">
                                <p class="xp_titulo m-0"><?= $title_exp ?></p>
                                <p class="username"><?= $name_user ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <!--Fim do "card"-->
        </div>
    </div>
<?php
}
?>