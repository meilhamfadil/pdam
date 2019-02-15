(function ($) {

    var defaultTable = {
        dom: "<'row p-l-10 p-r-10 p-t-10'<'col-5'l><'col'f>r<'clear'>>t<'row p-l-10 p-r-10 p-b-10'<'col-5'i><'col'p>>",
        processing: true,
        serverSide: true,
        responsive: true,
        language: {
            loadingRecords: "Mohon tunggu sejenak ....",
            processing: '<img src="assets/img/loading.gif"> <span style="color:#000000;">Sedang Proses</span>',
            search: "<span>Filter:</span> ",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan <span>_START_</span> s/d <span>_END_</span> dari <span>_TOTAL_</span> data",
            emptyTable: "Tidak ada data",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Tidak ada data",
            paginate: {
                first: "<<",
                last: ">>",
                next: "",
                previous: ""
            }
        },
        ajax: {
            url: "",
            type: "POST",
            dataType: "json"
        },
        columnDefs: [{
            targets: [0],
            orderable: false,
            class: "text-center",
            width: "30px"
        }]
    }

    var defaultTableLegacy = {
        sDom: "<'row p-l-10 p-r-10 p-t-10'<'col-5'l><'col'f>r<'clear'>>t<'row p-l-10 p-r-10 p-b-10'<'col-5'i><'col'p>>",
        bProcessing: true,
        bServerSide: true,
        retrieve: true,
        responsive: true,
        oLanguage: {
            sLoadingRecords: "Tunggu sejenak - memuat...",
            sProcessing: '<img src="assets/img/loading.gif"> <span style="color:#000000;">Sedang Proses</span>',
            sSearch: "<span>Pencarian:</span> ",
            sLengthMenu: "_MENU_ data per halaman",
            sInfo: "Menampilkan <span>_START_</span> s/d <span>_END_</span> dari <span>_TOTAL_</span> data",
            sEmptyTable: "Tidak ada data",
            sInfoEmpty: "Tidak ada data",
            sZeroRecords: "Tidak ada data",
            oPaginate: {
                sFirst: "<<",
                sLast: ">>",
                sNext: "",
                sPrevious: ""
            }
        },
        sAjaxSource: "",
        fnServerData: function (sSource, aoData, fnCallback, oSettings) {
            oSettings.jqXHR = $.ajax({
                dataType: "json",
                type: "POST",
                url: sSource,
                data: aoData,
                success: fnCallback
            });
        },
        fnDrawCallback: function (oSettings) {
            scrollTo();
        },
        aoColumnDefs: [{
            aTargets: [0],
            orderable: false,
            sClass: "text-center",
            sWidth: "30px"
        }]
    };

    $.fn.itable = function (config) {
        let version = "present";
        let initTable = defaultTable;
        if (config.hasOwnProperty("version")) {
            version = config.version;
            initTable = (version == "present") ? defaultTable : defaultTableLegacy;
        }

        if (version == "present") {
            initTable.ajax.url = config.source;
        } else {
            initTable.sAjaxSource = config.source
        }

        if (config.hasOwnProperty("customize")) {
            if (version == "present") {
                initTable.columnDefs = initTable.columnDefs.concat(config.customize);
            } else {
                initTable.aoColumnDefs = initTable.aoColumnDefs.concat(config.customize);
            }
        }

        if (!config.action.hasOwnProperty("action")) {
            var column = [{
                aTargets: [-1],
                mRender: function (data, type, row, meta) {
                    let custom = "";
                    var lihat = (!config.action.hasOwnProperty("detail")) ? "" : create_button({
                        type: "success",
                        icon: (config.action.detail != null && config.action.detail.hasOwnProperty("icon")) ? config.action.detail.icon : "fullscreen",
                        title: "view",
                        link: (config.action.detail != null && config.action.detail.hasOwnProperty("link")) ? config.action.detail.link : ""
                    }, 2, 1);
                    var ubah = (!config.action.hasOwnProperty("edit")) ? "" : create_button({
                        type: "info",
                        icon: (config.action.edit != null && config.action.edit.hasOwnProperty("icon")) ? config.action.edit.icon : "edit",
                        title: "edit",
                        link: (config.action.edit != null && config.action.edit.hasOwnProperty("link")) ? config.action.edit.link : ""
                    }, 2, 1);
                    var hapus = (!config.action.hasOwnProperty("delete")) ? "" : create_button({
                        type: "danger",
                        icon: (config.action.delete != null && config.action.delete.hasOwnProperty("icon")) ? config.action.delete.icon : "delete",
                        title: "delete",
                        link: (config.action.delete != null && config.action.delete.hasOwnProperty("link")) ? config.action.delete.link : ""
                    }, 2, 1);

                    if (config.action.hasOwnProperty("add")) {
                        if ($.isArray(config.action.add)) {
                            $.each(config.action.add, function (index, value) {
                                custom += value;
                            });
                        }
                        custom = config.action.add;
                    }

                    var btn = lihat + ubah + hapus + custom
                    var regRow = /row([\d]+)/gm
                    while ((r = regRow.exec(btn)) !== null) {
                        if (r.index === regRow.lastIndex) {
                            regRow.lastIndex++;
                        }
                        $.each(r, function (index, value) {
                            btn = btn.replace("row" + value, row[value]);
                        });
                    }
                    return btn;
                },
                sWidth: (config.action.hasOwnProperty("add")) ? "auto" : "100px",
                sClass: "text-center",
                orderable: false
            }];

            if (version == "present") {
                initTable.columnDefs = initTable.columnDefs.concat(column);
            } else {
                initTable.aoColumnDefs = initTable.aoColumnDefs.concat(column);
            }

        }

        var table = (version == "present") ? this.DataTable(initTable) : this.dataTable(initTable);
        tableListener(table, config);

        return table;
    };

}(jQuery));

function create_button(config, info, index) {
    var btn = "<button class='btn btn-sm btn-itable btn-{type} {class}' data-info='{info}' data-index='{index}' data-link='{link}' data-toggle='tooltip' title='{title}'><i class='zmdi zmdi-{icon}'></i></button> ";
    $.each(config, function (index, data) {
        btn = btn.replace("{" + index + "}", data);
    });

    if (btn.indexOf("text-") != -1) {
        btn = btn.replace("<i class='zmdi zmdi-text-", "");
        btn = btn.replace("'></i>", "");
    }

    btn = btn.replace("{index}", "row" + ((typeof (index) != "undefined") ? index : 1));
    btn = btn.replace("{info}", "row" + ((typeof (info) != "undefined") ? info : 2));
    btn = btn.replace(/\{\w+\}/gm, "");
    return btn;
}

function tableListener(table, config) {
    $(".table").on("click", ".btn-itable", function (e) {
        var index = $(this).attr("data-index");
        var link = $(this).attr("data-link");
        var info = $(this).attr("data-info");
        var type = $(this).attr("title");
        switch (type) {
            case 'edit':
                if (config.action.edit.hasOwnProperty("callback")) {
                    config.action.edit.callback(Number(index).toString(16));
                } else {
                    alert("Action Not Declared");
                }
                break;
            case 'delete':
                modalDelete.find(".modal-body b").text(info);
                modalDelete.find("#did").val(Number(index).toString(16));
                modalDelete.find("#dlink").val(link);
                modalDelete.modal();
                break;
            case 'view':
                if (config.action.detail.hasOwnProperty("callback")) {
                    config.action.detail.callback(index, config.action.detail.link + "/" + Number(index).toString(16));
                } else {
                    alert("Action Not Declared");
                }
                break;
        }
        return false;
    });

    modalDelete.find(".delete").on("click", function () {
        $.ajax({
            url: baseurl + modalDelete.find("#dlink").val(),
            data: {
                "id": modalDelete.find("#did").val()
            },
            type: "POST",
            dataType: "JSON",
            success: function (result) {
                modalDelete.modal("hide");
                table.ajax.reload();
                if (config.action.delete.hasOwnProperty("callback")) {
                    config.action.delete.callback(result);
                }
            }
        });
    });
}