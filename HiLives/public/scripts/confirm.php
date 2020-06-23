<script type="text/javascript">
    window.alertConfirm = function () {
        var txt;
        var msg = confirm("Tens a certeza que queres eliminar a experiência <?=$title_exp?>?");

        if (msg == true) {
            txt = "You pressed OK!";
            window.location.href = 'scripts/delete_xp.php?apaga=<?=$idContent?>&user=<?=$idUser?>';

        } else {
            txt = "You pressed Cancel!";
            window.location.href = 'profile.php?user=<?=$idUser?>';

        }
        document.getElementById("demo").innerHTML = txt;
    }


</script>


<script type="text/javascript">

    window.alertConfirm2 = function () {

        var txt2;
        var msg2 = confirm("Tem a certeza que quer eliminar o vídeo associado à vaga <?=$vacancie_name?>?");

        if (msg2 == true) {
            txt2 = "You pressed OK!";
            window.location.href = 'scripts/delete_vid_comp.php?apaga=<?=$Content_idContent?>';

        } else {
            txt2 = "You pressed Cancel!";
            window.location.href = 'profile.php?user=<?=$idUser?>';

        }
        document.getElementById("demo").innerHTML = txt2;
    }
</script>