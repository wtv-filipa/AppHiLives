

<div class="events w-75 mx-auto">

    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <div class="row no-gutters">
            <h3 class="mx-auto letter">
                Dúvida/Sugestão</h3>
            <p class="mt-5">Se tiveres uma dúvida ou uma sugestão, envia-nos uma mensagem! Teremos muito gosto em te
                responder!</p>
        </div>
        
        <form class="md-form inserir_nome mb-2"  action="https://formspree.io/xayplogr"
              method="POST" enctype="multipart/form-data">
        
            <div class="form-group text-left">
                <label class="label-margin" for="nome_user">Nome:</label>
                <input type="text" id="nome_user" name="name" class="form-control"
                       placeholder="Escreve aqui o teu nome..."
                       required="required"
                       aria-required="true">
            </div>
          
            <div class="form-group text-left">
                <label class="label-margin" for="mail_user">E-mail:</label>
                <input type="text" id="mail_user" name="mail" class="form-control"
                       placeholder="Escreve aqui o teu e-mail..."
                       required="required"
                       aria-required="true">
            </div>
            
            <div class="form-group text-left">
                <label class="label-margin" for="sugestao">Dúvida/Sugestão:</label>
                <textarea rows="7" type="text" id="sugestao" name="sugestao" class="form-control" maxlength="500"
                          placeholder="Escreve aqui a tua dúvida ou sugestão..."
                          required="required"
                          aria-required="true"></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-success enviar_btn" name="btn_enviar">Enviar</button>
            </div>
        </form>
    </div>
</div>
