<?php
if( !defined( 'ABSPATH' ) ) exit;

function gift_invites($atts) {

    $gift_id = isset($atts['gift_id']) ? $atts['gift_id'] : $_GET['gift_id'];
    $template = isset($atts['template']) ? $atts['template'] : 1;
    $limit = isset($atts['limit']) ? $atts['limit'] : false;
    $status = isset($atts['status']) ? $atts['status'] : 1;
    $inv_group = isset($atts['inv_group']) ? $atts['inv_group'] : false;
    $view_all_link = isset($atts['view-all-link']) ? $atts['view-all-link'] : false;
    $filter_by_user = isset($atts['filter-by-user']) ? $atts['filter-by-user'] : false;
    $show_resend = isset($atts['show-resend']) && !empty($atts['show-resend']) ? $atts['show-resend'] : false;

/*    $status = explode(',',$atts['status']);*/
    $show_op_icon = isset($atts['show_op_icon']) ? $atts['show_op_icon'] : 0;
    $recepients = Ajency_MFG_Gift::get_invitations($gift_id,$status,$limit,$inv_group,$filter_by_user);

    $classes = 'invit-emails';

    if(count($recepients) > 4) { // Make config?
        $classes .= ' more-email';
    }

    if($recepients) {

        $html = $name = $email = '';
        $html .= '<div class="'.$classes.'">';
        foreach ($recepients as $recepient) {

            if($recepient->display_name){
                //Check if email exists in the sustem
                $name = '<h5 class="name">'.$recepient->display_name.' </h5>';
            } else {
                $name = '<h5 class="name">'.$recepient->email.'</h5>';
            }

            if($recepient->pic){
                $pic = $recepient->pic;

            } else {
                $pic = get_template_directory_uri().'/img/dummy.png';
            }

            $html .= '
	    		<div class="col">
	    			<span class="profile"><img src="'.$pic.'" class="img-responsive" width="50"></span>
					<span class="profile-info">';

            $html .= '<h5 class="name"><span>'.$name.'</span>';

            if($recepient->inv_status == 1) {
                $html .= '<span class="label"><i class="fa fa-check" aria-hidden="true"></i> Invited</span>';
            }

            $html .= '</h5>';


            $html .= '<span class="close-holder">
					<a href="" class="email">'.$recepient->email.'</a>';

            //TODO only already invited
            if($show_resend) {
                $html .= '<a class="resend" data-toggle="tooltip" data-placement="right" title="Resend email" id="'.$recepient->inv_id.'"><i class="fa fa-paper-plane" aria-hidden="true"></i>
					</a>';
            }

            if($recepient->inv_status == 0) {
                $html .= '<span id="'.$recepient->inv_id.'" class="remove-email">&times;</span>';
            }

            $html .= '</span>';

            $html .= '</span></div>';

        }
/*        if($view_all_link && count($recepients) > 5) {*/

if($limit) {
    $html .= '<div class="col view-all"><a href="#" class="add view-all-invites">View all</a></div>';
}
/*
            $html .= '<div class="col view-all"><a href="/'.$view_all_link.'">View all</a></div>';*/
//        }
        $html .= '</div>';
    } else {
        $html = "No Invitations Found";
    }
    return $html;
}