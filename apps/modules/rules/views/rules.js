let deviceTable;

$(function () {

    deviceTable = table.itable({
        source: "rules/listData",
        action: {
            detail: {
                link: "rules/detail",
                callback: function (id, link) {
                    openDetailModal(link, function (result) {
                        modalDetail.find(".modal-title").text("Kode Aturan : " + result.kode_rule);
                        var body = "Nama Aturan : " + result.keterangan + "<br>";
                        body += "Regex : " + result.regex_filter + "<br>";
                        body += "Filter : " + result.filter_rendering;
                        modalDetail.find(".modal-body").html(body);
                        modalDetail.modal();
                    })
                }
            },
            edit: {
                link: "rules/form",
                callback: function (id) {
                    conform.load(baseurl + "rules/form/" + id, function () {
                        contable.swap(conform);
                        formOpened();
                    })
                }
            },
            delete: {
                link: "rules/delete",
                callback: function (result) {
                    toast("error", result.message);
                }
            }
        },
        customize: [{
            targets: [1],
            visible: false
        }, {
            targets: [4],
            render: function (data, type, row, meta) {
                var text = "";
                $.each(JSON.parse(data), function (index, value) {
                    text += index + " : " + value + "<br>";
                })
                return text;
            }
        }]
    });

    $("#openForm").on("click", function () {
        conform.load(baseurl + "rules/form", function () {
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

    console.log("heh");

    $("#case,#regex").on("keyup", function () {
        try {
            var regex = new RegExp($("#regex").val(), "gm");
            var cases = $("#case").val();
            var table = $("#table tbody")
            var filtered = regex.exec(cases);
            var no = 1;
            table.html('');
            $.each(filtered, function (index, value) {
                if (index != 0) {
                    var tr = "<tr>";
                    tr += "<td>" + no + "</td>";
                    tr += "<td>" + value + "</td>";
                    tr += "<td>" + $("#kelompok").html() + "</td>";
                    tr += "</tr>";
                    table.append(tr);
                    no++;
                }
            });
        } catch (e) {

        }
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