var myTable;

$(function () {

    myTable = table.itable({
        source: "watermeter/listData",
        action: {
            detail: {
                link: "watermeter/detail",
                callback: function (id, link) {
                    openDetailModal(link, function (result) {
                        console.log(result);
                        modalDetail.find(".modal-title").text(result.nickname);
                        modalDetail.find(".modal-body").text(result.name);
                        modalDetail.modal();
                    })
                }
            },
            edit: {
                link: "watermeter/form",
                callback: function (id) {
                    conform.load(baseurl + "watermeter/form/" + id, function () {
                        contable.swap(conform);
                        formOpened();
                    })
                }
            },
            delete: {
                link: "watermeter/delete",
                callback: function (result) {
                    toast(result.status.toLowerCase(), result.message);
                }
            }
        },
        customize: [{
            targets: [2,3],
            class: "text-center"
        },{
            targets: [1],
            visible: false
        }]
    });

    $("#openForm").on("click", function () {
        conform.load(baseurl + "watermeter/form", function () {
            contable.swap(conform);
            formOpened();
        })
    });

});

function formOpened() {
    $("#closeForm").on("click", function () {
        conform.swap(contable);
    });

    $("#form input").on("keypress", function (e) {
        return e.which !== 13;
    });

    $("#form").on("submit", function (evt) {
        var form = $(this);
        form.defaultFormSend(function (result) {
            if (result.status == "Success") {
                myTable.ajax.reload();
                conform.swap(contable);
                toast("success", result.message);
            } else {
                toast("error", result.message);
            }
        });

        return false;
    });
}