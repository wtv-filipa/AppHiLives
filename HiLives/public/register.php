<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- metadados -->
        <?php include "helpers/meta.php"; ?>
        <title>Registo Jovens</title>
        <!-- Custom fonts for this template-->
        <?php include "helpers/fonts.php"; ?>
        <!-- Custom styles for this template-->
        <?php include "helpers/css_register_login.php"; ?>
    </head>

    <body id="page-top" class="fundo_login_reg">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!--cartões com earnings pequenos-->
                <?php include "components/register.php"; ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <?php include "components/loading_screen.php"; ?>
        <!-- JavaScript-->
        <script>
            var select = document.getElementById("pais");
            var formularios = document.querySelectorAll('.formulario');

            select.onchange = function() {
                for (var i = 0; i < formularios.length; i++) formularios[i].style.display = 'none';
                var divID = select.options[select.selectedIndex].value;
                var div = document.getElementById(divID);
                div.style.display = 'block';
            };
            //FORM
            function checkPass() {
                //Store the password field objects into variables ...
                var pass1 = $("#register-form #password");
                var pass2 = $("#register-form #password_confirm");

                console.log(pass1.value, pass2);
                //Store the Confimation Message Object ...
                var message = $('#confirmMessage');
                //Set the colors we will be using ...
                var goodColor = "#66cc66";
                var badColor = "#ff6666";
                var opacidade = "0.7";
                //Compare the values in the password field
                //and the confirmation field
                if (pass1.val() == pass2.val()) {
                    //The passwords match.
                    //Set the color to the good color and inform
                    //the user that they have entered the correct password
                    pass2.css("backgroundColor", goodColor);
                    message.css("color", goodColor);
                    message.html("As palavras-passe estão iguais!");
                } else {
                    //The passwords do not match.
                    //Set the color to the bad color and
                    //notify the user.
                    pass2.css("backgroundColor", badColor);
                    pass2.css("opacity", opacidade);
                    message.css("color", badColor);
                    message.html("As palavras-passe estão diferentes!");
                }
            }

            var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab

            function showTab(n) {
                // This function will display the specified tab of the form ...
                var x = document.getElementsByClassName("tab");
                x[n].style.display = "block";
                // ... and fix the Previous/Next buttons:
                if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                }
                if (n == (x.length - 1)) {
                    document.getElementById("nextBtn").innerHTML = "Finalizar";
                } else {
                    document.getElementById("nextBtn").innerHTML = "Próximo";
                }
                // ... and run a function that displays the correct step indicator:
                fixStepIndicator(n)
            }

            function nextPrev(n) {
                // This function will figure out which tab to display
                var x = document.getElementsByClassName("tab");
                // Exit the function if any field in the current tab is invalid:
                if (n == 1 && !validateForm()) return false;
                // Hide the current tab:
                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:
                currentTab = currentTab + n;
                // if you have reached the end of the form... :
                if (currentTab >= x.length) {
                    //...the form gets submitted:
                    document.getElementById("register-form").submit();
                    return false;
                }
                // Otherwise, display the correct tab:
                showTab(currentTab);
            }

            function validateForm() {
                // This function deals with validation of the form fields
                var x, y, i, valid = true;
                x = document.getElementsByClassName("tab");
                y = x[currentTab].getElementsByTagName("input");
                // A loop that checks every input field in the current tab:
                for (i = 0; i < y.length; i++) {
                    // If a field is empty...
                    if (y[i].value == "") {
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false:
                        valid = false;
                    }
                }
                // If the valid status is true, mark the step as finished and valid:
                if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                }
                return valid; // return the valid status
            }

            function fixStepIndicator(n) {
                // This function removes the "active" class of all steps...
                var i, x = document.getElementsByClassName("step");
                for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                }
                //... and adds the "active" class to the current step:
                x[n].className += " active";
            }
        </script>

        <?php include "helpers/js.php"; ?>
        <?php include "helpers/fontawesome.php"; ?>
        <script>
              $(window).on("load", function() {
                $(".loader-wrapper").fadeOut("slow");
            });
        </script>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: ../admin/index.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
    header("Location: home_companies.php");
} else  if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: home_people.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: home_uni.php");
}
?>