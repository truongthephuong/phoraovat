$(document).ready(function() {	
	var viewportW = $(window).width();	
	$(window).resize(function(){
		layout();
	}).resize();
	$('.u-tab li').click(function(event) {
		event.preventDefault();
		$(this).addClass('active');
		$(this).siblings().removeClass('active');
	});	
	if(viewportW <= 600){
		var mainW = viewportW;	
		$('.sublink').on('click', function(e) {
			e.preventDefault();
			$(this).siblings('.close-box').css('display','block');
			$(this).siblings('.sub-hnav').css('display','flex');
		});			
		$('.close-box').click(function(event){
	        $('.sub-hnav').css('display','none');
		});	
	}
});
function layout(){
	var viewportW = $(window).width();	
	if(viewportW <= 600){
		var mainW = viewportW;	
		$('.user-list').css('width',mainW);				
	}else {
		var mainW = viewportW - 160;
		$('.user-list').css('width',mainW);	
	}	
}

jQuery('.anchor').on('click', function(event) {
	event.preventDefault();
	var target = "#" + jQuery(this).data('target');
	jQuery('html, body').animate({
		scrollTop: jQuery(target).offset().top
	}, 500);
});
// popup ------
var viewportW = $(window).width();
var paddspace = (viewportW - 610)/2;
jQuery('.pop_view').on('click', function(event) {
	event.preventDefault();
	$(this).siblings().css({
		'display':'block',
		'left': paddspace
	});
	$('body').append('<div class="gray_layer"> </div>');
});
$('body').on('click', '.gray_layer', function(e) {
	e.preventDefault();
	$('.gray_layer').remove();
	$('.s-popup').css('display','none');
});

// End popup ------

$(document).ready(function () {
	$('.pg-top').click(function () {
		$("html, body").animate({
			scrollTop: 10
		}, 600);
		return false;
	});
});
function showtab(tmp) {
	var num = tmp;
	if(num == 1) {
		alert("vi tri 1");	
	}
}

$(document).ready(function(){
	$(".btn-open-popup").click(function(even) {
		even.preventDefault();
		loadPopup(); // function show popup
	});

	$(".btn-close").click(function(){
		disablePopup();
	});

	$(this).keydown(function(event) {
		if (event.which == 27) { // 27 is 'Ecs' in the keyboard
			disablePopup();  // function close pop up
		}
	});

    $(".background-popup").click(function() {
		disablePopup();  // function close pop up
		disableLoginPopup();
	});

	var popupStatus = 0; // set value

	function loadPopup() {
		if(popupStatus == 0) { // if value is 0, show popup
			$(".to-popup").fadeIn(200); // fadein popup div
			$(".popup-cont").animate({scrollTop: 10}, 500); //scroll popup to Top
			$(".background-popup").css("opacity", "0.8"); // css opacity, supports IE7, IE8
			$(".background-popup").fadeIn(200);
			popupStatus = 1; // and set value to 1
		}
	}

	function disablePopup() {
		if(popupStatus == 1) { // if value is 1, close popup
			$(".to-popup").fadeOut(300);
			$(".background-popup").fadeOut(300);
			$('body,html').css("overflow","auto");//enable scroll bar
			popupStatus = 0;  // and set value to 0
		}
	}
});