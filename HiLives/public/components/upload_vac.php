<div class="events w-75 mx-auto">

    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <!--título-->
        <div class="row no-gutters">
            <h3 class="mx-auto letter">
                Criar nova vaga</h3>
        </div>
        <!----------->
        <form class="md-form inserir_dados" class="mb-3" action="scripts/criar_evento.php" enctype="multipart/form-data" method="post">
            <!--primeiro campo-->
            <div class="form-group text-left">
                <label for="nomevaga">Cargo na empresa:</label>
                <input type="text" id="nomevaga" name="nomevaga" class="form-control">
            </div>
            <!-------------------------------------------->
            <!--segundo campo-->
            <div class="form-group text-left mt-4">
                <label for="descricao">Descrição da vaga:</label>
                <textarea type="text" id="descricao" name="descricao" class="form-control"></textarea>
            </div>
            <!-------------------------------------------->
            <!--terceiro campo-->
            <div class="form-group text-left">
                <label for="numvagas">Número de vagas disponíveis:</label>
                <input type="text" id="numvagas" name="numvagas" class="form-control">
            </div>
            <!-------------------------------------------->
            <!--quarto campo-->
            <div class="form-group text-left">
                <label for="regiao">Região:</label>
                <select class="form-control" id="regiao">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <!-------------------------------------------->
            <!--quinto campo-->
            <div class="form-group text-left">
                <label for="jornada">Jornada de trabalho:</label>
                <select class="form-control" id="jornada">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <!-------------------------------------------->
            <!--input de upload-->
            <div class="alert alert-warning mt-4" role="alert">
                Insira um vídeo da experiência na empresa até 50MB. (opcional)
            </div>
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input file-upload" id="customFile" name="fileToUpload">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            
            <!-------------------------------------------->

            <div>
                <button type="submit" class="btn btn-success publicar_btn">Publicar</button>
            </div>

        </form>
    </div>
</div>