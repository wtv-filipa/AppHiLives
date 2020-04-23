<div class="w-75 mx-auto">
<div class="row mt-5">
    <div class="col-3">
        <img class="image_profile"
             src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=faces" alt="">
    </div>
    <div class="col-9">
        <h3 class="mt-2">Adelaide Ferreira</h3>
        <h6 class="mt-3">25 anos | Personalidade</h6>
       
        <div class="p-0 mt-3">
            <a href="edit_profile.php"><button class="btn edit_btn">Editar as minhas informações</button></a>
        </div>
    </div>

</div>

<hr class="mt-4">

<!-----CARDS DE INFORMAÇÃO------->
<div class="row mt-5">
    <!--PRIMEIRO CARD-->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header estudo">
                <h5>Últimas disciplinas que fiz</h5>
            </div>
            <div class="card-body altura">
                <blockquote class="blockquote mb-0">
                <ul class='taglabel'>
                        <li class='clearfix_uni_my_links'>
                            <a href=""><img alt="" title="" class="circle_links tagpost_thumb" src="img/ua.jpg"></a>
                            <p class="mb-0 link_info"><i class="fa fa-book mr-1" aria-hidden="true"></i>Estudar</p>
                            <p class="mb-0 link_title">Universidade de Aveiro</p>
                            <p class="mb-0 link_subtitle">Área da saúde</p>
                        </li>
                        <li class='clearfix_uni_my_links'>
                            <a href=""><img alt="" title="" class="circle_links tagpost_thumb" src="img/ua.jpg"></a>
                            <p class="mb-0 link_info"><i class="fa fa-book mr-1" aria-hidden="true"></i>Estudar</p>
                            <p class="mb-0 link_title">Universidade de Aveiro</p>
                            <p class="mb-0 link_subtitle">Área da saúde</p>
                        </li>
                        <li class='clearfix_uni_my_links'>
                            <a href=""><img alt="" title="" class="circle_links tagpost_thumb" src="img/ua.jpg"></a>
                            <p class="mb-0 link_info"><i class="fa fa-book mr-1" aria-hidden="true"></i>Estudar</p>
                            <p class="mb-0 link_title">Universidade de Aveiro</p>
                            <p class="mb-0 link_subtitle">Área da saúde</p>
                        </li>
                        <li class='clearfix_uni_my_links'>
                            <a href=""><img alt="" title="" class="circle_links tagpost_thumb" src="img/ua.jpg"></a>
                            <p class="mb-0 link_info"><i class="fa fa-book mr-1" aria-hidden="true"></i>Estudar</p>
                            <p class="mb-0 link_title">Universidade de Aveiro</p>
                            <p class="mb-0 link_subtitle">Área da saúde</p>
                        </li>
                </ul>
                <div class="text-center">
                 <a href="done_uc.php"><button class="btn add_btn">Adicionar novas disciplinas</button></a>
                </div>
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
            <div class="col-md-3 mt-3 div_videos" >
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1" style="background-color: #D2D2D2;">
            </div>
            <div class="col-md-3 mt-3 div_videos" >
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1" style="background-color: #D2D2D2;">
            </div>
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1" style="background-color: #D2D2D2;">
            </div>
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1" style="background-color: #D2D2D2;">
            </div>
            <div class="col-md-3 mt-3 div_videos" >
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1" style="background-color: #D2D2D2;">
            </div>
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1" style="background-color: #D2D2D2;">
            </div>
            <div class="col-md-3 mt-3 div_videos">
                <video class="img-fluid z-depth-1 p-0 m-0 tam_video" src="" alt="video"
                       data-toggle="modal" data-target="#modal1" style="background-color: #D2D2D2;">
            </div>
            <div class="col-md-3 mt-3 ">
               <a href="upload_xp.php"> <button type="" class="btn bt_add"  style="background-color: #D2D2D2;">Adicionar uma nova experiência</button></a>
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

</div><!--fim da div w-75-->