var myTable;

$(function () {

    myTable = table.itable({
        source: "change/listData",
        action: {
            detail: {
                link: "change/detail",
                icon: "text-Detail",
                callback: function (id, link) {
                    condetail.load(baseurl + "change/detail/" + id, function () {
                        contable.swap(condetail);
                        $("#closedetail").on("click", function(){
                            condetail.swap(contable);
                        });
                    });
                }
            }
        },
        customize: [{
            targets: [1],
            visible: false
        }, {
            targets: [6, 7, 8],
            render: function (data, type, row, meta) {
                var bg = ["dark", "success", "warning"]
                var render = "<span class='badge badge-" + ((data == 1) ? bg[meta.col - 6] : "danger") + "'>"
                render += (data == 1) ? "<i class='zmdi zmdi-check'></i>" : "<i class='zmdi zmdi-close'></i>";
                render += "</span>";
                return render;
            },
            class: "text-center",
            orderable: false
        }]
    });

});