$(document).ready(function () {
    let isVisible = true;

    $("#toggleHeader").click(function () {
        $("#categoryHeader").slideToggle(300, function () {
            isVisible = !isVisible
            $("toggleHeader").text(isVisible ? "V" : "Ʌ");
        });
    });
});
