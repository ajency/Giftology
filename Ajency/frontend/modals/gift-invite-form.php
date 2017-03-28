<?php
if( !defined( 'ABSPATH' ) ) exit;
?>
<form id="invite">
    <div class="form-group email-address">
        <label for="email" class="control-label">Type the email addresses and hit Enter</label>
        <p class="label-msg">You can invite any number of people</p>
        <input name="email" class="form-control" id="email-tags" placeholder="Email address" required>
    </div>
    <div class="form-group email-msg">
        <label for="message" class="control-label">A message to the contributors</label>
        <textarea class="form-control" placeholder="Message" name="message" id="message" rows="5" required>Hi! Its Sarvesh's anniversary, Lets give him a gift that'll be really helpful for him in the future!</textarea>
    </div>
</form>

<script>
    jQuery(document).ready(function() {
        jQuery('#email-tags').tagsinput(
            {
                onTagExists: function(item, tag) {
                    tag.hide().fadeIn();
                },
                trimValue: true,
                confirmKeys: [13]
            }
        );
    });

    function validateEmail(email)
    {
        var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
        if (reg.test(email)){
            return true; }
        else{
            return false;
        }
    }

    jQuery('#email-tags').on('itemAdded', function(event) {


        var tag = event.item;
        console.log("itemAdded"+event);
        if (validateEmail(tag) == false) {
            jQuery('#email-tags').tagsinput('remove', tag, { preventPost: true});
        }
    });


    <?php foreach (Ajency_MFG_Gift::get_invitations($gift_id, Ajency_MFG_Gift::STATUS_INVITE_QUEUED,false,false,get_current_user_id()) as $rec) {  ?>
            jQuery('#email-tags').tagsinput('add', "<?php echo $rec->email; ?>" );
            console.log("<?php echo $rec->email; ?>");
    <?php    } ?>


    jQuery('#email-tags').on('itemRemoved', function(event) {
        var tag = event.item;

        if (validateEmail(tag) == true) {
            //TODO Ateempt to delete that email, api call, very tricky and is for edge case handling
            var gift_id = jQuery( '#gift_id' ).val();
            var id = jQuery(this).attr('id');
            var url = giftology_api.root + 'giftology/v1/gifts/'+gift_id+'/delete-invite-by-email';
            jQuery.ajax({
                type: "POST",
                url: url,
                beforeSend: function ( xhr ) {
                    xhr.setRequestHeader( 'X-WP-Nonce', giftology_api.nonce );
                },
                data: { email : tag } ,
                success: function(data){
                    console.log(data);
                },
                error: function(error){
                    console.log(error);
                    alert("Internal Server Error : Please contact Admin");
                }
            });

        }
        console.log(tag);
        // Do some processing here

/*        if (!event.options || !event.options.preventPost) {
            $.ajax('/ajax-url', ajaxData, function(response) {
                if (response.failure) {
                    // Re-add the tag since there was a failure
                    // "preventPost" here will stop this ajax call from running when the tag is added
                    $('#tags-input').tagsinput('add', tag, {preventPost: true});
                }
            });
        }*/
    });


</script>