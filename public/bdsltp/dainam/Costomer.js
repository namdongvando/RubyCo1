$(function() {
    $('body').bind('contextmenu cut copy paste', function(event) {
        event.preventDefault();
    });
    $(".btn-toggle").click(function() {
        var dataHtml = $(this).data();
        $(dataHtml.target).toggle(200);
    });
    $('img.hinhVuong').each(function() {
        var width = $(this).width();
        $(this).height(width);
        $(this).css("max-height", width + "px");
    });
    $('img.HinhChuNhat').each(function() {
        var width = $(this).width();
        $(this).height(width * 0.725);
        $(this).css("max-height", width + "px");
    });
    $(window).resize(function() {
        $('img.hinhVuong').each(function() {
            var width = $(this).width();
            $(this).height(width);
            $(this).css("max-height", width + "px");
        });
        $('img.HinhChuNhat').each(function() {
            var width = $(this).width();
            $(this).height(width * 0.725);
            $(this).css("max-height", width + "px");
        });
    });
});
