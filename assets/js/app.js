var baseurl = location.origin + "/pdam/";
var assets = baseurl + "assets/";

$.fn.swap = function (changeTo) {
    this.slideUp("slow", function () {
        changeTo.slideDown();
    });
};

$.fn.defaultFormSend = function (callback) {
    $.ajax({
        url: this.attr("action"),
        data: this.serialize(),
        type: this.attr("method"),
        dataType: "json",
        beforeSend: function () {

        },
        success: function (result) {
            callback(result);
        },
        error: function (e) {
            alert("Cannot Send")
        }
    });
};

$.fn.multipartSend = function (callback) {
    $.ajax({
        url: this.attr("action"),
        data: new FormData(this[0]),
        type: this.attr("method"),
        dataType: "json",
        beforeSend: function () {

        },
        success: function (result) {
            callback(result);
        },
        error: function (e) {
            alert("Cannot Send")
        }
    });
};

Object.defineProperty(String.prototype, "pad", {
    value: function pad(max) {
        strpad = "0" + this;
        return this.length < max ? strpad.pad(max) : this;
    },
    writable: true,
    configurable: true
});

Object.defineProperty(String.prototype, "indoDate", {
    value: function indoDate() {
        var bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        var date = moment(this).format("YYYY-MM-DD").split("-");
        var time = moment(this).format("HH:mm:ss");
        return time + ", " + date[2] + " " + bulan[date[1]] + " " + date[0];
    },
    writable: true,
    configurable: true
});

function openDetailModal(link, callback) {
    $.ajax({
        url: link,
        type: "GET",
        dataType: "json",
        beforeSend: function () {

        },
        success: function (result) {
            callback(result);
        },
        error: function (e) {
            alert("cannot send");
        }
    });
}

function toast(type, message) {
    toastr.options.positionClass = "toast-bottom-right";
    switch (type) {
        case "success":
            toastr.success(message);
            break;
        case "info":
            toastr.info(message);
            break;
        case "warning":
            toastr.warning(message);
            break;
        case "error":
            toastr.error(message);
            break;
        default:
            toastr.warning("Something Wrong", message);
            break;
    }
}