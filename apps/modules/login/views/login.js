$(function () {

    $("#form").on("submit", function (evt) {
        var form = $(this);
        form.defaultFormSend(function (result) {
            if (result.status == "success") {
                $.when(toast("success", result.message)).done(function(){
                    window.location.reload();
                });
            } else {
                toast("error", result.message);
            }
        });

        return false;
    });

});