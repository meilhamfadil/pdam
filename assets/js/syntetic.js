$(function () {
    var ids = document.querySelectorAll("*[id]");
    ids.forEach(function (entry) {
        window[entry.id] = $("#" + entry.id);
    });
});