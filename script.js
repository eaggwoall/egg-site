$(document).ready(function () {
    let isVisible = true;

    $("#toggleHeader").click(function () {
        $("#categoryContent").slideToggle(300, function () {
            isVisible = !isVisible;
            $("#toggleHeader").text(isVisible ? "Ʌ" : "V");
        });
    });
});