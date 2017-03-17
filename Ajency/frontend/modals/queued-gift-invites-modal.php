<?php
$gift_id = $_GET['queued-gift-invites'];
echo do_shortcode( '[gift_invites limit=100 show_delete=1 template=2 gift_id=1 status=0]' );
?>