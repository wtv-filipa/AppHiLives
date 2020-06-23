<?php

if (isset($_GET["edit_xp"]) && isset($_SESSION["idUser"])) {
    $id_navegar = $_SESSION["idUser"];
    $id_xp = $_GET["edit_xp"];
    ?>
<div class="events w-75 mx-auto">

    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">
    <?php
    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT idExperiences, title_exp, description FROM experiences WHERE idExperiences=?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_xp);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idExperiences, $title_exp, $description);
        while (mysqli_stmt_fetch($stmt)) {
            ?>
        <!--título-->
        <div class="no-gutters">
            <h3 class="mx-auto letter">Editar experiência</h3>
            <h3 class="mx-auto letter2"><?= $title_exp?></h3>
        </div>
        <!----------->

                <form class="md-form inserir_dados" class="mb-3" action="scripts/update_xp.php?update_xp=<?=$id_xp?>" method="post">
                    <!--primeiro campo-->
                    <div class="form-group text-left">
                        <label class="label-margin" for="nomeVideo">Nome da experiência: <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                        <input type="text" id="nomeVideo" name="nomeVideo" class="form-control" value="<?= $title_exp?>" placeholder="Escreve aqui o título que melhor descreve o vídeo da tua experiência" required="required">
                    </div>
                    <!-------------------------------------------->
                    <!--segundo campo-->
                    <div class="form-group text-left mt-4">
                        <label class="label-margin" for="descricao">Descrição do vídeo: <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                        <textarea type="text" id="descricao" name="descricao" class="form-control" placeholder="Escreve aqui a descrição que melhor descreve o vídeo da tua experiência" required="required"> <?= $description?></textarea>
                    </div>
                    <!-------------------------------------------->
                    <div>
                        <button type="submit" class="btn btn-success publicar_btn">Guardar</button>
                    </div>

                </form>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php
}
?>