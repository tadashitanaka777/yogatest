$(function(){
    $('.zip').keyup(function(e){
        var empty;
        AjaxZip3.zip2addr(this,'','pref','dummy-city','address');
        if (AjaxZip3.nzip.length < 7) return;
        this.timer = setTimeout(
            function validate(){
                var element = $('select[name="pref"]');
                var code = element.val();
                cityChange(element,code);
                lineChange(element, code);
            },500
        );
    });
    $('.btn-route').on('click',function(){
        routeSearch($(this));
        return false;
    });
});

function latlonSearch(addr){
    $(function(){
        if(addr.value == ""){
            addr.value = ""
        }
        var address = $('.city-select').val() + addr.value;
        if(typeof timer !== undefined){
            clearTimeout(this.timer);
        }
        var pram = "address="+address+"&sensor=false";
        var url = "//maps.google.com/maps/api/geocode/json?"+pram;
        this.timer = setTimeout(
            function validate(){
                $.ajax({
                    type: 'GET',
                    url: url,
                    cache: false,
                    datatype: 'jsonp',
                    success: function(json){
                        //console.log(json);
                        var obj = json.results[0].geometry.location;
                        $('#gpsearch-lat-input').val(obj.lat);
                        $('#gpsearch-lon-input').val(obj.lng);
                        gpSearch_display(obj.lat,obj.lng);
                    }
                });

            },500
        );
        
    });
}

function routeSearch(element){
    $(function(){
        if(typeof timer !== undefined){
            clearTimeout(this.timer);
        }
        
        var parent = element.closest('.row');
        var line = parent.find('.line-select option:selected').text();
        var station = parent.find('.station-select option:selected').text();
        var addr = line + ' ' + station + '駅';
        
        console.log(addr);
        
        geocoder = new google.maps.Geocoder();
        
        geocoder.geocode( {'address': addr}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var obj = results[0].geometry.location;
				//console.log();
				//geocode_index = 0;
				//showResult(0);
				element.find('.station-lat').val(obj.lat);
                element.find('.station-lon').val(obj.lng);
				getRoute(obj);
				
			} else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
				alert(addr);
				// document.getElementById("place").value = "";
			} else {
				alert("Status: " + status);
			}
		});

        /*
        var pram = "address=" + addr + "&sensor=false";
        var url = "//maps.google.com/maps/api/geocode/json?" + pram;
        this.timer = setTimeout(
            function validate(){
                $.ajax({
                    type: 'GET',
                    url: url,
                    cache: false,
                    datatype: 'jsonp',
                    success: function(json){
                        //console.log(json);
                        var obj = json.results[0].geometry.location;
                        element.find('.station-lat').val(obj.lat);
                        element.find('.station-lon').val(obj.lng);
                        //gpSearch_display(obj.lat,obj.lng);
                        console.log(obj);
                        getRoute(obj);
                    }
                });
            },500
        );
        */
    });
}

function cityChange(element, pref = 13) {
    var parent = element.closest('.row');
    c_select = parent.find('.city-select');
    c_select.empty();
    for(c in _city){
        if(_city[c][2] == pref) {
            c_select.append(
                $("<option />")
                    .val(_city[c][3])
                    .text(_city[c][1])
            );
        }
    }
    var city = $('input[name="dummy-city"]').val();
    c_select.children('option').each(function(){
		if( $(this).text() == city ) {
		    $(this).prop('selected',true);
		}else{
		    $(this).prop('selected',false);
		}
	});
}

function lineChange(element, pref = 13){
    var parent = element.closest('.row');
    s_select = parent.find('.station-select');
    l_select = parent.find('.line-select');
    s_select.empty();
    l_select.empty();
    var i = 1;
    var line;
    for(p in _pref){
        if(_pref[p][0] == pref) {
            for(l in _line){
                if(_line[l][0] == _pref[p][1]){
                    if(i == 1) line = _line[l][0];
                    l_select.append(
                        $("<option />")
                            .val(_line[l][0])
                            .text(_line[l][1])
                    );
                    i++;
                }
            }
        }
    }
    stationChange(element,pref,line);
}

function stationChange(element,pref,line){
    var parent = element.closest('.row');
    s_select = parent.find('.station-select');
    s_select.empty();
    for(s in _station){
        if(_station[s][0] == line && _station[s][4] == pref){
            s_select.append(
                $("<option />")
                    .val(_station[s][1])
                    .text(_station[s][2])
            );
        }
    }
}