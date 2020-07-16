<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "public/helpers/meta.php"; ?>
    <title>Bem vindo(a)!</title>
    <?php include "public/helpers/fonts.php"; ?>
    <?php include "public/helpers/css_index.php"; ?>
</head>

<body id="fundo">
    <header class="sticky-top">
        <?php include "public/components/navbar.php"; ?>
    </header>
    <main class="container p-0 mb-5 mx-auto">
        <?php include "public/components/index.php"; ?>
    </main>
    <?php include "public/components/footer_index.php"; ?>
    <div class="loader-wrapper">
            <div class="body loading">
                <div id="loading-msg">
                    <div class="msg">
                        <img src="public/img/loading.png" title="HiLives logo" class="logo_loader mb-5">
                        <p style="color:white !important;">Bem vindo(a)!</p>
                        <div class="spin">
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <?php include "public/helpers/js.php"; ?>
    <?php include "public/helpers/fontawesome.php"; ?>
    <script>
            $(window).on("load", function() {
                $(".loader-wrapper").fadeOut("slow");
            });
        </script>
</body>

</html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: admin/index.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
    header("Location: public/home_companies.php");
} else  if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: public/home_people.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: public/home_uni.php");
}
?>