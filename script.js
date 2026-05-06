$(document).ready(function () {
    let isVisible = true;

    $("#toggleHeader").click(function () {
        $("#categoryContent").slideToggle(300, function () {
            isVisible = !isVisible;
            $("#toggleHeader").text(isVisible ? "-" : "+");
        });
    });

    $("#maxPrice").on("input", function () {
        $("#maxPriceValue").text(parseFloat(this.value).toFixed(2));
    });
});
