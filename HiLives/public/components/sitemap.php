<?php
include "navbar_2.php";
?>

<div class="w-75 mx-auto">
    <div class="mt-5">
        <h1 class="titulo1">Mapa da Aplicação</h1>
    </div>
    <div class="mt-5">
        <h3>
            <a href="index.php" target="_blank">Página inicial</a>
        </h3>

        <span>Registo:</span>
        <ol>
            <li class="ml-4">Jovens</li>
            <li class="ml-4">Universidades</li>
            <li class="ml-4">Empresas </li>
        </ol>

        <p> Inicia sessão</p>
        <p> Informação sobre a aplicação</p>
    </div>

    <div class="mt-5" id="jovem">
        <h3>
            <a href="home_people.php" target="_blank">Página inicial - Jovem</a>
        </h3>

        <h6>Conteúdo:</h6>
        <ol>
            <li>Ligações recentes com universidades</li>
            <li>Destaques</li>
            <li>Ligações recentes com empresas</li>
        </ol>


        <h6 class="mt-3">Menu principal "Eu quero":</h6>
        <span>Quero estudar</span>
        <ol>
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
            <ol type="a">
                <li>Vagas de trabalho que posso escolher</li>
                <li>Percursos de aprendizagem</li>
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

        <h6>Notificações "O que está a acontecer"</h6>

        <h6 class="menu_espaco">Menu perfil:</h6>
        <ol>
            <li>
                <a href="profile.php?user=<?= $idUser ?>" target="_blank">Sobre mim</a>
            </li>
            <ol type="a">
                <li>
                    <a href="edit_profile.php?user=<?= $idUser ?>" target="_blank">Editar as minhas informações</a>
                </li>
                <li>
                    <span>Últimas unidades curriculares que fiz:</span>
                </li>
                <ol type="i">
                    <li>
                        <a href="links_made.php" target="_blank">Ver todas as que eu já fiz</a>
                    </li>
                    <li>
                        <a href="done_uc.php" target="_blank">Adicionar novas disciplinas</a>
                    </li>
                </ol>
                <li>As minhas áreas de interesse</li>
                <li>As minhas competências</li>
                <li>Os meus ambientes de trabalho favoritos</li>

                <li>As minhas experiências:</li>
                <ol type="i">
                    <li>
                        <a href="upload_xp.php" target="_blank">Adicionar uma nova experiência</a>
                    </li>
                </ol>

            </ol>

            <li>
                <a href="favorites.php" target="_blank">Favoritos</a>
            </li>
            <li>
                <a href="settings.php">Definições</a>
            </li>
            <li>
                <a href="scripts/logout.php">Sair da HiLives</a>
            </li>
        </ol>
    </div>

    <div class="mt-5" id="universidade">
        <h3>Página inicial - Universidades</h3>
        <h6>Conteúdo:</h6>
        <ol>
            <li>Últmas entradas de jovens</li>
            <li>Destaques</li>
            <li>Últimas vagas publicadas por empresas</li>
        </ol>
        <h6 class="mt-3">Menu principal "Eu quero":</h6>
        <span>Candidatos</span>
        <ol>
            <li>
                <a href="can_choose_study.php" target="_blank">As minhas ligações</a>
            </li>
            <li>
                <a href="all_options_uni.php" target="_blank">Todos os jovens</a>
            </li>
        </ol>   

        <span>Vagas de Empresas</span>
        <ol>
            <li>
                <a href="allOptions_company.php" target="_blank">Todas as vagas</a>
            </li>
        </ol>

        <span>Experiências dos Jovens</span>
        <ol>
            <li>
                <a href="experiences.php" target="_blank">Todas as experiências</a>
            </li>
        </ol>

        <h6>Notificações "O que está a acontecer"</h6>

        <h6 class="menu_espaco">Menu perfil:</h6>
        <ol>
            <li>
                <a href="profile.php?user=<?= $idUser ?>" target="_blank">Sobre mim</a>
            </li>
            <ol type="a">
                <li>
                    <a href="edit_profile.php?user=<?= $idUser ?>" target="_blank">Editar as minhas informações</a>
                </li>
                <li>Áreas disponíveis</li>
                <li>Contactos</li>
            </ol>
            <li>
                <a href="settings.php">Definições</a>
            </li>
            <li>
                <a href="scripts/logout.php">Sair da HiLives</a>
            </li>
        </ol>
    </div>

    <div class="mt-5 mb-5" id="empresa">
        <h3>Página inicial - Empresas</h3>
        <h6>Conteúdo:</h6>
        <ol>
            <li>Ligações recentes</li>
        </ol>
        <h6 class="mt-3">Menu principal "Eu quero":</h6>
        <span>Candidatos</span>
        <ol>
            <li>
                <a href="can_choose_work.php" target="_blank">Os meus candidatos</a>
            </li>
            <ol type="a">
                <li>Os meus candidatos</li>
                <li>Candidatos para percurso de aprendizagem</li>
            </ol>
            <li>
                <a href="allOptions_company.php" target="_blank">Todas os jovens</a>
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
        <span>Experiência dos jovens</span>
        <ol>
            <li>
                <a href="experiences.php" target="_blank">Todas as experiências</a>
            </li>
        </ol>

        <h6>Notificações "O que está a acontecer"</h6>
    
        <h6 class="menu_espaco">Menu perfil:</h6>
        <ol>
            <li>
                <a href="profile.php?user=<?= $idUser ?>" target="_blank">Sobre mim</a>
            </li>
            <ol type="a">
                <li>
                    <a href="edit_profile.php?user=<?= $idUser ?>" target="_blank">Editar as minhas informações</a>
                </li>
                <li>Vagas disponíveis</li>
                <li>Contactos</li>
            </ol>
            <li>
                <a href="settings.php">Definições</a>
            </li>
            <li>
                <a href="scripts/logout.php">Sair da HiLives</a>
            </li>
        </ol>
    </div>
</div>