$(function () {

    $("#form").on("submit", function (evt) {
        var form = $(this);
        form.defaultFormSend(function (result) {
            if (result.status == "Success") {                
                window.location.reload();
                toast("success", result.message);
            } else {
                toast("error", result.message);
            }
        });

        return false;
    });

});