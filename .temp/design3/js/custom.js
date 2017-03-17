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

});