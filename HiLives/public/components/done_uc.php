<div class="events w-75 mx-auto">

    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <!--título-->
        <div class="row no-gutters">
            <h3 class="mx-auto letter">
                Carregar nova Unidade Curricular feita</h3>
        </div>
        <!----------->
        <form class="md-form inserir_dados" class="mb-3" action="scripts/insert_done_uc.php"
              enctype="multipart/form-data" method="post">
            <!--primeiro campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="nomeuc">Nome da Unidade Curricular: <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                <input type="text" id="nomeuc" name="nomeuc" class="form-control" required="required">
            </div>
            <!-------------------------------------------->
            <!--segundo campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="uniuc">Universidade onde foi feita: <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                <input type="text" id="uniuc" name="uniuc" class="form-control" required="required">
            </div>
            <!-------------------------------------------->
            <!--terceiro campo-->
            <div class="form-group text-left">
                <label class="label-margin" for="data">Data de conclusão: <span style="color: #79C4D9; font-weight: bold; font-size: 20px">*</span></label>
                <input type="date" id="data" name="data" class="form-control" required="required">
            </div>
            <!-------------------------------------------->
            <div>
                <button type="submit" class="btn btn-success publicar_btn">Publicar</button>
            </div>

        </form>
    </div>
</div>