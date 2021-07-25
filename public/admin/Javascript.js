$(function() {
    var classItem = window.sessionStorage.getItem("sidebartoggle");
    $("body").addClass(classItem);
    $(".sidebar-toggle").click(function() {
        var classItem = window.sessionStorage.getItem("sidebartoggle");
        if (classItem == "") {
            window.sessionStorage.setItem("sidebartoggle", "sidebar-collapse");
        } else {
            window.sessionStorage.setItem("sidebartoggle", "");
        }

    });
    $(".xoa").click(function() {
        var title = $(this).prop("title");
        if (window.confirm(title)) {
            return  true;
        }
        return  false;
    });
    $(".AjaxBtnResetContent").click(function() {
        var dataHtml = $(this).data();
        $.ajax({
            url: dataHtml.url
        }).then(function(res) {
            if (dataHtml.targetType == 'val')
            {
                $(dataHtml.target).val(res);
            } else {
                $(dataHtml.target).html(res);
            }

        });
    });


});