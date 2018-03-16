jQuery(function($) {
    //スクロールスピード
    var speed = 30;
    //マウスホイールで横移動
    $('.size-table tbody').mousewheel(function(event, mov) {
        //ie firefox
        $(this).scrollLeft( $(this).scrollLeft() - mov * speed );
        //webkit
        $('.size-table tbody').scrollLeft( $('.size-table tbody').scrollLeft() - mov * speed );
        return false;   //縦スクロール不可
    });
    
     $(".size-table tbody").kinetic({
        filterTarget: function(target, e){
            if (!/down|start/.test(e.type)){
                return !(/area|a|input/i.test(target.tagName));
            }
        }
    });
});