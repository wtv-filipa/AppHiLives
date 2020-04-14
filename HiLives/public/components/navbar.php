

<style>
    .zoom {
        padding: 50px;

        transition: transform .2s; /* Animation */
        margin: 0 auto;
    }

    .zoom:hover {
        transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }

</style>
<header class="top  ">


    <nav class="nav__ container cont_l">


        <div class=" nav__controls--left">
            <a href="#"  class="nav__link align-middle"><i class="fa fa-bars mr-3" id="button" style="color: #2f2f2f; font-size: 25px !important;"><span class="menunav ml-3">Eu quero</span> </i></a>

        </div>

        <div class="nav__brand"><a class="nav__link" href="index.php"><img src="img/logo.png" class="img-responsive" style="width:90px; margin-right: 5px"></a></div>
        <div class="nav__controls nav__controls--right">
            <!-- <div class="nav__search">
                 <input class="nav__search--input text-center" placeholder="Pesquisar..." type="text"/><a class="nav__search--icon " href="#"><i class="fa fa-bell-o" style="font-size: 21px"></i></a>
             </div> -->



            <div class="nav__avatar"><img src="img/notif.png" class=" " style="position:relative; max-width:30px"> <span class="nome ml-2" style=" width: 180px; color: black">O que está a acontecer</span>

                <div class="nav__avatar--dropdown sc" style="overflow-y: scroll; width: 400px">

                    <a href=""><button class="notif_ind mb-2 nome"> Tens uma nova ligação com a <span class="font-weight-bold" style=""> Universidade de Aveiro</span>.<span class=" ml-3 " style="color: grey">Há 2min</span></button></a>
                    <a href=""><button class="notif_ind mb-2 nome"> Tens uma nova ligação com a <span class="font-weight-bold" style=""> Universidade de Aveiro</span>.<span class=" ml-3 " style="color: grey">Há 2min</span></button></a>
                    <a href=""><button class="notif_ind mb-2 nome"> Tens uma nova ligação com a <span class="font-weight-bold" style=""> Universidade de Aveiro</span>.<span class=" ml-3 " style="color: grey">Há 2min</span></button></a>
                    <a href=""><button class="notif_ind mb-2 nome"> Tens uma nova ligação com a empresa<span class="font-weight-bold" style=""> FNAC</span>.<span class=" ml-3 " style="color: grey">Há 2min</span></button></a>
                    <a href=""><button class="notif_ind mb-2 nome"> Tens uma nova ligação com a empresa<span class="font-weight-bold" style=""> FNAC</span>.<span class=" ml-3 " style="color: grey">Há 2min</span></button></a>
                    <a href=""><button class="notif_ind mb-2 nome"> Tens uma nova ligação com a empresa<span class="font-weight-bold" style=""> FNAC</span>.<span class=" ml-3 " style="color: grey">Há 2min</span></button></a>




                </div>
            </div>




                <div class=" nav__avatar text-right mr-0"><img src="img/profilepic.jpg" class="nav__avatar--image text-right" style="max-width:35px"> <span class="nome" style=" width: 90px; color: black">Sobre mim</span>


                    <div class="nav__avatar--dropdown">


                        <button class="nav__btn2 text-light" style="background: #E93CAC;"><i class="fa fa-shield mr-2 text-light"></i>ADMIN</button></a>
                        <a href=""><button class="nav__btn2 nome"> <!--<i class="fa fa-star-o mr-2"></i>-->Ver Perfil</button></a>
                        <a href=""><button class="nav__btn2"> <!--<i class="fa fa-star-o mr-2"></i>-->Editar perfil</button></a>
                        <a href=""><button class="nav__btn2"> <!--<i class="fa fa-sliders mr-2"></i>-->Definições</button></a>

                        <a href="scripts/logout.php"><button class="nav__btn2"  style="background: #FDE74C;"><i class="fa fa-sign-out mr-2"></i>Logout</button></a>

                    </div>
                </div>
    </nav>

    <nav class="nav__ nao_container">


        <div class=" nav__controls--left">
            <a href="#"  class="nav__link"><i class="fa fa-bars" id="button1" style="font-size: 25px !important;"></i></a>
        </div>

        <div class="nav__brand"><a class="nav__link" href="index.php"><img src="img/logo_cores.png" class="img-responsive" style="width:90px; margin-right: 5px"></a></div>
        <div class="nav__controls nav__controls--right">
            <!--<div class="nav__search">
                <input class="nav__search--input text-center" placeholder="Pesquisar..." type="text"/><a class="nav__search--icon " href="#"><i class="fa fa-bell-o" style="font-size: 21px"></i></a>
            </div>-->

            <div class="nav__avatar"><img src="img/notif.png" class=" " style="position:relative; max-width:35px"> <span class="nome ml-3" style="color: black">O que está a acontecer</span></div>

            <div class="nav__avatar"><img src="img/profilepic.jpg" class="nav__avatar--image " style="max-width:35px"> <span class="nome ml-3">Sobre mim</span>


                    <div class="nav__avatar--dropdown "><a href="/login"></a>

                        <a href="../admin/index.php"><button class="nav__btn2" style="background: #E93CAC;"><i class="fa fa-shield mr-2"></i> ADMIN</button></a>
                        <a href=""><button class="nav__btn2 nome"> <!--<i class="fa fa-star-o mr-2"></i>-->Ver Perfil</button></a>
                        <a href=""><button class="nav__btn2"> <!--<i class="fa fa-star-o mr-2"></i>-->Editar perfil</button></a>
                        <a href=""><button class="nav__btn2"> <!--<i class="fa fa-sliders mr-2"></i>-->Definições</button></a>

                        <a href="scripts/logout.php"><button class="nav__btn2" style="background: #FDE74C;"><i class="fa fa-sign-out mr-2"></i>Logout</button></a>

                    </div>
    </nav>


    <div id="slide1" style="padding-right: "><a href="#" id="button2"><i class="fa fa-times" style="color: black"></i>


            <ul class="ml-2 ">
                <li><a class="nav__link mr-2 mb-1"><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text_main font-weight-bold">Todas as opções</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/></span><span class="nav__link--text ">Estudar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Trabalhar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Estudar e trabalhar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 mt-4"><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text_main font-weight-bold">Posso escolher</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/></span><span class="nav__link--text">Estudar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Trabalhar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Estudar e trabalhar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 mt-4"><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text_main font-weight-bold">As minhas ligações</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href="links_chosen.php"><img src="" alt="" class="icones nav__link--icon"/></span><span class="nav__link--text">Escolhas</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href="links_made.php"><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Feitas</span></a></li>
                <li><a class="nav__link mr-2 mb-1 mt-4"><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text_main font-weight-bold">Experiências</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Ver experiências</span></a></li>
            </ul>
    </div>

    <script>
        var btn = document.getElementById("button");
        var btn1 = document.getElementById("button1");
        var btn2 = document.getElementById("button2");
        function open() {
            var openThis = document.getElementById("slide1");
            openThis.style.width = "320px";
            if(openThis.style.width === "320px") {
                btn.style.visibility = "hidden";
                btn1.style.visibility = "hidden";

            }else{
                btn.style.visibility = "visible";
                btn1.style.visibility = "visible";
            }

        }
        function close() {
            var closeThis = document.getElementById("slide1");
            closeThis.style.width = "0px";
            if(closeThis.style.width === "0px") {
                btn.style.visibility = "visible";
                btn1.style.visibility = "visible";
            }else{
                btn.style.visibility = "visible";
                btn1.style.visibility = "visible";
            }
        }


        btn.addEventListener('click', open);
        btn1.addEventListener('click', open);
        btn2.addEventListener('click', close);




    </script>


</header>


