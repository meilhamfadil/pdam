var myTable;

$(function () {

    myTable = table.itable({
        source: "pelanggan/listData",
        action: {
            detail: {
                link: "pelanggan/detail",
                icon: "text-Detail",
                callback: function (id, link) {
                    openDetailModal(link, function (result) {
                        modalDetail.find(".modal-title").text(result.nama_depan + " " + result.nama_belakang);
                        modalDetail.find(".modal-body").text(result.alamat);
                        modalDetail.modal();
                    })
                }
            }
        }
        // customize: [{
        // targets: [1, 2, 3, 4, 5],
        // render: function (data, type, row, meta) {
        //     var regex = new RegExp(row[3], "gm");
        //     var filtered = regex.exec(row[2]);
        //     var rule = JSON.parse(row[4]);
        //     if (rule != null) {
        //         var indexing = ["", "EVENT", "INFO", "DETAIL", "USER", "TIME"];
        //         var dataIndex = Object.keys(rule).indexOf(indexing[meta.col]) + 1;
        //         return (dataIndex == 0) ? "-" : ((meta.col != 5) ? filtered[dataIndex] : filtered[dataIndex].indoDate());
        //     } else {
        //         return "";
        //     }
        // },
        // class: "text-center",
        // orderable: false
        // }]
    });
});