$(document).ready(function(){
    $(".noti").click(function(){
        var id = this.id;

        $.ajax({
            url: 'scripts/notifications.php',
            type: 'POST',
            data: {id:id},
            dataType: 'json',

            success:function(data){
                var text = data['text'];
                $("#"+id).html(text);
            }
        });
    });
});