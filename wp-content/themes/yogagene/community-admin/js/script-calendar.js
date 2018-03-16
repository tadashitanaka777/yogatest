$(function(){
  
  //if(!$('main.studio-edit').length) return;
  
  $('.calendar-nav button').on('click',function(){
    return false;
  });
  
  var color = "#FFB128";
  var url = "#";
  
  monthlyRefresh();

  $('#child').on('hidden.bs.modal', function () {
    monthlyDefault();
    $('body').addClass('modal-open');
  });
  $('#grandson').on('hidden.bs.modal', function () {
    $('body').addClass('modal-open');
  });
  $('.datepicker').datetimepicker({
	  format: 'YYYY-MM-DD'
	});
  
  $('#child').on('show.bs.modal', function (event) {
    for(var key in eventjson.monthly){
      if(eventjson.monthly[key].id == $(event.relatedTarget).data('eventid')) {
        $('.class-id').val(eventjson.monthly[key].id);
        $('.class-name').val(escapeHtml(eventjson.monthly[key].name));
        $('.class-startdate').val(escapeHtml(eventjson.monthly[key].startdate));
        $('.class-enddate').val(escapeHtml(eventjson.monthly[key].enddate));
        $('.class-starttime').val(escapeHtml(eventjson.monthly[key].starttime));
        $('.class-endtime').val(escapeHtml(eventjson.monthly[key].endtime));
        $('.class-content').val(escapeHtml(eventjson.monthly[key].content));
        for(var i in eventjson.monthly[key].teacher){
          console.log(eventjson.monthly[key].teacher[i]);
          for(var n in instructorjson){
            if(instructorjson[n].id == eventjson.monthly[key].teacher[i]){
              $('.calendar-instructor-ul').append(
                '<li class="calendar-instructor-li">'
                +'<img src="/images/instructor/inst-thumb-' + instructorjson[n].id + '.jpg" class="calendar-instructor-thumb">'
                +'<span>' + instructorjson[n].name + '</span>'
                +'<input type="hidden" class="data-id" value="' + instructorjson[n].id + '">'
                +'<button type="button" class="close"><span aria-hidden="true">×</span></button>'
                +'</li>'
              );
              $('#modal-calendar-instructor-list .data-id-' + instructorjson[n].id).prop('disabled',true);
              $('#modal-calendar-instructor-list .data-id-' + instructorjson[n].id).text('追加済');
            }
          }
        }
        $('.class-note').val(escapeHtml(eventjson.monthly[key].note));
      }
    }
    closeEvent()
	});
	
	$('.class-save').on('click',function(){
    var array = new Array();
    if(monthlyValidate()){
      //new
      if($('.class-id').val() === 'new'){
        var uid = getUniqueId();
        var obj = new Object();
        obj.teacher = new Array();
        obj.id = uid; obj.name = escapeHtml($('.class-name').val()); obj.startdate = escapeHtml($('.class-startdate').val());
        obj.enddate = escapeHtml($('.class-enddate').val()); obj.starttime = escapeHtml($('.class-starttime').val());
        obj.endtime = escapeHtml($('.class-endtime').val()); obj.content = escapeHtml($('.class-content').val());
        obj.note = escapeHtml($('.class-note').val()); obj.color = color; obj.url = url;
        var n = 0;
        $('#class-instructor-list .data-id').each(function(){
          obj.teacher[n] = $(this).val();
          n++;
        });
        eventjson.monthly.push(obj);
        //console.log(eventjson.monthly);
      }else{
        for(var key in eventjson.monthly){
          //update
          if(eventjson.monthly[key].id == $('.class-id').val()) {
            eventjson.monthly[key].name = escapeHtml($('.class-name').val());
            eventjson.monthly[key].startdate = escapeHtml($('.class-startdate').val());
            eventjson.monthly[key].enddate = escapeHtml($('.class-enddate').val());
            eventjson.monthly[key].starttime = escapeHtml($('.class-starttime').val());
            eventjson.monthly[key].endtime = escapeHtml($('.class-endtime').val());
            eventjson.monthly[key].content = escapeHtml($('.class-content').val());
            eventjson.monthly[key].note = escapeHtml($('.class-note').val());
            var n = 0;
            $('#class-instructor-list .data-id').each(function(){
              eventjson.monthly[key].teacher[n] = $(this).val();
              n++;
            });
          }
        }
      }
      monthlyRefresh();
      alert('ajax');
      $('#child').modal('hide');
    }
    closeEvent()
  });

  $('.class-remove').on('click',function(){
    var array = new Array();
    for(var key in eventjson.monthly){
      if(eventjson.monthly[key].id != $('.class-id').val()) {
        array.push(eventjson.monthly[key]);
      }
    }
    eventjson.monthly = [];
    eventjson.monthly = array;
    monthlyRefresh();
    alert('ajax');
    $('#child').modal('hide');
  });

  $('.calendar-create').on('click',function(){
    $('.class-id').val('new');
  	$('#child').modal('show');
  });

  function monthlyRefresh(){
    if(!$('#mycalendar').length) return;
    $('#mycalendar').empty();
    $('#mycalendar').monthly({
      mode: 'event',
      dataType: 'json',
      events: eventjson
    });
    monthlyClick();
    $('#modal-calendar-instructor-list button.add').prop('disabled',false);
    $('#modal-calendar-instructor-list button.add').text('追加');
    var sep = '-';
    var newDate = new Date();
    var now = newDate.getFullYear() + sep + (newDate.getMonth() + 1) + sep + 1;
    var next = newDate.getFullYear() + sep + (newDate.getMonth() + 2) + sep + 1;
    if($('.monthly-day-event').attr('data-date') == now ) {
        $('.monthly-prev').hide();
    }
    $('.monthly-next').on('click',function(){
      if($('.monthly-day-event').attr('data-date') == now ) {
        $('.monthly-next').hide();
        $('.monthly-prev').show();
        //$('monthly-reset').remove();
      }
    });
    $('.monthly-prev').on('click',function(){
      if($('.monthly-day-event').attr('data-date') == next ) {
        $('.monthly-next').show();
        $('.monthly-prev').hide();
      }
    });
	}
	function monthlyClick(){
  	$('.monthly-day-event').on('click',function(event){
  	  if(!$(this).find('.monthly-event-indicator').length){
  	    $('.class-startdate').val($(this).data('date'));
  	    $('.class-id').val('new');
  	    $('#child').modal('show');
  	  }
  	});
	}
	function monthlyDefault(){
	  $('.class-id').val(null);
    $('.class-name').val(null);
    $('.class-startdate').val(null);
    $('.class-enddate').val(null);
    $('.class-starttime').val(null);
    $('.class-endtime').val(null);
    $('.class-content').val(null);
    $('.class-note').val(null);
    $('#class-instructor-list .calendar-instructor-ul').empty();
	}
	function monthlyValidate(){
	  var flag = true;
	  if($('.class-id').val() == null){
	    alert('エラーが発生しました');
	    flag = false;
	  }
    if($('.class-name').val() == ''){
      alert('タイトルを入力してください');
      flag = false;
    }
    if($('.class-startdate').val() == null || $('.class-startdate').val() == ''){
      alert('開始日は必須です');
      flag = false;
    }else if(!checkDate($('.class-startdate').val())){
      alert('開始日の入力が間違っています');
      $('.class-startdate').val(null);
      flag = false;
    }
    //console.log($('.class-enddate').val());
    if($('.class-enddate').val() != ''){
      if(!checkDate($('.class-enddate').val())){
        alert('終了日の入力が間違っています');
        $('.class-enddate').val(null);
        flag = false;
      }else if(diffDate($('.class-startdate').val(),$('.class-enddate').val())){
        alert('開催日より過去の日付になっています');
        $('.class-enddate').val(null);
        flag = false;
      }
    }
    return flag;
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
	function diffDate(date_1,date_2){
	  var d1 = date_1.split('-');
	  var d2 = date_2.split('-');
	  var dt1 = new Date(d1[0],d1[1],d1[2]);
	  var dt2 = new Date(d2[0],d2[1],d2[2]);
	  if (dt1.getTime() <= dt2.getTime()){
	    return false;
	  }
	  return true;
	}
	function checkDate(date){
	  var dates = date.split('-');
	  var dt = new Date(dates[0],dates[1]-1,dates[2]);
    return(dt.getFullYear()==dates[0] && dt.getMonth()==dates[1]-1 && dt.getDate()==dates[2]);
	}
	function getUniqueId(){
    var strong = 1000;
    return new Date().getTime().toString(16)  + Math.floor(strong*Math.random()).toString(16)
  }
  function escapeHtml(string) {
    if(typeof string !== 'string') {
      return string;
    }
    return string.replace(/[&'`"<>]/g, function(match) {
      return {
        '&': '&amp;',
        "'": '&#x27;',
        '`': '&#x60;',
        '"': '&quot;',
        '<': '&lt;',
        '>': '&gt;',
      }[match]
    });
  }
});