
jQuery("#send-invites").click(function(){

    var gift_id = $( '#gift_id' ).val();
    var invite_group = Math.random().toString(36).substring(7);
    document.getElementById("invite_group").value = invite_group;
    console.log(invite_group);

    $.ajax({
        type: "POST",
        url: giftology_api.root + 'giftology/v1/gifts/'+ gift_id +'/send-invites?invite-group='+invite_group,
        beforeSend: function ( xhr ) {
            xhr.setRequestHeader( 'X-WP-Nonce', giftology_api.nonce );
        },
        data: {} ,
        success: function(data){
            /*                    $("#thanks").html(msg)
             $("#form-content").modal('hide');*/
            $('#confirm-emails').modal('hide');

            $('#confirm-emails').on('hidden.bs.modal', function () {
                // Load up a new modal...
                $('#confirmed-emails').modal('show')
            })
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

/*        jQuery('#login').on('show.bs.modal', function (e) {
 var gift_id = $( '#gift_id' ).val();
 var loadurl = giftology_api.homeUrl + '?login=true&modal=true';
 $(this).find('.modal-body').load(loadurl);
 });*/

jQuery('#confirm-emails').on('show.bs.modal', function (e) {
    var gift_id = $( '#gift_id' ).val();
    var loadurl = giftology_api.homeUrl + '?gift-invites-step-1='+gift_id+'&modal=true';
    $(this).find('.modal-body').load(loadurl);
});

jQuery("#send-invites-prev").click(function(){


    $('#confirm-emails').modal('hide');

    /*                    $('#confirm-emails').modal('show')*/

    $('#confirm-emails').on('hidden.bs.modal', function () {
        // Load up a new modal...
        $('#add-email').modal('show')
    });
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

            var loadurl = giftology_api.homeUrl + '?gift-invites-step-1='+gift_id+'&modal=true';


            $('#myModal .modal-body').load(loadurl );


            /*                  jQuery('#confirmed-emails').on('show.bs.modal', function (e) {
             var invite_group = $( '#invite_group' ).val();
             console.log("invite-group" + invite_group);
             var gift_id = $( '#gift_id' ).val();
             $(this).find('.modal-body').load(loadurl);
             });*/

            console.log(data);
        },
        error: function(){
            alert("Internal Server Error : Please contact Admin");
        }
    });
});

/*  jQuery('.close').click(function() {
 $('.modal').modal('hide');
 });


 jQuery('.cancel').click(function() {
 $('.modal').modal('hide');
 });
 */