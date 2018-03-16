/*
Gleenk - News Spot Slider v 2.1
http://www.gleenk.com
This opera is licensed under a Creative Commons Attribuzione
Non opere derivate 2.5 Italia License.
*/

(function($){  
 $.fn.newsSlider = function() {  
 
    return this.each(function() {  
 	
	var active = false;
	var numeroLiPoint = $(this).find(".news_slider li").size();
	var largLi = $(this).find(".news_slider li").width(); 
	var largLiTot = numeroLiPoint*largLi;
	var termina = largLiTot-largLi;
	
	
	//larghezza dinamica dell'ul
	var boxUl = $(this).find(".news_slider ul.slides");
	boxUl.css("width",largLiTot);
		
	//pallini inversa
	var boxLeft;
	var indexPal;
	
		var clicked = $(this).find('.news_slider-right').on('click', moveBox1);
		function moveBox1(e1) {
		e1.preventDefault();
		
			if (active) { return; }
			active = true;
			
			if(boxUl.css("left")!=-termina+"px"){
				boxUl.stop().animate({left:"-="+largLi+"px"}, {
				duration: 500,
				complete: function() {
					
					// gpx: chiamata alla funzione vd righe 75-90
					pallini( $(this) );
					
					 
				}
				
			  });
			}
			else {
				boxUl.stop().animate({left:"0px"}, {
				duration: 500,
				complete: function() {
					/*//muovi
					$(this).find('.news_slider-right').on('click', moveBox1);
					
					//pallini
					boxLeft = parseInt(boxUl.css("left"));
					indexPal = parseInt(-boxLeft/largLi);
					$(this).parents(".news_block").find(".news_slider-spots li").removeClass("active");
					$(this).parents(".news_block").find(".news_slider-spots li").eq(indexPal).addClass("active");
					
					//frecce
					if(boxUl.position().left== 0){$(this).parents(".news_block").find(".news_slider-left").hide();}
					else{$(this).parents(".news_block").find('.news_slider-left').show();}
					active = false; */
					
					// gpx: chiamata alla funzione vd righe 75-90
					pallini( $(this) );
					
				}
			  });
				$(this).find('.news_slider-right').on('click', moveBox1);
			}
		}
		
		function pallini( p )
		 {
		 	//muovi
							$( p ).find('.news_slider-right').on('click', moveBox1);
							
							//pallini
							boxLeft = parseInt(boxUl.css("left"));
							indexPal = parseInt(-boxLeft/largLi);
							$( p ).parents(".news_block").find(".news_slider-spots li").removeClass("active");
							$( p ).parents(".news_block").find(".news_slider-spots li").eq(indexPal).addClass("active");
							
							//frecce
							if(boxUl.position().left== 0){$( p ).parents(".news_block").find(".news_slider-left").hide();}
							else{$( p ).parents(".news_block").find('.news_slider-left').show();}
							active = false;
		 }  

		$(this).find('.news_slider-left').on('click', moveBox2);
		function moveBox2(e2) {
		e2.preventDefault();
		
			if (active) { return; }
			active = true;
			
			if(boxUl.css("left")!="0px"){
				boxUl.stop().animate({left:"+="+largLi+"px"}, {
				duration: 500,
				complete: function() {
					//muovi
					$(this).find('.news_slider-left').on('click', moveBox2);
					
					//pallini
					boxLeft = parseInt(boxUl.css("left"));
					indexPal = parseInt(-boxLeft/largLi);
					$(this).parents(".news_block").find(".news_slider-spots li").removeClass("active");
					$(this).parents(".news_block").find(".news_slider-spots li").eq(indexPal).addClass("active");
					
					//frecce
					if(boxUl.position().left== 0){$(this).parents(".news_block").find(".news_slider-left").hide();}
					else{$(this).parents(".news_block").find('.news_slider-left').show();}
					active = false; 
				}
			  });
			}
			else {
				$(this).find('.news_slider-left').on('click', moveBox2);
				
				//frecce
				if(boxUl.position().left== 0){$(this).parents(".news_block").find(".news_slider-left").hide();}
				else{$(this).parents(".news_block").find('.news_slider-left').show();}
				active = false; 
					
				active = false; 
				}
		}
	
	
	//creazione pallini
	for(i=0; i<numeroLiPoint; i++){
		$(this).find(".news_slider-spots").append("<li></li>");
	}
	//calcolo dinamico larghezza contenitore pallini
	var largPallini = $(this).find(".news_slider-spots li").width();
	$(this).find(".news_slider-spots").width(largPallini*numeroLiPoint);
	
	$(this).find(".news_slider-spots li:eq(0)").addClass("active");
	
	//spostamento dello slider al click sul pallino
	$(this).find(".news_slider-spots li").click(function(){
		$(this).parents("ul").find("li").removeClass("active");
		$(this).addClass("active");
		var indicePallini = $(this).parents("ul").find("li").index(this);
		boxUl.stop().animate({left:0-(indicePallini*largLi)}, {
			duration: 500,
			complete: function() {
					//frecce
					if(boxUl.position().left== 0){$(this).parents(".news_block").find(".news_slider-left").hide();}
					else{$(this).parents(".news_block").find('.news_slider-left').show();}
				}
		 });
		
		//sicurezza
		$(this).find('.news_slider-left').on('click', moveBox2);
		$(this).find('.news_slider-right').on('click', moveBox1);
		
		return false;
	});
	 
    });  
 };

 
})(jQuery);