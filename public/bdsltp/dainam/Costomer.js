$(function() {
    $('img.hinhVuong').each(function() {
        var width = $(this).width();
        $(this).height(width);
        $(this).css("max-height", width + "px");
    });
    $(window).resize(function() {
        $('img.hinhVuong').each(function() {
            var width = $(this).width();
            $(this).height(width);
            $(this).css("max-height", width + "px");
        });
    });
});
