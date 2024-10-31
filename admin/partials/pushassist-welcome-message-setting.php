<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://pushassist.com/
 * @since      2.2.2
 *
 * @package    Pushassist
 * @subpackage Pushassist/admin/partials
 */
?>

<div class="container-fluid pt-25">

    <div class="row mb-15">
        <div class="ml-5">
			<?php 
				if(isset($_REQUEST['response_message'])){
			?>
			<div class="alert alert-<?php echo esc_attr($_REQUEST['class']);?> alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php if($_REQUEST['response_message'] == 't'){echo esc_html("Setting save succssfully.");}else{echo esc_html("Oop`s something went wrong, Please try again.");} ?>
			</div>
			<?php 
				}
			?>
            <h5 class="txt-dark"><?php _e('Welcome Notification Setting', 'push-notification-for-wp-by-pushassist'); ?></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN VALIDATION STATES-->
            <div class="panel panel-default card-view">

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <!-- BEGIN FORM-->
                        <form action="admin.php?page=pushassist-welcome-message-setting" enctype="multipart/form-data" id="pushassist_welcome_setting_form" name="pushassist_welcome_setting_form"
                              class="form-horizontal" method="post"
                              autocomplete="off">
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Title', 'push-notification-for-wp-by-pushassist'); ?> <span class="required"> * </span></label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" placeholder="<?php _e('Title', 'push-notification-for-wp-by-pushassist'); ?>" class="form-control" id="pushassist_welcome_title" name="pushassist_welcome_title" value="<?php echo $welcome_message_text['title']; ?>" maxlength="78" required/></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Message', 'push-notification-for-wp-by-pushassist'); ?> <span class="required"> * </span> </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" placeholder="<?php _e('Message', 'push-notification-for-wp-by-pushassist'); ?>" class="form-control" id="pushassist_welcome_message" name="pushassist_welcome_message" value="<?php echo $welcome_message_text['message']; ?>"
                                                   maxlength="138" required/></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('URL', 'push-notification-for-wp-by-pushassist'); ?> 
										<span class="required"> * </span>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="url" placeholder="<?php _e('URL', 'push-notification-for-wp-by-pushassist'); ?>" class="form-control" id="pushassist_welcome_url" name="pushassist_welcome_url" value="<?php echo $url; ?>" required/></div>
                                    </div>
                                </div>
								
								<!--div class="form-group mb-0">
                                    <label class="control-label col-md-3"><?php //_e('Welcome Logo', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                    <div class="col-md-8">
                                        <div class="fileupload btn btn-info btn-anim">
                                            <i class="fa fa-upload"></i><span class="btn-text"><?php //_e('Upload Logo', 'push-notification-for-wp-by-pushassist'); ?></span>
                                            <input id="fileupload" type="file" name="pushassist_welcome_fileupload"
                                                   class="upload">
                                        </div>
                                        <span class="help-block"><?php //_e('Minimum 256x256px.', 'push-notification-for-wp-by-pushassist'); ?></span>
                                    </div>
                                </div-->
								
								<div class="row">
                                    <label class="control-label col-md-3"><?php _e('Add UTM Parameters', 'push-notification-for-wp-by-pushassist'); ?></label>
                                    <div class="col-md-8">
                                        <input value="1" name="pushassist_welcome_is_utm_show" id="pushassist_welcome_is_utm_show" type="checkbox" class="js-switch js-switch-1" data-size="small" data-color="#469408" data-secondary-color="#dc4666" <?php checked(stripslashes_deep($is_checked), 1);?>>
                                        <input type="hidden" id="pushassist_is_action_button" name="pushassist_is_action_button" value="<?php echo $action_button;?>">

                                    </div>
                                </div>

                                <div id="pushassist_welcome_utm_parameter_div" style="display:<?php if($is_checked){?>block<?php }else{?>none<?php }?>;">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('UTM Source', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">

                                                <input type="text" class="form-control"
                                                       id="pushassist_welcome_utm_source"
                                                       value="<?php echo $utm_source;?>"
                                                       name="pushassist_welcome_utm_source" maxlength="45"
                                                       required/>
                                            </div>
                                        <span class="custom-label label-default" data-toggle="tooltip"
                                              data-placement="right" title="Limit 45 Characters"
                                              data-original-title="Limit 45 Characters">?</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('UTM Medium', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" class="form-control"
                                                       id="pushassist_welcome_utm_medium"
                                                       value="<?php echo $utm_medium;?>"
                                                       name="pushassist_welcome_utm_medium" maxlength="73"
                                                       required/>
                                            </div>
                                        <span class="custom-label label-default" data-toggle="tooltip"
                                              data-placement="right" title="Limit 73 Characters"
                                              data-original-title="Limit 73 Characters">?</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('UTM Campaign', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" class="form-control"
                                                       id="pushassist_welcome_utm_campaign"
                                                       value="<?php echo $utm_campaign;?>"
                                                       name="pushassist_welcome_utm_campaign" maxlength="500"
                                                       required/>
                                            </div>
                                        <span class="custom-label label-default" data-toggle="tooltip"
                                              data-placement="right" title="Limit 500 Characters"
                                              data-original-title="Limit 500 Characters">?</span>
                                        </div>
                                    </div>
                                </div>
								
								<?php
									$button_display_1 = 'none';
									$button_display_2 = 'none';
									
									if($action_button == 1){
										$button_display_1 = 'block';
									}
									
									if($action_button == 3){
										$button_display_1 = 'block';
										$button_display_2 = 'block';
									}
								?>
								
								<div id="button_wrapper_1" style="display:<?php echo $button_display_1;?>;">

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('Action Name 1', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" class="form-control"
                                                       id="pushassist_welcome_button_txt_1"
                                                       value="<?php _e('Action Name 1', 'push-notification-for-wp-by-pushassist'); ?>"
                                                       name="pushassist_welcome_button_txt_1" maxlength="20"/>
                                            </div>
                                        <span class="custom-label label-default" data-toggle="tooltip"
                                              data-placement="right" title="Limit 20 Characters"
                                              data-original-title="Limit 20 Characters">?</span>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('Action URL 1', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" class="form-control"
                                                       id="pushassist_welcome_url_1"
                                                       value="<?php _e('Action URL 1', 'push-notification-for-wp-by-pushassist'); ?>"
                                                       name="pushassist_welcome_url_1"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="button_wrapper_2" style="display:<?php echo $button_display_2;?>;">

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('Action Name 2', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" class="form-control"
                                                       id="pushassist_welcome_button_txt_2"
                                                       value="<?php _e('Action Name 2', 'push-notification-for-wp-by-pushassist'); ?>"
                                                       name="pushassist_welcome_button_txt_2" maxlength="20"/>
                                            </div>
                                        <span class="custom-label label-default" data-toggle="tooltip"
                                              data-placement="right" title="Limit 20 Characters"
                                              data-original-title="Limit 20 Characters">?</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('Action URL 2', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">

                                                <input type="text" class="form-control"
                                                       id="pushassist_welcome_url_2"
                                                       value="<?php _e('Action URL 2', 'push-notification-for-wp-by-pushassist'); ?>"
                                                       name="pushassist_welcome_url_2"/>
                                            </div>
                                        </div>
                                    </div>

                                </div>
								
								<div class="form-group">

                                    <div class="col-lg-offset-9 col-lg-3 col-md-offset-8 col-md-4 float-r">
                                        <button type="button"
                                                class="btn btn-success btn-icon-anim btn-square ml-5 mr-10"
                                                id="addButton" data-toggle="tooltip" data-placement="top"
                                                title="Add Actionable Buttons"
                                                data-original-title="Add Actionable Buttons">
                                            <i class="icon-plus"></i></button>

                                        <button type="button" class="btn btn-danger btn-icon-anim btn-square"
                                                id="removeButton" data-toggle="tooltip" data-placement="top"
                                                title="Remove Actionable Buttons"
                                                data-original-title="Remove Actionable Buttons"><i
                                                class="icon-close"></i>
                                        </button>
                                    </div>

                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-5">
                                        <button type="submit" class="btn btn-success btn-anim mr-10" name="psa-welcome-msg-setting"><i
                                                class="icon-rocket"></i><span class="btn-text"><?php _e('Save Settings', 'push-notification-for-wp-by-pushassist'); ?></span></button>

                                        <a href="admin.php?page=pushassist-setting" class="btn btn-default btn-anim mr-10"><i
                                                class="icon icon-action-undo"></i><span class="btn-text"><?php _e('Back', 'push-notification-for-wp-by-pushassist'); ?></span></a>

                                    </div>

                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>

        <div class="col-md-6">
            <div class="dummy-notification panel panel-default card-view">

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="tab-struct custom-tab-1">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab"
                                                                          role="tab"
                                                                          href="#desktop_div"><?php _e('Desktop', 'push-notification-for-wp-by-pushassist'); ?></a></li>
                                <li role="presentation" class=""><a data-toggle="tab" role="tab" href="#mobile_div"
                                                                    aria-expanded="false"><?php _e('Mobile', 'push-notification-for-wp-by-pushassist'); ?></a></li>
                            </ul>
                            <div class="content-wrapper tab-content mt-20">
                                <div id="desktop_div" class="tab-pane fade active in desktop_div" role="tabpanel">
                                    <div class="widget1 shadow dummy-notification-inner-wrapper pull-right msg_box">
                                        <div class="wrapper">

                                            <div class="">

                                                <div class="col-sm-3 msg_img">
                                                    <div class="img_wrapper1">

                                                        <img id="logo" src="<?php echo $welcome_message_text['site_image']; ?>"
                                                             class="img-responsive">

                                                    </div>
                                                </div>

                                                <div class="col-sm-9 padd-r">
                                                    <div class="msg_text msg_title" id="notification_title">
                                                        <?php echo $welcome_message_text['title']; ?>
                                                    </div>

                                                    <div class="msg_text msg_message" id="notification_message">
                                                        <?php echo $welcome_message_text['message']; ?>
                                                    </div>

                                                    <div class="msg_text msg_desc" id="sub_domain_txt">

                                                        <?php
                                                        if ($welcome_message_text['ssl'] == 1) {
                                                            echo str_replace("https://", "", $welcome_message_text['url']);
                                                        } else {
                                                            echo $welcome_message_text['account_name'] . '.pushassist.com';
                                                        }
                                                        ?>

                                                    </div>
                                                </div>

                                                <div class="text_wrapper cat_border">
                                                    <!--<div class="big_img" id="big_img_div" style="display: block;">
                                                        <img id="big_img" src="images/bs-background.png">
                                                    </div>-->
                                                    <div class="border_top" id="action_1" style="display:<?php echo $button_display_1;?>;">
                                                        <div class="img_box_1" id="img_box_1" style="display: none;">
                                                            <img
                                                                id="action_icon_img_1" src=""></div>
                                                        <div class="add" id="notification_button_1">
                                                            <?php _e('Action Name 1', 'push-notification-for-wp-by-pushassist'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="border_top" id="action_2" style="display:<?php echo $button_display_2;?>;">
                                                        <div class="img_box_2" id="img_box_2" style="display: none;">
                                                            <img
                                                                id="action_icon_img_2" src=""></div>
                                                        <div class="add" id="notification_button_2">
                                                            <?php _e('Action Name 2', 'push-notification-for-wp-by-pushassist'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="mobile_div" class="tab-pane fade mobile_div" role="tabpanel">
                                    <div class="widget2">
                                        <div class="wrapper2">
                                            <div class="col-sm-3 msg_img2">

                                                <img id="mobile_logo" src="<?php echo $welcome_message_text['site_image']; ?>"
                                                     class="img-responsive">

                                            </div>
                                            <div class="col-sm-9">
                                                <div class="text_wrapper2 pull-left">
                                                    <div class="title2">
                                                        <div class="title_txt pull-left msg_title"
                                                             id="mobile_welcome_title">
                                                            <?php echo $welcome_message_text['title']; ?>
                                                        </div>
                                                    </div>

                                                    <div class="message2 msg_message" id="mobile_welcome_message">
                                                        <?php echo $welcome_message_text['message']; ?>
                                                    </div>

                                                    <div class="message2 msg_desc" id="mobile_subdomain">
                                                        <?php
                                                        if ($welcome_message_text['ssl'] == 1) {
                                                            echo str_replace("https://", "", $welcome_message_text['url']);
                                                        } else {
                                                            echo $welcome_message_text['account_name'] . '.pushassist.com';
                                                        }
                                                        ?>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="cat_div2 clearfix">
                                                <div class="action_box" id="mobile_action_1" style="display:<?php echo $button_display_1;?>;">
                                                    <div class="img_box" id="mobile_img_box_1" style="display: none;">
                                                        <img src="" id="mobile_action_icon_img_1">
                                                    </div>
                                                    <div class="add2" id="mobile_welcome_button_1"><?php _e('Action Name 1', 'push-notification-for-wp-by-pushassist'); ?>
                                                    </div>
                                                </div>
                                                <div class="action_box" id="mobile_action_2" style="display:<?php echo $button_display_2;?>;">
                                                    <div class="img_box" id="mobile_img_box_2" style="display: none;">
                                                        <img src="" id="mobile_action_icon_img_2">
                                                    </div>
                                                    <div class="add2" id="mobile_welcome_button_2"><?php _e('Action Name 2', 'push-notification-for-wp-by-pushassist'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo '../wp-content/plugins/push-notification-for-wp-by-pushassist/admin/js/switchery.min.js';?>"></script>

<script language="javascript">

	/* Switchery Init*/
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    jQuery('.js-switch-1').each(function () {
        new Switchery(jQuery(this)[0], jQuery(this).data());
    });
	
	jQuery("#pushassist_welcome_is_utm_show").on('change', function () {

        if (jQuery('#pushassist_welcome_is_utm_show').is(':checked')) {

            jQuery('#pushassist_welcome_is_utm_show').val(1);
            jQuery('#pushassist_welcome_utm_parameter_div').show('slow');
          
        } else {

            jQuery('#pushassist_welcome_is_utm_show').val(0);
            jQuery('#pushassist_welcome_utm_parameter_div').hide('slow');            
        }
    });
	
    jQuery("#pushassist_welcome_title").keyup(function () {

        title = jQuery('#pushassist_welcome_title').val();

        if (title !== "") {
            jQuery('#notification_title').text(title);
            jQuery('#mobile_welcome_title').text(title);
        } else {
            jQuery('#notification_title').text('<?php _e("Welcome Title", "push-notification-for-wp-by-pushassist");?>');
            jQuery('#mobile_welcome_title').text('<?php _e("Welcome Title", "push-notification-for-wp-by-pushassist");?>');
        }
    });

    jQuery("#pushassist_welcome_message").keyup(function () {

        message = jQuery('#pushassist_welcome_message').val();

        if (message !== "") {
            jQuery('#notification_message').text(message);
            jQuery('#mobile_welcome_message').text(message);
        } else {
            jQuery('#notification_message').text('<?php _e("Welcome Message", "push-notification-for-wp-by-pushassist");?>');
            jQuery('#mobile_welcome_message').text('<?php _e("Welcome Message", "push-notification-for-wp-by-pushassist");?>');
        }
    });

    jQuery("#pushassist_welcome_title").blur(function () {

        title = jQuery('#pushassist_welcome_title').val();

        if (title !== "") {
            jQuery('#notification_title').text(title);
            jQuery('#mobile_welcome_title').text(title);
        } else {
            jQuery('#notification_title').text('<?php _e("Welcome Title", "push-notification-for-wp-by-pushassist");?>');
            jQuery('#mobile_welcome_title').text('<?php _e("Welcome Title", "push-notification-for-wp-by-pushassist");?>');
        }
    });

    jQuery("#pushassist_welcome_message").blur(function () {

        message = jQuery('#pushassist_welcome_message').val();

        if (message !== "") {
            jQuery('#notification_message').text(message);
        } else {
            jQuery('#notification_message').text('<?php _e("Welcome Message", "push-notification-for-wp-by-pushassist");?>');
        }
    });
	
	/*  create dynamic button start */

    var counter = <?php if(isset($action_button)){ echo $action_button; }else{ echo 1; }?>

    jQuery("#addButton").click(function () {

        if (counter > 2) {
            return false;
        }

        if (counter === 1) {

            jQuery('#pushassist_is_action_button').val(1);

            jQuery('#button_wrapper_1').show();
            jQuery('#action_1').show();
            jQuery('#mobile_action_1').show();
        }

        if (counter === 2) {

            jQuery('#pushassist_is_action_button').val(2);

            jQuery('#button_wrapper_2').show();
            jQuery('#action_2').show();
            jQuery('#mobile_action_2').show();
        }

        counter++;
    });

    jQuery("#removeButton").click(function () {

        if (counter === 1) {
            return false;
        }

        if (counter === 2) {

            jQuery('#pushassist_is_action_button').val(0);

            jQuery('#button_wrapper_1').hide();
            jQuery('#action_1').hide();
            jQuery('#mobile_action_1').hide();
        }

        if (counter === 3) {

            jQuery('#pushassist_is_action_button').val(1);

            jQuery('#button_wrapper_2').hide();
            jQuery('#action_2').hide();
            jQuery('#mobile_action_2').hide();
        }

        counter--;
    });

    /*  create dynamic button end */

</script>