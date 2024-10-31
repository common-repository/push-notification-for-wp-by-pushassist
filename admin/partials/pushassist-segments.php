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
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Oop`s something went wrong, Please try again.
			</div>
			<?php 
				}
			?>
            <h5 class="txt-dark"><?php _e('Create Segment', 'push-notification-for-wp-by-pushassist'); ?></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN VALIDATION STATES-->
            <div class="panel panel-default card-view">

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <!-- BEGIN FORM-->
                        <form action="admin.php?page=pushassist-segments" id="segment_form" name="segment_form" class="form-horizontal" method="post"
                              autocomplete="off">
                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3"> <?php _e('Segment Name', 'push-notification-for-wp-by-pushassist'); ?> <span
                                            class="required"> * </span>
                                    </label>
                                    <div class="col-md-8">
                                        <div class="input-icon right">
                                            <input type="text" class="form-control" id="pushassist_segment_name"
                                                   name="pushassist_segment_name" value=""
                                                   maxlength="40" required/></div>                                        
                                        <span class="custom-label label-default" data-toggle="tooltip"
                                              data-placement="right" title="Limit 40 Characters. E.g. Google"
                                              data-original-title="Limit 40 Characters. E.g. Google">?</span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-5">
                                        <button type="submit" class="btn btn-success btn-anim mr-10"><i
                                                class="icon-rocket"></i><span class="btn-text"><?php _e('Submit', 'push-notification-for-wp-by-pushassist'); ?></span></button>
												
										<a href="admin.php?page=pushassist-segment-details" class="btn btn-default btn-anim mr-10"><i
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
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark"><?php _e('How to Implement Segments for your Push Notification Subscribers.', 'push-notification-for-wp-by-pushassist'); ?></h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body segment_div">

                        <div class="segment_box">
                            <p><strong><?php _e('Step 1 :', 'push-notification-for-wp-by-pushassist'); ?></strong><?php _e('Create a new segment. Go to Create Segments', 'push-notification-for-wp-by-pushassist'); ?></p>

                            <p><strong><?php _e('Step 2 :', 'push-notification-for-wp-by-pushassist'); ?></strong> <?php _e('Copy the following JavaScript code and paste it on your site page(s)..', 'push-notification-for-wp-by-pushassist'); ?></p>

                            <p><strong><?php _e('Subscribing for Single Segment', 'push-notification-for-wp-by-pushassist'); ?></strong></p>
                            <p><code>
                                    &lt;script&gt;
                                    <br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; var _pa = [];<br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; _pa.push('YourSegmentName');
                                    <br>
                                    &lt;/script&gt;</code>
                            </p>

                            <p><strong><?php _e('Subscribing for Multiple Segments', 'push-notification-for-wp-by-pushassist'); ?></strong></p>

                            <p><code>
                                    &lt;script&gt;
                                    <br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; var _pa = [];<br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; _pa.push('YourSegmentName1', 'YourSegmentName2');
                                    <br>
                                    &lt;/script&gt;</code>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>