
<style>
    .zoom {
        padding: 50px;

        transition: transform .2s; /* Animation */
        margin: 0 auto;
    }

    .zoom:hover {
        transform: scaleX(1.1);

        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
</style>
<header class="top">


    <nav class="nav__ container cont_l">


        <div class=" nav__controls--left">
            <a href="#"  class="nav__link"><i class="fa fa-bars" id="button" style="font-size: 25px !important;"></i></a>
        </div>

        <div class="nav__brand"><a class="nav__link" href="index.php"><img src="img/logo.png" class="img-responsive" style="width:100px; margin-right: 5px"></a></div>
        <div class="nav__controls nav__controls--right">
            <!-- <div class="nav__search">
                 <input class="nav__search--input text-center" placeholder="Pesquisar..." type="text"/><a class="nav__search--icon " href="#"><i class="fa fa-bell-o" style="font-size: 21px"></i></a>
             </div> -->




            <div class="nav__avatar"> <span class="nome ml-3" style="color: black"> Notificações </span>



                <div class="nav__avatar"><span class="nome ml-3" style="color: black">Perfil</span>


                    <div class="nav__avatar--dropdown"><a href="/login"></a>


                            <a href="../admin/index.php"><button class="nav__btn2" style="background: #7FC53C;"><i class="fa fa-shield"></i>ADMIN</button></a>




                        <a href="perfil.php?user="><button class="nav__btn2 nome"> <!--<i class="fa fa-star-o mr-2"></i>-->Ver Perfil</button></a>
                        <a href="codigo_utilizador.php"><button class="nav__btn2"> <!--<i class="fa fa-star-o mr-2"></i>-->Código</button></a>
                        <a href="definicoes.php"><button class="nav__btn2"> <!--<i class="fa fa-sliders mr-2"></i>-->Definições</button></a>




                        <a href="scripts/logout.php"><button class="nav__btn2 bg-warning"><i class="fa fa-sign-out mr-2"></i>Logout</button></a>

                    </div>
    </nav>

    <nav class="nav__ nao_container">


        <div class=" nav__controls--left">
            <a href="#"  class="nav__link"><i class="fa fa-bars" id="button1" style="font-size: 25px !important;"></i></a>
        </div>

        <div class="nav__brand"><a class="nav__link" href="index.php"><img src="img/Preto hilives.png" class="img-responsive" style="width:150px; margin-right: 5px"></a></div>
        <div class="nav__controls nav__controls--right">
            <!--<div class="nav__search">
                <input class="nav__search--input text-center" placeholder="Pesquisar..." type="text"/><a class="nav__search--icon " href="#"><i class="fa fa-bell-o" style="font-size: 21px"></i></a>
            </div>-->



            <div class="nav__avatar"><img src="../admin/uploads/img_perfil/" class="nav__avatar--image " style="max-width:35px"> <span class="nome ml-3">Nome</span>


                    <div class="nav__avatar"><img src="img/default.gif" class="nav__avatar--image " style="max-width:35px"> <span class="nome ml-3">Nome</span>




                    <div class="nav__avatar--dropdown"><a href="/login"></a>



                        <a href="perfil.php?user="><button class="nav__btn2"> <!--<i class="fa fa-star-o mr-2"></i>-->Ver Perfil</button></a>

                        <a href="codigo_utilizador.php"><button class="nav__btn2"> <!--<i class="fa fa-star-o mr-2"></i>-->Código</button></a>
                        <a href="definicoes.php"><button class="nav__btn2"> <!--<i class="fa fa-sliders mr-2"></i>-->Definições</button></a>




                        <a href="scripts/logout.php"><button class="nav__btn2 bg-warning"><i class="fa fa-sign-out mr-2"></i>Logout</button></a>

                    </div>
    </nav>


    <div id="slide1"><a href="#" id="button2"><i class="fa fa-times" style="color: black"></i>



            <ul class="ml-2 pl-2">

                <li><a class="nav__link mr-2 mb-1"><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text_main font-weight-bold">Todas as opções</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/></span><span class="nav__link--text ">Estudar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Trabalhar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Estudar e trabalhar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 mt-4"><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text_main font-weight-bold">Posso escolher</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/></span><span class="nav__link--text">Estudar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Trabalhar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Estudar e trabalhar</span></a></li>
                <li><a class="nav__link mr-2 mb-1 mt-4"><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text_main font-weight-bold">As minhas ligações</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/></span><span class="nav__link--text">Escolhas</span></a></li>
                <li><a class="nav__link mr-2 mb-1 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text">Feitas</span></a></li>
                <li><a class="nav__link mr-2 mb-1 mt-2 zoom" href=""><img src="" alt="" class="icones nav__link--icon"/><span class="nav__link--text_main font-weight-bold">Experiências</span></a></li>
            </ul>
    </div>


    <script>
        var btn = document.getElementById("button");
        var btn1 = document.getElementById("button1");
        var btn2 = document.getElementById("button2");
        function open() {
            var openThis = document.getElementById("slide1");
            openThis.style.width = "350px";
            if(openThis.style.width === "350px") {
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

