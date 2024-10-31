<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://pushassist.com/
 * @since      3.0.8
 *
 * @package    Pushassist
 * @subpackage Pushassist/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="container-fluid pt-25">

    <div class="row mb-15">
        <div class="ml-5">
		<?php 
				if(isset($_REQUEST['response_message'])){
			?>
			<div class="alert alert-<?php echo esc_attr($_REQUEST['class']);?> alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php if($_REQUEST['response_message'] == 't'){echo esc_html("Notification sent succssfully.");}else{echo esc_html("Oop`s something went wrong, Please try again.");} ?>
			</div>
			<?php 
				}
			?>
            <h5 class="txt-dark"><?php _e('New Notification', 'push-notification-for-wp-by-pushassist'); ?></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN VALIDATION STATES-->
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <!-- BEGIN FORM-->
                        <form action="admin.php?page=pushassist-send-notifications" enctype="multipart/form-data"
                              id="send_notification_form" name="send_notification_form" class="form-horizontal"
                              method="post">
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Notification Title', 'push-notification-for-wp-by-pushassist'); ?> <span
                                            class="required"> * </span>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" id="pushassist_notification_title"
                                                   name="pushassist_notification_title" required maxlength="77"/></div>
                                    <span class="custom-label label-default" data-toggle="tooltip"
                                          data-placement="right" title="Limit 77 Characters"
                                          data-original-title="Limit 77 Characters">?</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Notification Message', 'push-notification-for-wp-by-pushassist'); ?><span
                                            class="required"> * </span>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                        <textarea class="form-control" id="pushassist_notification_message"
                                                  name="pushassist_notification_message" required
                                                  maxlength="138"></textarea></div>
                                    <span class="custom-label label-default" data-toggle="tooltip"
                                          data-placement="right" title="Limit 138 Characters"
                                          data-original-title="Limit 138 Characters">?</span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"><?php _e('Notification URL', 'push-notification-for-wp-by-pushassist'); ?>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="url" class="form-control" id="pushassist_notification_url"
                                                   name="pushassist_notification_url"/>
                                        </div>
                                    <span class="custom-label label-default" data-toggle="tooltip"
                                          data-placement="right" title="e.g: http://www.demo.com or http://demo.com"
                                          data-original-title="e.g: http://www.demo.com or http://demo.com">?</span>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <label class="control-label col-md-3"><?php _e('Notification Logo', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                    <div class="col-md-8">
                                        <div class="fileupload btn btn-info btn-anim">
                                            <i class="fa fa-upload"></i><span class="btn-text"><?php _e('Upload Logo', 'push-notification-for-wp-by-pushassist'); ?></span>
                                            <input id="fileupload" type="file" name="pushassist_notification_fileupload"
                                                   class="upload">
                                        </div>
                                        <span class="help-block"><?php _e('Minimum 256x256px.', 'push-notification-for-wp-by-pushassist'); ?></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="control-label col-md-3"><?php _e('Send as big image', 'push-notification-for-wp-by-pushassist'); ?></label>
                                    <div class="col-md-8">
                                        <input value="1" name="pushassist_is_big_image" id="pushassist_is_big_image" type="checkbox"
                                               class="js-switch js-switch-1" data-size="small" data-color="#469408"
                                               data-secondary-color="#dc4666">
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="control-label col-md-3"><?php _e('Add UTM Parameters', 'push-notification-for-wp-by-pushassist'); ?></label>
                                    <div class="col-md-8">
                                        <input value="0" name="pushassist_notification_is_utm_show"
                                               id="pushassist_notification_is_utm_show" type="checkbox"
                                               class="js-switch js-switch-1" data-size="small" data-color="#469408"
                                               data-secondary-color="#dc4666">
                                        <input type="hidden" id="pushassist_is_action_button" name="pushassist_is_action_button" value="0">

                                    </div>
                                </div>

                                <div id="pushassist_notification_utm_parameter_div" style="display: none;">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('UTM Source', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">

                                                <input type="text" class="form-control"
                                                       id="pushassist_notification_utm_source"
                                                       value="pushassist"
                                                       name="pushassist_notification_utm_source" maxlength="45"
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
                                                       id="pushassist_notification_utm_medium"
                                                       value="pushassist_notification"
                                                       name="pushassist_notification_utm_medium" maxlength="73"
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
                                                       id="pushassist_notification_utm_campaign"
                                                       value="pushassist"
                                                       name="pushassist_notification_utm_campaign" maxlength="500"
                                                       required/>
                                            </div>
                                        <span class="custom-label label-default" data-toggle="tooltip"
                                              data-placement="right" title="Limit 500 Characters"
                                              data-original-title="Limit 500 Characters">?</span>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($extra_details['segments']) { ?>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('Segments', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        <div class="col-md-8">
                                            <select class="form-control select2"
                                                    name="pushassist_notification_segment[]"
                                                    id="pushassist_notification_segment" multiple>

                                                <?php
                                                foreach ($extra_details['segments'] as $row) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                <?php }


                                if ($extra_details['country_list']) {
                                    ?>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('Countries', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        <div class="col-md-8">
                                            <select class="form-control select2"
                                                    name="pushassist_notification_countries[]"
                                                    id="pushassist_notification_countries"
                                                    multiple>


                                                <?php
                                                foreach ($extra_details['country_list'] as $row) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3"><?php _e('Browsers Types', 'push-notification-for-wp-by-pushassist'); ?></label>
                                    <div class="col-md-8">
                                        <select class="form-control select2" name="pushassist_notification_browsers[]"
                                                id="pushassist_notification_browsers"
                                                multiple>

                                            <option value="Chrome">Chrome</option>
                                            <option value="Firefox">Firefox</option>
                                            <option value="Safari">Safari</option>
                                            <option value="Opera">Opera</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"><?php _e('Device Types', 'push-notification-for-wp-by-pushassist'); ?></label>
                                    <div class="col-md-8">
                                        <select class="form-control select2" name="pushassist_notification_devices[]"
                                                id="pushassist_notification_devices"
                                                multiple>
                                            <option value="0">Desktop</option>
                                            <option value="1">Mobile</option>
                                        </select>
                                    </div>
                                </div>

                                <?php if ($extra_details['os_list']) { ?>

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('OS', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        <div class="col-md-8">
                                            <select class="form-control select2"
                                                    name="pushassist_notification_os_users[]"
                                                    id="pushassist_notification_os_users"
                                                    multiple>

                                                <?php
                                                foreach ($extra_details['os_list'] as $row) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row['os_name']; ?>"><?php echo $row['os_name']; ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                <?php } ?>

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Expire In', 'push-notification-for-wp-by-pushassist'); ?></label>
                                    <div class="col-md-5">
                                        <div class="input-icon right">
                                            <select class="form-control select2"
                                                    name="pushassist_notification_ttl"
                                                    id="pushassist_notification_ttl">


                                                <?php
                                                foreach ($notification_ttl as $key => $value) {

                                                    if ($key == 259200) {

                                                        ?>
                                                        <option selected
                                                                value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                        <?php
                                                    } else { ?>

                                                        <option
                                                            value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                <span class="custom-label label-default" data-toggle="tooltip" data-placement="right"
                                      title="The notification will expire if the device remains offline for these number of seconds.. (The default value is 1 week)"
                                      data-original-title="The notification will expire if the device remains offline for these number of seconds. (The default value is 3 days)">?</span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Notification Priority', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                    <div class="col-md-8">
                                        <div class="radio radio-success">
                                            <input type="radio" name="pushassist_notification_priority"
                                                   id="pushassist_notification_high_priority"
                                                   value="high">
                                            <label for="high_priority" class="mr-35"> <?php _e('High', 'push-notification-for-wp-by-pushassist'); ?> </label>

                                            <input type="radio" name="pushassist_notification_priority"
                                                   id="pushassist_notification_normal_priority"
                                                   checked
                                                   value="normal">
                                            <label for="high_priority"> <?php _e('Normal', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                        </div>
                                    </div>
                                </div>

								<input type="hidden" name="pushassist_notification_alert_type" id="pushassist_notification_alert_type" value="0">
                               
                                <div id="button_wrapper_1" style="display: none;">

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('Action Name 1', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" class="form-control"
                                                       id="pushassist_notification_button_txt_1"
                                                       value="<?php _e('Action Name 1', 'push-notification-for-wp-by-pushassist'); ?>"
                                                       name="pushassist_notification_button_txt_1" maxlength="20"/>
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
                                                       id="pushassist_notification_url_1"
                                                       value="<?php _e('Action URL 1', 'push-notification-for-wp-by-pushassist'); ?>"
                                                       name="pushassist_notification_url_1"/>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div id="button_wrapper_2" style="display: none;">

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('Action Name 2', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" class="form-control"
                                                       id="pushassist_notification_button_txt_2"
                                                       value="<?php _e('Action Name 2', 'push-notification-for-wp-by-pushassist'); ?>"
                                                       name="pushassist_notification_button_txt_2" maxlength="20"/>
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
                                                       id="pushassist_notification_url_2"
                                                       value="<?php _e('Action URL 2', 'push-notification-for-wp-by-pushassist'); ?>"
                                                       name="pushassist_notification_url_2"/>
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

                            <div class="form-actions" id="action_div">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-success btn-anim mr-10">
                                            <i class="icon-rocket"></i><span
                                                class="btn-text"> &nbsp; <?php _e('Send', 'push-notification-for-wp-by-pushassist'); ?> &nbsp;</span>
                                        </button>
										<a href="admin.php?page=pushassist-sent-notification-details" class="btn btn-default btn-anim mr-10"><i
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

                                                        <img id="logo"
                                                             src="<?php echo $account_details['site_image']; ?>"
                                                             class="img-responsive">

                                                    </div>
                                                </div>

                                                <div class="col-sm-9 padd-r">
                                                    <div class="msg_text msg_title" id="pushassist_preview_notification_title">
                                                        <?php _e('Notification Title', 'push-notification-for-wp-by-pushassist'); ?>
                                                    </div>

                                                    <div class="msg_text msg_message" id="pushassist_preview_notification_message">
                                                        <?php _e('Notification Message', 'push-notification-for-wp-by-pushassist'); ?>
                                                    </div>

                                                    <div class="msg_text msg_desc" id="sub_domain_txt">

                                                        <?php
                                                        if ($account_details['ssl'] == 1) {
                                                            echo str_replace("https://", "", $account_details['url']);
                                                        } else {
                                                            echo $account_details['account_name'] . '.pushassist.com';
                                                        }
                                                        ?>

                                                    </div>
                                                </div>

                                                <div class="text_wrapper cat_border">
                                                    <!--<div class="big_img" id="big_img_div" style="display: block;">
                                                        <img id="big_img" src="images/bs-background.png">
                                                    </div>-->
                                                    <div class="border_top" id="action_1" style="display:none;">
                                                        <div class="img_box_1" id="img_box_1" style="display: none;">
                                                            <img
                                                                id="action_icon_img_1" src=""></div>
                                                        <div class="add" id="notification_button_1">
                                                            <?php _e('Action Name 1', 'push-notification-for-wp-by-pushassist'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="border_top" id="action_2" style="display:none;">
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

                                                <img id="mobile_logo"
                                                     src="<?php echo $account_details['site_image']; ?>"
                                                     class="img-responsive">

                                            </div>
                                            <div class="col-sm-9">
                                                <div class="text_wrapper2 pull-left">
                                                    <div class="title2">
                                                        <div class="title_txt pull-left msg_title"
                                                             id="mobile_pushassist_preview_notification_title">
                                                            <?php _e('Notification Title', 'push-notification-for-wp-by-pushassist'); ?>
                                                        </div>
                                                    </div>

                                                    <div class="message2 msg_message" id="mobile_pushassist_preview_notification_message">
                                                        <?php _e('Notification Message', 'push-notification-for-wp-by-pushassist'); ?>
                                                    </div>

                                                    <div class="message2 msg_desc" id="mobile_subdomain">

                                                        <?php
                                                        if ($account_details['ssl'] == 1) {
                                                            echo str_replace("https://", "", $account_details['url']);
                                                        } else {
                                                            echo $account_details['account_name'] . '.pushassist.com';
                                                        }
                                                        ?>
                                                    </div>

                                                </div>
                                            </div>
                                            <!--<div class="mobile_big_img" id="mobile_big_img_div" style="display: block;">
                                                <img id="mobile_big_img" src="images/bs-background.png">
                                            </div>-->
                                            <div class="cat_div2 clearfix">
                                                <div class="action_box" id="mobile_action_1" style="display:none;">
                                                    <div class="img_box" id="mobile_img_box_1" style="display: none;">
                                                        <img src="" id="mobile_action_icon_img_1">
                                                    </div>
                                                    <div class="add2" id="mobile_notification_button_1"><?php _e('Action Name 1', 'push-notification-for-wp-by-pushassist'); ?>
                                                    </div>
                                                </div>
                                                <div class="action_box" id="mobile_action_2" style="display:none;">
                                                    <div class="img_box" id="mobile_img_box_2" style="display: none;">
                                                        <img src="" id="mobile_action_icon_img_2">
                                                    </div>
                                                    <div class="add2" id="mobile_notification_button_2"><?php _e('Action Name 2', 'push-notification-for-wp-by-pushassist'); ?>
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

<script src="<?php echo '../wp-content/plugins/push-notification-for-wp-by-pushassist/admin/js/select2.full.min.js';?>"></script>
<script src="<?php echo '../wp-content/plugins/push-notification-for-wp-by-pushassist/admin/js/switchery.min.js';?>"></script>

<script language="javascript">
	/* Select2 Init*/
    jQuery(".select2").select2();

    /* Switchery Init*/
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    jQuery('.js-switch-1').each(function () {
        new Switchery(jQuery(this)[0], jQuery(this).data());
    });
	
    var title = "", message = "";

    jQuery("#pushassist_notification_is_utm_show").on('change', function () {

        if (jQuery('#pushassist_notification_is_utm_show').is(':checked')) {

            jQuery('#pushassist_notification_is_utm_show').val(1);
            jQuery('#pushassist_notification_utm_parameter_div').show('slow');
          
        } else {

            jQuery('#pushassist_notification_is_utm_show').val(0);
            jQuery('#pushassist_notification_utm_parameter_div').hide('slow');            
        }
    });

    jQuery("#pushassist_notification_title").keyup(function () {

        title = jQuery('#pushassist_notification_title').val();

        if (title !== "") {

            jQuery('#pushassist_preview_notification_title').text(title);
            jQuery('#mobile_pushassist_preview_notification_title').text(title);
        }
        else {
            jQuery('#pushassist_preview_notification_title').text('<?php _e('Notification Title', 'push-notification-for-wp-by-pushassist');?>');
            jQuery('#mobile_pushassist_preview_notification_title').text('<?php _e('Notification Title', 'push-notification-for-wp-by-pushassist');?>');
        }
    });

    jQuery("#pushassist_notification_message").keyup(function () {

        message = jQuery('#pushassist_notification_message').val();

        if (message !== "") {

            jQuery('#pushassist_preview_notification_message').text(message);
            jQuery('#mobile_pushassist_preview_notification_message').text(message);
        }
        else {

            jQuery('#pushassist_preview_notification_message').text('<?php _e('Notification Message', 'push-notification-for-wp-by-pushassist');?>');
            jQuery('#mobile_pushassist_preview_notification_message').text('<?php _e('Notification Message', 'push-notification-for-wp-by-pushassist');?>');
        }
    });

    jQuery("#pushassist_notification_title").blur(function () {

        title = jQuery('#pushassist_notification_title').val();

        if (title !== "") {

            jQuery('#pushassist_preview_notification_title').text(title);
            jQuery('#mobile_pushassist_preview_notification_title').text(title);
        }
        else {
            jQuery('#pushassist_preview_notification_title').text('<?php _e('Notification Title', 'push-notification-for-wp-by-pushassist');?>');
            jQuery('#mobile_pushassist_preview_notification_title').text('<?php _e('Notification Title', 'push-notification-for-wp-by-pushassist');?>');
        }
    });

    jQuery("#pushassist_notification_message").blur(function () {

        message = jQuery('#pushassist_notification_message').val();

        if (message !== "") {

            jQuery('#pushassist_preview_notification_message').text(message);
            jQuery('#mobile_pushassist_preview_notification_message').text(message);
        }
        else {

            jQuery('#pushassist_preview_notification_message').text('<?php _e('Notification Message', 'push-notification-for-wp-by-pushassist');?>');
            jQuery('#mobile_pushassist_preview_notification_message').text('<?php _e('Notification Message', 'push-notification-for-wp-by-pushassist');?>');
        }
    });

    jQuery("#pushassist_notification_button_txt_1").keyup(function () {

        var button_txt_1 = jQuery('#pushassist_notification_button_txt_1').val();

        if (button_txt_1 !== "") {

            jQuery('#notification_button_1').text(button_txt_1);
            jQuery('#mobile_notification_button_1').text(button_txt_1);
        }
        else {

            jQuery('#notification_button_1').text('Action Name 1');
            jQuery('#mobile_notification_button_1').text('Action Name 1');
        }
    });

    jQuery("#pushassist_notification_button_txt_2").keyup(function () {

        var button_txt_2 = jQuery('#pushassist_notification_button_txt_2').val();

        if (button_txt_2 !== "") {

            jQuery('#notification_button_2').text(button_txt_2);
            jQuery('#mobile_notification_button_2').text(button_txt_2);
        }
        else {

            jQuery('#notification_button_2').text('Action Name 2');
            jQuery('#mobile_notification_button_2').text('Action Name 2');
        }
    });

    jQuery("#pushassist_notification_button_txt_1").blur(function () {

        var button_txt_1 = jQuery('#pushassist_notification_button_txt_1').val();

        if (button_txt_1 !== "") {

            jQuery('#notification_button_1').text(button_txt_1);
            jQuery('#mobile_notification_button_1').text(button_txt_1);
        }
        else {

            jQuery('#notification_button_1').text('Action Name 1');
            jQuery('#mobile_notification_button_1').text('Action Name 1');
        }
    });

    jQuery("#pushassist_notification_button_txt_2").blur(function () {

        var button_txt_2 = jQuery('#pushassist_notification_button_txt_2').val();

        if (button_txt_2 !== "") {

            jQuery('#notification_button_2').text(button_txt_2);
            jQuery('#mobile_notification_button_2').text(button_txt_2);
        }
        else {

            jQuery('#notification_button_2').text('Action Name 2');
            jQuery('#mobile_notification_button_2').text('Action Name 2');
        }
    });

    /*  create dynamic button start */

    var counter = 1;

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