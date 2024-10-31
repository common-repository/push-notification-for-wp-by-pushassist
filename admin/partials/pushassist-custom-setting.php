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

    <div class="row">
        <div class="ml-5">
			<?php 
				if(isset($_REQUEST['response_message'])){
			?>		
			<div class="alert alert-success alert-dismissable mb-10">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Setting successfully save.
			</div>
			<?php
				}
			?>
        </div>
    </div>

	<form action="admin.php?page=pushassist-advance-settings" id="pushassist_custom_setting_form" name="pushassist_custom_setting_form"
                              class="form-horizontal" method="post" autocomplete="off" enctype="multipart/form-data">

    <div class="row mb-15">
		<div class="col-md-10"><h5 class="txt-dark pt-10 pl-10"><?php _e('Advanced Settings', 'push-notification-for-wp-by-pushassist'); ?></h5></div>
		<div class="col-md-2">
			<button name="psa-save-settings" type="submit" class="btn btn-success btn-anim mr-10"><i
                                                class="icon-rocket"></i><span class="btn-text"><?php _e('Save Settings', 'push-notification-for-wp-by-pushassist'); ?></span></button>

			<a href="admin.php?page=pushassist-setting" class="btn btn-default btn-anim mr-10"><i
					class="icon icon-action-undo"></i><span class="btn-text"><?php _e('Back', 'push-notification-for-wp-by-pushassist'); ?></span></a>
		</div>
	</div>
    <div class="col-md-12 pl-0">
        <div class="col-md-6">
            <!-- BEGIN VALIDATION STATES-->
            <div class="panel panel-default card-view">

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <!-- BEGIN FORM-->                        
                            <div class="form-body">

                                <div class="row">                                    
                                    <div class="col-md-8"><h6 class="txt-dark"><?php _e('Notification Settings', 'push-notification-for-wp-by-pushassist'); ?></h6></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 text-right">
										<input value="1" name="pushassist_auto_push" id="pushassist_auto_push" type="checkbox" class="js-switch js-switch-1" data-size="small" 
										data-color="#469408" data-secondary-color="#dc4666" <?php checked(stripslashes_deep($pushassist_settings['psaAutoPush']), 1);?>>
									</div>
                                    <div class="col-md-8"><label class="control-label"><?php _e('Auto Send Push Notifications When a Post is Published', 'push-notification-for-wp-by-pushassist'); ?></label></div>
                                </div>
								
								<div class="row">
                                    <div class="col-md-2 text-right">
										<input value="1" name="pushassist_edit_post_push" id="pushassist_edit_post_push" type="checkbox" class="js-switch js-switch-1" data-size="small" data-color="#469408" data-secondary-color="#dc4666" <?php checked(stripslashes_deep($pushassist_settings['psaEditPostPush']), 1);?>>
									</div>
                                    <div class="col-md-8"><label class="control-label"> <?php _e('Auto Send Push Notifications When a Post is Updated', 'push-notification-for-wp-by-pushassist'); ?></label></div>
                                </div>
								
								<div class="row">
                                    <div class="col-md-2 text-right">
										<input value="1" name="pushassist_logo_image" id="pushassist_logo_image" type="checkbox" class="js-switch js-switch-1" data-size="small" 
										data-color="#469408" data-secondary-color="#dc4666" <?php checked(stripslashes_deep($pushassist_settings['psaPostLogoImage']), 1);?>>
									</div>
                                    <div class="col-md-8"><label class="control-label"> <?php _e('Use Logo Image as Post Image (Default is Featured Image)', 'push-notification-for-wp-by-pushassist'); ?> </label></div>
                                </div>
								
								<div class="row">
                                    <div class="col-md-2 text-right">
										<input value="1" name="pushassist_big_image" id="pushassist_big_image" type="checkbox" class="js-switch js-switch-1" data-size="small" 
										data-color="#469408" data-secondary-color="#dc4666" <?php checked(stripslashes_deep($pushassist_settings['psaPostBigImage']), 1); ?>>
									</div>
                                    <div class="col-md-8"><label class="control-label"> <?php _e('Use the post`s featured image for Chrome`s large notification image', 'push-notification-for-wp-by-pushassist'); ?> </label></div>
                                </div>
								
								<div class="row">
                                    <div class="col-md-2 text-right">
										<input value="1" name="pushassist_setting_is_utm_show" id="pushassist_setting_is_utm_show" type="checkbox" class="js-switch js-switch-1" data-size="small" data-color="#469408" data-secondary-color="#dc4666" <?php checked(stripslashes_deep($pushassist_settings['psaIsAutoPushUTM']), 1); ?>>
									</div>
                                    <div class="col-md-8"><label class="control-label"> <?php _e('Add UTM Parameters in URL for Tracking', 'push-notification-for-wp-by-pushassist'); ?> </label></div>
                                </div>
								
								<div class="form-group" id="pushassist_setting_utm_parameter_div" style="display:<?php if ($pushassist_settings['psaIsAutoPushUTM']){echo 'block';}else {echo 'none';} ?>;">
									
									<div class="form-group">
										<label class="control-label col-md-2"><?php _e('UTM Source', 'push-notification-for-wp-by-pushassist'); ?></label>
										<div class="col-md-8">
											<div class="input-icon right">												
												<input type="text" class="form-control" value="<?php echo stripslashes_deep($pushassist_settings['psaUTMSource']); ?>" id="pushassist_setting_utm_source" name="pushassist_setting_utm_source" placeholder="<?php _e('Enter UTM Source', 'push-notification-for-wp-by-pushassist'); ?>"maxlength="45" required="required"/></div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-2"><?php _e('UTM Medium', 'push-notification-for-wp-by-pushassist'); ?></label>
										<div class="col-md-8">
											<div class="input-icon right">												
												<input type="text" class="form-control" value="<?php echo stripslashes_deep($pushassist_settings['psaUTMMedium']); ?>" id="pushassist_setting_utm_medium" name="pushassist_setting_utm_medium" placeholder="<?php _e('Enter UTM Medium', 'push-notification-for-wp-by-pushassist'); ?>"maxlength="73" required="required"/></div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-2"><?php _e('UTM Campaign', 'push-notification-for-wp-by-pushassist'); ?></label>
										<div class="col-md-8">
											<div class="input-icon right">												
												<input type="text" class="form-control" value="<?php echo stripslashes_deep($pushassist_settings['psaUTMCampaign']); ?>" id="pushassist_setting_utm_campaign" name="pushassist_setting_utm_campaign" placeholder="<?php _e('Enter UTM Campaign', 'push-notification-for-wp-by-pushassist'); ?>"maxlength="500" required="required"/></div>
										</div>
									</div>
									
								</div>							
                        
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
		</div>
		
        <div class="col-md-6">
            <!-- BEGIN VALIDATION STATES-->
            <div class="panel panel-default card-view">

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <!-- BEGIN FORM-->
                        
                            <div class="form-body">

                                <div class="row">                                    
                                    <div class="col-md-8"><h6 class="txt-dark"><?php _e('Advanced Settings', 'push-notification-for-wp-by-pushassist'); ?></h6></div>
                                </div>
                                								
								<div class="row">
                                    <div class="col-md-2 text-right">
										<input value="1" name="pushassist_js_restrict" id="pushassist_js_restrict" type="checkbox" class="js-switch js-switch-1" data-size="small" 
										data-color="#469408" data-secondary-color="#dc4666" <?php checked(stripslashes_deep($pushassist_settings['psaJsRestrict']), 1); ?>>
									</div>
                                    <div class="col-md-8"><label class="control-label"> <?php _e('Stop Automatic Script Inclusion. (I will insert PushAssist JS manually).', 'push-notification-for-wp-by-pushassist'); ?> </label></div>
                                </div>
																
								<div class="row mt-20 mb-10">
                                    <div class="col-md-8"><h6 class="txt-dark"><?php _e('Default Notification Message When a Post is Published', 'push-notification-for-wp-by-pushassist'); ?></h6></div>
                                </div>
								
								<div class="form-group">
                                    
                                    <div class="col-md-10">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" value="<?php echo stripslashes_deep($pushassist_settings['psaPostMessage']);?>" id="pushassist_setting_post_message" name="pushassist_setting_post_message" placeholder="<?php _e('Notification Message When a Post is Published', 'push-notification-for-wp-by-pushassist'); ?>" required/></div>
                                    </div>
                                </div>
								
								<div class="row mt-20 mb-10">
                                    <div class="col-md-8"><h6 class="txt-dark"><?php _e('Also Send Push Notification for following Post Types', 'push-notification-for-wp-by-pushassist'); ?></h6></div>
                                </div>
								
								<div class="form-group">									
                                    <div class="col-md-10">
                                        <div class="input-icon right">											
										<select class="form-control select2" name="pushassist_post_types[]" id="pushassist_post_types" multiple>
											<?php
												$psa_post_list = array();
												if(isset($pushassist_settings['psaAllowCustomPostTypes'])){
													$psa_post_list = explode(",", $pushassist_settings['psaAllowCustomPostTypes']);
												}
										
												foreach ( get_post_types( '', 'names' ) as $post_type ) {
											
													if(in_array($post_type, $psa_post_list)){
                                            ?>											
														<option selected value="<?php echo $post_type; ?>"><?php echo $post_type; ?></option>
                                            <?php
													} else {
											?>
														<option value="<?php echo $post_type; ?>"><?php echo $post_type; ?></option>
											<?php
													}
												}
											?>
										</select>
									</div>
								</div>

                            </div>                            
                        
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
		</div>
	</div>
	
	</form>

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
	
	jQuery("#pushassist_setting_is_utm_show").on('change', function () {

        if (jQuery('#pushassist_setting_is_utm_show').is(':checked')) {
            jQuery('#pushassist_setting_utm_parameter_div').show('slow');
        } else {
            jQuery('#pushassist_setting_utm_parameter_div').hide('slow');
        }
    });
</script>