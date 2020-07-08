<?php
include "navbar_2.php";
?>

<div class="w-75 mx-auto">
    <div class="mt-5">
        <h1 class="titulo1">Mapa da Aplicação</h1>
    </div>

<!--    <div>-->
<!--        <h6 class="ml-5"> - <a href="#jovem">Jovens</a></h6>-->
<!--        <h6 class="ml-5"> - <a href="#universidade">Universidades</a></h6>-->
<!--        <h6 class="ml-5"> - <a href="#empresa">Empresas</a></h6>-->
<!--    </div>-->

    <!--INDEX-->
    <div class="mt-5">
        <h3>
            <a href="index.php" target="_blank">Página inicial</a>
        </h3>

        <span>Registo:</span>
        <ol>
            <li class="ml-4">
                <a href="register.php" target="_blank">Jovens</a>
                <!--AQUI FALTA O TÍTULO NA PÁGINA "REGISTO JOVENS" - COERENCIA COM AS OUTRAS PÁGINAS-->
            </li>
            <li class="ml-4">
                <a href="register_uni.php" target="_blank">Universidades</a>
            </li>
            <li class="ml-4">
                <a href="register_comp.php" target="_blank">Empresas</a>
            </li>
        </ol>

        <a href="login.php" target="_blank"> Inicia sessão</a>
    </div>

    <!--PÁGINA INICIAL - JOVEM-->
    <div class="mt-5" id="jovem">
        <h3>
            <a href="home_people.php" target="_blank">Página inicial - Jovem</a>
        </h3>

        <span>Conteúdo:</span>
        <ol>
            <li>
                <a href="#">Ligações recentes</a>
            </li>
            <li>
                <a href="#">Destaques</a>
            </li>
            <li>
                <a href="#">Ligações com universidades</a>
            </li>
        </ol>


        <span class="mt-3">Menu principal "Eu quero":</span>
        <ol>
            <li>
                <span>Quero estudar</span>
            </li>
            <li>
                <a href="can_choose_study.php" target="_blank">As minhas ligações</a>
            </li>
            <li>
                <a href="all_options_uni.php" target="_blank">Todas as opções disponíveis</a>
            </li>
        </ol>


        <span>Quero trabalhar:</span>
        <ol>
            <li>
                <a href="can_choose_work.php" target="_blank">As minhas ligações</a>
            </li>
            <ol>
                <li>
                    <a href="#">Vagas de trabalho que posso escolher</a>
                </li>
                <li>
                    <a href="#">Percursos de aprendizagem</a>
                </li>
            </ol>
            <li>
                <a href="allOptions_company.php" target="_blank">Todas as opções disponíveis</a>
            </li>
        </ol>


        <span>Quero estudar e trabalhar:</span>
        <ol>
            <li>
                <a href="can_choose_ws.php" target="_blank">As minhas ligações</a>
            </li>
            <li>
                <a href="allOptions.php" target="_blank">Todas as opções disponíveis</a>
            </li>
        </ol>


        <span>Quero ver o que já foi feito:</span>
        <ol>
            <li>
                <a href="links_made.php" target="_blank">O que eu já fiz</a>
            </li>
            <li>
                <a href="experiences.php" target="_blank">O que os outros fizeram</a>
            </li>
        </ol>


        <!--NOTIFICAÇÕES-->
        <span>Notificações "O que está a acontecer"</span>

        <br>

        <!--MENU PERFIL-->
        <div class="menu_espaco">Menu perfil:</div>
        <ol>
            <li>
                <a href="profile.php?user=<?= $idUser ?>" target="_blank">Sobre mim</a>
            </li>
            <ol type="a">
                <li>
                    <a href="edit_profile.php?user=<?= $idUser ?>" target="_blank">Editar as minhas informações</a>
                </li>
                <li>
                    <span>Últimas disciplinas que fiz:</span>
                </li>
                <ol type="i">
                    <li>
                        <a href="done_uc.php" target="_blank">Adicionar novas disciplinas</a>
                    </li>
                </ol>
                <li>
                    <a href="#">Áreas de interesse</a>
                </li>

                <li>
                    <span>As minhas experiências:</span>
                </li>
                <ol type="i">
                    <li>
                        <a href="upload_xp.php" target="_blank">Adicionar uma nova experiência</a>
                    </li>
                </ol>

            </ol>

            <li>
                <a href="#" target="_blank">Favoritos</a>
            </li>
            <li>
                <a href="#">Definições</a>
            </li>
            <li>
                <a href="scripts/logout.php">Sair da HiLives</a>
            </li>
        </ol>
    </div>

    <!--PÁGINA INICIAL - UNIVERSIDADE-->
    <div class="mt-5" id="universidade">
        <h3>Página inicial - Universidades</h3>

        <span class="mt-3">Menu principal "Eu quero":</span>
        <ol>
            <li>
                <span>Candidatos</span>
            </li>
            <li>
                <a href="can_choose_study.php" target="_blank">Vagas das Empresas</a>
            </li>
            <li>
                <a href="all_options_uni.php" target="_blank">Experiências dos Jovens</a>
            </li>
        </ol>


        <span>Candidatos</span>
        <ol>
            <li>
                <a href="choose_study.php" target="_blank">As minhas ligações</a>
            </li>
            <li>
                <a href="allOptions.php" target="_blank">Todos os jovens</a>
            </li>
        </ol>


        <span>Vagas das Empresas</span>
        <ol>
            <li>
                <a href="allOptions_company.php" target="_blank">Todas as vagas</a>
            </li>
        </ol>


        <span>Experiências:</span>
        <ol>
            <li>
                <a href="experiences.php" target="_blank">Todas as experiências</a>
            </li>
        </ol>


        <!--NOTIFICAÇÕES-->
        <span>Notificações "O que está a acontecer"</span>

        <br>

        <!--MENU PERFIL-->
        <div class="menu_espaco">Menu perfil:</div>
        <ol>
            <li>
                <a href="profile.php?user=<?= $idUser ?>" target="_blank">Sobre mim</a>
            </li>
            <ol type="a">
                <li>
                    <a href="edit_profile.php?user=<?= $idUser ?>" target="_blank">Editar as minhas informações</a>
                </li>
                <li>
                    <span>Áreas disponíveis:</span>
                </li>
                <ol type="i">

                    <li>
                        <a href="done_uc.php" target="_blank">Adicionar novas áreas</a>
                    </li>
                </ol>
                <li>
                    <a href="#">Contactos</a>
                </li>
            </ol>

            <li>
                <a href="#" target="_blank">Favoritos</a>
            </li>
            <li>
                <a href="#">Definições</a>
            </li>
            <li>
                <a href="scripts/logout.php">Sair da HiLives</a>
            </li>
        </ol>
    </div>

    <!--PÁGINA INICIAL - EMPRESAS-->
    <div class="mt-5" id="empresa">
        <h3>Página inicial - Empresas</h3>

        <span class="mt-3">Menu principal "Eu quero":</span>
        <ol>
            <li>
                <span>Candidatos</span>
            </li>
            <li>
                <a href="can_choose_study.php" target="_blank">Vagas</a>
            </li>
            <li>
                <a href="all_options_uni.php" target="_blank">Experiências dos Jovens</a>
            </li>
        </ol>


        <span>Candidatos</span>
        <ol>
            <li>
                <a href="can_choose_work.php" target="_blank">Os meus candidatos</a>
            </li>
            <li>
                <a href="allOptions_company.php" target="_blank">Todos os jovens</a>
            </li>
        </ol>


        <span>Vagas</span>
        <ol>
            <li>
                <a href="all_vacancies_comp.php" target="_blank">As minhas vagas</a>
            </li>
            <li>
                <a href="upload_vac.php" target="_blank">Criar vaga</a>
            </li>
        </ol>


        <span>Experiência dos jovens:</span>
        <ol>
            <li>
                <a href="experiences.php" target="_blank">Todas as experiências</a>
            </li>
        </ol>


        <!--NOTIFICAÇÕES-->
        <span>Notificações "O que está a acontecer"</span>

        <br>

        <!--MENU PERFIL-->
        <div class="menu_espaco">Menu perfil:</div>
        <ol>
            <li>
                <a href="profile.php?user=<?= $idUser ?>" target="_blank">Sobre mim</a>
            </li>
            <ol type="a">
                <li>
                    <a href="edit_profile.php?user=<?= $idUser ?>" target="_blank">Editar as minhas informações</a>
                </li>
                <li>
                    <span>Vagas:</span>
                </li>
                <ol type="i">

                    <li>
                        <a href="done_uc.php" target="_blank">Adicionar nova vaga</a>
                    </li>
                </ol>
                <li>
                    <a href="#">Contactos</a>
                </li>
            </ol>

            <li>
                <a href="#" target="_blank">Favoritos</a>
            </li>
            <li>
                <a href="#">Definições</a>
            </li>
            <li>
                <a href="scripts/logout.php">Logout</a>
            </li>
        </ol>
    </div>
</div>