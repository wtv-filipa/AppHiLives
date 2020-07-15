<?php

require_once("connections/connection.php");
$type = $_SESSION["type"];
if (isset($_SESSION["idUser"])) {
    $idUser = $_SESSION["idUser"];
}

?>
<!-- Site footer -->
<footer class="site-footer ">
    <div class="container">
        <div class="row mx-auto">
            <!--            <div class="col-sm-12 col-md-6">-->
            <!--                <h6>About</h6>-->
            <!--                <p class="text-justify">Scanfcode.com <i>CODE WANTS TO BE SIMPLE </i> is an initiative  to help the upcoming programmers with the code. Scanfcode focuses on providing the most efficient code or snippets as the code wants to be simple. We will help programmers build up concepts in different programming languages that include C, C++, Java, HTML, CSS, Bootstrap, JavaScript, PHP, Android, SQL and Algorithm.</p>-->
            <!--            </div>-->
            <?php
            if (isset($_SESSION["idUser"])) {
            ?>
                <div class="col-xs-12 col-sm-6 col-lg-4 adjustment">
                    <h6>Atalhos</h6>
                    <ul class="footer-links">
                        <?php
                        if ($type == 7) {
                        ?>
                            <li><a href="can_choose_work.php">Os meus candidatos</a></li>
                            <li><a href="all_vacancies_comp.php">As minhas vagas</a></li>
                            <li><a href="profile.php?user=<?=$idUser?>">Sobre mim</a></li>
                        <?php
                        } else if ($type == 10) {
                        ?>
                            <li><a href="can_choose_study.php">Ligações com universidades</a></li>
                            <li><a href="can_choose_work.php">Ligações com empresas</a></li>
                            <li><a href="profile.php?user=<?=$idUser?>">Sobre mim</a></li>
                        <?php
                        } else if ($type == 13) {
                        ?>
                            <li><a href="can_choose_study.php">Os meus candidatos</a></li>
                            <li><a href="allOptions_company.php">Vagas de empresas</a></li>
                            <li><a href="profile.php?user=<?=$idUser?>">Sobre mim</a></li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
                <!------------****------------>
                <div class="col-xs-12 col-sm-6  col-lg-4 pr-0 adjustment">
                    <h6>Outros</h6>
                    <ul class="footer-links">
                        <li><a href="accessibility.php">Acessibilidade</a></li>
                        <li><a href="help.php">Ajuda</a></li>
                        <li><a href="sitemap.php">Mapa da aplicação</a></li>
                        <li><a href="question_form.php">Contacto</a></li>
                    </ul>
                </div>
                <!------------****------------>
                <div class="col-xs-12 col-sm-6  col-lg-2 p-0 esconder">
                    <h6>Parceiros</h6>
                    <ul class="footer-links">
                        <li><a href="https://www.ua.pt/" target="_blank">University of Aveiro </a></li>
                        <li><a href="https://english.hi.is/university_of_iceland" target="_blank">University of Iceland (UI)</a></li>
                        <li><a href="https://www.usal.es/" target="_blank">University of Salamanca </a></li>
                        <li><a href="https://www.ugent.be/en" target="_blank">University of Ghent</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6  col-lg-2 mt-4 pl-0 esconder">

                    <ul class="footer-links">
                        <li><a href="https://assol.pt/" target="_blank">ASSOL</a></li>
                        <li><a href="https://www.formem.org.pt/" target="_blank">FORMEM</a></li>
                        <li><a href="https://paisemrede.pt/" target="_blank">Pais em Rede</a></li>
                        <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" target="_blank">AVISPT21</a></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-md-4 mt-4 pl-0 sponsors_phone">
                    <h6>Parceiros</h6>
                    <ul class="footer-links">
                        <li><a href="https://www.ua.pt/" target="_blank">University of Aveiro </a></li>
                        <li><a href="https://english.hi.is/university_of_iceland" target="_blank">University of Iceland (UI)</a></li>
                        <li><a href="https://www.usal.es/" target="_blank">University of Salamanca </a></li>
                        <li><a href="https://www.ugent.be/en" target="_blank">University of Ghent</a></li>
                        <li><a href="https://assol.pt/" target="_blank">ASSOL</a></li>
                        <li><a href="https://www.formem.org.pt/" target="_blank">FORMEM</a></li>
                        <li><a href="https://paisemrede.pt/" target="_blank">Pais em Rede</a></li>
                        <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" target="_blank">AVISPT21</a></li>
                    </ul>
                </div>
            <?php
            } else {
            ?>
                <!------------****------------>
                <div class="col-xs-12 col-sm-6  col-lg-2 p-0 esconder">
                    <h6>Parceiros</h6>
                    <ul class="footer-links">
                        <li><a href="https://www.ua.pt/" target="_blank">University of Aveiro </a></li>
                        <li><a href="https://english.hi.is/university_of_iceland" target="_blank">University of Iceland (UI)</a></li>
                        <li><a href="https://www.usal.es/" target="_blank">University of Salamanca </a></li>
                        <li><a href="https://www.ugent.be/en" target="_blank">University of Ghent</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6  col-lg-2 mt-4 pl-0 esconder">
                    <h6></h6>
                    <ul class="footer-links">
                        <li><a href="https://assol.pt/" target="_blank">ASSOL</a></li>
                        <li><a href="https://www.formem.org.pt/" target="_blank">FORMEM</a></li>
                        <li><a href="https://paisemrede.pt/" target="_blank">Pais em Rede</a></li>
                        <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" target="_blank">AVISPT21</a></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-md-4 mt-4 pl-0 sponsors_phone">
                    <h6>Parceiros</h6>
                    <ul class="footer-links">
                        <li><a href="https://www.ua.pt/" target="_blank">University of Aveiro </a></li>
                        <li><a href="https://english.hi.is/university_of_iceland" target="_blank">University of Iceland (UI)</a></li>
                        <li><a href="https://www.usal.es/" target="_blank">University of Salamanca </a></li>
                        <li><a href="https://www.ugent.be/en" target="_blank">University of Ghent</a></li>
                        <li><a href="https://assol.pt/" target="_blank">ASSOL</a></li>
                        <li><a href="https://www.formem.org.pt/" target="_blank">FORMEM</a></li>
                        <li><a href="https://paisemrede.pt/" target="_blank">Pais em Rede</a></li>
                        <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" target="_blank">AVISPT21</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6  col-lg-4 pr-0 adjustment">
                    <h6>Outros</h6>
                    <ul class="footer-links">
                        <li><a href="accessibility.php" target="_blank">Acessibilidade</a></li>
                        <li><a href="help.php" target="_blank">Ajuda</a></li>
                        <li><a href="sitemap.php" target="_blank">Mapa da aplicação</a></li>
                    </ul>
                </div>
            <?php
            }
            ?>
            <!------------****------------>
        </div>
        <hr style="border-top: 1px solid #2f2f2f;">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <p class="copyright-text">Copyright &copy; HiLives 2020. Todos os direitos reservados.
                </p>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="social-icons">
                    <li><a class="dribbble" title="Website HiLives" href="http://hilives.web.ua.pt/" target="_blank"><i class="fa fa-dribbble" style="color: white;"></i><span class="sr-only">(Website HiLives)</span></a></li>
                    <li><a class="facebook" title="Facebook HiLives" href="https://www.facebook.com/HiLives_Erasmus-111765073655672/" target="_blank"><i class="fa fa-facebook" style="color: white;"></i><span class="sr-only">(Facebook HiLives)</span></a></li>
                    <li><a class="twitter" title="Twitter HiLives" href="https://twitter.com/HiLives_Erasmus" target="_blank"><i class="fa fa-twitter" style="color: white;"></i><span class="sr-only">(Twitter HiLives)</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>