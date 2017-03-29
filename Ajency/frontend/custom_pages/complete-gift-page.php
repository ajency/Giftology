<?php
if( !defined( 'ABSPATH' ) ) exit;
?>
<?php get_header(); ?>

<?php

if(is_user_logged_in()){

    $gift_id = $_GET['update-gift'];
    $gift = Ajency_MFG_Gift::get_gift_details($gift_id,true);
    $fund = $gift->fund;

    if($gift->created_by == get_current_user_id()) {

        ?>

        <?php
        echo '<input type="hidden" name="gift_id" id="gift_id" value="' . $gift_id . '" />';
        ?>


        <section class="gift-card single-bg">

        <div class="container">
            <!-- breadcrums -->
            <div class="row breadcrums">
                <div class="col-sm-12">
                    <ul class="steps">
                        <li><a href="">Home</a></li>
                        <li>/</li>
                        <li><a href="">Create a Gift</a></li>
                    </ul>
                </div>
            </div>

            <!-- owner info -->



            <div class="row m-t-1">
                <div class="col-sm-7">
                    <div class="gift-owner">
                        <div class="name-box">
                            <h1 class="owner-name">Hi <?php echo wp_get_current_user()->first_name; ?>!</h1>
                            <p class="caption">From the details you filled in the popup, we know that...</p>
                            <div class="voucher">
                                <div class="col voucher-name">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/smiley-dark.png" class="img-responsive center-block">
                                    <span>
									<p>This gift is for</p>
									<h5><?php echo $gift->receiver_name ?></h5>
								</span>
                                </div>
                                <div class="col occasion">
                                    <p>On the happy occasion of</p>
                                    <h5><?php echo $gift->receiver_occasion ?></h5>
                                </div>
                                <div class="col share">
                                    <!-- <i class="fa fa-share-alt" aria-hidden="true"></i> -->
                                </div>
                            </div>
                        </div>
                        <div class="gift-note">
                            <h6 class="title">please note</h6>
                            <p class="data">The minimum amount to be contributed by you for this gift to be ready is <b>Rs. <?php echo $fund->_fund_min_investment; ?>.</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="data-card dc">
                        <p class="dc-head">Selected gift fund details</p>
                        <div class="dc-subtitle">
                            <h3><?php echo $fund->post_title; ?>
                                <a href="#" class="site-link">axismf.com</a>
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
                            <p><?php echo $fund->post_content; ?> <a href="" class="more">More details</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gift data -->

            <div class="row">
                <div class="col-sm-7">


                    <form id="update-gift1">

                    <div class="gift-name width-box">
                        <label class="input-label required">What do you want to call this gift?</label>
                        <input name="title" type="text" class="input-box name-text" placeholder="Name this gift">
                    </div>
                    <!-- <div class="cover width-box">
                        <label class="input-label required">Add a cover image to this gift</label>
                        <p class="label-caption">You can choose from our collection or upload your own</p>
                    </div> -->
                    <div class="choose-templ width-box">
                        <label class="input-label required">We have 3 page templates for you to choose from</label>
                        <p class="label-caption">You can preview before finalising any</p>
                    </div>
                    <div class="template">
                        <div class="col">
                            <div class="template__cover">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/template-1.png" class="img-responsive center-block">
                                <div class="overlay"></div>
                            </div>
                            <h2 class="template__name">The Bohemian Rapshody</h2>
                            <p class="template__number">Template 01</p>
                        </div>
                        <div class="col">
                            <div class="template__cover">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/template-1.png" class="img-responsive center-block">
                                <div class="overlay"></div>
                            </div>
                            <h2 class="template__name">The Blue Danube</h2>
                            <p class="template__number">Template 02</p>
                        </div>
                        <div class="col">
                            <div class="template__cover">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/template-1.png" class="img-responsive center-block">
                                <div class="overlay"></div>
                            </div>
                            <h2 class="template__name">Moonlight Sonata</h2>
                            <p class="template__number">Template 03</p>
                        </div>
                    </div>
                    <div class="send-details width-box">
                        <div class="contact-info">
                            <div class="data">
                                <label class="input-label required">Some details about Sarvesh </label>
                                <div class="cols">
                                    <input  name="receiver_email" type="email" class="input-box name-text email-text m-r-1" placeholder="Email address">
                                    <input name="receiver_mobile" type="number" class="input-box name-text" placeholder="Mobile number">
                                </div>
                            </div>
                        </div>
                        <div class="msg-info">
                            <label class="input-label required">Type a message for Sarvesh</label>
                            <p class="label-caption">Sarvesh will see this when he receives the gift <a href="#" class="underline" data-toggle="modal" data-target="#template-modal">Choose from a template</a></p>
                            <textarea name="receiver_message" rows="4" class="input-box" placeholder="A nice message that will bring a smile to the recipient's face..."></textarea>
                        </div>
                    </div>

                    <div class="contribute width-box">
                        <div class="option">
                            <label class="input-label required">Would you like others to contribute to this gift?</label>
                            <div class="radio-option">
                                <label>
                                    <input type="radio" name="contrib_setting_id" value="2" class="input-radio">
                                    <span>Yes, I want others to contribute</span>
                                </label>
                                <label>
                                    <input type="radio" name="contrib_setting_id" value="1" class="input-radio">
                                    <span>No i don't</span>
                                </label>
                            </div>
                        </div>
                        <div class="option">
                            <label class="input-label">A note for the contributors</label>
                            <p class="label-caption">This note will be visible to the contributors when they land on the gift page</p>
                            <textarea name="contributors_note" rows="4" class="input-box" placeholder="A nice message that will encourage the conributors to contribute..."></textarea>
                        </div>
                        <div class="option">
                            <label class="input-label required">When do you want the gift to be sent?</label>
                            <div class="radio-option align-top">
                                <label class="s-label">
                                    <input name="send_type" type="radio" value="1" class="input-radio">
                                    <span>Send now</span>
                                </label>
                                <label class="s-label schedule">
                                    <div class="flex-col">
                                        <input  name="send_type" type="radio" value="2" class="input-radio schedule-trigger">
                                        <span>Schedule to send</span>
                                    </div>
                                    <input type="date" class="input-box date-field">
                                </label>
                            </div>
                        </div>
                    </div>


                    </form>


            <div class="send-actions">
<!--                        <button type="button" class="btn btn-default cancel">Cancel</button>-->
                        <div class="group">
                            <button type="button" id="update-gift" class="btn btn-default site-btn-2">Contribute</button>
                        </div>
                    </div>

                </div>
                <div class="col-sm-5">

                    <div class="section-number affix">
                        <ul class="points">
                            <li class="first active">
                                <h6 class="number">01</h6>
                                <span class="caption">Design &amp; details</span>
                            </li>
                            <li class="second">
                                <h6 class="number">02</h6>
                                <span class="caption">Sarvesh's details</span>
                            </li>
                            <li class="third">
                                <h6 class="number">03</h6>
                                <span class="caption">Contributors</span>
                            </li>
                        </ul>
<!--                        <div class="save-changes">
                            <p class="title">Make sure to save your changes regularly</p>
                            <button type="button" class="btn btn-default site-btn save-draft">Save as draft</button>
                        </div>-->
                    </div>

                </div>
            </div>


            <!-- Template selection -->

            <div class="template-modal modal fade" id="template-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Choose a message template</h4>
                            <p class="modal-caption">You can edit the template once you select a template</p>
                        </div>
                        <div class="modal-body">
                            <div class="templates">
                                <div class="read-more">
                                    <div class="keywords">
                                        <input type="radio" class="radio-select" name="temp-select">
                                        <span class="string">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium deserunt accusamus molestias eum aperiam quos.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium deserunt accusamus molestias eum aperiam quos.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium deserunt accusamus molestias eum aperiam quos.</span>
                                    </div>
                                    <div class="count">
                                        <b class="number">134</b> Words
                                    </div>
                                </div>
                                <hr>
                                <div class="read-more">
                                    <div class="keywords">
                                        <input type="radio" class="radio-select" name="temp-select">
                                        <span class="string">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium deserunt accusamus molestias eum aperiam quos.</span>
                                    </div>
                                    <div class="count">
                                        <b class="number">134</b> Words
                                    </div>
                                </div>
                                <hr>
                                <div class="read-more">
                                    <div class="keywords">
                                        <input type="radio" class="radio-select" name="temp-select">
                                        <span class="string">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur animi quos quis natus repudiandae aliquam cum. Magni aliquid natus modi praesentium voluptates, autem eius, odit blanditiis non porro cum, doloribus.</span>
                                    </div>
                                    <div class="count">
                                        <b class="number">134</b> Words
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <span class="select-msg">Select a template to proceed</span>
                            <button type="submit" class="btn btn-primary site-btn-2 disabled">Done</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </section>

    <?php
    } else {
        //throw access denied - TODO
    }

} else {

    print "The complete gift form will come here, User Logged out";

    Ajency_MFG_Users::popup_login_form();
}

?>

<?php get_footer(); ?>