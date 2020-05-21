<!--Modal do vídeo para a parte onde mostra todas as experiências-->
<div class="modal fade" id="modalvid<?= $row_vid['idExperiences'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <!--Conteudo-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Corpo-->
            <div class="modal-body mb-0 p-0">
                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 m-0">
                    <video class="embed-responsive-item" src="../admin/uploads/xp/<?= $row_vid['content_name']; ?>" controls="controls"></video>
                </div>
            </div>

            <!--Footer-->
            <div class="ml-3 mr-3">
                <h3 class="mt-4"><?= $row_vid['title_exp'] ?></h3>
                <img class="avatar_modal" src="../admin/uploads/img_perfil/<?= $row_vid['profile_img'] ?>">
                <p class="username_modal"><?= $row_vid['name_user'] ?></p>
                <hr>
                <h5 class="mt-3">Descrição</h5>
                <p class="descricao"><?= $row_vid['description'] ?></p>

            </div>
        </div>
    </div>
</div>

<!--Modal do vídeo das experiências do jovem-->
<div class="modal fade" id="modalvideo<?= $idExperiences ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <!--Conteudo-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Corpo-->
            <div class="modal-body mb-0 p-0">
                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 m-0">
                    <video class="embed-responsive-item" src="../admin/uploads/xp/<?= $content_name ?>" controls="controls"></video>
                </div>
            </div>

            <!--Footer-->
            <div class="ml-3 mr-3">
                <h3 class="mt-4"><?= $title_exp ?></h3>
                <img class="avatar_modal" src="../admin/uploads/img_perfil/<?= $profile_img ?>">
                <p class="username_modal"><?= $name_user ?></p>
                <hr>
                <h5 class="mt-3">Descrição</h5>
                <p class="descricao"><?= $description ?></p>

            </div>
        </div>
    </div>
</div>

<!--Modal do vídeo que está nas vagas da empresa-->
<div class="modal fade" id="modalvideo<?= $idVacancies ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <!--Conteudo-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Corpo-->
            <div class="modal-body mb-0 p-0">
                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 m-0">
                    <video class="embed-responsive-item" src="../admin/uploads/vid_vac/<?= $content_name ?>" controls="controls"></video>
                </div>
            </div>

            <!--Footer-->
            <div class="ml-3 mr-3">
                <h3 class="mt-4"><?= $vacancie_name ?></h3>
                <?php
                if (isset($profile_img)) {
                ?>
                    <img class="avatar_modal" src="../admin/uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" />
                <?php
                } else {
                ?>
                    <img class="avatar_modal" src="img/no_profile_img.png" alt="sem imagem de perfil" />
                <?php
                }
                ?>
                <p class="username_modal"><?= $name_user ?></p>
                <hr>
            </div>
        </div>
    </div>
</div>