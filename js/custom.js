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



        $('#email-tags').tagsinput({
        });

        $('#email-tags').on('beforeItemAdd', function(event) {


            var tag = event.item;
            // Do some processing here

            alert(tag);
            /*if (!event.options || !event.options.preventPost) {
                $.ajax('/ajax-url', ajaxData, function(response) {
                    if (response.failure) {
                        // Remove the tag since there was a failure
                        // "preventPost" here will stop this ajax call from running when the tag is removed
                        $('#tags-input').tagsinput('remove', tag, {preventPost: true});
                    }
                });
            }*/
        });


        jQuery("#send-invites").click(function(){
            $.ajax({
                type: "POST",
                url: "/wp-json/giftology/v1/gifts/1/send-invites",
                data: {} ,
                success: function(data){
                    /*                    $("#thanks").html(msg)
                     $("#form-content").modal('hide');*/
                    console.log(data);
                },
                error: function(){
                    alert("failure");
                }
            });
        });


        jQuery('#confirm-emails').on('show.bs.modal', function (e) {
            var loadurl = 'http://mfgiftology.dev/gift-invite/?gift_id=1';
            $(this).find('.modal-body').load(loadurl);
        });

        jQuery("#queue-invites").click(function(){
            $.ajax({
                type: "POST",
                url: "/wp-json/giftology/v1/gifts/1/queue-invites",
                data: $('#invite').serialize() ,
                success: function(data){
/*                    $("#thanks").html(msg)
                    $("#form-content").modal('hide');*/
                    console.log(data);
                },
                error: function(){
                    alert("failure");
                }
            });
        });

        jQuery("#change-settings").click(function(){

            var security = $( '#change-settings-ajax-nonce' ).val();
            console.log(security);

            $.ajax({
                type: "POST",
                url: POST_SUBMITTER.root + 'giftology/v1/gifts/1/change-settings',
                beforeSend: function ( xhr ) {
                    xhr.setRequestHeader( 'X-WP-Nonce', POST_SUBMITTER.nonce );
                },

                data: $('#settings').serialize() ,
                success: function(data){
                    /*                    $("#thanks").html(msg)
                     $("#form-content").modal('hide');*/
                    console.log(data);
/*                    window.location.reload();*/
                },
                error: function(){
                    alert("failure");
                }
            });
        });

    });




})( jQuery );