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

        function show_invite_contributors_form(loadurl) {
            $('#inviteModal').modal('show').find('.modal-body').load(loadurl);
            $('#invite-submit').text('Save');
            $('.modal-title').text('Invite people to contribute');
            $('.modal-caption').text('Invitation is sent by email');
            $('#invite-submit')
                .removeClass('step-1-submit')
                .removeClass('step-2-submit')
                .addClass('step-0-submit');
            $('#invite-back').hide();
        }

        $(document).on('click', '.invite-contributors', function (e) {
            var gift_id = $( '#gift_id' ).val();
            var loadurl = giftology_api.homeUrl + '?gift-invites-step-0='+gift_id+'&modal=true';
            e.preventDefault();
            show_invite_contributors_form(loadurl);
        });

        jQuery("#invite-back").click(function(){
            var gift_id = $( '#gift_id' ).val();
            var loadurl = giftology_api.homeUrl + '?gift-invites-step-0='+gift_id+'&modal=true';
            show_invite_contributors_form(loadurl);
        });

        $(document).on('click', '.step-0-submit', function () {
            console.log('Clicked step-0-submit');
            var gift_id = $( '#gift_id' ).val();
            console.log(gift_id);

            $.ajax({
                type: "POST",
                url: giftology_api.root + 'giftology/v1/gifts/'+gift_id+'/queue-invites',
                beforeSend: function ( xhr ) {
                    xhr.setRequestHeader( 'X-WP-Nonce', giftology_api.nonce );
                },

                data: $('#invite').serialize() ,
                success: function(data){

                    //Loader button
                    var loadurl = giftology_api.homeUrl + '?gift-invites-step-1='+gift_id+'&modal=true';
                    $('#inviteModal').modal('show').find('.modal-body').load(loadurl);

                    $('.modal-title').text('Confirm Invitations');
                    $('.modal-caption').text('You can go back to confirm email addresses');
                    $('#invite-submit').text('Send');
                    $('#invite-back').show();

                    $('#invite-submit').removeClass('step-0-submit').addClass('step-1-submit');

                    console.log(data);
                },
                error: function(){
                    alert("Internal Server Error : Please contact Admin");
                }
            });
        });


        $(document).on('click', '.step-1-submit', function () {
            var gift_id = $( '#gift_id' ).val();
            var invite_group = Math.random().toString(36).substring(7);
            document.getElementById("invite_group").value = invite_group;

            $.ajax({
                type: "POST",
                url: giftology_api.root + 'giftology/v1/gifts/'+ gift_id +'/send-invites?invite-group='+invite_group,
                beforeSend: function ( xhr ) {
                    xhr.setRequestHeader( 'X-WP-Nonce', giftology_api.nonce );
                },
                data: {} ,
                success: function(data){
                    //Loader button
                    var loadurl = giftology_api.homeUrl + '?gift-invites-step-2='+gift_id+'&modal=true&invite-group='+invite_group;
                    $('#inviteModal').modal('show').find('.modal-body').load(loadurl);
                    $('.modal-title').text('Contributors Invited!');
                    $('.modal-caption').text('Rejoice! Your invitations have been sent');
                    $('#invite-submit').text('Done');
                    $('#invite-submit').removeClass('step-1-submit').addClass('step-2-submit');
                    $('#invite-back').hide();
                    console.log(data);
                },
                error: function(){
                    alert("Internal Server Error : Please contact Admin");
                }
            });
        });

        $(document).on('click', '.step-2-submit', function () {
            console.log('Clicked step-2-submit');
            var gift_id = $( '#gift_id' ).val();
            console.log(gift_id);
            $('#inviteModal').modal('hide');
            window.location.reload();

        });

        jQuery('.modal').on('shown.bs.modal', function (e) {
            jQuery('body').addClass('modal-open');
        });

        jQuery('.modal').on('hidden.bs.modal', function (e) {
            jQuery('body').removeClass('modal-open');
        });

    });




})( jQuery );