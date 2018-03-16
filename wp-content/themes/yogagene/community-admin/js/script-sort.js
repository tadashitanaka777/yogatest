jQuery(function($){

    var width = $(window).width();
    $('button.sort').click(function(){
        return false;
    });
    if(width > 640) { sorTable(); }

    function sorTable(){
        $('.news-add .table').sortable({
            containerSelector: 'table',
            itemPath: '> tbody',
            itemSelector: 'tr',
            placeholder: '<tr>'
        });
    }
});

jQuery(window).load(function(){
    $('.list-js').each(function(){
        if($(this).has('ul.pagination').length){
            var lh = $(this).children('ul.list').height();
            $(this).children('ul.list').css('height',lh+'px');
        }
    });
});

jQuery(function($){
    clickEvent();
    disableEvent();
    function clickEvent(){
        $('#modal-studio-list button.add').on('click',function(){
            var id = $(this).attr('data-id');
            var element = $(this).closest('.table-li');
            $('#studio-list ul.list').append(
                '<li>'
                +'<span class="shop-name">' + element.find('.table-title').attr('data-name')
                +' ' + element.find('.table-description .shop-name').attr('data-shop-name')
                +'</span><span class="pref-name">'
                + element.find('.table-pref').attr('data-pref-name')
                +'</span>'
                +'<select class="form-control case">'
                +'<option value="set">追加準備</option>'
                +'<option value="delete">解除</option>'
                +'</select>'
                +'<input type="hidden" value="' + id + '">'
                +'</li>'
            );
            //studiolist.add({ 'shop-name': element.find('.table-title').attr('data-name'), 'pref-name': element.find('.table-pref').attr('data-pref-name') });
            $('#modal-studio-list .data-id-' + id).prop('disabled',true);
            $('#modal-studio-list .data-id-' + id).text('追加済');
            return false;
        });
    };
    function disableEvent(){
        $('#studio-list .list .data-id').each(function(){
            var id = $(this).val();
            //console.log(id);
            $('#modal-studio-list .data-id-' + id).prop('disabled',true);
            $('#modal-studio-list .data-id-' + id).text('追加済');
        });
    };
});

jQuery(function($){
    clickEvent();
    disableEvent();
    function clickEvent(){
        $('#modal-license-list button.add').on('click',function(){
            var id = $(this).attr('data-id');
            var data = $(this).closest('.table-li');
            var element = $('#license-list');
            var tr = element.find('.tr-add-row').clone(true);
            element.find('tbody .tr-add-row').before(tr);
            tr.fadeIn(500).removeClass('tr-add-row');
            _texrareaAutoHeight();
            _checkRowNumber(element,5);
            var checkbox = tr.find('.md-checkbox');
            checkbox.children('input').attr('id','license-' + id);
            checkbox.children('input').val('license-' + id);
            checkbox.children('label').attr('for','license-' + id);
            tr.find('.license-name').text(data.find('.table-title').attr('data-name'));
            tr.find('.license-parent-name').text(data.find('.parent-name').attr('data-parent-name'));
            tr.find('.license-child-name').text(data.find('.child-name').attr('data-child-name'));
            tr.find('.license-teacher-name').text(data.find('.teacher-name').attr('data-teacher-name'));
            tr.find('.data-id').val(id);
            tr.find('.btn-remove-row').attr('data-id',id);
            $('#modal-license-list .data-id-' + id).prop('disabled',true);
            $('#modal-license-list .data-id-' + id).text('追加済');
            return false;
        });
    };
    function disableEvent(){
        $('#license-list .list .data-id').each(function(){
            var id = $(this).val();
            $('#modal-license-list .data-id-' + id).prop('disabled',true);
            $('#modal-license-list .data-id-' + id).text('追加済');
        });
    };
});

jQuery(function($){
    clickEvent();
    disableEvent();
    function clickEvent(){
        $('#modal-event-list button.add').on('click',function(){
            var id = $(this).attr('data-id');
            var element = $(this).closest('.table-li');
            $('#event-list ul.list').append(
                '<li>'
                +'<time class="event-date">'+element.find('.event-start-date').attr('data-start-date')+'</time>'
                +'<span class="event-name">' + element.find('.table-title').attr('data-value')
                +' ' + element.find('.event-organizer').attr('data-value')
                +'</span><span class="event-pref-name">'
                + element.find('.event-area').attr('data-area')
                +'</span>'
                +'<select class="form-control case">'
                +'<option value="set">追加準備</option>'
                +'<option value="delete">解除</option>'
                +'</select>'
                +'<input type="hidden" value="' + id + '">'
                +'</li>'
            );
            //studiolist.add({ 'shop-name': element.find('.table-title').attr('data-name'), 'pref-name': element.find('.table-pref').attr('data-pref-name') });
            $('#modal-event-list .data-id-' + id).prop('disabled',true);
            $('#modal-event-list .data-id-' + id).text('追加済');
            return false;
        });
    };
    function disableEvent(){
        $('#event-list .list .data-id').each(function(){
            var id = $(this).val();
            //console.log(id);
            $('#modal-event-list .data-id-' + id).prop('disabled',true);
            $('#modal-event-list .data-id-' + id).text('追加済');
        });
    };
});

jQuery(function($){
    clickEvent();
    disableEvent();
    function clickEvent(){
        $('#modal-instructor-list button.add').on('click',function(){
            var id = $(this).attr('data-value');
            var element = $(this).closest('.table-li');
            $('#instructor-list > .row').append(
                '<div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">'
                +'<div class="area">'
                +'<div class="area-thumbnail">'
                +'<img src="/images/instructor/inst-thumb-' + id + '.jpg" class="suck">'
                +'</div>'
                +'<div class="area-content">'
                +'<h3 class="area-title">' + element.find('.table-title').attr('data-value')+'</h3>'
                +'<p class="area-description"><span>活動エリア：</span>' + element.find('.instructor-area').attr('data-value') + '</p>'
                +'</div>'
                +'<div class="area-footer">'
                +'<select class="form-control case">'
                +'<option value="set">追加準備</option>'
                +'<option value="delete">解除</option>'
                +'</select>'
                +'<input type="hidden" value="' + id + '">'
                +'</div>'
                +'</div>'
                +'</div>'
            );
            //studiolist.add({ 'shop-name': element.find('.table-title').attr('data-name'), 'pref-name': element.find('.table-pref').attr('data-pref-name') });
            $('#modal-instructor-list .data-id-' + id).prop('disabled',true);
            $('#modal-instructor-list .data-id-' + id).text('追加済');
            return false;
        });
    };
    function disableEvent(){
        $('#instructor-list .area .data-id').each(function(){
            var id = $(this).val();
            //console.log(id);
            $('#modal-instructor-list .data-id-' + id).prop('disabled',true);
            $('#modal-instructor-list .data-id-' + id).text('追加済');
        });
    };
});

jQuery(function($){
    clickEvent();
    $('#class-instructor-list .list .data-id').each(function(){
        disableEvent($(this).val());
    });
    var modal_instructorlist = new List('modal-calendar-instructor-list', {
        page: 4,
        pagination: true
    });
    function clickEvent(){
        $('#modal-calendar-instructor-list button.add').on('click',function(){
            var id = $(this).attr('data-value');
            var element = $(this).closest('.table-li');
            //$('#class-instructor-list > .list').append('<li class="calendar-instructor-li">'+'<img src="/images/instructor/inst-thumb-' + id + '.jpg" class="calendar-instructor-thumb"></li>');
            $('#class-instructor-list > .list').append(
                '<li class="calendar-instructor-li">'
                +'<img src="/images/instructor/inst-thumb-' + id + '.jpg" class="calendar-instructor-thumb">'
                +'<span>' + element.find('.table-title').attr('data-value') +'</span>'
                +'<input type="hidden" class="data-id" value="' + id + '">'
                +'<button type="button" class="close"><span aria-hidden="true">×</span></button>'
                +'</li>'
            );
            disableEvent(id);
            closeEvent();
            return false;
        });
    }
    function disableEvent(id){
        $('#modal-calendar-instructor-list .data-id-' + id).prop('disabled',true);
        $('#modal-calendar-instructor-list .data-id-' + id).text('追加済');
    }
    function closeEvent(){
        $('#class-instructor-list .calendar-instructor-li .close').on('click',function(){
            var element = $(this).closest('.calendar-instructor-li');
            var id = element.children('.data-id').val();
            $('#modal-calendar-instructor-list .data-id-' + id).prop('disabled',false);
            $('#modal-calendar-instructor-list .data-id-' + id).text('追加');
            element.remove();
        });
    }
});

jQuery(function($){
    clickEvent();
    disableEvent();
    function clickEvent(){
        $('#modal-license-studio-list button.add').on('click',function(){
            var id = $(this).attr('data-value');
            //console.log(id);
            var data = $(this).closest('.table-li');
            var element = $('#license-studio-list');
            var tr = element.find('.tr-add-row').clone(true);
            element.find('tbody .tr-add-row').before(tr);
            tr.fadeIn(500).removeClass('tr-add-row');
            _texrareaAutoHeight();
            _checkRowNumber(element,5);

            tr.find('.shop-name').text(data.find('.table-title').attr('data-value'));
            tr.find('.child-name').text(data.find('.table-description .shop-name').attr('data-value'));
            tr.find('.pref-name').text(data.find('.table-pref').attr('data-value'));
            tr.find('.data-id').val(id);
            tr.find('.btn-remove-row').attr('data-id',id);
            
            //studiolist.add({ 'shop-name': element.find('.table-title').attr('data-name'), 'pref-name': element.find('.table-pref').attr('data-pref-name') });
            $('#modal-license-studio-list .data-id-' + id).prop('disabled',true);
            $('#modal-license-studio-list .data-id-' + id).text('追加済');
            addSelect();
            return false;
        });
    };
    function disableEvent(){
        $('#license-studio-list .list .data-id').each(function(){
            var id = $(this).val();
            $('#modal-license-studio-list .data-id-' + id).prop('disabled',true);
            $('#modal-license-studio-list .data-id-' + id).text('追加済');
        });
    };
    function addSelect(){
        console.log('add');
        $('.select-studio').empty();
        $('.select-studio').append($('<option>', { value: 'all', text: 'すべて' }));
        $('.select-studio').append($('<option>', { value: 'not', text: '未選択' }));
        $('#license-studio-list .list .data-id').each(function(){
            if($(this).val() != '') {
                var value = $(this).val();
                var element = $(this).closest('.td-question');
                var name = element.find('.shop-name').text() + ' ' + element.find('.child-name').text();;
                var option = $('<option>', { value: value, text: name });
                $('.select-studio').append(option);
            }
        });
    }
});

jQuery(function($){
    defaultEvent();
    clickEvent();
    disableEvent();
    function clickEvent(){
        $('#modal-event-studio-list button.add').on('click',function(){
            var id = $(this).attr('data-value');
            //console.log(id);
            var data = $(this).closest('.table-li');
            var element = $('#event-studio-list');
            var tr = element.find('.tr-add-row').clone(true);
            element.find('tbody .tr-add-row').before(tr);
            tr.fadeIn(500).removeClass('tr-add-row');
            _texrareaAutoHeight();
            _checkRowNumber(element,1);

            tr.find('.shop-name').text(data.find('.table-title').attr('data-value'));
            tr.find('.child-name').text(data.find('.table-description .shop-name').attr('data-value'));
            tr.find('.pref-name').text(data.find('.table-pref').attr('data-value'));
            tr.find('.data-id').val(id);
            tr.find('.btn-remove-row').attr('data-id',id);
            
            //studiolist.add({ 'shop-name': element.find('.table-title').attr('data-name'), 'pref-name': element.find('.table-pref').attr('data-pref-name') });
            $('#modal-event-studio-list .data-id-' + id).prop('disabled',true);
            $('#modal-event-studio-list .data-id-' + id).text('追加済');
            addSelect();
            return false;
        });
    };
    function disableEvent(){
        $('#event-studio-list .list .data-id').each(function(){
            var id = $(this).val();
            $('#modal-event-studio-list .data-id-' + id).prop('disabled',true);
            $('#modal-event-studio-list .data-id-' + id).text('追加済');
        });
    };
    function addSelect(){
        $('.select-studio').empty();
        $('.select-studio').append($('<option>', { value: 'all', text: 'すべて' }));
        $('.select-studio').append($('<option>', { value: 'not', text: '未選択' }));
        $('#event-studio-list .list .data-id').each(function(){
            if($(this).val() != '') {
                var value = $(this).val();
                var element = $(this).closest('.td-question');
                var name = element.find('.shop-name').text() + ' ' + element.find('.child-name').text();;
                var option = $('<option>', { value: value, text: name });
                $('.select-studio').append(option);
            }
        });
    }
    function defaultEvent(){
        var parent = $('#event-studio-list');
        var element = $('#event-studio-list .list tr');
        if(element.length > 1) {
            parent.find('.btn-add-row').hide();
        }
    }
});

jQuery(function($){
    defaultEvent();
    clickEvent();
    disableEvent();
    function clickEvent(){
        $('#modal-job-event-list button.add').on('click',function(){
            var id = $(this).attr('data-value');
            //console.log(id);
            var data = $(this).closest('.table-li');
            var element = $('#job-event-list');
            var tr = element.find('.tr-add-row').clone(true);
            element.find('tbody .tr-add-row').before(tr);
            tr.fadeIn(500).removeClass('tr-add-row');
            _texrareaAutoHeight();
            _checkRowNumber(element,1);

            tr.find('.shop-name').text(data.find('.table-title').attr('data-value'));
            tr.find('.child-name').text(data.find('.table-description .shop-name').attr('data-value'));
            tr.find('.pref-name').text(data.find('.table-pref').attr('data-value'));
            tr.find('.data-id').val(id);
            tr.find('.btn-remove-row').attr('data-id',id);
            
            //studiolist.add({ 'shop-name': element.find('.table-title').attr('data-name'), 'pref-name': element.find('.table-pref').attr('data-pref-name') });
            $('#modal-job-event-list .data-id-' + id).prop('disabled',true);
            $('#modal-job-event-list .data-id-' + id).text('追加済');
            return false;
        });
    };
    function disableEvent(){
        $('#job-event-list .list .data-id').each(function(){
            var id = $(this).val();
            $('#modal-job-event-list .data-id-' + id).prop('disabled',true);
            $('#modal-job-event-list .data-id-' + id).text('追加済');
        });
    };
    function defaultEvent(){
        var parent = $('#job-event-list');
        var element = $('#job-event-list .list tr');
        if(element.length > 1) {
            console.log('OK');
            parent.find('.btn-add-row').hide();
        }
    }
});

jQuery(function($){
    defaultEvent();
    clickEvent();
    disableEvent();
    function clickEvent(){
        $('#modal-job-address-list button.add').on('click',function(){
            var id = $(this).attr('data-value');
            //console.log(id);
            var data = $(this).closest('.table-li');
            var element = $('#job-address-list');
            var tr = element.find('.tr-add-row').clone(true);
            element.find('tbody .tr-add-row').before(tr);
            tr.fadeIn(500).removeClass('tr-add-row');
            _texrareaAutoHeight();
            _checkRowNumber(element,1);

            tr.find('.shop-name').text(data.find('.table-title').attr('data-value'));
            tr.find('.child-name').text(data.find('.table-description .shop-name').attr('data-value'));
            tr.find('.pref-name').text(data.find('.table-pref').attr('data-value'));
            tr.find('.data-id').val(id);
            tr.find('.btn-remove-row').attr('data-id',id);
            
            //studiolist.add({ 'shop-name': element.find('.table-title').attr('data-name'), 'pref-name': element.find('.table-pref').attr('data-pref-name') });
            $('#modal-job-address-list .data-id-' + id).prop('disabled',true);
            $('#modal-job-address-list .data-id-' + id).text('追加済');
            addSelect();
            return false;
        });
    };
    function disableEvent(){
        $('#job-address-list .list .data-id').each(function(){
            var id = $(this).val();
            $('#modal-job-address-list .data-id-' + id).prop('disabled',true);
            $('#modal-job-address-list .data-id-' + id).text('追加済');
        });
    };
    function addSelect(){
        $('.select-studio').empty();
        $('.select-studio').append($('<option>', { value: 'all', text: 'すべて' }));
        $('.select-studio').append($('<option>', { value: 'not', text: '未選択' }));
        $('#job-address-list .list .data-id').each(function(){
            if($(this).val() != '') {
                var value = $(this).val();
                var element = $(this).closest('.td-question');
                var name = element.find('.shop-name').text() + ' ' + element.find('.child-name').text();;
                var option = $('<option>', { value: value, text: name });
                $('.select-studio').append(option);
            }
        });
    }
    function defaultEvent(){
        var parent = $('#job-address-list');
        var element = $('#job-address-list .list tr');
        if(element.length > 1) {
            parent.find('.btn-add-row').hide();
        }
    }
});

$(function(){
var option = ['list-title','list-subtitle','pref-name','studio-hidden','case-hidden','id-hidden'];
var page = 10;
var certifiedlist = new List('certified-list', { valueNames: option,page: page,pagination: true });

$('#certified-list select.select-pref').on('change',function(){
    var val = $(this).val();
    var cas = $('#certified-list select.select-case').val();
    var stu = $('#certified-list select.select-studio').val();
    _certifiedlist(val,cas,stu);
});

$('#certified-list select.select-case').on('change',function(){
    var cas = $(this).val();
    var val = $('#certified-list select.select-pref').val();
    var stu = $('#certified-list select.select-studio').val();
    _certifiedlist(val,cas,stu);
});

$('#certified-list select.select-studio').on('change',function(){
    var stu = $(this).val();
    var val = $('#certified-list select.select-pref').val();
    var cas = $('#certified-list select.select-case').val();
    _certifiedlist(val,cas,stu);
});

$('#certified-list').on('change','li select.case',function(){
    var id = $(this).closest('li').find('.id-hidden').text();
    var item = certifiedlist.get('id-hidden',id)[0];
    console.log(item);
    item.values({
        'case-hidden': $(this).val()
    });
    $(this).closest('li').find('.case-hidden').text($(this).val());
});

function _certifiedlist(val,cas,stu){
    if(val != 'all' && cas != 'all' && stu != 'all'){
        certifiedlist.filter(function(item){
            if(item._values['pref-name'] == val && item._values['case-hidden'] == cas && item._values['studio-hidden'] == stu){
                return true;
            }else{
                return false;
            }
        });
    } else if(val != 'all' && cas != 'all'){
        certifiedlist.filter(function(item){
            if(item._values['pref-name'] == val && item._values['case-hidden'] == cas){
                return true;
            }else{
                return false;
            }
        });
    } else if(val == 'all' && cas != 'all'){
        certifiedlist.filter(function(item){
            if(item._values['case-hidden'] == cas){
                return true;
            }else{
                return false;
            }
        });
    } else if(val != 'all' && cas == 'all') {
        certifiedlist.filter(function(item){
            if(item._values['pref-name'] == val){
                return true;
            }else{
                return false;
            }
        });
    } else {
        certifiedlist.filter();
    }
}

});

var stylelist = new List('style-list', {
    valueNames: [
        'style-name',
    ],
    page: 10,
    pagination: true
});

var studiolist = new List('studio-list', {});

var eventlist = new List('event-list', {});
/*
var licenselist = new List('license-list', {});
*/