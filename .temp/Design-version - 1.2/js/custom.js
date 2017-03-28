$(function(){

	//Disabling/checking of email radio buttons

	$(".settings input[type='radio']").change(function() {
	    if (this.value == "option1") {
	        $('.second-option').attr('disabled','disable');
	    } else {
	        $('.second-option').removeAttr('disabled');
	        $('.sub-option').attr('checked','checked');
	        
	    }
	});

	// To enable tooltip

	$('[data-toggle="tooltip"]').tooltip()

	// To add read more link(Requires read-more.js to be included)

	$('.cards .read-more').readmore({
       speed: 25,
       collapsedHeight: 233,
       moreLink: '<a href="#">More</a>',
       lessLink: '<a href="#">Less</a>'
     });

	$('#template-modal').on('shown.bs.modal', function () {
  		$('.templates .read-more').readmore({
	       speed: 25,
	       collapsedHeight: 80,
	       moreLink: '<a href="#">More</a>',
	       lessLink: '<a href="#">Less</a>'
	     });
  		$('.templates .read-more .string').each(function(){
			var count = $(this).text().length;
			$(this).parent().siblings('.count').children('.number').text(count);
			// console.log(count);
		});
		$('.radio-select').on('change',function(){
			if($('.radio-select:checked')){
				$('.site-btn-2').removeClass('disabled');
			}
			else{
				$('.site-btn-2').addClass('disabled');
			}
			
		});
	});


	

        // $('.section .read-more').readmore({
        //    speed: 25,
        //    collapsedHeight: 22,
        //    moreLink: '<a href="#">More</a>',
        //    lessLink: '<a href="#">Less</a>'
        //  });


	// Card full view mode

	$('.sub-footer').click(function(){
		$(this).parent().addClass('full-view');
		$(this).closest('.cards').find('.footer').removeClass('hidden');
		$(this).addClass('hidden');
		$('.card-overlay').addClass('active');
	});

	$('.view-close').click(function(){
		$(this).parent().parents('.cards').removeClass('full-view');
		$(this).closest('.cards').find('.footer').addClass('hidden');
		$(this).closest('.cards').find('.sub-footer').removeClass('hidden');
		$('.card-overlay').removeClass('active');
	});
	// Search functionality

	$(".input-search").on('focus', function () {
		console.log('test');
		$('.search').addClass('active');
	});

	$(".input-search").on('blur', function () {
		if($('.input-search').val().length == 0)
			$('.search').removeClass('active');
	});






    if($(window).width() < 991) {
        $('.filter-title').click(function(){
			$(this).siblings('.selection').slideToggle();
			$(this).toggleClass('arrow');
		});
		$('.filter-trigger').click(function(){
			$('body').toggleClass('blocked');
			$(this).toggleClass('active');
			$('.filter').toggleClass('active');
		});
    }



 //   $('input:checkbox').change(function(){
	//     if($(this).is(":checked")) {
	//         $(this).parent().addClass("ff-check");
	//     } else {
	//         $(this).parent().removeClass("ff-check");
	//     }
	// });

	$('input[name="gift-send"]').on('change',function(){
		$('input:not(:checked)').parent().removeClass("date-style");
        $('input:checked').parent().addClass("date-style");
	});


 // $('.schedule-trigger').change(function() {
 //        $('label:has(input:radio:checked)').addClass('active');
 //        $('label:has(input:radio:not(:checked))').removeClass('active');
 //    });


$('.section-number').affix({
        offset: {
          top: $('.gift-name').offset().top,
          bottom: function() {
            return this.bottom = $('.gift-footer').outerHeight(true);
          }
        }
      });


var first = $('.template').offset().top;
var second = $('.send-details').offset().top;
var third = $('.contribute').offset().top;

$(window).scroll(function(){
	var trigger = $(this).scrollTop() + 40;
	if (trigger < second){ 
        $('.points .first').addClass('active').siblings().removeClass('active'); 
    }    
    else if ((trigger > second) && (trigger < third)){ 
        $('.points .second').addClass('active').siblings().removeClass('active'); 
    }
    else{
        $('.points .third').addClass('active').siblings().removeClass('active'); 
    }
});





});