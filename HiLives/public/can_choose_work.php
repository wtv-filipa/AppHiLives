<?php
session_start();
if (isset($_SESSION["idUser"])) {
    if ($_SESSION["type"] == 7 || $_SESSION["type"] == 10) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <?php include "helpers/meta.php"; ?>
            <title>As minhas ligações</title>
            <?php include "helpers/fonts.php"; ?>
            <?php include "helpers/css_can_choose.php"; ?>
            <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
            <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
        </head>

        <body id="fundo">

            <?php include "components/loading_screen.php"; ?>

            <header class="sticky-top">
                <?php include "components/navbar.php"; ?>
            </header>
            <main class="container p-0 mb-5 mx-auto">
                
                <?php include "components/choose_work.php"; ?>
            </main>
            <?php include "components/footer.php"; ?>

            <?php include "helpers/fontawesome.php"; ?>
            
            <?php include "helpers/js.php"; ?>
            <script src="js/fav.js"></script>
            <script type="text/javascript" src="js/notifications.js"></script>

            <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
            <script>
                $(window).on("load", function() {
                    $(".loader-wrapper").fadeOut("slow");
                });

                $(document).ready(function($) {
                    $('.card-slider').slick({
                        dots: true,
                        infinite: true,
                        speed: 500,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        autoplay: false,
                        autoplaySpeed: 2000,
                        arrows: true,
                        responsive: [{
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 400,
                                settings: {
                                    arrows: false,
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            }
                        ]
                    });
                });
            </script>
        </body>

        </html>
<?php
    } else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
        header("Location: ../admin/index.php");
    } else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
        header("Location: home_uni.php");
    } else {
        header("Location: ../public/login.php");
    }
} else {
    header("Location: ../public/login.php");
}
?>