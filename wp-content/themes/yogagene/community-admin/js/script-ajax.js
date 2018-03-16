/**
 * Instructor => Studio申請
 * admin-ajax.php?action=example
 * exampleを飛び先に変更します。
 */

(function ($) {
    $("#modal-studio-list .pagination li a").click(function(){
        var page = $(this).attr('data-value');
        var post_type = 'studio';
        var pref = $('.bd-studio-modal-lg select[name="pref"]').val();
        var status = $('.bd-studio-modal-lg select[name="status"]').val();
        console.log( page + ',' + post_type + ',' + pref + ',' + status );
        $.ajax({
            type    : "GET",
            url     : "admin-ajax.php?action=example",
            data    : {
                'page': page,
                'post_type': post_type,
                'pref': pref,
                'status': status
            },
            dataType: "json",
            async   : true
        }).done(function(callback){
            console.log(callback);
            /*
            if ( callback != null && callback.status == 'OK' ) {
                resultMsg("処理は成功しました");
                //updateContent(callback.content[id]);
                updateContent(callback.content[0]);
            } else {
                resultMsg("処理は失敗しました");
            }
            */
        }).fail(function(XMLHttpRequest, textStatus, errorThrown){
            //resultMsg("処理は失敗しました2");
            // エラー時のデバッグ用
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        });
        return false;
    });
/*
    function resultMsg(msg) {
        var element = $("#linkgo_side_box_in span.info");
        element.empty();
        element.append(msg);
        element.addClass('success');
        element.css('display','block');
        return;
    }
    
    function updateContent(content){
        $('#wp-content-editor-container .wp-editor-area').val(content);
    }
*/
})(jQuery);


/**
 * Instructor => Event申請
 * admin-ajax.php?action=example
 * exampleを飛び先に変更します。
 */

(function ($) {
    $("#modal-event-list .pagination li a").click(function(){
        var page = $(this).attr('data-value');
        var post_type = 'event';
        var pref = $('.bd-event-modal-lg select[name="pref"]').val();
        var status = $('.bd-event-modal-lg select[name="status"]').val();
        console.log( page + ',' + post_type + ',' + pref + ',' + status );
        $.ajax({
            type    : "GET",
            url     : "admin-ajax.php?action=example",
            data    : {
                'page': page,
                'post_type': post_type,
                'pref': pref,
                'status': status
            },
            dataType: "json",
            async   : true
        }).done(function(callback){
            console.log(callback);
            /*
            if ( callback != null && callback.status == 'OK' ) {
                resultMsg("処理は成功しました");
                //updateContent(callback.content[id]);
                updateContent(callback.content[0]);
            } else {
                resultMsg("処理は失敗しました");
            }
            */
        }).fail(function(XMLHttpRequest, textStatus, errorThrown){
            //resultMsg("処理は失敗しました2");
            // エラー時のデバッグ用
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        });
        return false;
    });
/*
    function resultMsg(msg) {
        var element = $("#linkgo_side_box_in span.info");
        element.empty();
        element.append(msg);
        element.addClass('success');
        element.css('display','block');
        return;
    }
    
    function updateContent(content){
        $('#wp-content-editor-container .wp-editor-area').val(content);
    }
*/
})(jQuery);