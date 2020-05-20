

<!--Link do vídeo onde vi estes processos: https://www.youtube.com/watch?v=LtdE_LtLwqE-->
<!--https://pt.stackoverflow.com/questions/40858/como-enviar-e-mail-do-localhost-usando-a-fun%C3%A7%C3%A3o-mail-do-php-->

<div class="events w-75 mx-auto">

    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <!--título-->
        <div class="row no-gutters">
            <h3 class="mx-auto letter">
                Dúvida/Sugestão</h3>
            <p class="mt-5">Se tiveres uma dúvida ou uma sugestão, envia-nos uma mensagem! Teremos muito gosto em te
                responder!</p>
        </div>
        <!----------->
        <form class="md-form inserir_nome mb-2" action="scripts/data_question_form.php" enctype="multipart/form-data"
              method="post">
            <!--Nome do utilizador-->
            <div class="form-group text-left">
                <label class="label-margin" for="nome_user">Nome:</label>
                <input type="text" id="nome_user" name="nome_user" class="form-control"
                       placeholder="Escreve aqui o teu nome...">
            </div>
            <!-------------------------------------------->
            <!--E-Mail do utilizador-->
            <div class="form-group text-left">
                <label class="label-margin" for="mail_user">E-mail:</label>
                <input type="text" id="mail_user" name="mail_user" class="form-control"
                       placeholder="Escreve aqui o teu e-mail...">
            </div>
            <!-------------------------------------------->
            <!--Assunto do e-mail e sugestão/dúvida-->
            <div class="form-group text-left">
                <label class="label-margin" for="sugestao">Dúvida/Sugestão:</label>
                <input type="text" name="assunto" class="form-control mb-1"
                       placeholder="Escreve aqui o assunto do teu e-mail...">
                <textarea rows="5" type="text" id="sugestao" name="sugestao" class="form-control" maxlength="500"
                          placeholder="Escreve aqui a tua dúvida ou sugestão..."></textarea>
            </div>
            <!-------------------------------------------->

            <!--Código de php que gera as mensagens de erro e sucesso. Por GET vai buscar o "error" e o "sucess" à URL, que foram definidas no script "data_question_form.php". Aí também estão definidas as variáveis que vão guardar a informação proveniente dos campos desta página-->
            <?php
            $mensagem = "";
            if(isset($_GET['error'])){

                $mensagem = "<div class='alert alert-danger'>Por favor, preenche todos os campos.</div>";

                echo $mensagem;
            }

            if(isset($_GET['success'])){

                $mensagem = "<div class='alert alert-success'>A tua mensagem foi enviada com sucesso! Obrigado, prometemos ser breves.</div>";

                echo $mensagem;
            }
            ?>

            <div>
                <button type="submit" class="btn btn-success enviar_btn" name="btn_enviar">Enviar</button>
            </div>
        </form>
    </div>
</div>
