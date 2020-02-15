/*global jQuery:false */
(function ($) {

	var wow = new WOW(
	  {
		boxClass:     'wow',      // animated element css class (default is wow)
		animateClass: 'animated', // animation css class (default is animated)
		offset:       0,          // distance to the element when triggering the animation (default is 0)
		mobile:       false       // trigger animations on mobile devices (true is default)
	  }
	);
	wow.init();

	//jQuery to collapse the navbar on scroll
	$(window).scroll(function() {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").addClass("top-nav-collapse");
		//	$(".top-area").addClass("top-padding");
		//	$(".navbar-brand").addClass("reduce");

			$(".navbar-custom ul.nav ul.dropdown-menu").css("margin-top","11px");
		
		} else {
			$(".navbar-fixed-top").removeClass("top-nav-collapse");
		//	$(".top-area").removeClass("top-padding");
		//	$(".navbar-brand").removeClass("reduce");

		//	$(".navbar-custom ul.nav ul.dropdown-menu").css("margin-top","16px");
	
		}
	});
	
	//scroll to top
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
			} else {
			$('.scrollup').fadeOut();
		}
	});
	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 1000);
			return false;
	});
	


	//jQuery for page scrolling feature - requires jQuery Easing plugin
			$(function() {
				$('.navbar-nav li a').bind('click', function(event) {
					var $anchor = $(this);
					var nav = $($anchor.attr('href'));
					if (nav.length) {
					$('html, body').stop().animate({				
						scrollTop: $($anchor.attr('href')).offset().top				
					}, 1500, 'easeInOutExpo');
					
					event.preventDefault();
					}
				});
				$('.page-scroll a').bind('click', function(event) {
					var $anchor = $(this);
					$('html, body').stop().animate({
						scrollTop: $($anchor.attr('href')).offset().top
					}, 1500, 'easeInOutExpo');
					event.preventDefault();
				});
			});

	//nivo lightbox
	$('.gallery-item a').nivoLightbox({
		effect: 'fadeScale',                             // The effect to use when showing the lightbox
		theme: 'default',                           // The lightbox theme to use
		keyboardNav: true,                          // Enable/Disable keyboard navigation (left/right/escape)
		clickOverlayToClose: true,                  // If false clicking the "close" button will be the only way to close the lightbox
		onInit: function(){},                       // Callback when lightbox has loaded
		beforeShowLightbox: function(){},           // Callback before the lightbox is shown
		afterShowLightbox: function(lightbox){},    // Callback after the lightbox is shown
		beforeHideLightbox: function(){},           // Callback before the lightbox is hidden
		afterHideLightbox: function(){},            // Callback after the lightbox is hidden
		onPrev: function(element){},                // Callback when the lightbox gallery goes to previous item
		onNext: function(element){},                // Callback when the lightbox gallery goes to next item
		errorMessage: 'The requested content cannot be loaded. Please try again later.' // Error message when content can't be loaded
	});
	
})(jQuery);
$(window).load(function() {
	$(".loader").delay(100).fadeOut();
	$("#page-loader").delay(100).fadeOut("fast");


	//$('#datetimepicker1').datetimepicker();

	$('#datetimepicker1, #datetimepicker2').datepicker().on('change', function(){
        $('.datepicker').hide();
    });



	function checkrow(ctrl){ 

		$(ctrl).closest('tr').find('input[type="checkbox"]').each(function(){

			$(ctrl).closest('tr').find('.bleft2').removeClass('min_h_100');

			var _ischecked = $(ctrl).prop('checked');

			if(_ischecked==true){
				$(ctrl).closest('tr').find('.bleft2').addClass('min_h_100');
				return;
			} 

		});
	}


	$("body").on("change", ".set_checkbox input[type='checkbox']", function(){
		checkrow($(this))

	   var ischecked = $(this).prop('checked');
	  // alert(ischecked);
	   if(ischecked==true){
		   $(this).closest('.set_checkbox').next('.setinputs').addClass('active');
	   }else{
		   $(this).closest('.set_checkbox').next('.setinputs').removeClass('active');
	   } 

	});

	// $('input[type="radio"]').change(function(){
	$("body").on("change", 'input[type="radio"]', function(){
			

		var ischecked = $(this).closest('.charts').find($('input[type="radio"].showinput5')).prop('checked');
		console.log(">>>>>>>>>>",ischecked);
		if(ischecked==true){
			$(this).closest('.charts').find($('input[type="radio"].showinput5')).next('input[type="text"]').removeClass('hide');
		}else{ 
		   $(this).closest('.charts').find($('input[type="radio"].showinput5')).next('input[type="text"]').addClass('hide');
		 } 
 
	  });


	  $("body").on("change",'input[type="checkbox"].showinput',function(){  
 
	   var ischecked = $(this).prop('checked');
	   
	   if(ischecked==true){
		   $(this).closest('.checkbox').find('input[type="text"]').removeClass('hide');
	   }else{ 
		$(this).closest('.checkbox').find('input[type="text"]').addClass('hide');
	    } 

     });


	$("body").on("click",'.slider .block',function(){
		// $(this).closest('.row').siblings('.row').find('.slider').removeClass('active');
		$(this).closest('.slider').addClass('active');
	});

	     
	$("body").on("change",'input[name="q4"]',function(){  
		var ischecked = $(this).val();
		if(ischecked==30){
			$(this).closest('.slider').find('.option').removeClass('active');
			$(this).closest('.slider').find('.option[data-for="'+4+'"]').addClass('active'); 
			
		}else{
			$(this).closest('.slider').find('.option').removeClass('active');
			$(this).closest('.slider').find('.option[data-for="'+4+'"]').removeClass('active'); 
		
		}
});

$("body").on("change",'input[name="q9"]',function(){  
	var ischecked = $(this).val();
	if(ischecked==93){
		$(this).closest('.slider').find('.option').removeClass('active');
		$(this).closest('.slider').find('.option[data-for="'+9+'"]').addClass('active'); 
		
	}else{
		$(this).closest('.slider').find('.option').removeClass('active');
		$(this).closest('.slider').find('.option[data-for="'+9+'"]').removeClass('active'); 
	
	}
});




	// $('input[name="q5"]').change(function(){  
	//    var ischecked = $(this).val(); 
	//  $(this).closest('.slider').find('.option').removeClass('active');
	//   $(this).closest('.slider').find('.option[data-for="'+ischecked+'"]').addClass('active'); 
	// });

	$("body").on("change",'input[name="q10"]',function(){  
		var ischecked = $(this).val(); 
	  $(this).closest('.slider').find('.option').removeClass('active');
	   $(this).closest('.slider').find('.option[data-for="'+ischecked+'"]').addClass('active'); 
	 });

	$("body").on("click", 'input[name="q12"]', function(){  
		var ischecked = $(this).val(); 

		// alert(ischecked);
		// return;
		if($(this).prop("checked") == true){

			if(ischecked !=109){
				$(":checkbox.q12other").attr("checked", false);
			
				$(this).closest('.slider').find('.option[data-for="'+ischecked+'"]').addClass('active');
				$(this).closest('.slider').find('.option[data-for="'+ischecked+'"]').removeClass('hide');
			}
		}
		else if($(this).prop("checked") == false){
			$(this).closest('.slider').find('.option[data-for="'+ischecked+'"]').removeClass('active');
		}
		if($(this).val()==109){
			console.log("None is Selected!!!");
			$(":checkbox.q12").attr("checked", false);
			$(this).closest('.slider').find('.option[data-for="107"]').addClass('hide');
			$(this).closest('.slider').find('.option[data-for="108"]').addClass('hide');
		}
	});

});


	
