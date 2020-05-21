<?php
include "navbar_2.php";

if ($_SESSION["idUser"]) {

$idUser = $_SESSION["idUser"];

require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT User_university, Area, name_user, profile_img 
            FROM young_university 
            INNER JOIN users ON young_university.User_university = users.idUser 
            WHERE User_young LIKE ?";
?>

<div class="w-75 mx-auto">
    <div id='wrapper_title'>
        <div class='tagpost-top section' id='tagpost-top'>
            <div class='widget HTML' id='HTML5'>
                <div data-aos="fade-up">
                    <h3 class="mb-4 main_title">As minhas ligações | Estudar</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="cards-circle">
        <div class="row">
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $User_university,$Area, $name_user, $profile_img);

                while (mysqli_stmt_fetch($stmt)) {
                    ?>
                    <div class="card-container col-lg-4">
                        <a class="card" href="profile.php?user=<?= $User_university ?>">
                            <?php
                            if (isset($profile_img)) {
                                ?>
                                <div class="image" style="background-image: url('../uploads/img_perfil/<?= $profile_img ?>')"></div>

                                <?php
                            } else {
                                ?>
                                <div class="image" style="background-image: url('img/index_2.png')"></div>
                                <?php
                            }
                            ?>

                            <div class="card-info">
                                <h4 class="card-intro description_title"><i class="fas fa-book" aria-hidden="true"></i>
                                    Estudar</h4>
                                <h2 class="card-title sub_title"><?= $name_user ?></h2>
                                <p class="card-intro description_title2"><?= $Area ?></p>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
            }
            ?>
        </div>
    </div>
</div>