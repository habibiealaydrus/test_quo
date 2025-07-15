function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

jQuery(function ($) {
    $(function () {
        $(".ribuan").blur(function () {
            $(this).val(numberWithCommas($(this).val()));
        });

        $(".ribuan").focus(function () {
            $(this).val(removeCommas($(this).val()));
        })
    })

    function removeCommas(x) {
        return x.replace(/,/g, "");
    }

    String.prototype.removeCommas = function () {
        return removeCommas(this);
    };


});