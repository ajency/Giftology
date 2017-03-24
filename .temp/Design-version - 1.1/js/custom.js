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

	$('.fund-desc .read-more').readmore({
	  speed: 25,
	  collapsedHeight: 42,
	  moreLink: '<a href="#">More</a>',
	  lessLink: '<a href="#">Less</a>'
	});

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



// $('.section-number').affix({
//         offset: {
//           top: $('.gift-name').offset().top,
//           bottom: function() {
//             return this.bottom = $('.gift-footer').outerHeight(true);
//           }
//         }
//       });


// var one = $('.gift-owner').offset().top;
// var second = $('.send-details').offset().top;
// var third = $('.contribute').offset().top;

// $(window).scroll(function(){
// 	if ($(this).scrollTop() > one){ 
//         $('.points .one').addClass('active').siblings().removeClass('active'); 
//     }    
//     else if ($(this).scrollTop() > second){ 
//         $('.points .second').addClass('active').siblings().removeClass('active'); 
//     }
//     else if($(this).scrollTop() > third){
//     	$('.points .third').addClass('active').siblings().removeClass('active'); 
//     }
//     else{
//         $('.points li').addClass('active').removeClass('active');
//     }
// });





});