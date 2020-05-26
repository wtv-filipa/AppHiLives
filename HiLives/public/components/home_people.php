<?php
include "navbar_2.php";


if ($_SESSION["idUser"]) {

    $idUser = $_SESSION["idUser"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT Area, name_user, profile_img 
            FROM young_university 
            INNER JOIN users ON young_university.User_university = users.idUser 
            WHERE User_young LIKE ? LIMIT 6";
    ?>

    <div class="w-75 mx-auto list_links">
    <div id='wrapper_title'>
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title">Ligações recentes com universidades</h3>
                </div>
            </div>
        </div>
    </div>

    <div id='wrapper'>
    <div id='recenttags'>
    <div class='tagpost-top section' id='tagpost-top'>
    <div class='widget HTML' id='HTML5'>
    <div class='widget-content'>
    <?php
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $Area, $name_user, $profile_img);

        while (mysqli_stmt_fetch($stmt)) {
            ?>
            <ul class='taglabel'>
                <li class='clearfix_uni mt-2'>
                    <a href="">
                        <?php
                        if (isset($profile_img)) {
                            ?>
                            <img alt="<?= $profile_img ?>" title="" class="tagpost_thumb"
                                 src="../uploads/img_perfil/<?= $profile_img ?>">
                            <?php
                        } else {
                            ?>
                            <img alt="imagem de perfil default da universidade" title="" class="tagpost_thumb"
                                 src="img/index_2.png">
                            <?php
                        }
                        ?>
                        <p class="mb-0 link_info"><i class="fa fa-book mr-1" aria-hidden="true"></i>Estudar
                        </p>
                        <h4 class="mb-0 link_title"><?= $name_user ?></h4>
                        <h5 class="mb-0 link_subtitle"><?= $Area ?></h5>
                    </a>
                </li>
            </ul>
            <?php
        }
        ?>
        </div>
        <div class='clear'></div>
        </div>
        </div>
        </div>

        <div id='footer'>
            <a href="can_choose_study.php">
                <button class="btn_cards mx-auto">Ver mais</button>
            </a>
        </div>
        </div>
        </div>
        <?php
    }
}
?>


<!--CARDS-->
<div class="w-75 mx-auto">
    <div id='wrapper_title'>
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title">Destaques</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row container_highlights ">
        <div class="cards col-xs-12 col-md-6">
            <div class="card-item">
                <div class="card-image">
                    <img class="imagem" src="img/ua.jpg"></div>
                <div class="card-info">
                    <h2 class="card-title sub_title">Universidade de Aveiro</h2>
                    <p class="card-intro description_title">Far far away, behind the word mountains, far from the
                        countries Vokalia and Consonantia, there live the blind texts.</p>
                    <a href="about_university.php" >
                        <button class="btn_destaques">Ver mais</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="cards col-xs-12 col-md-6">
            <div class="card-item">
                <div class="card-image">
                    <img class="imagem" src="img/univer_coimbra.jpg"></div>
                <div class="card-info">
                    <h2 class="card-title sub_title">Universidade de Coimbra</h2>
                    <p class="card-intro description_title">Far far away, behind the word mountains, far from the
                        countries Vokalia and Consonantia, there live the blind texts.</p>
                    <a href="about_university.php">
                        <button class="btn_destaques">Ver mais</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="w-75 mx-auto list_links">
    <div id='wrapper_title'>
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title adjustment_top">Ligações recentes com empresas</h3>
                </div>
            </div>
        </div>
    </div>

    <div id='wrapper'>
        <div id='recenttags'>
            <div class='tagpost-top section' id='tagpost-top'>
                <div class='widget HTML' id='HTML5'>
                    <div class='widget-content'>
                        <ul class='taglabel'>

                            <li class='clearfix_companies'>
                                <a href=""><img alt="Imagem da FNAC2" title="" class="tagpost_thumb"
                                                src="img/fnac.jpg"></a>
                                <p class="mb-0 link_info"><i class="fa fa-briefcase mr-1"
                                                             aria-hidden="true"></i>Trabalhar
                                </p>
                                <h4 class="mb-0 link_title">FNAC</h4>
                                <h5 class="mb-0 link_subtitle">Recursos Humanos</h5>
                            </li>
                            <li class='clearfix_companies'>
                                <a href=""><img alt="Imagem da FNAC2" title="" class="tagpost_thumb"
                                                src="img/fnac.jpg"></a>
                                <p class="mb-0 link_info"><i class="fa fa-briefcase mr-1"
                                                             aria-hidden="true"></i>Trabalhar
                                </p>
                                <h4 class="mb-0 link_title">FNAC</h4>
                                <h5 class="mb-0 link_subtitle">Recursos Humanos</h5>
                            </li>
                            <li class='clearfix_companies'>
                                <a href=""><img alt="Imagem da FNAC2" title="" class="tagpost_thumb"
                                                src="img/fnac.jpg"></a>
                                <p class="mb-0 link_info"><i class="fa fa-briefcase mr-1"
                                                             aria-hidden="true"></i>Trabalhar
                                </p>
                                <h4 class="mb-0 link_title">FNAC</h4>
                                <h5 class="mb-0 link_subtitle">Recursos Humanos</h5>
                            </li>
                            <li class='clearfix_companies'>
                                <a href=""><img alt="Imagem da FNAC2" title="" class="tagpost_thumb"
                                                src="img/fnac.jpg"></a>
                                <p class="mb-0 link_info"><i class="fa fa-briefcase mr-1"
                                                             aria-hidden="true"></i>Trabalhar
                                </p>
                                <h4 class="mb-0 link_title">FNAC</h4>
                                <h5 class="mb-0 link_subtitle">Recursos Humanos</h5>
                            </li>
                            <li class='clearfix_companies'>
                                <a href=""><img alt="Imagem da FNAC2" title="" class="tagpost_thumb"
                                                src="img/fnac.jpg"></a>
                                <p class="mb-0 link_info"><i class="fa fa-briefcase mr-1"
                                                             aria-hidden="true"></i>Trabalhar
                                </p>
                                <h4 class="mb-0 link_title">FNAC</h4>
                                <h5 class="mb-0 link_subtitle">Recursos Humanos</h5>
                            </li>
                            <li class='clearfix_companies'>
                                <a href=""><img alt="Imagem da FNAC2" title="" class="tagpost_thumb"
                                                src="img/fnac.jpg"></a>
                                <p class="mb-0 link_info"><i class="fa fa-briefcase mr-1"
                                                             aria-hidden="true"></i>Trabalhar
                                </p>
                                <h4 class="mb-0 link_title">FNAC</h4>
                                <h5 class="mb-0 link_subtitle">Recursos Humanos</h5>
                            </li>
                        </ul>
                    </div>
                    <div class='clear'></div>
                </div>
            </div>
        </div>
        <div id='footer'>
            <a href="can_choose_work.php">
                <button class="btn_cards mx-auto">Ver mais</button>
            </a>
        </div>
    </div>
</div>