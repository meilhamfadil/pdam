let deviceTable;

$(function () {

    deviceTable = table.itable({
        source: "devices/listData",
        action: {
            detail: {
                link: "devices/detail",
                callback: function (id, link) {
                    openDetailModal(link, function (result) {
                        modalDetail.find(".modal-title").text("Kode Device : " + result.kode_device);
                        var body = "Nama Device : " + result.nama_device + "<br>";
                        body += "Nama File : " + result.nama_file
                        modalDetail.find(".modal-body").html(body);
                        modalDetail.modal();
                    })
                }
            },
            edit: {
                link: "devices/form",
                callback: function (id) {
                    conform.load(baseurl + "devices/form/" + id, function () {
                        contable.swap(conform);
                        formOpened();
                    })
                }
            },
            delete: {
                link: "devices/delete",
                callback: function (result) {
                    toast(result.status.toLowerCase(), result.message);
                }
            }
        },
        customize: [{
            targets: [1],
            render: function (data, type, row, meta) {
                return data.pad(4);
            },
            class: "text-center",
            width: "150px"
        }]
    });

    $("#openForm").on("click", function () {
        conform.load(baseurl + "devices/form", function () {
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
                deviceTable.ajax.reload();
                conform.swap(contable);
                toast("success", result.message);
            } else {
                toast("error", result.message);
            }
        });

        return false;
    });
}