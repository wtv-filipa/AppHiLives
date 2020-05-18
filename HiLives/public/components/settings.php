<!--Definições gerais-->
<?php
include "navbar_2.php";
if (isset($_SESSION["idUser"])) {
    $id_navegar = $_SESSION["idUser"];
?>
    <div class="w-75 mx-auto">
        <!--primeiro título-->
        <div id='wrapper_title'>
            <div class='tagpost-top' id='tagpost-top'>
                <div class='widget'>
                    <div data-aos="fade-up">
                        <h3 class="mb-4 main_title"><i class="fa fa-cogs mr-2" aria-hidden="true"></i>
                            Geral</h3>
                    </div>
                </div>
            </div>
        </div>

        <!--texto das definições-->
        <div class="mt-3 mb-3 ml-5">
            <h6 class="mb-3"><a href="#">Notificações</a></h6>

            <h6 class="mb-3"><a href="edit_profile.php?edit=<?= $id_navegar ?>">Editar as minhas informações</a></h6>

            <h6 class="mb-3"><a href="#">Privacidade e segurança</a></h6>

            <h6 class="mb-3"><a href="question_form.php">Comunicar dúvidas ou sugestões</a></h6>

            <h6 class="mb-3"><a href="">Ajuda</a></h6>


        </div>
        <!--segundo título-->
        <div id='wrapper_title'>
            <div class='tagpost-top' id='tagpost-top'>
                <div class='widget'>
                    <div data-aos="fade-up">
                        <h3 class="mb-4 main_title"><i class="fas fa-user-lock mr-2" aria-hidden="true"></i>
                            Privacidade</h3>
                    </div>
                </div>
            </div>
        </div>
        <!--texto das definições-->
        <div class="mt-3 mb-3 ml-5">
            <h6 class="mb-3"><a href="#">Quem pode ver as tuas informações pessoais?</a></h6>

            <h6 class="mb-3"><a href="#">Quem pode ver as tuas últimas disciplinas feitas?</a></h6>

            <h6 class="mb-3"><a href="#">Quem pode ver as tuas àreas de interesse?</a></h6>
        </div>
        <!--segundo título-->
        <div id='wrapper_title'>
            <div class='tagpost-top' id='tagpost-top'>
                <div class='widget'>
                    <div data-aos="fade-up">
                        <h3 class="mb-4 main_title"><i class="fas fa-user-cog mr-2" aria-hidden="true"></i>
                            Conta</h3>
                    </div>
                </div>
            </div>
        </div>
        <!--texto das definições-->
        <div class="mt-3 mb-5 ml-5">
            <h6 class="mb-3"><a href="#">Indioma</a></h6>

            <h6 class="mb-3"><a href="#" data-toggle="modal" data-target="#deleteModal<?= $idUser ?>">Eliminar a conta no HiLives</a></h6>
        </div>

    <?php
   //Modal de apagar user
   include('components/delete_modal.php');
}
    ?>