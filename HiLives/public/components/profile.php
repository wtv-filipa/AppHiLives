<div class="row mt-5">
    <div class="col-2">
        <img class="image_profile"
             src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=faces" alt="">
    </div>
    <div class="col-10">
        <h3 class="">Adelaide Ferreira</h3>
        <br>
        <h5 class="">97 anos</h5>
        <!--
       <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit</p>
        -->
        <div class="mt-4">
            <button class="btn profile-edit-btn">Editar perfil</button>
            <button class="btn profile-edit-btn">Adicionar disciplinas</button>
        </div>
    </div>

</div>

<!-----CARDS DE INFORMAÇÃO------->
<div class="row mt-5">
    <!--PRIMEIRO CARD-->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Características</h5>
            </div>
            <div class="card-body altura">
                <blockquote class="blockquote mb-0">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pellentesque dignissim velit, id
                        porta nisi sollicitudin a. Phasellus quam magna, semper et lobortis semper, placerat at ipsum.
                        Quisque porta ante et placerat tempor. Suspendisse vel sem vitae tellus ornare egestas. Sed
                        euismod in sem id dictum. Vestibulum ut nulla nec odio consectetur facilisis. Fusce accumsan
                        euismod tellus, ac euismod magna fringilla at. Donec a sapien vel tortor pharetra tincidunt in
                        ac ex. Integer ut erat ante. Phasellus auctor iaculis justo a commodo. Ut at sem ac nulla
                        scelerisque luctus. Etiam sit amet bibendum elit. Praesent lobortis sit amet ipsum condimentum
                        dictum.</p>
                </blockquote>
            </div>
        </div>
    </div>
    <!------------------------------------------>
    <!--SEGUNDO CARD-->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Habilidades</h5>
            </div>
            <div class="card-body altura">
                <blockquote class="blockquote mb-0 mt-4">
                    <p>Telefone: 234 567 890</p>
                    <p>Email: exemplo@exemplo.com</p>
                    <p>Website: www.exemplo.com</p>
                    <p>Facebook: www.facebook.com/exemplo</p>
                    <p>Instagram: www.instagram.com/exemplo</p>
                </blockquote>
            </div>
        </div>
    </div>
</div>

<!--div que contém os videos-->
<div class="mt-5 mb-5">
    <h3 class="mb-4 titulo_videos">As minhas experiências</h3>
    <div class="card mt-4">
        <div class="row m-3">
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1">
            </div>
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1">
            </div>
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1">
            </div>
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1">
            </div>
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1">
            </div>
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1">
            </div>
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1">
            </div>
            <div class="col-md-3 mt-3 bt_add">
                <button type="" class="btn">ADICIONAR</button>
            </div>
        </div>
    </div>
</div>
<!--Modal dos vídeos-->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <!--Conteudo-->
        <div class="modal-content">

            <!--Corpo-->
            <div class="modal-body mb-0 p-0">

                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 m-0">
                    <video class="embed-responsive-item" src=""
                           controls="controls"></video>
                </div>
            </div>

            <!--Footer-->
            <div class="ml-3 mr-3">
                <h3 class="mt-4">Título do vídeo</h3>

                <img class="avatar" src="img/jovem.png" alt="Fotografia de perfil">
                <p class="username_modal">Joana Martins</p>

                <hr>

                <h5 class="mt-3">Descrição</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.</p>

                <button type="button" class="btn btn-outline-primary btn-rounded btn-md mb-4" data-dismiss="modal">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>