<div class="events w-75 mx-auto">

    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <!--título-->
        <div class="row no-gutters">
            <h3 class="mx-auto letter">
                Editar experiência</h3>
        </div>
        <!----------->
        <form class="md-form inserir_dados" class="mb-3" action="scripts/criar_evento.php" enctype="multipart/form-data" method="post">
            <!--input de upload-->
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input file-upload" id="customFile" name="fileToUpload">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <div class="alert alert-warning" role="alert">
                Insere um vídeo até 50MB.
            </div>
            <!-------------------------------------------->
            <!--primeiro campo-->
            <div class="form-group text-left">
                <label for="nomeVideo">Nome do vídeo:</label>
                <input type="text" id="nomeVideo" name="nomeVideo" class="form-control">
            </div>
            <!-------------------------------------------->
            <!--segundo campo-->
            <div class="form-group text-left mt-4">
                <label for="descricao">Descrição do vídeo:</label>
                <textarea type="text" id="descricao" name="descricao" class="form-control"></textarea>
            </div>
            <!-------------------------------------------->
            <div>
                <button type="submit" class="btn btn-success publicar_btn">Guardar</button>
            </div>

        </form>
    </div>
</div>