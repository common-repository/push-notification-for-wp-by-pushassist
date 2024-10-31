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
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php if($_REQUEST['response_message'] == 't'){echo esc_html("Setting save succssfully.") ;}else{echo esc_html("Oop`s something went wrong, Please try again.");} ?>
			</div>
			<?php 
				}
			?>
            <h5 class="txt-dark"><?php _e('Subscription Dialogbox Settings', 'push-notification-for-wp-by-pushassist'); ?></h5>
        </div>
    </div>

</div>


<!-- Row -->
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                    <form class="form-horizontal" action="admin.php?page=pushassist-opt-in-setup" enctype="multipart/form-data" id="opt_in_setting_form" name="opt_in_setting_form" method="POST">

                        <fieldset>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-wrap">

                                        <div class="form-group">
                                            <label class="control-label col-md-3"><?php _e('WebSite URL', 'push-notification-for-wp-by-pushassist'); ?>
                                                <span class="required" aria-required="true"> * </span>
                                            </label>

                                            <div class="col-md-7 col-sm-12">
                                                <input type="text" placeholder="" class="form-control" value="<?php echo $opt_in_details['url']; ?>"
                                                       id="pushassist_website_url" name="pushassist_website_url" maxlength="150"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3"><?php _e('Opt-in Template', 'push-notification-for-wp-by-pushassist'); ?>
                                            </label>

                                            <input type="hidden" name="pushassist_template_location"
                                                   id="pushassist_template_location"
                                                   value="<?php echo $opt_in_details['template']; ?>">

                                            <div class="col-md-7 col-sm-12">
                                                <select id="pushassist_template" name="pushassist_template" class="form-control select select2">
                                                    <?php

                                                    $https_template = array('0' => 'Default', '1' => 'Default with Overlay', '2' => 'Template 1', '3' => 'Template 2', '4' => 'Template 3', '5' => 'Template 4', '6' => 'Template 5', '7' => 'Template 6', '8' => 'Template 7', '9' => 'Template 8', '10' => 'Template 9');
                                                    
													$http_template = array('2' => 'Template 1', '3' => 'Template 2', '4' => 'Template 3', '5' => 'Template 4', '6' => 'Template 5', '7' => 'Template 6', '8' => 'Template 7', '9' => 'Template 8', '10' => 'Template 9');
													
													$template = $http_template;
													
													if($opt_in_details['ssl'] == 1){
														$template = $https_template;
													}

													if($opt_in_details['ssl'] == 0 && ($opt_in_details['template'] <= 1)){
														$opt_in_details['template'] = 2;
													}

													foreach ($template as $key => $val) {

                                                        if ($key == $opt_in_details['template']) {
                                                            ?>
                                                            <option value="<?php echo $key; ?>"
                                                                    data-title="<?php echo $key; ?>"
                                                                    selected> <?php echo $val; ?></option>
                                                        <?php } else {
                                                            ?>
                                                            <option data-title="<?php echo $key; ?>"
                                                                    value="<?php echo $key; ?>"> <?php echo $val; ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
										
									 <div class="form-group">
											<label class="control-label col-md-3"><?php _e('Opt-In Interval', 'push-notification-for-wp-by-pushassist'); ?>
											</label>

											<div class="col-md-7 col-sm-12">
												<input type="number" class="form-control" name="pushassist_opt_in_interval"
													   id="pushassist_opt_in_interval" max="30"
													   value="<?php echo $opt_in_details['interval']; ?>"
													   min="0"/>
											</div>
										</div>
                                        
										<div class="form-group" id="opt_in_location_div" style="display:<?php if ($opt_in_details['template'] >= 2){echo 'block';} else {echo 'none';} ?>">
                                            <label class="control-label col-md-3"><?php _e('Opt-in Location', 'push-notification-for-wp-by-pushassist'); ?></label>
                                            <?php
                                            $location   = array('1' => 'Top Left', '2' => 'Top Right', '3' => 'Top Center', '4' => 'Bottom Left', '5' => 'Bottom Right', '6' => 'Bottom Center');
                                            $location_2 = array('1' => 'Top Left', '2' => 'Top Right', '4' => 'Bottom Left', '5' => 'Bottom Right');
                                            $location_3 = array('7' => 'Top', '8' => 'Bottom');
                                            ?>
                                            <div class="col-md-7 col-sm-12" id="psa_list_1"
                                                 style="display: <?php if (($opt_in_details['template'] < 8 || $opt_in_details['template'] == 10) && $opt_in_details['template'] >= 2) {
                                                     echo 'block';
                                                 } else {
                                                     echo 'none';
                                                 } ?>;">
                                                <select class="form-control select2" name="position" id="position">
                                                    <?php

													foreach ($location as $key => $val) {

                                                        if ($key == $opt_in_details['location']) {
                                                            ?>
                                                            <option value="<?php echo $key; ?>"
                                                                    selected> <?php echo $val; ?></option>
                                                        <?php } else {
                                                            ?>
                                                            <option
                                                                value="<?php echo $key; ?>"> <?php echo $val; ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-7 col-sm-12" id="psa_list_2"
                                                 style="display: <?php if ($opt_in_details['template'] == 8) {
                                                     echo 'block';
                                                 } else {
                                                     echo 'none';
                                                 } ?>;">
                                                <select class="form-control select2" name="position_1" id="position_1">
                                                    <?php

													foreach ($location_2 as $key => $val) {

                                                        if ($key == $opt_in_details['location']) {
                                                            ?>
                                                            <option value="<?php echo $key; ?>"
                                                                    selected> <?php echo $val; ?></option>
                                                        <?php } else {
                                                            ?>
                                                            <option
                                                                value="<?php echo $key; ?>"> <?php echo $val; ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-7 col-sm-12" id="psa_list_3"
                                                 style="display: <?php if ($opt_in_details['template'] == 9) {
                                                     echo 'block';
                                                 } else {
                                                     echo 'none';
                                                 } ?>;">
                                                <select class="form-control select2" name="position_2" id="position_2">
                                                    <?php

														foreach ($location_3 as $key => $val) {

                                                        if ($key == $opt_in_details['location']) {
                                                            ?>
                                                            <option value="<?php echo $key; ?>"
                                                                    selected> <?php echo $val; ?></option>
                                                        <?php } else {
                                                            ?>
                                                            <option
                                                                value="<?php echo $key; ?>"> <?php echo $val; ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="non_ssl" style="display:<?php if ($opt_in_details['template'] > 1){echo 'block';} else {echo 'none';} ?>;">
                                           
                                            <div class="form-group">
                                                <label class="control-label col-md-3"><?php _e('Opt-In Box Title', 'push-notification-for-wp-by-pushassist'); ?>
                                                    <span class="required"> * </span>
                                                </label>

                                                <div class="col-md-7 col-sm-12">
                                                    <input type="text" class="form-control" name="pushassist_opt_in_title"
                                                           id="pushassist_opt_in_title"
                                                           value="<?php _e(stripslashes_deep($opt_in_details['title']), 'push-notification-for-wp-by-pushassist'); ?>"
                                                           maxlength="80" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3"><?php _e('Opt-In Box Message', 'push-notification-for-wp-by-pushassist'); ?>
                                                    <span class="required"> * </span>
                                                </label>

                                                <div class="col-md-7 col-sm-12">
                                                    <input type="text" class="form-control" name="pushassist_opt_in_message"
                                                           id="pushassist_opt_in_message"
                                                           value="<?php _e(stripslashes_deep($opt_in_details['subtitle']), 'push-notification-for-wp-by-pushassist'); ?>"
                                                           maxlength="105" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3"><?php _e('Allow Button Text', 'push-notification-for-wp-by-pushassist'); ?>
                                                    <span class="required"> * </span>
                                                </label>

                                                <div class="col-md-7 col-sm-12">
                                                    <input type="text" class="form-control" name="pushassist_allow_button_text"
                                                           id="pushassist_allow_button_text" maxlength="25"
                                                           value="<?php _e(stripslashes_deep($opt_in_details['allow_button']), 'push-notification-for-wp-by-pushassist'); ?>"
                                                           required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3"><?php _e('Don\'t Allow Button Text', 'push-notification-for-wp-by-pushassist'); ?>
                                                    <span class="required"> * </span>
                                                </label>

                                                <div class="col-md-7 col-sm-12">
                                                    <input type="text" class="form-control" name="pushassist_disallow_button_text"
                                                           value="<?php _e(stripslashes_deep($opt_in_details['disallow_button']), 'push-notification-for-wp-by-pushassist'); ?>"
                                                           id="pushassist_disallow_button_text" maxlength="25" required/>
                                                </div>
                                            </div>

                                            <div class="form-group mb-0">
                                                <label class="control-label col-md-3"><?php _e('Opt-in Logo', 'push-notification-for-wp-by-pushassist'); ?> </label>
                                                <div class="col-md-7 col-sm-12">
                                                    <div class="fileupload btn btn-info btn-anim">
                                                        <i class="fa fa-upload"></i><span
                                                            class="btn-text"><?php _e('Upload Logo', 'push-notification-for-wp-by-pushassist'); ?></span>
                                                        <input id="fileupload" type="file" name="pushassist_setting_fileupload"
                                                               class="upload">
                                                    </div>
                                                    <span class="help-block"><?php _e('Minimum 256x256px.', 'push-notification-for-wp-by-pushassist'); ?></span>
                                                </div>
                                                <input type="hidden" class="form-control"
                                                       name="notification_logo" id="notification_logo"
                                                       value=""/>
                                            </div>

                                        </div>
										<?php
											/*
											$psa_ssl = false;
											if($opt_in_details['ssl'] == 1){
												$psa_ssl = true;
											}
										?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3"><?php _e('Enable SSL Opt-In', 'push-notification-for-wp-by-pushassist'); ?>  </label>
                                            <div class="col-md-7 col-sm-12">
												<input value="1" name="pushassist_switch_ssl" id="pushassist_switch_ssl" type="checkbox"
												   class="js-switch js-switch-1" data-size="small"
												   data-color="#469408"
												   data-secondary-color="#dc4666" <?php checked(stripslashes_deep($psa_ssl), 1);?>>
												
                                            </div>
                                        </div>
										
										<?php
											*/
											$powered_by_flag = false;
											if($opt_in_details['powered_by'] == 1){
												$powered_by_flag = true;
											}													
										?>

                                        <div class="form-group">
                                            <label class="control-label col-md-3"><?php _e('Remove Powered by PushAssist', 'push-notification-for-wp-by-pushassist'); ?>  </label>
                                            <div class="col-md-7 col-sm-12">
												<input value="1" name="pushassist_powered_by" id="pushassist_powered_by" type="checkbox"
												   class="js-switch js-switch-1" data-size="small"
												   data-color="#469408"
												   data-secondary-color="#dc4666" <?php checked(stripslashes_deep($powered_by_flag), 1);?>>
												
                                            </div>
                                        </div>

                                        <div class="form-group " id="upgradeplan" style="display:none;">
                                            <label class="control-label col-md-3"> &nbsp; </label>
                                            <label class="col-md-7 col-sm-12 form-label">&nbsp; &nbsp; <?php _e('Only available in paid plans,', 'push-notification-for-wp-by-pushassist'); ?> <a href="#" class="link"><?php _e('Upgrade Now!', 'push-notification-for-wp-by-pushassist'); ?></a>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-7 col-sm-12">
                                                <button name="psa-opt-in-setting" type="submit" class="btn btn-success btn-anim"><i
                                                        class="icon-rocket"></i><span class="btn-text"><?php _e('Save Setting', 'push-notification-for-wp-by-pushassist'); ?></span>
                                                </button>
                                                <a href="admin.php?page=pushassist-setting" class="btn btn-default btn-anim ml-15"><i
                                                        class="icon icon-action-undo"></i><span
                                                        class="btn-text"><?php _e('Back', 'push-notification-for-wp-by-pushassist'); ?></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">


        <div class="pushassist_notification8 preview"
             id="notification_template_preview_1"
             style="display: none;">
            <div class="pushassist_notification8_inner_wraper">

                <div class="pushassist_notification8_image_wraper">
                    <div class="push_noti4_imginnerwrap"><img id="logo"
                                                              src="<?php echo $opt_in_details['site_image']; ?>">
                    </div>
                </div>

                <div class="pushassist_notification8_text_wraper">

                                                        <span class="pushassist_notification8_title"
                                                              id="notification_title"><?php echo stripslashes($opt_in_details['title']); ?></span>

                    <p class="pushassist_notification8_message"
                       id="notification_message"><?php echo stripslashes($opt_in_details['subtitle']); ?></p>
                </div>

                <div class="pushassist_notification8_footer_wraper">
                
                    <div id="hide_show_powered_by" style="display:<?php if($opt_in_details['powered_by'] == 0){?>block<?php }else{ ?>none<?php } ?>">
                        <a class="pushassist8_branding" target="_blank"
                           href="https://pushassist.com/">
                            <img src="<?php echo plugins_url( '/images/pushassist-16x16.png', dirname(__FILE__));?>">
                        </a>
                        <span><a class="pushassist8_powered_by" target="_blank" href="https://pushassist.com/"><?php _e('Powered by PushAssist', 'push-notification-for-wp-by-pushassist'); ?></a></span>
                    </div>                

                    <div class="pushassist8_button_wrapper">
                        <button class="pushassist8_btn_close"
                                id="notification_donot_allow">
                            <?php echo stripslashes($opt_in_details['disallow_button']); ?>
                        </button>
                        <button class="pushassist8_btn_allow"
                                id="notification_allow"><?php echo stripslashes($opt_in_details['allow_button']); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="pushassist_notification3 preview"
             id="notification_template_preview_2"
             style="display: none;">
            <div class="push_noti3_innerwrap">
                <div class="pushassist_notification3_inner_wraper">
                    <div class="pushassist_notification3_title_wraper">
                                                            <span class="pushassist_notification3_title"
                                                                  id="notification_title_2"><?php echo stripslashes($opt_in_details['title']); ?></span>
                    </div>
                    <div class="pushassist_notification3_image_wraper">
                        <div class="push_noti3_imginnerwrap"><img id="logo_2"
                                                                  src="<?php echo $opt_in_details['site_image']; ?>">
                        </div>
                    </div>
                    <div class="pushassist_notification3_text_wraper">
                        <p class="pushassist_notification3_message"
                           id="notification_message_2"><?php echo stripslashes($opt_in_details['subtitle']); ?></p>
                    </div>
                </div>
                <div class="pushassist3_button_wrapper">
                    <button class="pushassist3_btn_close"
                            id="notification_donot_allow_2"><?php echo stripslashes($opt_in_details['disallow_button']); ?>
                    </button>
                    <button class="pushassist3_btn_allow" id="notification_allow_2">
                        <?php echo stripslashes($opt_in_details['allow_button']); ?>
                    </button>
                </div>


                <div class="pushassist_notification3_footer_wraper"
                     id="hide_show_powered_by_2" style="display:<?php if($opt_in_details['powered_by'] == 0){?>block<?php }else{ ?>none<?php } ?>">
                    <a class="pushassist3_branding" target="_blank"
                       href="https://pushassist.com/">
                        <img src="<?php echo plugins_url( '/images/pushassist-16x16.png', dirname(__FILE__));?>">
                    </a>
                                <span><a class="pushassist3_powered_by" target="_blank" href="https://pushassist.com/"><?php _e('Powered by PushAssist', 'push-notification-for-wp-by-pushassist'); ?></a></span>
                </div>

            </div>
            <div class="pushassist3_closediv"></div>
        </div>

        <div class="pushassist_notification4 preview"
             id="notification_template_preview_3"
             style="display: none;">
            <div class="pushassist_notification4_inner_wraper">
                <div class="pushassist_notification4_title_wraper">
                    <span class="pushassist_notification4_title" id="notification_title_3">
                        <?php echo stripslashes($opt_in_details['title']); ?></span>
                </div>
                <div class="pushassist_notification4_image_wraper">
                    <div class="push_noti4_imginnerwrap"><img id="logo_3"
                                                              src="<?php echo $opt_in_details['site_image']; ?>">
                    </div>
                </div>
                <div class="pushassist_notification4_text_wraper">
                    <p class="pushassist_notification4_message"
                       id="notification_message_3"><?php echo stripslashes($opt_in_details['subtitle']); ?></p>
                </div>
            </div>
            <div class="pushassist4_button_wrapper">
                <button class="pushassist4_1_btn_close"
                        id="notification_donot_allow_3">
                    <i></i><?php echo stripslashes($opt_in_details['disallow_button']); ?>
                </button>
                <button class="pushassist4_1_btn_allow" id="notification_allow_3">
                    <i></i><?php echo stripslashes($opt_in_details['allow_button']); ?>
                </button>
            </div>

            <div class="pushassist_notification4_footer_wraper"
                 id="hide_show_powered_by_3" style="display:<?php if($opt_in_details['powered_by'] == 0){?>block<?php }else{ ?>none<?php } ?>">
                <a class="pushassist4_branding" target="_blank"
                   href="https://pushassist.com/">
                    <img src="<?php echo plugins_url( '/images/pushassist-16x16.png', dirname(__FILE__));?>">
                </a>
                        <span><a class="pushassist4_powered_by" target="_blank" href="https://pushassist.com/"><?php _e('Powered by PushAssist', 'push-notification-for-wp-by-pushassist'); ?></a></span>
            </div>

        </div>

        <div class="pushassist_notification7 preview"
             id="notification_template_preview_4"
             style="display: none;">
            <div class="pushassist_notification7_inner_wraper">
                <div class="pushassist_notification7_head_wraper">
                    <div class="pushassist_notification7_image_wraper">
                        <div class="push_noti7_imginnerwrap"><img id="logo_4"
                                                                  src="<?php echo $opt_in_details['site_image']; ?>">
                        </div>
                    </div>
                    <div class="pushassist_notification7_title_wraper">
                                                            <span class="pushassist_notification7_title"
                                                                  id="notification_title_4"><?php echo stripslashes($opt_in_details['title']); ?></span>
                    </div>
                </div>
                <div class="pushassist_notification7_text_wraper">
                    <p class="pushassist_notification7_message">
                        <?php echo stripslashes($opt_in_details['subtitle']); ?></p>
                </div>
            </div>
            <div class="pushassist7_button_wrapper">
                <button class="pushassist7_btn_close"
                        id="notification_donot_allow_4"><?php echo stripslashes($opt_in_details['disallow_button']); ?>
                </button>
                <button class="pushassist7_btn_allow" id="notification_allow_4">
                    <?php echo stripslashes($opt_in_details['allow_button']); ?>
                </button>
            </div>

            <div class="pushassist_notification7_footer_wraper"
                 id="hide_show_powered_by_4" style="display:<?php if($opt_in_details['powered_by'] == 0){?>block<?php }else{ ?>none<?php } ?>">
                <a class="pushassist7_branding" target="_blank"
                   href="https://pushassist.com/">
                    <img src="<?php echo plugins_url( '/images/pushassist-16x16.png', dirname(__FILE__));?>">
                </a>
                        <span><a class="pushassist7_powered_by" target="_blank" href="https://pushassist.com/"><?php _e('Powered by PushAssist', 'push-notification-for-wp-by-pushassist'); ?></a></span>
            </div>
        </div>

        <div class="pushassist_notification4 preview"
             id="notification_template_preview_5"
             style="display: none;">
            <div class="pushassist_notification4_inner_wraper">
                <div class="pushassist_notification4_title_wraper">
                                                        <span class="pushassist_notification4_title"
                                                              id="notification_title_5"><?php echo stripslashes($opt_in_details['title']); ?></span>
                </div>
                <div class="pushassist_notification4_image_wraper">
                    <div class="push_noti4_imginnerwrap"><img id="logo_5"
                                                              src="<?php echo $opt_in_details['site_image']; ?>">
                    </div>
                </div>
                <div class="pushassist_notification4_text_wraper">
                    <p class="pushassist_notification4_message"
                       id="notification_message_5"><?php echo stripslashes($opt_in_details['subtitle']); ?></p>
                </div>
            </div>
            <div class="pushassist4_button_wrapper">
                <button class="pushassist4_btn_close"><i></i>
                            <span id="notification_donot_allow_5">
                                <?php echo stripslashes($opt_in_details['disallow_button']); ?></span>
                </button>
                <button class="pushassist4_btn_allow"><i></i>
                    <span id="notification_allow_5"><?php echo stripslashes($opt_in_details['allow_button']); ?></span>
                </button>
            </div>

            <div class="pushassist_notification4_footer_wraper"
                 id="hide_show_powered_by_5" style="display:<?php if($opt_in_details['powered_by'] == 0){?>block<?php }else{ ?>none<?php } ?>">
                <a class="pushassist4_branding" target="_blank"
                   href="https://pushassist.com/">
                    <img src="<?php echo plugins_url( '/images/pushassist-16x16.png', dirname(__FILE__));?>">
                </a>
                        <span><a class="pushassist4_powered_by" target="_blank" href="https://pushassist.com/"><?php _e('Powered by PushAssist', 'push-notification-for-wp-by-pushassist'); ?></a></span>
            </div>

        </div>

        <div class="pushassist_notification preview"
             id="notification_template_preview_6" style="display: none">
            <div class="pushassist_notification_inner_wraper">
                <div class="pushassist_notification_image_wraper">
                    <img id="logo_6"
                         src="<?php echo $opt_in_details['site_image']; ?>">
                </div>
                <div class="pushassist_notification_text_wraper">
                    <span class="pushassist_notification_title" id="notification_title_6">
                        <?php echo stripslashes($opt_in_details['title']); ?></span>

                    <p class="pushassist_notification_message"
                       id="notification_message_6"><?php echo stripslashes($opt_in_details['subtitle']); ?></p>
                </div>

                <div class="pushassist_notification_footer_wraper"
                     id="hide_show_powered_by_6" style="display:<?php if($opt_in_details['powered_by'] == 0){?>block<?php }else{ ?>none<?php } ?>">
                    <a class="pushassist_branding" target="_blank"
                       href="https://pushassist.com">
                        <img src="<?php echo plugins_url( '/images/pushassist-16x16.png', dirname(__FILE__));?>">
                    </a>
                                <span><a class="pushassist_powered_by" target="_blank" href="https://pushassist.com/"><?php _e('Powered by PushAssist', 'push-notification-for-wp-by-pushassist'); ?></a></span>
                </div>

            </div>
            <div class="pushassist_button_wrapper">
                <button class="pushassist_btn_close"
                        id="notification_donot_allow_6"><?php echo stripslashes($opt_in_details['disallow_button']); ?>
                </button>
                <button class="pushassist_btn_allow" id="notification_allow_6">
                    <?php echo stripslashes($opt_in_details['allow_button']); ?>
                </button>
            </div>
        </div>

        <div class="preview" id="notification_template_preview_7"
             style="display: none">
            <div class="pushassist_single_notification">
                <div class="pushassist_single_notification_inner_wraper">
                    <a href="">
                        <img src="<?php echo plugins_url( '/images/pushassist_round.png', dirname(__FILE__));?>">
                    </a>
                </div>

                <div class="message_box">
                                                    <span id="notification_title_7">
                                                        <?php echo stripslashes($opt_in_details['title']); ?>
                                                    </span>

                    <div class="message_box_arrow"></div>
                </div>

            </div>
        </div>

        <div class="preview" id="notification_template_preview_8"
             style="display: none">

            <div class="pushassist_fullscreen_notification">
                <div class="pushassist_fullscreen_message_box_wrapper">
                    <div class="pushassist_fullscreen_message_box">
                        <p id="notification_title_8"><?php echo stripslashes($opt_in_details['title']); ?></p>
                    </div>

                    <div class="pushassist_fullscreen_notification_button_wrapper">
                        <button class="pushassist_full_btn_close"
                                id="notification_donot_allow_8">
                            <?php echo stripslashes($opt_in_details['disallow_button']); ?>
                        </button>
                        <button class="pushassist_full_btn_allow"
                                id="notification_allow_8"><?php echo stripslashes($opt_in_details['allow_button']); ?>
                        </button>
                    </div>

                    <div class="pushassist_fullscreen_powered_by"
                         id="hide_show_powered_by_8" style="display:<?php if($opt_in_details['powered_by'] == 0){?>block<?php }else{ ?>none<?php } ?>">
                            <span> <a target="_blank" href="https://pushassist.com/"> <img
                                        src="<?php echo plugins_url( '/images/pushassist-16x16.png', dirname(__FILE__));?>"> </a><?php _e('Powered by PushAssist', 'push-notification-for-wp-by-pushassist'); ?></span>
                    </div>

                </div>
            </div>
        </div>

        <div class="preview" id="notification_template_preview_9"
             style="display: none;">

            <div class="pushassist_notification8_inner_wraper">

                <div class="pushassist_notification13">
                    <div class="pushassist_notification13_inner_wraper">
                        <div class="pushassist_notification13_image_wraper">
                            <img id="logo_9"
                                 src="<?php echo $opt_in_details['site_image']; ?>">

                        </div>
                        <div class="pushassist_notification13_text_wraper">
                                                                <span class="pushassist_notification13_title"
                                                                      id="notification_title_9"> <?php echo stripslashes($opt_in_details['title']); ?> </span>

                            <p class="pushassist_notification13_message"
                               id="notification_message_9">
                                <?php echo stripslashes($opt_in_details['subtitle']); ?></p>
                        </div>
                        <div class="pushassist_notification13_footer_wraper">

                            <div class="pushassist_notification13_powerd_by"
                                 id="hide_show_powered_by_9" style="display:<?php if($opt_in_details['powered_by'] == 0){?>block<?php }else{ ?>none<?php } ?>">
                                <a class="pushassist13_branding" target="_blank"
                                   href="https://pushassist.com/">
                                    <img src="<?php echo plugins_url( '/images/pushassist-16x16.png', dirname(__FILE__));?>">
                                </a>
								<span class="pushassist13_powered_by"><?php _e('Powered by ', 'push-notification-for-wp-by-pushassist'); ?> <a target="_blank" href="https://pushassist.com/"> <?php _e('PushAssist', 'push-notification-for-wp-by-pushassist'); ?> </a></span>
                            </div>

                            <div class="pushassist13_button_wrapper">

                                <button class="pushassist13_btn_close"
                                        id="notification_donot_allow_9">
                                    <?php echo stripslashes($opt_in_details['disallow_button']); ?>
                                </button>

                                <button class="pushassist13_btn_allow"
                                        id="notification_allow_9">
                                    <?php echo stripslashes($opt_in_details['allow_button']); ?>
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pushassist_notification11 preview"
             id="notification_template_preview_11"
             style="display: none">
            <p> <?php _e('SSL default Opt-in', 'push-notification-for-wp-by-pushassist'); ?> </p>
            <img class="chrome_img" alt="Chrome SSL"
                 src="<?php echo plugins_url( '/images/chrome.png', dirname(__FILE__));?>">
            <img alt="Firefox SSL" src="<?php echo plugins_url( '/images/firefox.png', dirname(__FILE__));?>">

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

    var logo_name, poweredByLogo;

    var notification_id = <?php echo $opt_in_details['template']; ?>;

    jQuery('.preview').hide();

    if(notification_id <= 1){
		jQuery('#notification_template_preview_11').show();
	}else{
		notification_id = notification_id - 1;
		jQuery('#notification_template_preview_' + notification_id).show();
	}

    jQuery("#pushassist_powered_by").on('change', function () {

        var is_premium = <?php echo $opt_in_details['planId']; ?>;
		
        if (jQuery('#pushassist_powered_by').is(':checked')) {
			
            if (is_premium > 0) {
			
				if (jQuery('#pushassist_powered_by').is(':checked')) {

					jQuery('#pushassist_powered_by').val(1);

					jQuery('#hide_show_powered_by').hide();
					jQuery('#hide_show_powered_by_2').hide();
					jQuery('#hide_show_powered_by_3').hide();
					jQuery('#hide_show_powered_by_4').hide();
					jQuery('#hide_show_powered_by_5').hide();
					jQuery('#hide_show_powered_by_6').hide();
					jQuery('#hide_show_powered_by_8').hide();
					jQuery('#hide_show_powered_by_9').hide();
				} else {
					jQuery('#pushassist_powered_by').val(0);
					jQuery('#hide_show_powered_by').show();
					jQuery('#hide_show_powered_by_2').show();
					jQuery('#hide_show_powered_by_3').show();
					jQuery('#hide_show_powered_by_4').show();
					jQuery('#hide_show_powered_by_5').show();
					jQuery('#hide_show_powered_by_6').show();
					jQuery('#hide_show_powered_by_8').show();
					jQuery('#hide_show_powered_by_9').show();
				}

            } else {
				
                jQuery('#pushassist_powered_by').val(0);
                jQuery('#upgradeplan').show('slow');

                jQuery('#hide_show_powered_by').show();
                jQuery('#hide_show_powered_by_2').show();
                jQuery('#hide_show_powered_by_3').show();
                jQuery('#hide_show_powered_by_4').show();
                jQuery('#hide_show_powered_by_5').show();
                jQuery('#hide_show_powered_by_6').show();
                jQuery('#hide_show_powered_by_8').show();
                jQuery('#hide_show_powered_by_9').show();
            }

        } else {

            jQuery('#powered_by').val(0);
            jQuery('#upgradeplan').hide('slow');

            jQuery('#hide_show_powered_by').show();
            jQuery('#hide_show_powered_by_2').show();
            jQuery('#hide_show_powered_by_3').show();
            jQuery('#hide_show_powered_by_4').show();
            jQuery('#hide_show_powered_by_5').show();
            jQuery('#hide_show_powered_by_6').show();
            jQuery('#hide_show_powered_by_8').show();
            jQuery('#hide_show_powered_by_9').show();

        }
    });

    jQuery("#pushassist_opt_in_title").keyup(function () {

        var title = jQuery('#pushassist_opt_in_title').val();

        if (title !== "") {

            jQuery('#notification_title').text(title);
            jQuery('#notification_title_2').text(title);
            jQuery('#notification_title_3').text(title);
            jQuery('#notification_title_4').text(title);
            jQuery('#notification_title_5').text(title);
            jQuery('#notification_title_6').text(title);
            jQuery('#notification_title_7').text(title);
            jQuery('#notification_title_8').text(title);
            jQuery('#notification_title_9').text(title);
        }
        else {

            jQuery('#notification_title').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_2').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_3').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_4').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_5').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_6').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_7').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_8').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_9').text('SiteName Would Like to Send You Push Notifications.');
        }
    });

    jQuery("#pushassist_opt_in_message").keyup(function () {

        var subtitle = jQuery('#pushassist_opt_in_message').val();

        if (subtitle !== "") {

            jQuery('#notification_message').text(subtitle);
            jQuery('#notification_message_2').text(subtitle);
            jQuery('#notification_message_3').text(subtitle);
            jQuery('#notification_message_4').text(subtitle);
            jQuery('#notification_message_5').text(subtitle);
            jQuery('#notification_message_6').text(subtitle);
            jQuery('#notification_message_9').text(subtitle);
        }
        else {

            jQuery('#notification_message').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_2').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_3').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_4').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_5').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_6').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_9').text('Notifications can be turned off anytime from browser settings.');
        }
    });

    jQuery("#pushassist_allow_button_text").keyup(function () {

        var allow = jQuery('#pushassist_allow_button_text').val();

        if (allow !== "") {

            jQuery('#notification_allow').text(allow);
            jQuery('#notification_allow_2').text(allow);
            jQuery('#notification_allow_3').text(allow);
            jQuery('#notification_allow_4').text(allow);
            jQuery('#notification_allow_5').text(allow);
            jQuery('#notification_allow_6').text(allow);
            jQuery('#notification_allow_8').text(allow);
            jQuery('#notification_allow_9').text(allow);
        }
        else {

            jQuery('#notification_allow').text('Allow');
            jQuery('#notification_allow_2').text('Allow');
            jQuery('#notification_allow_3').text('Allow');
            jQuery('#notification_allow_4').text('Allow');
            jQuery('#notification_allow_5').text('Allow');
            jQuery('#notification_allow_6').text('Allow');
            jQuery('#notification_allow_8').text('Allow');
            jQuery('#notification_allow_9').text('Allow');
        }
    });

    jQuery("#pushassist_disallow_button_text").keyup(function () {

        var disallow = jQuery('#pushassist_disallow_button_text').val();

        if (disallow !== "") {

            jQuery('#notification_donot_allow').text(disallow);
            jQuery('#notification_donot_allow_2').text(disallow);
            jQuery('#notification_donot_allow_3').text(disallow);
            jQuery('#notification_donot_allow_4').text(disallow);
            jQuery('#notification_donot_allow_5').text(disallow);
            jQuery('#notification_donot_allow_6').text(disallow);
            jQuery('#notification_donot_allow_8').text(disallow);
            jQuery('#notification_donot_allow_9').text(disallow);
        }
        else {

            jQuery('#notification_donot_allow').text('Don\'t Allow');
            jQuery('#notification_donot_allow_2').text('Don\'t Allow');
            jQuery('#notification_donot_allow_3').text('Don\'t Allow');
            jQuery('#notification_donot_allow_4').text('Don\'t Allow');
            jQuery('#notification_donot_allow_5').text('Don\'t Allow');
            jQuery('#notification_donot_allow_6').text('Don\'t Allow');
            jQuery('#notification_donot_allow_8').text('Don\'t Allow');
            jQuery('#notification_donot_allow_9').text('Don\'t Allow');
        }
    });

    jQuery("#pushassist_opt_in_title").blur(function () {

        var title = jQuery('#pushassist_opt_in_title').val();

        if (title !== "") {

            jQuery('#notification_title').text(title);
            jQuery('#notification_title_2').text(title);
            jQuery('#notification_title_3').text(title);
            jQuery('#notification_title_4').text(title);
            jQuery('#notification_title_5').text(title);
            jQuery('#notification_title_6').text(title);
            jQuery('#notification_title_7').text(title);
            jQuery('#notification_title_8').text(title);
            jQuery('#notification_title_9').text(title);
        }
        else {

            jQuery('#notification_title').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_2').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_3').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_4').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_5').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_6').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_7').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_8').text('SiteName Would Like to Send You Push Notifications.');
            jQuery('#notification_title_9').text('SiteName Would Like to Send You Push Notifications.');
        }
    });

    jQuery("#pushassist_opt_in_message").blur(function () {

        var subtitle = jQuery('#pushassist_opt_in_message').val();

        if (subtitle !== "") {

            jQuery('#notification_message').text(subtitle);
            jQuery('#notification_message_2').text(subtitle);
            jQuery('#notification_message_3').text(subtitle);
            jQuery('#notification_message_4').text(subtitle);
            jQuery('#notification_message_5').text(subtitle);
            jQuery('#notification_message_6').text(subtitle);
            jQuery('#notification_message_9').text(subtitle);
        }
        else {

            jQuery('#notification_message').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_2').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_3').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_4').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_5').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_6').text('Notifications can be turned off anytime from browser settings.');
            jQuery('#notification_message_9').text('Notifications can be turned off anytime from browser settings.');
        }
    });

    jQuery("#allow_button").blur(function () {

        var allow = jQuery('#allow_button').val();

        if (allow !== "") {

            jQuery('#notification_allow').text(allow);
            jQuery('#notification_allow_2').text(allow);
            jQuery('#notification_allow_3').text(allow);
            jQuery('#notification_allow_4').text(allow);
            jQuery('#notification_allow_5').text(allow);
            jQuery('#notification_allow_6').text(allow);
            jQuery('#notification_allow_8').text(allow);
            jQuery('#notification_allow_9').text(allow);
        }
        else {
            jQuery('#notification_allow').text('Allow');
            jQuery('#notification_allow_2').text('Allow');
            jQuery('#notification_allow_3').text('Allow');
            jQuery('#notification_allow_4').text('Allow');
            jQuery('#notification_allow_5').text('Allow');
            jQuery('#notification_allow_6').text('Allow');
            jQuery('#notification_allow_8').text('Allow');
            jQuery('#notification_allow_9').text('Allow');
        }
    });

    jQuery("#pushassist_disallow_button_text").blur(function () {

        var disallow = jQuery('#pushassist_disallow_button_text').val();

        if (disallow !== "") {

            jQuery('#notification_donot_allow').text(disallow);
            jQuery('#notification_donot_allow_2').text(disallow);
            jQuery('#notification_donot_allow_3').text(disallow);
            jQuery('#notification_donot_allow_4').text(disallow);
            jQuery('#notification_donot_allow_5').text(disallow);
            jQuery('#notification_donot_allow_6').text(disallow);
            jQuery('#notification_donot_allow_8').text(disallow);
            jQuery('#notification_donot_allow_9').text(disallow);
        }
        else {
            jQuery('#notification_donot_allow').text('Don\'t Allow');
            jQuery('#notification_donot_allow_2').text('Don\'t Allow');
            jQuery('#notification_donot_allow_3').text('Don\'t Allow');
            jQuery('#notification_donot_allow_4').text('Don\'t Allow');
            jQuery('#notification_donot_allow_5').text('Don\'t Allow');
            jQuery('#notification_donot_allow_6').text('Don\'t Allow');
            jQuery('#notification_donot_allow_8').text('Don\'t Allow');
            jQuery('#notification_donot_allow_9').text('Don\'t Allow');
        }
    });

    jQuery("#pushassist_template").on("change", function () {

        if (jQuery('#is_ssl').is(':checked')) {
			
            jQuery('.preview').hide();
            jQuery('#notification_template_preview_11').show();

        } else {

            jQuery('.preview').hide();

			if(jQuery(this).val() <= 1){
				jQuery('#opt_in_location_div').hide();
				jQuery('#non_ssl').hide();
				jQuery('#notification_template_preview_11').show();
				return false;
			}
			
            jQuery('#opt_in_location_div').show();
            jQuery('#non_ssl').show();
            jQuery('#notification_template_preview_' + (jQuery(this).val() - 1)).show();
			
            if (jQuery(this).val() === "9") {

                jQuery('#psa_list_3').show();
                jQuery('#psa_list_2').hide();
                jQuery('#psa_list_1').hide();

                jQuery('#pushassist_template_location').val(jQuery('#position_2').val());
            }

            if (jQuery(this).val() === "8") {

                jQuery('#psa_list_3').hide();
                jQuery('#psa_list_2').show();
                jQuery('#psa_list_1').hide();

                jQuery('#pushassist_template_location').val(jQuery('#position_1').val());
            }

            if ((jQuery(this).val() > 1 && jQuery(this).val() < 8) || (jQuery(this).val() === "10")) {

                jQuery('#psa_list_3').hide();
                jQuery('#psa_list_2').hide();
                jQuery('#psa_list_1').show();

                jQuery('#pushassist_template_location').val(jQuery('#position').val());
            }
        }
    });

    jQuery("#position").on("change", function () {

        var template_location = jQuery(this).val();
        jQuery('#pushassist_template_location').val(template_location);
    });

    jQuery("#position_1").on("change", function () {

        var template_location = jQuery(this).val();
        jQuery('#pushassist_template_location').val(template_location);
    });

    jQuery("#position_2").on("change", function () {

        var template_location = jQuery(this).val();
        jQuery('#pushassist_template_location').val(template_location);
    });

</script>
