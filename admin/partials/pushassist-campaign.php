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
<!-- Content Start -->
<div class="container-fluid pt-25">

    <div class="row mb-15">
        <div class="ml-5">
			<?php
				if(isset($_REQUEST['response_message'])){
			?>
			<div class="alert alert-<?php echo esc_attr($_REQUEST['class']);?> alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php if($_REQUEST['response_message'] == 't'){echo esc_html("Campaign created succssfully.") ;}else{echo esc_html("Oop`s something went wrong, Please try again.");} ?>
			</div>
			<?php 
				}
			?>
            <h5 class="txt-dark"><?php _e('New Campaign', 'push-notification-for-wp-by-pushassist'); ?></h5>
        </div>
    </div>
	
    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN VALIDATION STATES-->
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <!-- BEGIN FORM-->
                        <form action="admin.php?page=pushassist-campaigns" enctype="multipart/form-data"
                              id="create_pushassist_campaign_form" name="create_pushassist_campaign_form"
                              class="form-horizontal"
                              method="post">
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Campaign Title', 'push-notification-for-wp-by-pushassist'); ?> <span class="required"> * </span></label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" id="pushassist_campaign_title"
                                                   name="pushassist_campaign_title" required maxlength="77"/></div>
                                    <span class="custom-label label-default" data-toggle="tooltip"
                                          data-placement="right" title="Limit 77 Characters"
                                          data-original-title="Limit 77 Characters">?</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Campaign Message', 'push-notification-for-wp-by-pushassist'); ?> <span
                                            class="required"> * </span>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                        <textarea class="form-control" id="pushassist_campaign_message"
                                                  name="pushassist_campaign_message" required
                                                  maxlength="138"></textarea></div>
                                    <span class="custom-label label-default" data-toggle="tooltip"
                                          data-placement="right" title="Limit 138 Characters"
                                          data-original-title="Limit 138 Characters">?</span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"><?php _e('Campaign URL', 'push-notification-for-wp-by-pushassist'); ?>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="url" class="form-control" id="pushassist_campaign_url"
                                                   name="pushassist_campaign_url"/>
                                        </div>
                                    <span class="custom-label label-default" data-toggle="tooltip"
                                          data-placement="right" title="e.g: http://www.demo.com or http://demo.com"
                                          data-original-title="e.g: http://www.demo.com or http://demo.com">?</span>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <label class="control-label col-md-3"><?php _e('Campaign Logo', 'push-notification-for-wp-by-pushassist'); ?></label>
                                    <div class="col-md-8">
                                        <div class="fileupload btn btn-info btn-anim">
                                            <i class="fa fa-upload"></i><span class="btn-text"><?php _e('Upload Logo', 'push-notification-for-wp-by-pushassist'); ?></span>
                                            <input id="fileupload" type="file" name="pushassist_campaign_fileupload"
                                                   class="upload">
                                        </div>
                                        <span class="help-block"><?php _e('Minimum 256x256px.', 'push-notification-for-wp-by-pushassist'); ?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"><?php _e('Campaign Date', 'push-notification-for-wp-by-pushassist'); ?>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="col-sm-9 input-group date" id="form_datetime"
                                             data-date=""
                                             data-date-format="M dd, yyyy HH:ii P"
                                             data-link-field="pushassist_campaign_date">
                                            <input class="form-control" type="text"
                                                   value="" readonly
                                                   id="readonly">
                                    <span class="input-group-addon"><span
                                            class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-th"></span></span>
                                        </div>

                                        <input type="hidden" id="pushassist_campaign_date"
                                               name="pushassist_campaign_date"
                                               value=""/>
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
                                        <input value="0" name="pushassist_campaign_is_utm_show"
                                               id="pushassist_campaign_is_utm_show" type="checkbox"
                                               class="js-switch js-switch-1" data-size="small" data-color="#469408"
                                               data-secondary-color="#dc4666">
                                        <input type="hidden" id="pushassist_is_action_button" name="pushassist_is_action_button" value="0">
                                        <input type="hidden" id="is_utm_show_hidden" name="is_utm_show_hidden"
                                               value="0">
                                    </div>
                                </div>

                                <div id="pushassist_campaign_utm_parameter_div" style="display: none;">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('UTM Source', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">

                                                <input type="text" class="form-control"
                                                       id="pushassist_campaign_utm_source"
                                                       value="pushassist"
                                                       name="pushassist_campaign_utm_source" maxlength="45"
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
                                                       id="pushassist_campaign_utm_medium"
                                                       value="pushassist_notification"
                                                       name="pushassist_campaign_utm_medium" maxlength="73"
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
                                                       id="pushassist_campaign_utm_campaign"
                                                       value="pushassist"
                                                       name="pushassist_campaign_utm_campaign" maxlength="500"
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
                                                    name="pushassist_campaign_segment[]"
                                                    id="pushassist_campaign_segment" multiple>

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
                                                    name="pushassist_campaign_countries[]"
                                                    id="pushassist_campaign_countries"
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
                                        <select class="form-control select2" name="pushassist_campaign_browsers[]"
                                                id="pushassist_campaign_browsers"
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
                                        <select class="form-control select2" name="pushassist_campaign_devices[]"
                                                id="pushassist_campaign_devices"
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
                                                    name="pushassist_campaign_os_users[]"
                                                    id="pushassist_campaign_os_users"
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
                                    <label class="control-label col-md-3"><?php _e('Expire In', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                    <div class="col-md-5">
                                        <div class="input-icon right">
                                            <select class="form-control select2"
                                                    name="pushassist_campaign_ttl"
                                                    id="pushassist_campaign_ttl">


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
                                    <label class="control-label col-md-3"><?php _e('Notification Priority', 'push-notification-for-wp-by-pushassist');?> </label>
                                    <div class="col-md-8">
                                        <div class="radio radio-success">
                                            <input type="radio" name="pushassist_campaign_priority"
                                                   id="pushassist_campaign_high_priority"
                                                   value="high">
                                            <label for="high_priority" class="mr-35"> <?php _e('High', 'push-notification-for-wp-by-pushassist'); ?></label>

                                            <input type="radio" name="pushassist_campaign_priority"
                                                   id="pushassist_campaign_normal_priority"
                                                   checked
                                                   value="normal">
                                            <label for="high_priority"> <?php _e('Normal', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        </div>
                                    </div>
                                </div>
								
								<input type="hidden" name="pushassist_campaign_alert_type" id="pushassist_campaign_alert_type" value="0">
                                								
                                <div class="form-group">
                                    <label class="control-label col-md-3"><?php _e('Timezone', 'push-notification-for-wp-by-pushassist'); ?></label>
                                    <div class="col-md-8">
                                        <select class="form-control select2" name="pushassist_campaign_timezone"
                                                id="pushassist_campaign_timezone">

                                            <?php
                                            foreach ($timezones as $key => $value) {

                                                if ($account_details['timezone'] == $value) {
                                                    ?>
                                                    <option selected
                                                            value="<?php echo $value; ?>"><?php echo $key; ?></option>

                                                    <?php
                                                } else { ?>

                                                    <option value="<?php echo $value; ?>"><?php echo $key; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div id="button_wrapper_1" style="display: none;">

                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php _e('Action Name 1', 'push-notification-for-wp-by-pushassist'); ?></label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <input type="text" class="form-control"
                                                       id="pushassist_campaign_button_txt_1"
                                                       value="Action Name 1"
                                                       name="pushassist_campaign_button_txt_1" maxlength="20"/>
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
                                                <input type="text" class="form-control" id="pushassist_campaign_url_1"
                                                       value="Action Url 1"
                                                       name="pushassist_campaign_url_1"/>
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
                                                       id="pushassist_campaign_button_txt_2"
                                                       value="Action Name 2"
                                                       name="pushassist_campaign_button_txt_2" maxlength="20"/>
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

                                                <input type="text" class="form-control" id="pushassist_campaign_url_2"
                                                       value="Action Url 2"
                                                       name="pushassist_campaign_url_2"/>
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
                                        <button name="pushassist-create-campaign" type="submit" class="btn btn-success btn-anim mr-10">
                                            <i class="icon-rocket"></i><span
                                                class="btn-text"> &nbsp; <?php _e('Send', 'push-notification-for-wp-by-pushassist'); ?> &nbsp;</span>
                                        </button>
										<a href="admin.php?page=pushassist-campaigns-details" class="btn btn-default btn-anim mr-10"><i
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
                                                    <div class="msg_text msg_title"
                                                         id="pushassist_preview_campaign_title">
                                                        <?php _e('Campaign Title', 'push-notification-for-wp-by-pushassist'); ?>
                                                    </div>

                                                    <div class="msg_text msg_message"
                                                         id="pushassist_preview_campaign_message">
                                                        <?php _e('Campaign Message', 'push-notification-for-wp-by-pushassist'); ?>
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
                                                             id="mobile_pushassist_preview_campaign_title">
                                                            <?php _e('Campaign Title', 'push-notification-for-wp-by-pushassist'); ?>
                                                        </div>
                                                    </div>

                                                    <div class="message2 msg_message"
                                                         id="mobile_pushassist_preview_campaign_message">
                                                        <?php _e('Campaign Message', 'push-notification-for-wp-by-pushassist'); ?>
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
                                                    <div class="add2" id="mobile_campaign_button_1"><?php _e('Action Name 1', 'push-notification-for-wp-by-pushassist'); ?>
                                                    </div>
                                                </div>
                                                <div class="action_box" id="mobile_action_2" style="display:none;">
                                                    <div class="img_box" id="mobile_img_box_2" style="display: none;">
                                                        <img src="" id="mobile_action_icon_img_2">
                                                    </div>
                                                    <div class="add2" id="mobile_campaign_button_2"><?php _e('Action Name 2', 'push-notification-for-wp-by-pushassist'); ?>
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
<script src="<?php echo '../wp-content/plugins/push-notification-for-wp-by-pushassist/admin/js/bootstrap-datetimepicker.js';?>"></script>

<script language="javascript">

	/* Select2 Init*/
    jQuery(".select2").select2();

    /* Switchery Init*/
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    jQuery('.js-switch-1').each(function () {
        new Switchery(jQuery(this)[0], jQuery(this).data());
    });

    var title = "", message = "";

    jQuery("#pushassist_campaign_is_utm_show").on('change', function () {

        if (jQuery('#pushassist_campaign_is_utm_show').is(':checked')) {

            jQuery('#pushassist_campaign_is_utm_show').val(1);
            jQuery('#pushassist_campaign_utm_parameter_div').show('slow');            

        } else {

            jQuery('#pushassist_campaign_is_utm_show').val(0);
            jQuery('#pushassist_campaign_utm_parameter_div').hide('slow');            
        }
    });

    jQuery("#pushassist_campaign_title").keyup(function () {

        title = jQuery('#pushassist_campaign_title').val();

        if (title !== "") {

            jQuery('#pushassist_preview_campaign_title').text(title);
            jQuery('#mobile_pushassist_preview_campaign_title').text(title);
        } else {
            jQuery('#pushassist_preview_campaign_title').text('<?php _e('Campaign Title', 'push-notification-for-wp-by-pushassist');?>');
            jQuery('#mobile_pushassist_preview_campaign_title').text('<?php _e('Campaign Title', 'push-notification-for-wp-by-pushassist');?>');
        }
    });

    jQuery("#pushassist_campaign_message").keyup(function () {

        message = jQuery('#pushassist_campaign_message').val();

        if (message !== "") {

            jQuery('#pushassist_preview_campaign_message').text(message);
            jQuery('#mobile_pushassist_preview_campaign_message').text(message);
        } else {

            jQuery('#pushassist_preview_campaign_message').text('<?php _e('Campaign Message', 'push-notification-for-wp-by-pushassist');?>');
            jQuery('#mobile_pushassist_preview_campaign_message').text('<?php _e('Campaign Message', 'push-notification-for-wp-by-pushassist');?>');
        }
    });

    jQuery("#pushassist_campaign_title").blur(function () {

        title = jQuery('#pushassist_campaign_title').val();

        if (title !== "") {

            jQuery('#pushassist_preview_campaign_title').text(title);
            jQuery('#mobile_pushassist_preview_campaign_title').text(title);
        } else {
            jQuery('#pushassist_preview_campaign_title').text('<?php _e('Campaign Title', 'push-notification-for-wp-by-pushassist');?>');
            jQuery('#mobile_pushassist_preview_campaign_title').text('<?php _e('Campaign Title', 'push-notification-for-wp-by-pushassist');?>');
        }
    });

    jQuery("#pushassist_campaign_message").blur(function () {

        message = jQuery('#pushassist_campaign_message').val();

        if (message !== "") {

            jQuery('#pushassist_preview_campaign_message').text(message);
            jQuery('#mobile_pushassist_preview_campaign_message').text(message);
        } else {

            jQuery('#pushassist_preview_campaign_message').text('<?php _e('Campaign Message', 'push-notification-for-wp-by-pushassist');?>');
            jQuery('#mobile_pushassist_preview_campaign_message').text('<?php _e('Campaign Message', 'push-notification-for-wp-by-pushassist');?>');
        }
    });

    jQuery(function () {		
		jQuery('#form_datetime').datetimepicker({
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            setDate: new Date()
        });
    });

    jQuery("#pushassist_campaign_button_txt_1").keyup(function () {

        var button_txt_1 = jQuery('#pushassist_campaign_button_txt_1').val();

        if (button_txt_1 !== "") {

            jQuery('#notification_button_1').text(button_txt_1);
            jQuery('#mobile_campaign_button_1').text(button_txt_1);
        } else {

            jQuery('#notification_button_1').text('Action Name 1');
            jQuery('#mobile_campaign_button_1').text('Action Name 1');
        }
    });

    jQuery("#pushassist_campaign_button_txt_2").keyup(function () {

        var button_txt_2 = jQuery('#pushassist_campaign_button_txt_2').val();

        if (button_txt_2 !== "") {

            jQuery('#notification_button_2').text(button_txt_2);
            jQuery('#mobile_campaign_button_2').text(button_txt_2);
        } else {

            jQuery('#notification_button_2').text('Action Name 2');
            jQuery('#mobile_campaign_button_2').text('Action Name 2');
        }
    });

    jQuery("#pushassist_campaign_button_txt_1").blur(function () {

        var button_txt_1 = jQuery('#pushassist_campaign_button_txt_1').val();

        if (button_txt_1 !== "") {

            jQuery('#notification_button_1').text(button_txt_1);
            jQuery('#mobile_campaign_button_1').text(button_txt_1);
        } else {

            jQuery('#notification_button_1').text('Action Name 1');
            jQuery('#mobile_campaign_button_1').text('Action Name 1');
        }
    });

    jQuery("#pushassist_campaign_button_txt_2").blur(function () {

        var button_txt_2 = jQuery('#pushassist_campaign_button_txt_2').val();

        if (button_txt_2 !== "") {

            jQuery('#notification_button_2').text(button_txt_2);
            jQuery('#mobile_campaign_button_2').text(button_txt_2);
        } else {

            jQuery('#notification_button_2').text('Action Name 2');
            jQuery('#mobile_campaign_button_2').text('Action Name 2');
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