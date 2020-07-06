<?php
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"])) {

    $User_type = $_SESSION["type"];
    $idUser = $_SESSION["idUser"];

    $query = "SELECT User_type_idUser_type, type_user FROM users INNER JOIN user_type ON users.User_type_idUser_type= user_type.idUser_type WHERE idUser=?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $User_type_idUser_type, $type_user);
        while (mysqli_stmt_fetch($stmt)) {
?>

            <div class="home_menu mx-auto w-75 mt-0 pt-0">
                <ul class="row p-0" style="list-style-type: none;">
                    <!---PRIMEIRA-->
                    <?php
                    if ($type_user == "Jovem") {
                    ?>
                        <li class="col-lg-3 col-sm-12 p-0">
                            <div class="menu">
                                <div class="menu-title mb-0">
                                    <h5 class='mx-auto titulo'>Quero estudar</h5>
                                </div>
                                <ul class="menu-dropdown">
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_study.php">As minhas ligações</a></li>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions_uni.php">Todas as opções disponíveis</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    } else if ($type_user == "Empresa") {
                    ?>
                        <li class="col-lg-4 col-sm-12 p-0">
                            <div class="menu">
                                <div class="menu-title mb-0">
                                    <h5 class='mx-auto titulo'>Candidatos</h5>
                                </div>
                                <ul class="menu-dropdown">
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_work.php">Os meus candidatos</a></li>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions_company.php">Todos os jovens</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    } else if ($type_user == "Universidade") {
                    ?>
                        <li class="col-lg-4 col-sm-12 p-0">
                            <div class="menu">
                                <div class="menu-title mb-0">
                                    <h5 class='mx-auto titulo'>Candidatos</h5>
                                </div>
                                <ul class="menu-dropdown">
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_study.php">As minhas ligações</a></li>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions_uni.php">Todos os jovens</a></li>
                                </ul>
                            </div>
                        </li>
                        <!---*******************************-->

                    <?php
                    }

                    if ($type_user == "Jovem") {
                    ?>
                        <!---SEGUNDA-->
                        <li class="col-lg-3 col-sm-12 p-0">
                            <div class="menu">
                                <div class="menu-title mb-0">
                                    <h5 class='mx-auto titulo'>Quero trabalhar</h5>
                                </div>
                                <ul class="menu-dropdown">
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_work.php">As minhas ligações</a></li>
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions_company.php">Todas as opções disponíveis</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    } else if ($type_user == "Empresa") {
                    ?>
                        <li class="col-lg-4 col-sm-12 p-0">
                            <div class="menu">
                                <div class="menu-title mb-0">
                                    <h5 class='mx-auto titulo'>Vagas</h5>
                                </div>
                                <ul class="menu-dropdown">
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="all_vacancies_comp.php">As minhas vagas</a></li>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="upload_vac.php">Criar uma vaga</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    } else if ($type_user == "Universidade") {
                    ?>
                        <li class="col-lg-4 col-sm-12 p-0">
                            <div class="menu">
                                <div class="menu-title mb-0">
                                    <h5 class='mx-auto titulo'>Vagas de Empresas</h5>
                                </div>
                                <ul class="menu-dropdown">
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions_company.php">Todas as vagas</a></li>
                                </ul>
                            </div>
                        </li>
                        <!---*******************************-->
                    <?php
                    }
                    if ($type_user == "Jovem") {
                    ?>
                        <!---TERCEIRA-->
                        <li class="col-lg-3 col-sm-12 p-0">
                            <div class="menu">
                                <div class="menu-title mb-0">
                                    <h5 class='mx-auto titulo'>Quero estudar e trabalhar</h5>
                                </div>
                                <ul class="menu-dropdown">
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_ws.php">As minhas ligações</a></li>
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions.php">Todas as opções disponíveis</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    } else if ($type_user == "Empresa") {
                    ?>
                        <li class="col-lg-4 col-sm-12 p-0">
                            <div class="menu">
                                <div class="menu-title mb-0">
                                    <h5 class='mx-auto titulo'>Experiências de Jovens</h5>
                                </div>
                                <ul class="menu-dropdown">
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="experiences.php">Todas as experiências</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    } else if ($type_user == "Universidade") {
                    ?>
                        <li class="col-lg-4 col-sm-12 p-0">
                            <div class="menu">
                                <div class="menu-title mb-0">
                                    <h5 class='mx-auto titulo'>Experiências de Jovens</h5>
                                </div>
                                <ul class="menu-dropdown">
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="experiences.php">Todas as experiências</a></li>
                                </ul>
                            </div>
                        </li>
                        <!---*******************************-->
                    <?php
                    }
                    if ($type_user == "Jovem") {
                    ?>
                        <!---QUARTA-->
                        <li class="col-lg-3 col-sm-12 p-0">
                            <div class="menu">
                                <div class="menu-title mb-0">
                                    <h5 class='mx-auto titulo'>Quero ver o que já foi feito</h5>
                                </div>
                                <ul class="menu-dropdown">
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="links_made.php">O que eu já fiz</a></li>
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="experiences.php">O que os outros fizeram</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            </li>
            </ul>

            </div>
<?php
        }
        /* close statement */
        mysqli_stmt_close($stmt);
    }
    /* close connection */
    mysqli_close($link);
}
?>