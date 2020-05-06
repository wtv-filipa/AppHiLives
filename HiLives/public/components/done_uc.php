
<div class="events w-75 mx-auto">

    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <!--título-->
        <div class="row no-gutters">
            <h3 class="mx-auto letter">
                Carregar nova Unidade Curricular feita</h3>
        </div>
        <!----------->
        <form class="md-form inserir_dados" class="mb-3" action="scripts/criar_evento.php" enctype="multipart/form-data" method="post">
            <!--primeiro campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="nomeuc">Nome da Unidade Curricular:</label>
                <input type="text" id="nomeuc" name="nomeuc" class="form-control">
            </div>
            <!-------------------------------------------->
            <!--segundo campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="uni">Universidade onde foi feita:</label>
                <select class="form-control" id="uni">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <!-------------------------------------------->
            <!--terceiro campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="data">Data de conclusão:</label>
                <input type="date" id="data" name="data" class="form-control">
            </div>
            <!-------------------------------------------->
            <div>
                <button type="submit" class="btn btn-success publicar_btn">Publicar</button>
            </div>

        </form>
    </div>
</div>