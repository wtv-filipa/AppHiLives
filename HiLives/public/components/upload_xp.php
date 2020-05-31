<?php

if (isset($_SESSION["idUser"])) {
    $id_navegar = $_SESSION["idUser"];
    ?>
<div class="events w-75 mx-auto">

    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <!--título-->
        <div class="row no-gutters">
            <h3 class="mx-auto letter">
                Carregar vídeo de experiência</h3>
        </div>
        <!----------->
        <?php
        require_once("connections/connection.php");
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "SELECT idUser FROM users WHERE idUser=?";
        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $id_navegar);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $idUser);
            while (mysqli_stmt_fetch($stmt)) {
        ?>
                <form class="md-form inserir_dados" class="mb-3" action="scripts/upload_xp.php?xp=<?=$idUser?>" enctype="multipart/form-data" method="post">
                    <!--input de upload-->
                    <div class="alert alert-warning mb-3" role="alert">
                        Insere um vídeo até 50MB.
                    </div>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input file-upload" id="fileToUpload" name="fileToUpload" accept=".avi, .wmv, .mp4" >
                        <label class="custom-file-label" for="fileToUpload">Escolher ficheiro</label>
                    </div>
                    <!-------------------------------------------->
                    <!--primeiro campo-->
                    <div class="form-group text-left">
                        <label class="label-margin" for="nomeVideo">Nome da experiência</label>
                        <input type="text" id="nomeVideo" name="nomeVideo" class="form-control" placeholder="Escreve aqui o título que melhor descreve o vídeo da tua experiência">
                    </div>
                    <!-------------------------------------------->
                    <!--segundo campo-->
                    <div class="form-group text-left mt-4">
                        <label class="label-margin" for="descricao">Descrição</label>
                        <textarea type="text" id="descricao" name="descricao" class="form-control" placeholder="Escreve aqui a descrição que melhor descreve o vídeo da tua experiência"></textarea>
                    </div>
                    <!-------------------------------------------->
                    <div>
                        <button type="submit" name="but_upload" class="btn btn-success publicar_btn">Publicar</button>
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