<?php

function gift_invites($atts) {

    $gift_id = isset($atts['gift_id']) ? $atts['gift_id'] : $_GET['gift_id'];
    $template = isset($atts['template']) ? $atts['template'] : 1;
    $limit = isset($atts['limit']) ? $atts['limit'] : false;
    $status = isset($atts['status']) ? $atts['status'] : 1;
    $inv_group = isset($atts['inv_group']) ? $atts['inv_group'] : false;
    $view_all_link = isset($atts['view-all-link']) ? $atts['view-all-link'] : false;

/*    $status = explode(',',$atts['status']);*/
    $show_op_icon = isset($atts['show_op_icon']) ? $atts['show_op_icon'] : 0;
    $recepients = Ajency_MFG_Gift::get_invitations($gift_id,$status,$limit,$inv_group);

    $classes = 'invit-emails center-email';

    if(count($recepients) > 5) { // Make config?
        $classes .= ' more-email';
    }

    if($recepients) {

        $html = $name = $email = '';
        $html .= '<div class="'.$classes.'">';
        foreach ($recepients as $recepient) {
            $html .= '<div class="col"><span class="profile">';

            if($recepient->pic){
                $html .= '<img src="'.$recepient->pic.'" class="img-responsive" width="50"></span>';
            } else {
                $html .= '<img src="'. get_template_directory_uri().'/img/dummy.png' .'" class="img-responsive" width="50"></span>';

            }
            $html .= '<span class="profile-info">';

            if($recepient->display_name){
                //Check if email exists in the sustem
                $name = '<h5 class="name">'.$recepient->display_name.' </h5>';
            } else {
                $name = '<h5 class="name">'.$recepient->email.'</h5>';
            }
            $email = '<a href="" class="email">'.$recepient->email.'</a>';
            if($template == 1) {
                $html .= $name;
                $html .= $email;
            } else if($template == 2){
                $html .= $email;
                $html .= $name;
            }
            $html .= '</span>';
            if($show_op_icon) {
                if($recepient->inv_status == 0) {
                    $html .= '<div class="remove-email"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
                } else if($recepient->inv_status == 1 || $recepient->inv_status == 3) {
                    $html .= '<div class="remove-email"><a href="#"><i class="fa fa-check" aria-hidden="true"></i></a></div>';
                }
            }
            $html .= '</div>';
        }
        if($view_all_link && count($recepients) > 5) {
            $html .= '<div class="col view-all">
					    			<a href="/'.$view_all_link.'">View all</a>
					    		</div>';
        }
        $html .= '</div>';
    } else {
        $html = "No Invitations Queued for confirmation";
    }
    return $html;
}


