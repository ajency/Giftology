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

	// $('.fund-desc .read-more').readmore({
	//   speed: 25,
	//   collapsedHeight: 22,
	//   moreLink: '<a href="#">More</a>',
	//   lessLink: '<a href="#">Less</a>'
	// });

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



});