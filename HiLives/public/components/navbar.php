<style>
    .zoom {
        transition: transform .2s; /* Animation */
        margin: 0 auto;
    }

    .zoom:hover {
        transform: scale(1.1); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
</style>

<?php

require_once("connections/connection.php");
if (isset($_SESSION["type"]) && isset($_SESSION["idUser"])) {

    $User_type = $_SESSION["type"];
    $idUser = $_SESSION["idUser"];
}

// Create a new DB connection
$link = new_db_connection();

/* create a prepared statement */
$stmt = mysqli_stmt_init($link);

?>
<header class="top">
    <nav id="topNav" class="navbar fixed-top navbar-toggleable-sm" >
        <!--div con
        taine do conteúdo-->
        <div class="container padding">
            <div class="row col-12 m-0 p-0 my-auto">
                <?php
                if (isset($_SESSION["idUser"])) {
                ?>
                    <!--menu do lado esquerdo-->
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                        <ul>
                            <!-- EU QUERO ESTUDAR -->
                            <li>
                                <a class="nav__link mr-2 mb-1">
                                    <span class="nav__link--text_main font-weight-bold">Eu quero estudar</span>
                                </a>
                            </li>
                            <li>
                                <a href="can_choose_study.php" class="nav__link mr-2 mb-1 zoom">
                                    <span class="nav__link--text">As minha ligações</span>
                                </a>
                            </li>
                            <li>
                                <a href="allOptions_uni.php" class="nav__link mr-2 mb-1 zoom">
                                    <span class="nav__link--text">Todas as opções disponíveis</span>
                                </a>
                            </li>
                            <li>
                                <a href="links_chosen.php" class="nav__link mr-2 mb-1 zoom">
                                    <span class="nav__link--text">As minhas escolhas</span>
                                </a>
                            </li>

                            <!-- EU QUERO TRABALHAR -->
                            <li>
                                <a class="nav__link mr-2 mb-1 mt-4">
                                    <span class="nav__link--text_main font-weight-bold">Eu quero trabalhar</span>
                                </a>
                            </li>
                            <li>
                                <a href="can_choose_work.php" class="nav__link mr-2 mb-1 zoom">
                                    <span class="nav__link--text">As minhas ligações</span>

                                </a>
                            </li>
                            <li>
                                <a href="allOptions_company.php" class="nav__link mr-2 mb-1 zoom">
                                    <span class="nav__link--text">Todas as opções disponíveis</span>
                                </a>
                            </li>

                            <!-- EU QUERO ESTUDAR E TRABALHAR -->
                            <li>
                                <a class="nav__link mr-2 mb-1 mt-4">
                                    <span class="nav__link--text_main font-weight-bold">Eu quero estudar e trabalhar</span>
                                </a>
                            </li>
                            <li>
                                <a href="can_choose_ws.php" class="nav__link mr-2 mb-1 zoom">
                                    <span class="nav__link--text">As minhas ligações</span>
                                </a>
                            </li>
                            <li>
                                <a href="allOptions.php" class="nav__link mr-2 mb-1 zoom">
                                    <span class="nav__link--text">Todas as opções disponíveis</span>
                                </a>
                            </li>

                            <!-- EU QUERO VER O QUE JÁ FOI FEITO -->
                            <li>
                                <a class="nav__link mr-2 mb-1 mt-4">
                                    <span class="nav__link--text_main font-weight-bold">Eu quero ver o que já foi feito</span>
                                </a>
                            </li>
                            <li>
                                <a href="links_made.php" class="nav__link mr-2 mb-1 zoom">
                                    <span class="nav__link--text">O que eu já fiz</span>
                                </a>
                            </li>
                            <li>
                                <a href="experiences.php" class="nav__link mr-2 mb-1 zoom">
                                    <span class="nav__link--text">O que os outros fizeram</span>
                                </a>
                            </li>
                        </ul>

                    </div>

                    <!-- Use any element to open the sidenav -->
                    <div class="col-4 text-left p-0 my-auto">
                        <span onclick="openNav()" class="menu_lado">
                            <i class="fas fa-ellipsis-v" style="color: #2f2f2f; font-size: 25px !important; ">
                                <span class="menunav nome ml-1" style="font-weight: normal">Eu quero</span> </i>
                        </span>
                    </div>
                <?php
                }
                ?>
                <!--fim do menu do lado esquerdo-->
                <!--logo no centro-->

                <?php
                if (isset($_SESSION["idUser"])) {
                ?>
                    <div class="col-4 text-center p-0">
                        <a class="navbar-brand mx-auto" href="homepage_userDID.php">
                            <img src="img/logo.png" class="img-responsive logo" alt="Logótipo do HiLives">
                        </a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="col-4"></div>
                    <div class="col-4 text-center ">
                        <a class="navbar-brand mx-auto" href="index.php">
                            <img src="img/logo.png" class="img-responsive logo" alt="Logótipo do HiLives">
                        </a>
                    </div>
                    <div class=" col-4 text-right my-auto pr-0">
                        <a href="login.php">
                            <button class="btn inicia_nav m-0" >Inicia Sessão</button>
                        </a>
                    </div>


                    <?php
                }
                ?>
                <!---------------------------------->
                <!--botão de iniciar sessão se ainda não tive sessão-->

                <!--notificações e perfil dropdown-->
                <!--dropdowns das notificações-->
                <div class="col-4 p-0 text-right my-auto">
                    <?php
                    if (isset($_SESSION["idUser"])) {
                    ?>
                        <div class="dropdown">
                            <button class="btn pl-0" type="button" role="button" data-toggle="dropdown">
                                <img src="img/notif.png" alt="Símbolo de notificações" style="position:relative; max-width:25px"><span class="nome ml-2">O que está a acontecer</span>
                            </button>
                            <ul class="dropdown-menu mx-auto" style="overflow-y: scroll">
                                <a href="">
                                    <button class="notif_ind mb-2"> Já não tens uma ligação há algum tempo...
                                        <span class="font-weight-bold">Edita o teu perfil</span> para conseguires ter novas
                                        ligações!
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                                <a href="">
                                    <button class="notif_ind mb-2"> Tens uma nova ligação com a
                                        <span class="font-weight-bold"> Universidade de Aveiro</span>.
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                                <a href="">
                                    <button class="notif_ind mb-2"> Tens uma nova ligação com a
                                        <span class="font-weight-bold"> Universidade de Aveiro</span>.
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                                <a href="">
                                    <button class="notif_ind mb-2"> Tens uma nova ligação com a empresa
                                        <span class="font-weight-bold"> FNAC</span>.
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                                <a href="">
                                    <button class="notif_ind mb-2"> Tens uma nova ligação com a empresa
                                        <span class="font-weight-bold"> FNAC</span>.
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                                <a href="">
                                    <button class="notif_ind mb-2"> Tens uma nova ligação com a empresa
                                        <span class="font-weight-bold"> FNAC</span>.
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                    <!--dropdown do perfil-->
                    <div class="dropdown">
                        <?php
                        $query = "SELECT idUser, name_user, profile_img
            FROM users
            WHERE idUser LIKE ?";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, 'i', $idUser);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id, $name_user, $profile_img);
                            while (mysqli_stmt_fetch($stmt)) {
                                $nome_todo = $name_user;
                                $nomes = explode(' ', $nome_todo); // separamos por espaços e fica: por exemplo Array ( [0] => Eduardo [1] => da [2] => Silva [3] => Fernandes )
                                $nome = $nomes[0]; // primeiro nome
                                if (isset($img_perfil)) {

                        ?>

                                    <button class="btn pl-0 pr-0" type="button" role="button" data-toggle="dropdown">
                                        <img src="../admin/uploads/img_perfil/<?= $img_perfil ?>" class="nav__avatar--image " style="max-width:25px" alt="Imagem de perfil">
                                        <span class="nome ml-2" style="color: black"><?= $nome ?></span>
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn pl-0 pr-0" type="button" role="button" data-toggle="dropdown">
                                        <img src="img/no_profile_img.png" class="nav__avatar--image " style="max-width:25px" alt="Imagem de perfil padrão">
                                        <span class="nome ml-2" style="color: black"><?= $nome ?></span>
                                    </button>
                        <?php
                                }
                            }
                        }
                        ?>
                        <ul class="dropdown-menu alinhar_user mx-auto">
                            <?php
                            if (isset($User_type) && $User_type == 4) {
                            ?>
                                <a href="../admin/index.php">
                                    <button class="nav__btn2 text-light" style="background: #E93CAC;">
                                        <i class="fa fa-shield mr-2 text-light"></i>ADMIN
                                    </button>
                                </a>
                            <?php
                            }
                            ?>
                            <a href="profile.php?user=<?= $idUser ?>">
                                <button class="nav__btn2">
                                    <!--<i class="fa fa-star-o mr-2"></i>-->Sobre mim</button>
                            </a>
                            <a href="edit_profile.php">
                                <button class="nav__btn2">
                                    <!--<i class="fa fa-star-o mr-2"></i>-->Favoritos</button>
                            </a>
                            <a href="">
                                <button class="nav__btn2">
                                    <!--<i class="fa fa-sliders mr-2"></i>-->Definições</button>
                            </a>
                            <a href="scripts/logout.php">
                                <button class="nav__btn2" style="background: #FDE74C;"><i class="fa fa-sign-out mr-2"></i>Logout
                                </button>
                            </a>
                        </ul>
                    </div>
                    <div>
                        <!---------------------------------->
                    </div>
                </div>
                <!--fim da div container-->
    </nav>
</header>

<script>
    /* Set the width of the side navigation to 250px */
    function openNav() {
        document.getElementById("mySidenav").style.width = "340px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>