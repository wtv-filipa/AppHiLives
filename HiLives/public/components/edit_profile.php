<div class="card text-center">
    <h3>Editar Perfil</h3>
    <hr>
        <!-- edit form column -->

        <form class="form-horizontal row" role="form">

            <!-- left column -->
            <div class="col-md-4">
                <div class="text-center">
                    <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
                    <h6>Seleciona uma nova foto</h6>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input file-upload" id="customFile" name="fileToUpload" >
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
            <!--primeiro input-->
            <div class="form-group text-left">
                <label class="label-margin" for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control">
            </div>
            <!----------------------->
            <!--segundo input-->
            <div class="form-group text-left">
                <label class="label-margin" for="email">Email:</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
            <!----------------------->
            <!--terceiro input-->
            <div class="form-group text-left">
                <label class="label-margin" for="tlm">Número de telemóvel:</label>
                <input type="text" id="tlm" name="tlm" class="form-control">
            </div>
            <!----------------------->
            <!--quarto input-->
            <div class="form-group text-left">
                <label class="label-margin" for="born">Data de nascimento:</label>
                <input type="date" id="born" name="born" class="form-control">
            </div>
            <!----------------------->
            <!--quinto input-->
            <div class="form-group text-left">
                <label class="label-margin" for="def">Defeciência:</label>
                <input type="text" id="def" name="def" class="form-control">
            </div>
            <!----------------------->
            <!--sexto input-->
            <div class="form-group text-left">
                <label class="label-margin" for="laudo">Data do laudo:</label>
                <input type="date" id="laudo" name="laudo" class="form-control">
            </div>
            <!----------------------->
            <!--sétimo input-->
            <div class="form-group text-left">
                <label class="label-margin" for="escola">Nível de educação escolar:</label>
                <div class="form-check" id="escola">
                    <label class="form-check-label label-margin">
                        <input type="radio" class="form-check-input" name="optradio">Ensino Primário
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label label-margin">
                        <input type="radio" class="form-check-input" name="optradio">Ensino Básico
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label label-margin">
                        <input type="radio" class="form-check-input" name="optradio">Ensino Secundário
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label label-margin">
                        <input type="radio" class="form-check-input" name="optradio">Ensino Superior
                    </label>
                </div>
            </div>
            <!----------------------->
            <!--oitavo input-->
            <div class="form-group text-left">
                <label class="label-margin" for="xp">Experiência de trabalho:</label>
                <input type="text" id="xp" name="xp" class="form-control">
            </div>
            <!----------------------->
            <!--nono input-->
            <div class="form-group text-left">
                <label class="label-margin" for="areas">Áreas de interesse:</label>
                <div class="form-check" id="areas">
                    <label class="form-check-label label-margin">
                        <input type="checkbox" class="form-check-input" value="">Option 1
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label label-margin">
                        <input type="checkbox" class="form-check-input" value="">Option 2
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label label-margin">
                        <input type="checkbox" class="form-check-input" value="">Option 3
                    </label>
                </div>
            </div>
            <!----------------------->
            <!--nono input-->
            <div class="form-group text-left">
                <label class="label-margin" for="reg">Região:</label>
                <div class="form-check" id="reg">
                    <label class="form-check-label label-margin">
                        <input type="checkbox" class="form-check-input" value="">Option 1
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label label-margin">
                        <input type="checkbox" class="form-check-input" value="">Option 2
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label label-margin">
                        <input type="checkbox" class="form-check-input" value="">Option 3
                    </label>
                </div>
            </div>
            <!----------------------->
            <div class="form-group">
                <label class="col-md-3 control-label label-margin"></label>
                <div class="col-md-8">
                    <input type="button" class="btn guardar_btn" value="Guardar">
                    <span></span>
                    <input type="reset" class="btn cancel_btn" value="Cancelar">
                </div>
            </div>
            </div>
        </form>
</div>