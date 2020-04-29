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
    <nav id="topNav" class="navbar fixed-top navbar-toggleable-sm">
        <!--div con
        taine do conteúdo-->
        <div class="container">
            <div class="row col-12">
                <?php
                if (isset($_SESSION["idUser"])) {
                ?>
                    <!--menu do lado esquerdo-->
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="#">About</a>
                        <a href="#">Services</a>
                        <a href="#">Clients</a>
                        <a href="#">Contact</a>
                    </div>

                    <!-- Use any element to open the sidenav -->
                    <div class="col-4 text-left">
                        <span onclick="openNav()" class="menu_lado" style=" vertical-align: middle !important;">
                            <i class="fas fa-ellipsis-v" style="margin-left:20px; color: #2f2f2f; font-size: 25px !important;">
                                <span class="menunav nome ml-1">Eu quero</span> </i>
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
                    <div class="col-4">
                        <a class="navbar-brand mx-auto" href="homepage_userDID.php">
                            <img src="img/logo.png" class="img-responsive" style="width:90px">
                        </a>
                    </div>
                <?php
                } else {
                ?>
                    <a class="navbar-brand mx-auto" href="index.php">
                        <img src="img/logo.png" class="img-responsive" style="width:90px; margin-right: 5px">
                    </a>
                <?php
                }
                ?>
                <!---------------------------------->
                <!--botão de iniciar sessão se ainda não tive sessão-->

                <!--notificações e perfil dropdown-->
                <!--dropdowns das notificações-->
                <div class="col-4 p-0">
                    <?php
                    if (isset($_SESSION["idUser"])) {
                    ?>
                        <div class="dropdown">
                            <button class="btn" type="button" role="button" data-toggle="dropdown">
                                <img src="img/notif.png" class=" " style="position:relative; max-width:30px"><span class="nome ml-2" style=" width: 180px; color: black">O que está a acontecer</span>
                            </button>
                            <ul class="dropdown-menu mx-auto" style="overflow-y: scroll; width: 400px">
                                <a href="">
                                    <button class="notif_ind mb-2 nome"> Já não tens uma ligação há algum tempo...
                                        <span class="font-weight-bold">Edita o teu perfil</span> para conseguires ter novas
                                        ligações!
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                                <a href="">
                                    <button class="notif_ind mb-2 nome"> Tens uma nova ligação com a
                                        <span class="font-weight-bold"> Universidade de Aveiro</span>.
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                                <a href="">
                                    <button class="notif_ind mb-2 nome"> Tens uma nova ligação com a
                                        <span class="font-weight-bold"> Universidade de Aveiro</span>.
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                                <a href="">
                                    <button class="notif_ind mb-2 nome"> Tens uma nova ligação com a empresa
                                        <span class="font-weight-bold"> FNAC</span>.
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                                <a href="">
                                    <button class="notif_ind mb-2 nome"> Tens uma nova ligação com a empresa
                                        <span class="font-weight-bold"> FNAC</span>.
                                        <span class="m-0 p-0" style="color: grey; font-family: Quicksand !important;"> • Há 2min</span>
                                    </button>
                                </a>
                                <a href="">
                                    <button class="notif_ind mb-2 nome"> Tens uma nova ligação com a empresa
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
                                $nome_todo = "Frederico Proença";
                                $nomes = explode(' ', $nome_todo); // separamos por espaços e fica: por exemplo Array ( [0] => Eduardo [1] => da [2] => Silva [3] => Fernandes )
                                $nome = $nomes[0]; // primeiro nome
                                if (isset($img_perfil)) {

                        ?>

                                    <button class="btn" type="button" role="button" data-toggle="dropdown">
                                        <img src="../admin/uploads/img_perfil/<?= $img_perfil ?>" class="nav__avatar--image " style="max-width:35px">
                                        <span class="nome ml-2" style="color: black"><?= $nome ?></span>
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn" type="button" role="button" data-toggle="dropdown">
                                        <img src="img/no_profile_img.png" class="nav__avatar--image " style="max-width:35px">
                                        <span class="nome ml-2" style="color: black"><?= $nome ?></span>
                                    </button>
                        <?php
                                }
                            }
                        }
                        ?>
                        <ul class="dropdown-menu mx-auto">
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
        document.getElementById("mySidenav").style.width = "250px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>