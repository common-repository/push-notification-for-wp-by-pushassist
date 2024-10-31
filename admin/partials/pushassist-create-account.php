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
<div id="pushassist" class="content clearfix">
    
	<div class="col-sm-12 mt-10">
        <div class="ml-5">
			<?php 
				if(isset($_REQUEST['response_message'])){
			?>
			<div class="alert alert-<?php echo esc_html($_REQUEST['class']);?> alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php if($_REQUEST['response_message'] == 't'){echo esc_html("PushAssist is installed, no additional step is needed. Completely Purge Site Cache once to see it in action. Your Account Details have already been emailed to you. Also check under SPAM if you don't find it.");}else{echo esc_html("Oop`s something went wrong, Please try again.");} ?>
			</div>
			<?php 
				}
			?>
        </div>
    </div>

    <!-- Container Start -->
    <div class="container-widget clearfix">
        <div class="col-md-6">

            <h4 class="mb-15"><?php _e('Create an Account', 'push-notification-for-wp-by-pushassist');?></h4>

            <div class="panel panel-default">
                <div class="panel-body">

                    <form name="registration_form" id="registration_form" class="space-top"
                          action="admin.php?page=pushassist-create-account"
                          method="post">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="pushassist_name" id="pushassist_name"
                                       placeholder="<?php _e('Full Name', 'push-notification-for-wp-by-pushassist');?>" type="text" maxlength="100"
                                       required="required">								
                            </div>
                        </div>

                        <input type="hidden" name="pushassist_api_form" id="pushassist_api_form" value="pushassist_account_creation">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="pushassist_company_name" id="pushassist_company_name"
                                       placeholder="<?php _e('Company Name', 'push-notification-for-wp-by-pushassist');?>" type="text" maxlength="200">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group" id="result">
                                <input class="form-control" name="pushassist_contact" id="pushassist_contact" type="tel">
							   <input type="hidden" name="hidden_psa_error_msg" id="hidden_psa_error_msg" value="0">							   
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="pushassist_email" id="pushassist_email" placeholder="<?php _e('Email', 'push-notification-for-wp-by-pushassist');?>"
                                       type="email" maxlength="150" required="required">
                            </div>
                        </div>
                        <div class="col-sm-12 margin-b-20 clearfix">
                            <div class="form-group clearfix">
                                <input class="form-control cont_form_password col-sm-12" name="pushassist_password" id="pushassist_password"
                                       placeholder="<?php _e('Password', 'push-notification-for-wp-by-pushassist');?>" type="password" maxlength="50"
                                       required="required">
                            </div>
                        </div>
						
                        <div class="col-sm-2 margin-b-20">
							<div class="form-group">
								<select name="pushassist_protocol" id="pushassist_protocol" class="selectpicker form-control dropdown-toggle" required>
									<option value="http://"><?php _e('http://', 'push-notification-for-wp-by-pushassist');?></option>
									<option value="https://"><?php _e('https://', 'push-notification-for-wp-by-pushassist');?></option>
								</select>
							</div>
                        </div>
                        <div class="col-sm-10 margin-b-20">
							<div class="form-group">
                            <input class="form-control" name="pushassist_site_url" id="pushassist_site_url"
                                   placeholder="<?php _e('Site Url', 'push-notification-for-wp-by-pushassist');?>" type="text" maxlength="200"
                                   required="required">
							</div>
                        </div>

						<span class="subdomain_protocol bg-color margin-b-20">
							https://
						</span>
						
                        <div class="col-sm-9 subdomain-title tooltip margin-b-20">
                            <input class="form-control text-r" name="pushassist_sub_domain" id="pushassist_sub_domain"
                                   placeholder="<?php _e('Your domain, brand, sitename', 'push-notification-for-wp-by-pushassist');?>" type="text" maxlength="80"
                                   required="required">
							<span class="tooltip__text">Browsers permit subscriptions on https sites only. We require a SSL subdomain to manage subscriptions and deliver push notifications. This subdomain is displayed in the notification you deliver and from where you gather subscription data. It can only contain a-z, 0-9 characters. Doesn't apply for SSL sites.</span>
                        </div>
                        <div class="form-group col-sm-3 subdomain bg-color margin-b-20">
                            <?php _e('.pushassist.com', 'push-notification-for-wp-by-pushassist');?>
                        </div>

						<div class="col-sm-10 margin-b-20">
							<input type="submit" class="btn btn-ghost btn-default margin-b-20 margin-t-20 margin-l-5"
								   value="<?php _e('Create Account', 'push-notification-for-wp-by-pushassist');?>">
							<!-- Validation Response -->
							<div class="response-holder"></div>
						</div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-6">

            <h4 class="mb-15"><?php _e('Provide API Key And Secret Key.', 'push-notification-for-wp-by-pushassist');?></h4>

            <div class="panel panel-default">
                <div class="panel-body">

                    <form name="key_form" id="key_form" class="space-top"
                          action="admin.php?page=pushassist-create-account"
                          method="post">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="pushassist_api_key" id="pushassist_api_key"
                                       placeholder="<?php _e('API Key', 'push-notification-for-wp-by-pushassist');?>" type="text" maxlength="250"
                                       required="required">
                            </div>
                        </div>

                        <input type="hidden" name="pushassist_api_form" id="pushassist_api_form" value="pushassist_appKey">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="pushassist_secret_key" id="pushassist_secret_key"
                                       placeholder="<?php _e('Secret Key', 'push-notification-for-wp-by-pushassist');?>" type="text" maxlength="250">
                            </div>
                        </div>
						<div class="col-sm-12">
							<input type="submit" class="btn btn-ghost btn-default margin-b-20 margin-t-20 margin-l-5" value="<?php _e('Submit', 'push-notification-for-wp-by-pushassist');?>">
							<!-- Validation Response -->
							<div class="response-holder"></div>
						</div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-6">

            <h4 class="mb-15"><?php _e('How to get API Keys', 'push-notification-for-wp-by-pushassist');?></h4>

            <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                        <?php _e("If you are an existing user of PushAssist you can find your api keys under your PushAssist control panel. To get your API and Secret Keys login to your", 'push-notification-for-wp-by-pushassist');?>
                        <strong><?php _e('PushAssist Admin Control Panel', 'push-notification-for-wp-by-pushassist');?></strong> <?php _e('and click', 'push-notification-for-wp-by-pushassist');?>
                        <strong><?php _e('Sites', 'push-notification-for-wp-by-pushassist');?></strong>
                        <?php _e(". Copy the API Key and Secret Keys from your control Panel and paste above. Your account login details were sent to you at the time of signup. In case you have missed your account credentials please send us an email at", 'push-notification-for-wp-by-pushassist');?>
                        <a href='mailto:support@pushassist.com'><?php _e("support@pushassist.com", 'push-notification-for-wp-by-pushassist');?> </a>
                        <?php _e("containing your site url and we will send you your account credentials.", 'push-notification-for-wp-by-pushassist');?>
                    </p>
                    <p> <?php _e('Please do not share your API and Secret keys with anyone.', 'push-notification-for-wp-by-pushassist');?> </p>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo '../wp-content/plugins/push-notification-for-wp-by-pushassist/admin/js/select2.full.min.js';?>"></script>

<script language="javascript">
	/* Select2 Init*/
    jQuery(".select2").select2();
</script>