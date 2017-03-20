<?php get_header(); ?>

<?php
$gift_id = $_GET['gifts'];
$gift = Ajency_MFG_Gift::get_gift_details($gift_id, true);
$fund = $gift->fund;
$user_id = get_current_user_id();
?>
    <!-- Gift card section -->

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

            <div class="row fund-gift">
                <div class="col-sm-7">
                    <div class="data-banner">
                        <h1 class="banner-title"><?php  echo $gift->title; ?>
                            <a href="" class="banner-link">Edit gift details</a>
                        </h1>
                        <div class="banner-img">
                            <img src="<?php  echo $gift->img; ?>" class="img-responsive">
                        </div>
                        <div class="voucher">
                            <div class="col voucher-name">
                                <i class="fa fa-smile-o" aria-hidden="true"></i>
                                <span>
								<p>This gift is for</p>
								<h5><?php  echo $gift->receiver_name; ?></h5>
							</span>
                            </div>
                            <div class="col occasion">
                                <p>On the happy occasion of</p>
                                <h5>Wedding Anniversary</h5>
                            </div>
                            <div class="col share">
                                <i class="fa fa-share-alt" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="data-card dc">
                        <p class="dc-head">Gift fund details</p>
                        <div class="dc-subtitle">
                            <h3><?php  echo $fund->post_title; ?>
                                <a href="#" class="site-link"><?php  echo $fund->_fund_url; ?></a>
                            </h3>
                            <div><img src="<?php echo get_template_directory_uri(); ?>/img/axis.jpg" class="img-reponsive" width="40"></div>
                        </div>
                        <div class="dc-body">
                            <div class="age">
                                <span>Age group</span>
                                <h4>25 - 40 years</h4>
                            </div>
                            <div class="cat">
                                <span>Categories</span>
                                <h4>Bucket 1, Bucket 2</h4>
                            </div>
                        </div>
                        <div class="dc-footer">
                            <p><?php  echo $fund->post_content; ?></p>
                        </div>
                    </div>
                    <div class="data-card dc-gift">

                    </div>
                    <div class="data-card dc-days">

                    </div>
                </div>
            </div>

            <div class="row testimonial">
                <div class="col-sm-7"><?php  echo $gift->receiver_message; ?></div>
                <div class="col-sm-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui voluptatum totam, est voluptates, quis voluptate praesentium accusantium harum labore facilis esse nobis. Dolor eos eum minima harum placeat sunt explicabo.</div>
            </div>

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
                                        <span><b><?php echo $perms['recepients_count'] ?></b> Invitees</span>
                                        <!--
                                        If the current user is allowed to send-invites and recepients are more than 0, show the add button
                                        -->
                                        <?php  if($perms['current_user_can_send_invites'] && $perms['recepients_count'] > 0) : ?>
                                            <a href="#" class="add" data-toggle="modal" data-target="#add-email">Add</a>
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
                                        <button class="btn btn-default site-btn-2" data-toggle="modal" data-target="#add-email">Invite contributors</button>
                                    </div>

                                <?php  endif; ?>



                                <!--If user is allowed to seee invites and invitations have been sent
-->

                                <?php if($perms['current_user_can_view_invites'] && $perms['recepients_count'] > 0) : ?>
                                    <?php echo do_shortcode( '[gift_invites view-all-link=# limit=4 gift_id="'.$gift_id.'" status="1"]' ); ?>
                                <?php  endif; ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="contributors">contributors</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Add modal -->
        <div class="add-email modal fade" id="add-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Invite people to contribute</h4>
                        <p class="modal-caption">Invitation is sent by email</p>
                    </div>
                    <div class="modal-body">

                        <!--<div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Emails</label>
                            <div class="col-sm-10">
                                <input name="email" class="form-control" id="email-tags" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-10">
                                <textarea name="message" class="form-control" placeholder="Message" id="message" rows="5" required>[Default Message Template]</textarea>
                            </div>
                        </div>-->

                        <form id="invite">
                            <div class="form-group email-address">
                                <label for="email" class="control-label">Enter the email addresses seperated by comma</label>
                                <p class="label-msg">You can invite any number of people</p>
                                <input name="email" class="form-control" id="email-tags" placeholder="Email address" required>
                            </div>
                            <div class="form-group email-msg">
                                <p class="label-msg">A message to the contributors</p>
                                <textarea class="form-control" placeholder="Message" name="message" id="message" rows="5" required>Hi! Its Sarvesh's anniversary, Lets give him a gift that'll be really helpful for him in the future!</textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
                        <span>
	        	<button type="submit" id="queue-invites" class="btn btn-primary site-btn-2">Next</button>
<!--	        	<button type="submit" id="queue-invites" class="btn btn-primary site-btn-2" data-toggle="modal" data-load-url="#" data-target="#confirm-emails" data-dismiss="modal">Next</button>-->
	        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- List of Queued Emails   -->



        <div class="add-email modal fade"  id="confirm-emails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Invite people to contribute</h4>
                        <p class="modal-caption">Invitation is sent by email</p>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
                        <span>
<!--                <button type="submit" class="btn btn-default cancel" data-toggle="modal" data-load-url="#" data-target="#add-email" data-dismiss="modal">Back</button>-->
                <button type="submit" id="send-invites-prev" class="btn btn-default cancel">Back</button>
	        	<button type="submit" id="send-invites" class="btn btn-primary site-btn-2">Next</button>
<!--	        	<button type="submit" id="send-invites" class="btn btn-primary site-btn-2" data-toggle="modal" data-load-url="#" data-target="#confirmed-emails" data-dismiss="modal">Next</button>-->
	        </span>
                    </div>
                </div>
            </div>
        </div>

        <?php
        echo '<input type="hidden" name="invite_group" id="invite_group" value="" />';
        ?>


        <div class="add-email modal fade" id="confirmed-emails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Invite people to contribute</h4>
                        <p class="modal-caption">Invitation is sent by email</p>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default cancel">Cancel</button>
                        <span>
	        	<!-- <button type="submit" class="btn btn-default cancel">Back</button> -->
<!--	        	<button type="submit" class="btn btn-primary site-btn-2">Next</button>-->
	        </span>
                         <div class="done">
                            <button type="submit" id="finish-invites" class="btn btn-primary site-btn-2">Done</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Email settings modal -->
        <div class="change-email modal fade" id="change-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Update Contribution Settings</h4>
                    </div>
                    <div class="modal-body">
                        <form class="" id="settings">
                            <div class="settings">
                                <h6 class="settings-heading">Who can contribute to this gift?</h6>
                                <ul>
                                    <li>
                                        <label class="radio-inline">
                                            <input name="contribSetting" id="radio1" value="<?php echo Ajency_MFG_Gift::SETTING_CONTRIB_ONLY_ME; ?>" <?php echo Ajency_MFG_Gift::SETTING_CONTRIB_ONLY_ME == $gift->contrib_setting_id ? 'checked' : ''; ?> type="radio"> Only me (Private)
                                        </label>
                                    </li>
                                    <li>
                                        <label class="radio-inline select">
                                            <input disabled name="contribSetting" id="radio2" value="others" type="radio"> Other than me
                                        </label>
                                        <ul>
                                            <li>
                                                <label class="radio-inline">
                                                    <input name="contribSetting" id="radio1" value="<?php echo Ajency_MFG_Gift::SETTING_CONTRIB_SPECIFIC; ?>" <?php echo Ajency_MFG_Gift::SETTING_CONTRIB_SPECIFIC == $gift->contrib_setting_id ? 'checked' : ''; ?> type="radio" class="sub-option"> Specific People
                                                </label>
                                            </li>
                                            <li>
                                                <label class="radio-inline">
                                                    <input name="contribSetting" id="radio2" value="<?php echo Ajency_MFG_Gift::SETTING_CONTRIB_EVERYONE; ?>" <?php echo Ajency_MFG_Gift::SETTING_CONTRIB_EVERYONE == $gift->contrib_setting_id ? 'checked' : ''; ?> type="radio" class="sub-option"> Everyone (Public)
                                                </label>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>



                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default">Close</button>
                        <button type="submit" id="change-settings" class="btn btn-primary site-btn-2">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>