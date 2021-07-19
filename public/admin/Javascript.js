$(function() {
    $(".xoa").click(function() {
        var title = $(this).prop("title");
        if (window.confirm(title)) {
            return  true;
        }
        return  false;
    });
});