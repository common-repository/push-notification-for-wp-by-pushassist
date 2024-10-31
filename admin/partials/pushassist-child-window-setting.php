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
            <h5 class="txt-dark"><?php _e('Child Window Setting (HTTP Sites)', 'push-notification-for-wp-by-pushassist'); ?></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN VALIDATION STATES-->
            <div class="panel panel-default card-view">

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <!-- BEGIN FORM-->
                        <form action="admin.php?page=pushassist-child-window-setting" id="pushassist_child_setting_form" name="pushassist_child_setting_form"
                              class="form-horizontal" method="post"
                              autocomplete="off">
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Opt-in Text', 'push-notification-for-wp-by-pushassist'); ?> <span class="required"> * </span> </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" id="pushassist_child_text"
                                                   name="pushassist_child_text" value="<?php echo $child_window_details['text']; ?>"
                                                   maxlength="90" required/></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Opt-in Title', 'push-notification-for-wp-by-pushassist'); ?> <span
                                            class="required"> * </span>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" id="pushassist_child_title"
                                                   name="pushassist_child_title" value="<?php echo $child_window_details['title']; ?>"
                                                   maxlength="75" required/></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Opt-in Message', 'push-notification-for-wp-by-pushassist'); ?> <span
                                            class="required"> * </span>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" id="pushassist_child_message"
                                                   name="pushassist_child_message" value="<?php echo $child_window_details['message']; ?>"
                                                   maxlength="135" required/></div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-5">
                                        <button name="psa-child-window-setting" type="submit" class="btn btn-success btn-anim mr-10"><i
                                                class="icon-rocket"></i><span class="btn-text"><?php _e('Save Setting', 'push-notification-for-wp-by-pushassist'); ?></span></button>

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
    </div>
</div>