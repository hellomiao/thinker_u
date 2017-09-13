/**
 * Created by heypigg on 2015/12/15.
 */
var page = {
    tabel:function(){
        var hashStr = location.hash.replace("#", "")
        if (hashStr) {
            var params = hashStr.substr(1).split("/");
            _controller=params[0];
            _action=params[1];
            params.shift();
            params.shift();
            var ajaxTableDom = $("#commontable-ajax tbody")[0];
            if (ajaxTableDom) {
                var ajaxTabelUrl = $("#commontable-ajax").attr("data-url");
                //console.log(params);
                AjaxPage.init(ajaxTableDom, ajaxTabelUrl, params);
                ajaxTable.init(ajaxTableDom);
                $("#ajaxForm button").click(function () {
                    AjaxPage.getData(_controller,_action);
                });
            }

        }
    },
    load: function () {
        var hashStr = location.hash.replace("#", "");
        if (hashStr) {
            var params = hashStr.substr(1).split("/");
            _module = params[0];
            _controller=params[1];
            _action=params[2];
            var route = '..' + hashStr;
            var ca = _module+'/'+_controller+'/'+_action;
            if($(".admin-content").data("__hashLoad")==ca){
                page.tabel();
            }else {
                $(".admin-content").load(route, function (html){
                    $(".admin-content").data("__hashLoad",ca);
                    //$(".admin-content").html(html);
                    $.pjax.reload({container:"#countries"});
                    page.tabel();
                });
            }
        }

    }
};
page.load();
window.onhashchange = function () {
    page.load();

};

