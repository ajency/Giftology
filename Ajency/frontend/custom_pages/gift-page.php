<?php
if( !defined( 'ABSPATH' ) ) exit;
?>
<?php get_header(); ?>

    <section class="gift-card">

        <?php
        echo '<input type="hidden" name="gift_id" id="gift_id" value="' . $gift_id . '" />';
        ?>


        <div class="container">

            <!-- breadcrums -->
            <div class="row breadcrums">
                <div class="col-sm-7">
                    <ul class="steps">
                        <li><a href="">Home</a></li>
                        <li>/</li>
                        <li><a href="">Gifts</a></li>
                        <li>/</li>
                        <li><a href=""><?php  echo $gift->title; ?></a></li>
                    </ul>
                </div>
                <div class="col-sm-5">
                    <div class="cont-note pull-right">
                        <a href="">View note to the contributors</a>
                    </div>
                </div>
            </div>

            <?php
            include locate_template('Ajency/frontend/custom_pages/gift-templates/template-'.$gift->template_id.'.php', false, false);
            ?>
        </div>

    </section>


    <!-- Comment section -->

    <section class="comment">

        <div class="container">
            <div class="row">
                <div class="col-sm-7"></div>
                <div class="col-sm-5">

                    <!--
                       If the current user is allowed to view-invites show the tabs
                       -->
                    <?php
                    $perms['recepients_count'] = count(Ajency_MFG_Gift::get_invitations($gift_id,[Ajency_MFG_Gift::STATUS_INVITE_SENT]));
                    $perms['current_user_can_edit'] = $user_id == $gift->created_by ? true : false;
                    $perms['current_user_can_view_invites'] = Ajency_MFG_Gift::get_acl_access_rule('gift',$gift_id,$user_id,'view-invites');
                    $perms['current_user_can_send_invites'] = Ajency_MFG_Gift::get_acl_access_rule('gift',$gift_id,$user_id,'send-invites');
                    ?>

                    <?php if($perms['current_user_can_edit']) : ?>
                        <!-- if the gift creator only then show edit contrib settings -->

                        <?php  if($gift->contrib_setting_id == Ajency_MFG_Gift::SETTING_CONTRIB_ONLY_ME || $gift->contrib_setting_id  == 0): ?>
                            <div class="only-me">
                                <p>You have selected <span class="link-color">Only me</span> option to change/update setting click <a href="#" data-toggle="modal" data-target="#change-email">here</a></p>
                            </div>
                        <?php  endif; ?>

                        <?php  if($gift->contrib_setting_id == Ajency_MFG_Gift::SETTING_CONTRIB_SPECIFIC): ?>
                            <div class="only-me">
                                <p>You have selected <span class="link-color">specific</span> option to change/update setting click <a href="#" data-toggle="modal" data-target="#change-email">here</a></p>
                            </div>
                        <?php  endif; ?>

                        <?php  if($gift->contrib_setting_id == Ajency_MFG_Gift::SETTING_CONTRIB_EVERYONE): ?>
                            <div class="only-me">
                                <p>You have selected <span class="link-color">everyone</span> option to change/update setting click <a href="#" data-toggle="modal" data-target="#change-email">here</a></p>
                            </div>
                        <?php  endif; ?>

                    <?php  endif; ?>

                    <div class="contrib-selector">

                        <?php  if($perms['current_user_can_view_invites'] && $perms['recepients_count'] > 0) : ?>

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <div class="invitees">
                                    <a href="#invitees" aria-controls="invitees" role="tab" data-toggle="tab" class="tab-link">
                                        <span><b><?php echo $perms['recepients_count']; ?></b> <?php echo $perms['recepients_count'] == 1 ? "Invitee" : "Invitees" ?></span>
                                        <!--
                                        If the current user is allowed to send-invites and recepients are more than 0, show the add button
                                        -->
                                        <?php  if($perms['current_user_can_send_invites'] && $perms['recepients_count'] > 0) : ?>
                                            <a href="#" class="add invite-contributors">Add</a>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </li>
                            <li role="presentation">
                                <div class="invitees">
                                    <a href="#contributors" aria-controls="contributors" role="tab" data-toggle="tab" class="tab-link">
                                        <span><b>5</b> Contributors</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                         <?php endif; ?>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="invitees">
                                <!--If user is allowed to send invites and no invitations have been sent, show the big invite button
                                -->

                                <?php  if($perms['current_user_can_send_invites'] && $perms['recepients_count'] == 0) : ?>

                                    <div class="no-invit">
                                        <p>You have not invited any contributors to this gift yet</p>
                                        <button class="invite-contributors btn btn-default site-btn-2" data-target="#add-email">Invite contributors</button>
                                    </div>

                                <?php  endif; ?>



                                <!--If user is allowed to seee invites and invitations have been sent
-->

                                <?php if($perms['current_user_can_view_invites'] && $perms['recepients_count'] > 0) : ?>
                                    <?php $show_resend = (isset($perms['current_user_can_send_invites']) && !empty($perms['current_user_can_send_invites'])) ? 1 : 0;  ?>
                                    <?php echo do_shortcode( '[gift_invites show-resend='.$show_resend.' gift_id="'.$gift_id.'" status="1"]' ); ?>
                                <?php  endif; ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="contributors">contributors</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Add modal -->
        <div class="add-email modal fade" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="inviteModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="inviteModalLabel">Modal Title</h4>
                        <p class="modal-caption">Modal Caption</p>
                    </div>
                    <div class="modal-body">
                        //Dynamically Load Modal here
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
                        <span>
                <button type="submit" id="invite-back" class="btn btn-default cancel">Back</button>
	        	<button type="submit" id="invite-submit" class="btn btn-primary site-btn-2">Next</button>
	        </span>
                    </div>
                </div>
            </div>
        </div>

        <?php
        echo '<input type="hidden" name="invite_group" id="invite_group" value="" />';
        ?>

        <!-- Email settings modal -->
        <div class="change-email modal fade" id="change-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Contribution Settings</h4>
                        <p class="modal-caption">Manage whether you want others to contribute</p>
                    </div>
                    <div class="modal-body">
                        <form class="" id="settings">
                            <div class="settings">
                                <h6 class="settings-heading">Pick the type of contribution you wish to set</h6>
                                <ul>
                                    <li>
                                        <label class="radio-inline">
                                            <input name="contribSetting" id="radio1" value="<?php echo Ajency_MFG_Gift::SETTING_CONTRIB_ONLY_ME; ?>" <?php echo Ajency_MFG_Gift::SETTING_CONTRIB_ONLY_ME == $gift->contrib_setting_id ? 'checked' : ''; ?> type="radio">
                                            <div class="radio-cont">
                                                <span class="radio-label">Only me </span>
                                                <p class="radio-detail">No one else can contribute</p>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="radio-inline">
                                            <input name="contribSetting" id="radio1" value="<?php echo Ajency_MFG_Gift::SETTING_CONTRIB_SPECIFIC; ?>" <?php echo Ajency_MFG_Gift::SETTING_CONTRIB_SPECIFIC == $gift->contrib_setting_id ? 'checked' : ''; ?> type="radio" class="sub-option">

                                            <div class="radio-cont">
                                                <span class="radio-label">Private </span>
                                                <p class="radio-detail">Only invited people can contribute</p>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="radio-inline">
                                            <input name="contribSetting" id="radio2" value="<?php echo Ajency_MFG_Gift::SETTING_CONTRIB_EVERYONE; ?>" <?php echo Ajency_MFG_Gift::SETTING_CONTRIB_EVERYONE == $gift->contrib_setting_id ? 'checked' : ''; ?> type="radio" class="sub-option">
                                            <div class="radio-cont">
                                                <span class="radio-label">Public </span>
                                                <p class="radio-detail">Anyone can see and contribute</p>
                                            </div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="change-settings" class="btn btn-primary site-btn-2">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?php get_footer(); ?>