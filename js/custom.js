(function( $ ) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
	 *
	 * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
	 *
	 * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */


    jQuery(document).ready(function() {

/*

        $(".settings input[type='radio']").change(function() {
            if (this.value == "option1") {
                $('.second-option').attr('disabled','disable');
            } else {
                $('.second-option').removeAttr('disabled');
                $('.sub-option').attr('checked','checked');

            }
        });
*/


        function validateEmail(email)
        {
            var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
            if (reg.test(email)){
                return true; }
            else{
                return false;
            }
        }

        $('#email-tags').tagsinput({
        });

        $('#email-tags').on('beforeItemAdd', function(event) {

            var tag = event.item;
            console.log(validateEmail(tag));
            if (validateEmail(tag) == false) {
                console.log('Entered');
                $('#email-tags').tagsinput('remove', tag);
            }
        });


        jQuery("#send-invites").click(function(){

            var gift_id = $( '#gift_id' ).val();

            $.ajax({
                type: "POST",
                url: giftology_api.root + 'giftology/v1/gifts/'+ gift_id +'/send-invites',
                beforeSend: function ( xhr ) {
                    xhr.setRequestHeader( 'X-WP-Nonce', giftology_api.nonce );
                },
                data: {} ,
                success: function(data){
                    /*                    $("#thanks").html(msg)
                     $("#form-content").modal('hide');*/
                    console.log(data);
                },
                error: function(){
                    alert("Internal Server Error : Please contact Admin");
                }
            });
        });

        jQuery("#finish-invites").click(function(){

            document.getElementsByName("email").value = '';
            document.getElementsByName("message").value = '';
            window.location.reload();
        });

        jQuery('#confirm-emails').on('show.bs.modal', function (e) {
            var gift_id = $( '#gift_id' ).val();
            var loadurl = giftology_api.homeUrl + '?gift-invites-step-1='+gift_id+'&modal=true';
            $(this).find('.modal-body').load(loadurl);
        });

        jQuery('#confirmed-emails').on('show.bs.modal', function (e) {
            var gift_id = $( '#gift_id' ).val();
            var loadurl = giftology_api.homeUrl + '?gift-invites-step-2='+gift_id+'&modal=true';
            $(this).find('.modal-body').load(loadurl);
        });

        jQuery("#queue-invites").click(function(){

            var gift_id = $( '#gift_id' ).val();


            console.log(giftology_api.homeUrl);
            var gift_id = $( '#gift_id' ).val();
            console.log("gift_id" + gift_id);


            $.ajax({
                type: "POST",
                url: giftology_api.root + 'giftology/v1/gifts/'+gift_id+'/queue-invites',
                beforeSend: function ( xhr ) {
                    xhr.setRequestHeader( 'X-WP-Nonce', giftology_api.nonce );
                },

                data: $('#invite').serialize() ,
                success: function(data){
/*                    $("#thanks").html(msg)
                    $("#form-content").modal('hide');*/
                    console.log(data);
                },
                error: function(){
                    alert("Internal Server Error : Please contact Admin");
                }
            });
        });

        jQuery("#change-settings").click(function(){

            var gift_id = $( '#gift_id' ).val();

            $.ajax({
                type: "POST",
                url: giftology_api.root + 'giftology/v1/gifts/'+gift_id+'/change-settings',
                beforeSend: function ( xhr ) {
                    xhr.setRequestHeader( 'X-WP-Nonce', giftology_api.nonce );
                },

                data: $('#settings').serialize() ,
                success: function(data){
                    /*                    $("#thanks").html(msg)
                     $("#form-content").modal('hide');*/
                    console.log(data);
                    window.location.reload();
                },
                error: function(){
                    alert("Internal Server Error : Please contact Admin");
                }
            });
        });

    });




})( jQuery );