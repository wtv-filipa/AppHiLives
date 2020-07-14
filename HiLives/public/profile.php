<?php
session_start();

if (isset($_SESSION["idUser"]) and $_SESSION["type"] != 4) {
    $id_navegar = $_SESSION["idUser"];
    $query20 = "SELECT idUser
            FROM users 
            WHERE idUser = ?";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- metadados -->
        <?php include "helpers/meta.php"; ?>
        <?php
        require_once("connections/connection.php");

        $link7 = new_db_connection();
        $stmt7 = mysqli_stmt_init($link7);
        if (mysqli_stmt_prepare($stmt7, $query20)) {

            mysqli_stmt_bind_param($stmt7, 'i', $id_navegar);
            mysqli_stmt_execute($stmt7);
            mysqli_stmt_bind_result($stmt7, $idUser);
            while (mysqli_stmt_fetch($stmt7)) {
                if (isset($_GET["user"]) && $_GET["user"] == $id_navegar) {
                    echo "<title>Sobre mim</title>";
                }else{
                    echo "<title>Perfil</title>";
                } 
            }
            mysqli_stmt_close($stmt7);
        }
        ?>
        <!-- Custom fonts for this template-->
        <?php include "helpers/fonts.php"; ?>
        <!-- Custom styles for this template-->
        <?php include "helpers/css_profile.php"; ?>

    </head>

    <body id="fundo">
        <header class="sticky-top">
            <!--navbar-->
            <?php include "components/navbar.php"; ?>
        </header>
        <main class="container">
            <?php include "components/profile.php"; ?>
        </main>
        <?php include "components/footer.php"; ?>
        <!-- JavaScript-->
        <?php include "helpers/js.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
        <script type="text/javascript" src="js/notifications.js"></script>
        <script>
            $('.modal_problem').appendTo("body");
        </script>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: ../admin/index.php");
} else {
    header("Location: ../public/login.php");
}
?>