<?php get_header(); ?>

<?php
$gift_id = $_GET['gifts'];
$gift = Ajency_MFG_Gift::get_gift_details($gift_id, true);
$fund = $gift->fund;
print_r($fund);
$user_id = get_current_user_id();
?>
    <!-- Gift card section -->

    <section class="gift-card">

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
                        <h1 class="banner-title">Sarvesh's Anniversary Gift
                            <a href="" class="banner-link">Edit gift details</a>
                        </h1>
                        <div class="banner-img">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/gift-banner.png" class="img-responsive">
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
                    <div class="contrib-selector">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <div class="invitees">
                                    <a href="#invitees" aria-controls="invitees" role="tab" data-toggle="tab" class="tab-link">
                                        <span><b>8</b> Invitees</span>
                                        <?php  if(Ajency_MFG_Gift::get_acl_access_rule('gift',$gift_id,$user_id,'send-invites') == 1) : ?>
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

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="invitees">

                                <!-- only me setting -->

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


                                <!-- no-invitation -->

                                <!--If the user can send invites and ionvitations have not been sent before
                                -->

                                <?php $recepients = Ajency_MFG_Gift::get_invitations($gift_id,[Ajency_MFG_Gift::STATUS_INVITE_SENT,Ajency_MFG_Gift::STATUS_INVITE_SENT_USED,Ajency_MFG_Gift::STATUS_INVITE_USED]); ?>

                                <?php  if(Ajency_MFG_Gift::get_acl_access_rule('gift',$gift_id,$user_id,'send-invites') == 1 && count($recepients) == 0) : ?>

                                    <div class="no-invit">
                                        <p>You have not invited any contributors to this gift yet</p>
                                        <button class="btn btn-default site-btn-2" data-toggle="modal" data-target="#add-email">Invite contributors</button>
                                    </div>

                                <?php  endif; ?>



                                <!--                                //If invitations have been sent and the user can see invitiaions-->

                                <?php if(Ajency_MFG_Gift::get_acl_access_rule('gift',$gift_id,$user_id,'send-invites') == 1 && count($recepients) > 0) : ?>


                                    <!--<div class="invit-emails">
                                        <?php /*foreach ($recepients as $recepient) { */?>

                                            <div class="col">
                                                <span class="profile"><img src="<?php /*echo isset($recepient->pic) ? $recepient->pic : get_template_directory_uri().'/img/dummy.png'; */?>" class="img-responsive" width="50"></span>
                                                <span class="profile-info">
									<h5 class="name"><?php /*echo $recepient->display_name; */?> <span class="label"><?php /*echo $recepient->contributed; */?></span></h5>
									<a href="" class="email"><?php /*echo $recepient->email; */?></a>
									</span>
                                            </div>

                                        <?php /*} */?>
                                        <div class="col view-all">
                                            <a href="">View all</a>
                                        </div>
                                    </div>-->

                                    <?php echo do_shortcode( '[gift_invites gift_id="'.$gift_id.'" status="1,2,3"]' ); ?>

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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Email</h4>
                    </div>
                    <form class="form-horizontal" id="invite">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input name="email" class="form-control" id="email-tags" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message" class="col-sm-2 control-label">Message</label>
                                <div class="col-sm-10">
                                    <textarea name="message" class="form-control" placeholder="Message" id="message" rows="5" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>


                            <button type="submit" id="queue-invites" class="btn btn-primary site-btn-2" data-toggle="modal" data-load-url="/?queued-gift-invites=<?php echo $gift_id; ?>&modal=true" data-target="#confirm-emails" data-dismiss="modal">Save</button>

                            <!--                        <button type="submit" id="submit-invites" class="btn btn-primary site-btn-2">Save</button>-->
                        </div>
                    </form>

                </div>
            </div>
        </div>



        <!-- List of Queued Emails   -->


        <div class="add-email modal fade" id="confirm-emails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirm Invitations</h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="send-invites" id="send-invites" class="btn btn-primary site-btn-2">Send Invites</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email settings modal -->


        <div class="change-email modal fade" id="change-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Update Email Settings</h4>
                    </div>
                    <div class="modal-body">
                        <form class="" id="settings">

                            <?php
                            echo '<input type="hidden" name="change-settings-ajax-nonce" id="change-settings-ajax-nonce" value="' . wp_create_nonce( 'change-settings-ajax-nonce' ) . '" />';
                            ?>
                            <div class="settings">
                                <h6 class="settings-heading">Update your email settings</h6>
                                <ul>
                                    <li>
                                        <label class="radio-inline">
                                            <input name="contribSetting" id="radio1" value="<?php echo Ajency_MFG_Gift::SETTING_CONTRIB_ONLY_ME; ?>" <?php echo Ajency_MFG_Gift::SETTING_CONTRIB_ONLY_ME == $gift->contrib_setting_id ? 'checked' : ''; ?> type="radio"> Only me (Default)
                                        </label>
                                    </li>
                                    <li>
                                        <label class="radio-inline select">
                                            <input name="contribSetting" id="radio2" value="others" type="radio"> Other than me
                                        </label>
                                        <ul>
                                            <li>
                                                <label class="radio-inline">
                                                    <input name="contribSetting" id="radio1" value="<?php echo Ajency_MFG_Gift::SETTING_CONTRIB_SPECIFIC; ?>" <?php echo Ajency_MFG_Gift::SETTING_CONTRIB_SPECIFIC == $gift->contrib_setting_id ? 'checked' : ''; ?> type="radio" class="sub-option"> Specific
                                                </label>
                                            </li>
                                            <li>
                                                <label class="radio-inline">
                                                    <input name="contribSetting" id="radio2" value="<?php echo Ajency_MFG_Gift::SETTING_CONTRIB_EVERYONE; ?>" <?php echo Ajency_MFG_Gift::SETTING_CONTRIB_EVERYONE == $gift->contrib_setting_id ? 'checked' : ''; ?> type="radio" class="sub-option"> Everyone
                                                </label>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>



                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="change-settings" class="btn btn-primary site-btn-2">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <script>



            //twitter bootstrap script


        </script>





    </section>

<?php get_footer(); ?>