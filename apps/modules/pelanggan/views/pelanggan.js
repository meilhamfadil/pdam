var myTable;

$(function () {

    myTable = table.itable({
        source: "pelanggan/listData",
        action: {
            detail: {
                link: "pelanggan/detail",
                callback: function (id, link) {
                    openDetailModal(link, function (result) {
                        console.log(result);
                        modalDetail.find(".modal-title").text(result.nama_depan + " " + result.nama_belakang);
                        modalDetail.find(".modal-body").text(result.alamat);
                        modalDetail.modal();
                    })
                }
            },
            edit: {
                link: "pelanggan/form",
                callback: function (id) {
                    conform.load(baseurl + "pelanggan/form/" + id, function () {
                        contable.swap(conform);
                        formOpened();
                    })
                }
            },
            delete: {
                link: "pelanggan/delete",
                callback: function (result) {
                    toast(result.status.toLowerCase(), result.message);
                }
            }
        },
        customize: [{
            targets: [1],
            class: "text-center",
            visible: false,
            orderable: false
        }]
    });

    $("#openForm").on("click", function () {
        conform.load(baseurl + "pelanggan/form", function () {
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