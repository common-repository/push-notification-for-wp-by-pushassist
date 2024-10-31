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
        </div>
		<div class="col-md-9">
		<h5 class="txt-dark pt-10"><?php _e('AMP Integration Steps (Works only for HTTPS Websites)', 'push-notification-for-wp-by-pushassist'); ?></h5>
        </div>
		<div class="col-md-1 pr-5">
			<div class="pull-right">
				<a href="admin.php?page=pushassist-setting" class="btn btn-default btn-anim"><i
													class="icon icon-action-undo"></i><span class="btn-text"><?php _e('Back', 'push-notification-for-wp-by-pushassist'); ?></span></a>
			</div>
        </div>
    </div>
	
    <div class="row">
        <div class="col-md-10">
            <!-- BEGIN VALIDATION STATES-->
            <div class="panel panel-default card-view">

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <!-- BEGIN FORM-->
                    <p class="mb-15"><?php _e('To integrate PushAssist on your AMP powered website pages, you need to follow the steps given below. If at any time you need help setting up, please create a support ticket by submitting PushAssist contact us form.', 'push-notification-for-wp-by-pushassist'); ?></p>
                    <p><?php _e('Insert this code into your AMP webpages just before the head tag ends.', 'push-notification-for-wp-by-pushassist'); ?></p>
					
					<p class="mb-15"><pre><code>&#x3C;script async custom-element=&#x22;amp-web-push&#x22; src=&#x22;https://cdn.ampproject.org/v0/amp-web-push-0.1.js&#x22;&#x3E;&#x3C;/script&#x3E;</code></pre></p>
                    
					<p class="mb-15 mt-15"><?php _e('Add the following CSS to your AMP webpages (style amp-custom tag). This is the CSS theme for the subscribe/unsubscribe buttons. You can customize it to suit your website theme.', 'push-notification-for-wp-by-pushassist'); ?></p>
					
					<p class="mb-15"><pre><code>.psa-web-push{padding-top:10px;text-align:center}.psa-amp-subscribe,.psa-amp-unsubscribe{padding:8px 15px;cursor:pointer;outline:0;font-weight:400;-webkit-tap-highlight-color:transparent}.psa-amp-subscribe{border-radius:2px;border:1px solid #4a90e2;margin:0;font-size:16px;background:#4a90e2;color:#fff}.psa-amp-subscribe amp-img{width:20px;height:20px;vertical-align:sub;margin-right:4px}.psa-amp-unsubscribe{border-radius:2px;border:1px solid #b3b3b3;margin:0;font-size:15px;background:#bdbdbd;color:#555}.psa-amp-subscribe:active,.psa-amp-unsubscribe:active{transform:scale(.99)}</code></pre></p>
					                    
					<?php
						$webSiteUrl = get_home_url();
						$sub_domain = $account_details['account_name'];
						
						$permission_dialog = $webSiteUrl.'/wp-content/plugins/push-notification-for-wp-by-pushassist/public/psa-sdk/permission-dialog.html';
						$helper_iframe = $webSiteUrl.'/wp-content/plugins/push-notification-for-wp-by-pushassist/public/psa-sdk/helper-iframe.html';
						$service_worker = $webSiteUrl.'/wp-content/plugins/push-notification-for-wp-by-pushassist/public/psa-sdk/service-worker.php?sub_domain='.$sub_domain;
					?>
					
					<p class="mb-15 mt-15"><?php _e('Add the following code on your page, where you want to show "Subscribe/Unsubscribe" button.', 'push-notification-for-wp-by-pushassist'); ?></p>
					
					<p class="mb-15"><pre><code>&#x3C;amp-web-push id=&#x22;amp-web-push&#x22; layout=&#x22;nodisplay&#x22; helper-iframe-url=&#x22;<?php echo $helper_iframe;?>&#x22; permission-dialog-url=&#x22;<?php echo $permission_dialog;?>&#x22; service-worker-url=&#x22;<?php echo $service_worker; ?>&#x22;&#x3E;&#x3C;/amp-web-push&#x3E;&#x3C;div class=&#x22;psa-web-push&#x22;&#x3E; &#x3C;amp-web-push-widget visibility=&#x22;unsubscribed&#x22; layout=&#x22;fixed&#x22; width=&#x22;250&#x22; height=&#x22;40&#x22;&#x3E;&#x3C;button class=&#x22;psa-amp-subscribe&#x22; on=&#x22;tap:amp-web-push.subscribe&#x22;&#x3E;&#x3C;amp-img width=&#x22;20&#x22; height=&#x22;20&#x22; layout=&#x22;fixed&#x22; src=&#x22;data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNTYgMjU2Ij48dGl0bGU+UHVzaEFsZXJ0PC90aXRsZT48ZyBpZD0iRm9ybWFfMSIgZGF0YS1uYW1lPSJGb3JtYSAxIj48ZyBpZD0iRm9ybWFfMS0yIiBkYXRhLW5hbWU9IkZvcm1hIDEtMiI+PHBhdGggZD0iTTEzMi4wNywyNTBjMTguNjIsMCwzMy43MS0xMS41MywzMy43MS0yMUg5OC4zNkM5OC4zNiwyMzguNDIsMTEzLjQ2LDI1MCwxMzIuMDcsMjUwWk0yMTksMjAwLjUydjBhNTcuNDIsNTcuNDIsMCwwLDEtMTguNTQtNDIuMzFWMTE0LjcyYTY4LjM2LDY4LjM2LDAsMCwwLTQzLjI0LTYzLjU1VjM1LjlhMjUuMTYsMjUuMTYsMCwxLDAtNTAuMzIsMFY1MS4xN2E2OC4zNiw2OC4zNiwwLDAsMC00My4yMyw2My41NXY0My40NmE1Ny40Miw1Ny40MiwwLDAsMS0xOC41NCw0Mi4zMXYwYTEwLjQ5LDEwLjQ5LDAsMCwwLDYuNTcsMTguNjdIMjEyLjQzQTEwLjQ5LDEwLjQ5LDAsMCwwLDIxOSwyMDAuNTJaTTEzMi4wNyw0NS40MmExMS4zMywxMS4zMywwLDEsMSwxMS4zNi0xMS4zM0ExMS4zMywxMS4zMywwLDAsMSwxMzIuMDcsNDUuNDJabTczLjg3LTE3LjY3LTYuNDUsOS43OGE4My40Niw4My40NiwwLDAsMSwzNi4xNSw1NC43N2wxMS41My0yLjA2YTk1LjIzLDk1LjIzLDAsMCwwLTQxLjIzLTYyLjVoMFpNNjQuNDYsMzcuNTJMNTgsMjcuNzVhOTUuMjMsOTUuMjMsMCwwLDAtNDEuMjMsNjIuNWwxMS41MywyLjA2QTgzLjQ2LDgzLjQ2LDAsMCwxLDY0LjQ1LDM3LjU0aDBaIiBmaWxsPSIjZmZmIi8+PC9nPjwvZz48L3N2Zz4=&#x22;&#x3E;&#x3C;/amp-img&#x3E;Subscribe to Notifications&#x3C;/button&#x3E;&#x3C;/amp-web-push-widget&#x3E;&#x3C;amp-web-push-widget visibility=&#x22;subscribed&#x22; layout=&#x22;fixed&#x22; width=&#x22;250&#x22; height=&#x22;40&#x22;&#x3E;&#x3C;button class=&#x22;psa-amp-unsubscribe&#x22; on=&#x22;tap:amp-web-push.unsubscribe&#x22;&#x3E;Unsubscribe from Notifications&#x3C;/button&#x3E;&#x3C;/amp-web-push-widget&#x3E;&#x3C;/div&#x3E;</code></pre></p>
						
						
					<!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
    </div>
</div>