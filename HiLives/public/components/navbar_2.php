<?php
require_once("connections/connection.php");
if (isset($_SESSION["idUser"])) {

    $User_type = $_SESSION["type"];
    $idUser = $_SESSION["idUser"];

    // Create a new DB connection
    $link = new_db_connection();
    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT User_type_idUser_type, type_user FROM users INNER JOIN user_type ON users.User_type_idUser_type= user_type.idUser_type WHERE idUser=?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $User_type_idUser_type, $type_user);
        while (mysqli_stmt_fetch($stmt)) {
?>

            <div class="home_menu mx-auto w-75 mt-0 pt-0">
                <ul class="row p-0" style="list-style-type: none;">
                    <li class="col-lg-3 col-sm-12 p-0">
                        <div class="menu">
                            <div class="menu-title mb-0">
                                <?php
                                if ($type_user == "Jovem") {
                                    echo "<h5 class='mx-auto titulo'>Quero estudar</h5>";
                                } else if ($type_user == "Empresa") {
                                    echo "<h5 class='mx-auto titulo'>Adicionar vaga</h5>";
                                } else {
                                    echo "<h5 class='mx-auto titulo'>OUTRO TITULO</h5>";
                                }
                                ?>
                            </div>
                            <ul class="menu-dropdown">
                                <?php
                                if ($type_user == "Jovem") {
                                ?>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_study.php">As minhas ligações</a></li>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions_uni.php">Todas as opções disponíveis</a></li>
                                <?php
                                } else if ($type_user == "Empresa") {
                                ?>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="upload_vac.php">Criar uma nova vaga</a></li>
                                <?php
                                } else {
                                ?>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_study.php">As minhas ligações</a></li>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions_uni.php">Todas as opções disponíveis</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class="col-lg-3 col-sm-12 p-0">
                        <div class="menu">
                            <div class="menu-title menu-title_2nd mb-0">
                                <?php
                                if ($type_user == "Jovem") {
                                    echo "<h5 class='mx-auto titulo'>Quero trabalhar</h5>";
                                } else {
                                    echo "<h5 class='mx-auto titulo'>OUTRO TITULO</h5>";
                                }
                                ?>
                            </div>
                            <ul class="menu-dropdown">
                                <?php
                                if ($type_user == "Jovem") {
                                ?>
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_work.php">As minhas ligações</a></li>
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions_company.php">Todas as opções disponíveis</a></li>
                                <?php
                                } else {
                                ?>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_study.php">As minhas ligações</a></li>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions_uni.php">Todas as opções disponíveis</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class="col-lg-3 col-sm-12 p-0">
                        <div class="menu">
                            <div class="menu-title menu-title_3rd mb-0">
                                <?php
                                if ($type_user == "Jovem") {
                                    echo "<h5 class='mx-auto titulo'>Quero estudar e trabalhar</h5>";
                                } else {
                                    echo "<h5 class='mx-auto titulo'>OUTRO TITULO</h5>";
                                }
                                ?>
                            </div>
                            <ul class="menu-dropdown">
                                <?php
                                if ($type_user == "Jovem") {
                                ?>
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_ws.php">As minhas ligações</a></li>
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions.php">Todas as opções disponíveis</a></li>
                                <?php
                                } else {
                                ?>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="can_choose_study.php">As minhas ligações</a></li>
                                    <li> <a class="btn" style="width:100%; font-size: 0.8rem;" href="allOptions_uni.php">Todas as opções disponíveis</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class="col-lg-3 col-sm-12 p-0">
                        <div class="menu">
                            <div class="menu-title menu-title_4th mb-0">
                                <?php
                                if ($type_user == "Jovem") {
                                    echo "<h5 class='mx-auto titulo'>Quero ver o que já foi feito</h5>";
                                } else {
                                    echo "<h5 class='mx-auto titulo'>Experiências</h5>";
                                }
                                ?>
                            </div>
                            <ul class="menu-dropdown">
                                <?php
                                if ($type_user == "Jovem") {
                                ?>
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="links_made.php">O que eu já fiz</a></li>
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="experiences.php">O que os outros fizeram</a></li>
                                <?php
                                } else {
                                ?>
                                    <li><a class="btn" style="width:100%; font-size: 0.8rem;" href="experiences.php">Experiências dos jovens</a></li>
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
    }
}
?>