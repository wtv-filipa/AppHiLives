<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>HiLives</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->
    <?php include "helpers/css_home.php"; ?>
</head>

<body>
    <header class="sticky-top">
        <!--navbar-->
        <?php include "components/navbar.php"; ?>
    </header>
    <main class="container p-0 mb-5 mx-auto mt-0 pt-0">
        <!--componente da homepage-->
        <?php include "components/home_userDID_content.php"; ?>
    </main>
    <!-- JavaScript-->
    <?php //include "helpers/js.php"; 
    ?>
<script>
    let acordeon = document.getElementById("acordeon-content"),
        acordeonBody = [...document.querySelectorAll(".acordeon__body")];

    function openMenu(element) {
        let parent = element.target.parentNode,
            lastChild = parent.lastElementChild,
            menu = lastChild.firstElementChild;

        acordeonBody.map((el) => (el.style.height = 0));

        if (lastChild.clientHeight) {
            lastChild.style.height = 0;
        } else {
            let altoMenu = menu.clientHeight;
            lastChild.style.height = `${altoMenu}px`;
        }
    }

    function getTarget(e) {
        if (e.target.tagName === "DIV") {
            openMenu(e);
        }
    }

    acordeon.addEventListener("click", getTarget);

</script>

</body>

</html>