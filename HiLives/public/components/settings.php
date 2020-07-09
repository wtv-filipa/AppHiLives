<!--Definições gerais-->
<?php
include "navbar_2.php";
if (isset($_SESSION["idUser"])) {
    $id_navegar = $_SESSION["idUser"];
?>
    <div class="w-75 mx-auto">
        <?php
        if (isset($_SESSION["delete"])) {
            $msg_show = true;
            switch ($_SESSION["delete"]) {
                case 1:
                    $message = "Não foi possível apagar a sua conta, por favor tente mais tarde.";
                    $class = "alert-warning";
                    $_SESSION["delete"] = 0;
                    break;
                case 2:
                    $message = "Não foi possível apagar a tua conta, por favor tenta mais tarde.";
                    $class = "alert-warning";
                    $_SESSION["delete"] = 0;
                    break;
                case 0:
                    $msg_show = false;
                    break;
                default:
                    $msg_show = false;
                    $_SESSION["delete"] = 0;
            }

            if ($msg_show == true) {
                echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                                </button>
                                </div>";
                echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
            }
        }
        ?>
        <!--primeiro título-->
        <div id='wrapper_title'>
            <div class='tagpost-top' id='tagpost-top'>
                <div class='widget'>
                    <div data-aos="fade-up">
                        <h3 class=" main_title"><i class="fa fa-cogs mr-2" aria-hidden="true"></i>
                            Geral</h3>
                    </div>
                </div>
            </div>
        </div>

        <!--texto das definições-->
        <div class="mt-3 mb-3 ml-5">
            <h6 class="mb-3"><a href="construction.php">Notificações</a></h6>

            <h6 class="mb-3"><a href="edit_profile.php?edit=<?= $id_navegar ?>">Editar as minhas informações</a></h6>

            <h6 class="mb-3"><a href="construction.php">Privacidade e segurança</a></h6>

            <h6 class="mb-3"><a href="question_form.php">Comunicar dúvidas ou sugestões</a></h6>

            <h6 class="mb-3"><a href="help.php">Ajuda</a></h6>


        </div>
        <!--segundo título-->
        <div id='wrapper_title'>
            <div class='tagpost-top' id='tagpost-top'>
                <div class='widget'>
                    <div data-aos="fade-up">
                        <h3 class="main_title"><i class="fas fa-user-lock mr-2" aria-hidden="true"></i>
                            Privacidade</h3>
                    </div>
                </div>
            </div>
        </div>
        <!--texto das definições-->
        <div class="mt-3 mb-3 ml-5">
            <h6 class="mb-3"><a href="construction.php">Quem pode ver as tuas informações pessoais?</a></h6>

            <h6 class="mb-3"><a href="construction.php">Quem pode ver as tuas últimas disciplinas feitas?</a></h6>

            <h6 class="mb-3"><a href="construction.php">Quem pode ver as tuas áreas de interesse?</a></h6>
        </div>
        <!--segundo título-->
        <div id='wrapper_title'>
            <div class='tagpost-top' id='tagpost-top'>
                <div class='widget'>
                    <div data-aos="fade-up">
                        <h3 class="main_title"><i class="fas fa-user-cog mr-2" aria-hidden="true"></i>
                            Conta</h3>
                    </div>
                </div>
            </div>
        </div>
        <!--texto das definições-->
        <div class="mt-3 mb-5 ml-5">
            <h6 class="mb-3"><a href="construction.php">Indioma</a></h6>

            <h6 class="mb-3"><a href="#" data-toggle="modal" data-target="#deleteModal<?= $idUser ?>">Eliminar a conta no HiLives</a></h6>
        </div>

    <?php
    //Modal de apagar user
    include('components/delete_modal.php');
} else {
    include("404.php");
}
    ?>