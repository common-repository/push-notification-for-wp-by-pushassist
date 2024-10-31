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
            <h5 class="txt-dark"><?php _e('PushAssist Settings', 'push-notification-for-wp-by-pushassist'); ?></h5>
        </div>
    </div>
	
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="col-sm-3 col-xs-12 mb-15 outer-box">
                        <div class="box">
                            <div class="image-div text-center">
                                <img src="<?php echo esc_url( plugins_url( 'images/setting-icons/website-setup.png', __DIR__ ) );?>" alt="Website Setup">
                            </div>
                            <div class="title text-center">
                                <h3><?php _e('Opt-in Setup', 'push-notification-for-wp-by-pushassist'); ?></h3>
                                <p class="mt-5 mb-10"><?php _e('A warm welcome to all new subscribers', 'push-notification-for-wp-by-pushassist'); ?></p>
                            </div>
                            <div class="text-center"><a href="admin.php?page=pushassist-opt-in-setup" class="btn btn-success"><?php _e('Edit', 'push-notification-for-wp-by-pushassist'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12 mb-15 outer-box">
                        <div class="box" style="border: 1px solid #d9e1e3;padding: 20px;background: #fff;">
                            <div class="image-div text-center">
                                <img src="<?php echo esc_url( plugins_url( 'images/setting-icons/welcome-message.png', __DIR__ ) );?>" alt="WelCome Message Setup">
                            </div>
                            <div class="title text-center">
                                <h3><?php _e('WelCome Notification Settings', 'push-notification-for-wp-by-pushassist'); ?></h3>
                                <p class="mt-5 mb-10"><?php _e('Send new users a welcome notification after subscribing', 'push-notification-for-wp-by-pushassist'); ?></p>
                            </div>
                            <div class="text-center"><a href="admin.php?page=pushassist-welcome-message-setting" class="btn btn-success"><?php _e('Edit', 'push-notification-for-wp-by-pushassist'); ?></a>
                            </div>
                        </div>
                    </div>

                    <?php if($account_details['ssl'] == 0){ //0 = Non SSL?>
                    <div class="col-sm-3 col-xs-12 mb-15 outer-box">
                        <div class="box">
                            <div class="image-div text-center">
                                <img src="<?php echo esc_url( plugins_url( 'images/setting-icons/child-window.png', __DIR__ ) );?>" alt="Child Window Setup">
                            </div>
                            <div class="title text-center">
                                <h3><?php _e('Child Window Setup', 'push-notification-for-wp-by-pushassist'); ?></h3>
                                <p class="mt-5 mb-10"><?php _e('Modify the HTTP Pop-up Prompt Settings', 'push-notification-for-wp-by-pushassist'); ?></p>
                            </div>
                            <div class="text-center"><a href="admin.php?page=pushassist-child-window-setting" class="btn btn-success"><?php _e('Edit', 'push-notification-for-wp-by-pushassist'); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="col-sm-3 col-xs-12 mb-15 outer-box">
                        <div class="box">
                            <div class="image-div text-center">
                                <img src="<?php echo esc_url( plugins_url( 'images/setting-icons/website-setup.png', __DIR__ ) );?>" alt="Advance Settings">
                            </div>
                            <div class="title text-center">
                                <h3><?php _e('Advanced Settings', 'push-notification-for-wp-by-pushassist'); ?></h3>
                                <p class="mt-5 mb-10"><?php _e('Additional Settings to Manage Default Controls', 'push-notification-for-wp-by-pushassist'); ?></p>
                            </div>
                            <div class="text-center"><a href="admin.php?page=pushassist-advance-settings" class="btn btn-success"><?php _e('Edit', 'push-notification-for-wp-by-pushassist'); ?></a>
                            </div>
                        </div>
                    </div>

					<?php if($account_details['ssl'] == 1){ //1 = SSL?>
                    <div class="col-sm-3 col-xs-12 mb-15 outer-box">
                        <div class="box">
                            <div class="image-div text-center">
                                <img src="<?php echo esc_url( plugins_url( 'images/setting-icons/website-setup.png', __DIR__ ) );?>" alt="Advance Settings">
                            </div>
                            <div class="title text-center">
                                <h3><?php _e('AMP Integration', 'push-notification-for-wp-by-pushassist'); ?></h3>
                                <p class="mt-5 mb-10"><?php _e('AMP Integration Steps', 'push-notification-for-wp-by-pushassist'); ?></p>
                            </div>
                            <div class="text-center"><a href="admin.php?page=pushassist-amp-settings" class="btn btn-success"><?php _e('Edit', 'push-notification-for-wp-by-pushassist'); ?></a>
                            </div>
                        </div>
                    </div>
                     <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>