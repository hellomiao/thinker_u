//刷新页面
var pajax_container = "#page-content";

var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));
        } else {
                output.val('JSON browser support required for this demo.');
        }
};

function reload() {
        $.pjax.reload(pajax_container);
}

function page_load(url) {

        if (url && typeof(url) != "undefined") {
                $.pjax({url: url, container: pajax_container});
        } else {
                reload();
        }
}

(function ($) {
        $.fn.serializeAll = function () {
                var rselectTextarea = /^(?:select|textarea)/i;
                var rinput = /^(?:color|date|datetime|datetime-local|email|file|hidden|month|number|password|range|search|tel|text|time|url|week)$/i;
                var rCRLF = /\r?\n/g;

                var arr = this.map(function () {
                            return this.elements ? jQuery.makeArray(this.elements) : this;
                    })
                    .filter(function () {
                            return this.name && !this.disabled &&
                                ( this.checked || rselectTextarea.test(this.nodeName) ||
                                rinput.test(this.type) );
                    })
                    .map(function (i, elem) {
                            var val = jQuery(this).val();

                            return val == null ?
                                null :
                                jQuery.isArray(val) ?
                                    jQuery.map(val, function (val, i) {
                                            return {name: elem.name, value: val.replace(rCRLF, "\r\n")};
                                    }) :
                                {name: elem.name, value: val.replace(rCRLF, "\r\n")};
                    }).get();

                return $.param(arr);
        }
})(jQuery);

function ajax_form(formName, url) {
        $('form#' + formName).on('beforeSubmit', function (e) {
                var $form = $(this);
                var formData = new FormData($form[0]);
                formData.append('form_commit', true);
                $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                                if (data.status) {

                                        layer.msg(data.message, {
                                                time: 2000, icon: 6, end: function () {
                                                        page_load(url);
                                                }
                                        });


                                } else {
                                        layer.msg(data.message, {time: 2000, icon: 5});

                                }
                        }
                });


                // do whatever here, see the parameter \$form? is a jQuery Element to your form
        }).on('submit', function (e) {

                e.preventDefault();
        });
}


//建立一個可存取到該file的url
function getObjectURL(file) {
        var url = null;
        if (window.createObjectURL != undefined) { // basic
                url = window.createObjectURL(file);
        } else if (window.URL != undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file);
        } else if (window.webkitURL != undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file);
        }
        return url;
}

function sendFile(file, editor, welEditable) {
        var data = new FormData();
        data.append("file", file);
        $.ajax({
                data: data,
                dataType: "json",
                type: "POST",
                url: uploadUrl,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                        if (data.status == 1)
                                editor.insertImage(welEditable, data.url);
                        else
                                showMsg(data.msg, 'error');
                }
        });
}
$(document).ready(function () {


        $(document).on('click', 'a', function (event) {
                if ($(this).parents('ul').hasClass('treeview-menu')) {
                        var title = $(this).attr("title");
                        document.title = title;
                        $("ul .treeview-menu li").removeClass("active");
                        $(this).parent('li').addClass('active');
                }

                if ($(this).hasClass('noajax')) {
                        location.href = $(this).attr("href");
                        return false;
                }

                var title = $(this).attr("title");
                if (title == "删除" || $(this).hasClass('ajax-confirm')) {
                        return false;
                }
                $.pjax.click(event, pajax_container)
        });


        $(document).on("click", "a[title='删除'],.ajax-confirm", function (e) {

                var url = $(this).attr("href");
                var redirect = $(this).data("redirect");
                var message = $(this).data("message");
                var confirmButtonText = $(this).data("btext");
                message = message ? message : "是否要删除此项?";
                confirmButtonText = confirmButtonText ? confirmButtonText : '删除';

                layer.confirm(message, {
                        title: '操作提示',
                        btn: [confirmButtonText, '取消'] //按钮
                }, function () {
                        $.getJSON(url, function (d) {
                                if (d.status) {
                                        layer.msg(d.message, {time: 2000, icon: 6});
                                        page_load(redirect);
                                }
                        });

                });


                e.preventDefault();
                return false;

        });

        $(document).on("click", "form button[type='reset']", function (e) {
                var url = $(this).data('url')||$(this).parents("form").attr("action");
                page_load(url);
                e.preventDefault();
                return false;

        });

});


