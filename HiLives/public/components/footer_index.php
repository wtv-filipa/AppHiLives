<?php

require_once("connections/connection.php");
if (isset($_SESSION["idUser"])) {
    $idUser = $_SESSION["idUser"];
}

?>
<!-- Site footer -->
<footer class="site-footer ">
    <div class="container">
        <div class="row mx-auto">
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
                    <li><a href="public/accessibility.php" target="_blank">Acessibilidade</a></li>
                    <li><a href="public/help.php" target="_blank">Ajuda</a></li>
                    <li><a href="public/sitemap.php" target="_blank">Mapa da aplicação</a></li>
                </ul>
            </div>
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
