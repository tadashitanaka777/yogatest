<!--
	var classNames = new Array('holiday','xday','birthday','otherday');
	
	/*Å@ãxã∆ì˙ÇÃê›íËÅ@*/
	var holiday = new Object();
	holiday["2012/1/2"] = 0;
	holiday["2012/1/3"] = 0;
	holiday["2012/1/9"] = 0;
	holiday["2012/2/11"] = 0;
	holiday["2012/2/15"] = 0; /*é–àıå§èC*/
	holiday["2012/3/20"] = 0;
	holiday["2012/4/29"] = 0;
	holiday["2012/4/30"] = 0;
	holiday["2012/5/3"] = 0;
	holiday["2012/5/4"] = 0;
	holiday["2012/5/5"] = 0;
	holiday["2012/7/16"] = 0;
	holiday["2012/8/13"] = 0;
	holiday["2012/8/14"] = 0;
	holiday["2012/8/15"] = 0;
	holiday["2012/9/17"] = 0;
	holiday["2012/9/22"] = 0;
	holiday["2012/10/8"] = 0;
	holiday["2012/11/3"] = 0;
	holiday["2012/11/23"] = 0;
	holiday["2012/12/24"] = 0;
	holiday["2012/12/29"] = 0;
	holiday["2012/12/30"] = 0;
	holiday["2012/12/31"] = 0;
	holiday["2013/1/1"] = 0;
	holiday["2013/1/2"] = 0;
	holiday["2013/1/3"] = 0;
	holiday["2013/1/14"] = 0;
	holiday["2013/2/11"] = 0;
	holiday["2013/3/20"] = 0;
	holiday["2013/4/29"] = 0;
	holiday["2013/5/3"] = 0;
	holiday["2013/5/3"] = 0;
	holiday["2013/5/6"] = 0;
	holiday["2013/7/15"] = 0;
	holiday["2013/8/13"] = 0;
	holiday["2013/8/14"] = 0;
	holiday["2013/8/15"] = 0;
	holiday["2013/9/16"] = 0;
	holiday["2013/9/23"] = 0;
	holiday["2013/10/14"] = 0;
	holiday["2013/11/4"] = 0;
	holiday["2013/12/23"] = 0;
	holiday["2013/12/28"] = 0;
	holiday["2013/12/29"] = 0;
	holiday["2013/12/31"] = 0;
	holiday["2014/1/1"] = 0;
	holiday["2014/1/2"] = 0;
	holiday["2014/1/3"] = 0;
	holiday["2014/1/13"] = 0;	
	holiday["2014/2/11"] = 0;
	holiday["2014/3/21"] = 0;
	holiday["2014/4/29"] = 0;
	holiday["2014/5/3"] = 0;
	holiday["2014/5/5"] = 0;
	holiday["2014/5/6"] = 0;
	holiday["2014/7/21"] = 0;
	holiday["2014/9/15"] = 0;
	holiday["2014/9/23"] = 0;
	holiday["2014/10/13"] = 0;
	holiday["2014/11/3"] = 0;
	holiday["2014/11/24"] = 0;
	holiday["2014/12/23"] = 0;



	/*Å@èkè¨âcã∆ì˙ÇÃê›íËÅ@*/
	var otherday = new Object();
	otherday["2011/12/28"] = 3;
	otherday["2012/1/4"] = 3;
	otherday["2012/5/1"] = 3;
	otherday["2012/5/2"] = 3;
	otherday["2013/12/30"] = 3;



	
	var today = new Date();
	var cal_year = today.getYear();
	var cal_month = today.getMonth() + 1;
	var cal_day = today.getDate();
	if (cal_year < 1900) cal_year += 1900;
	document.write("<div id='calendar'></div>");
	var cal = document.getElementById("calendar");
	var defaultBackgroundColors = new Object();
	var to_year = cal_year;
	var to_month = cal_month;
	var to_day = cal_day;
	
	//function tdOver(obj){
	//	defaultBackgroundColors[obj] = obj.style.backgroundColor;
	//	obj.style.backgroundColor = '#FFFFFF';
	//}
	
	function tdOut(obj){
		obj.style.backgroundColor = defaultBackgroundColors[obj];
	}
	function spanOver(obj){
		defaultBackgroundColors[obj] = obj.style.backgroundColor;
		obj.style.color = '#FF9900';
	}
	function spanOut(obj){
		obj.style.color = defaultBackgroundColors[obj];
	}
	
	function currentCal(){
		cal_year = to_year;
		cal_month = to_month;
		cal_day = to_day;
		writeCal(cal_year,cal_month,cal_day);
	}
	function prevCal(){
		cal_month -= 1;
		if(cal_month < 1){
			cal_month = 12;
			cal_year -= 1;
		}
		writeCal(cal_year,cal_month,0);
	}
	function nextCal(){
		cal_month += 1;
		if(cal_month > 12){
			cal_month = 1;
			cal_year += 1;
		}
		writeCal(cal_year,cal_month,0);
	}
	function getWeek(year,month,day){
		if (month == 1 || month == 2) {
			year--;
			month += 12;
		}
		var week = Math.floor(year + Math.floor(year/4) - Math.floor(year/100) + Math.floor(year/400) + Math.floor((13 * month + 8) / 5) + day) % 7;
		return week;
	}
	function writeCal(year,month,day){
		var calendars = new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
		var weeks = new Array("ì˙","åé","âŒ","êÖ","ñÿ","ã‡","ìy");
		var monthName = new Array('none','1åé','2åé','3åé','4åé','5åé','6åé','7åé','8åé','9åé','10åé','11åé','12åé');
		
		var cal_flag = 0;
		if(year % 100 == 0 || year % 4 != 0){
			if(year % 400 != 0){
				cal_flag = 0;
			}
			else{
				cal_flag = 1;
			}
		}
		else if(year % 4 == 0){
			cal_flag = 1;
		}
		else{
			cal_flag = 0;
		}
		calendars[2] += cal_flag;
		
		var cal_start_day = getWeek(year,month,1);
		var cal_tags = "<table border='0' cellspacing='0' cellpadding='0' class='calendar'>";
		cal_tags += "<tr><th colspan='7'>";
		cal_tags += year + " îN" +monthName[month] ;
		cal_tags += "<span onMouseOver='spanOver(this);' onMouseOut='spanOut(this);' onClick='nextCal();'>Å@nextÅÑ</span>";
		cal_tags += "<span onMouseOver='spanOver(this);' onMouseOut='spanOut(this);' onClick='currentCal();'>Å@today</span>";
		cal_tags += "<span onMouseOver='spanOver(this);' onMouseOut='spanOut(this);' onClick='prevCal();'>ÅÉback</span>" + "</th></tr>";
		cal_tags += "<tr class='headline'>";
		for(var i=0;i<weeks.length;i++){
			cal_tags += "<td>" + weeks[i] + "</td>";
		}
		cal_tags += "</tr><tr>";
		for(var i=0;i < cal_start_day;i++){
			cal_tags += "<td>&nbsp;</td>";
		}
		
		//main
		for(var cal_day_cnt = 1;cal_day_cnt <= calendars[month];cal_day_cnt++){
			var cal_day_match = year + "/" + month + "/" + cal_day_cnt;
			var dayClass = "";
			
			if(holiday[cal_day_match] != undefined){
				dayClass = ' class="'+classNames[holiday[cal_day_match]]+'"';
			}
			else if(cal_start_day == 0 && cal_day_cnt == day){
				dayClass = ' class="SunToday"';
			}
			else if(cal_start_day == 0){
				dayClass = ' class="Sun"';
			}
			else if(cal_start_day == 6 && cal_day_cnt == day){
				dayClass = ' class="SatToday"';
			}
			else if(cal_start_day == 6){
				dayClass = ' class="Sat"';
			}
			else if(cal_day_cnt == day){
				dayClass = ' class="Today"';
			}
			if(otherday[cal_day_match] != undefined){
				dayClass = ' class="'+classNames[otherday[cal_day_match]]+'"';
			}
			cal_tags += "<td onMouseOver='tdOver(this);' onMouseOut='tdOut(this);'"+dayClass+">" + cal_day_cnt + "</td>";
			if(cal_start_day == 6){
				cal_tags += "</tr>";
				if(cal_day_cnt < calendars[month]){
					cal_tags += "<tr>";
				}
				cal_start_day = 0;
			}
			else{
				cal_start_day++;
			}
		}
		while(cal_start_day <= 6 && cal_start_day != 0){
			cal_tags += "<td>&nbsp;</td>";
			if(cal_start_day == 6){
				cal_tags += "</tr>";
			}
			cal_start_day++;
		}
		cal_tags += "</table>";
		cal.innerHTML = cal_tags;
	}
	writeCal(cal_year,cal_month,cal_day);
//-->