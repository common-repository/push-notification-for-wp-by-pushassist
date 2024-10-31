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

        <div class="row">
            <div class="col-md-9 col-xs-6">
                <h5 class="txt-dark"><?php _e('Notification History', 'push-notification-for-wp-by-pushassist'); ?></h5>
            </div>
            <div class="col-md-3 col-xs-6">
                <a href="admin.php?page=pushassist-send-notifications" class="btn btn-success btn-anim pull-right"><i class="fa fa-send"></i><span
                        class="btn-text"><?php _e('New Notification', 'push-notification-for-wp-by-pushassist'); ?></span></a>
            </div>
        </div>

        <div class="notification-list-table bootstrap-table mt-20">
            <div class="table-responsive">
                <table class="table hidden-sm hidden-xs">
                    <colgroup>
                        <col width="40%"/>
                        <col width="13%"/>
                        <col width="13%"/>
                        <col width="10%"/>
                        <col width="16%"/>
                        <col width="10%"/>
                    </colgroup>
                    <thead class="listing_heading">
                    <tr>
                        <th><?php _e('Notification', 'push-notification-for-wp-by-pushassist'); ?></th>
                        <th><?php _e('Total Sent', 'push-notification-for-wp-by-pushassist'); ?></th>
                        <th><?php _e('Delivered', 'push-notification-for-wp-by-pushassist'); ?></th>
                        <th><?php _e('Unsubscribed', 'push-notification-for-wp-by-pushassist'); ?></th>
                        <th><?php _e('Clicked', 'push-notification-for-wp-by-pushassist'); ?></th>
                        <th><?php _e('Ignored', 'push-notification-for-wp-by-pushassist'); ?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    if ($notification_list) {

                        foreach ($notification_list as $notification) {
                            ?>
                            <tr class="listing_row listing_row-dash">
                                <td>
                                    <?php if ($notification['is_campaign'] == 2) { ?>
                                        <div class="campaign_tag">
                                            <span class="campaign"><?php _e('Campaign', 'push-notification-for-wp-by-pushassist'); ?></span>
                                            <?php if ($notification['event_id'] == '') { ?>
                                                <span class="campaign_title">
                                                    <?php 
														echo $notification['campaign_datetime']; 														
														foreach ($timezones as $key => $value) {
															if ($notification['timezone'] == $value) {
																echo "(" . $notification['timezone'] . ")";
															}
														}													
													?>
                                                </span>
                                            <?php } ?>
                                            <span class="campaign_title">&nbsp;</span>
                                        </div>
                                    <?php } ?>
                                    <div class="image_wrapper">
                                        <img src="<?php echo $notification['logo']; ?>" alt="<?php echo $notification['title']; ?>">
                                    </div>
                                    <div class="div_txt">
                                        <span class="title"><?php echo $notification['title']; ?></span>
                                        <span class="message"><?php echo $notification['message']; ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="stats">
                                        <?php echo number_format($notification['total_sent']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="stats"><?php echo number_format($notification['success']); ?></span>
                                </td>
                                <td>
                                    <span class="stats"><?php echo number_format($notification['failed']); ?></span>
                                </td>
                                <td>
                                    <span
                                        class="stats"><?php echo number_format($notification['total_clicked']); ?></span>

                                    <?php

                                    if ($notification['success'] != 0) {

                                        $percentChange = ($notification['total_clicked'] / $notification['success']) * 100;
                                    } else {

                                        $percentChange = 0;
                                    }

                                    $percentChange = number_format($percentChange, 2);

                                    if ($percentChange >= 1) {
                                        ?>
                                        <span class="stats txt-success"><?php echo $percentChange; ?>%</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <span class="stats"><?php echo number_format($notification['close_click']); ?></span>
                                </td>
                            </tr>
                            <tr class="listing_row_bottom">
                                <td colspan="1">
                                    <?php if (!empty($notification['url'])) { ?>
                                        <a href="<?php echo $notification['url']; ?>"
                                           title="<?php echo $notification['title']; ?>"
                                           target="_blank"><?php echo substr($notification['url'], 0, 70); ?>...</a>
                                    <?php } ?>
                                </td>
                                <td colspan="3">
                                <span class="segments">
                                        <?php echo $notification['segments']; ?>
                                </span>
                                </td>
                                <td colspan="2">
                                    <div class="notification_date"><i
                                            class="icon icon-clock"></i><?php echo $notification['created_at']; ?></div>
                                </td>
                            </tr>
                            <tr class="blank-row">
                                <td colspan="6">&nbsp;</td>
                            </tr>

                        <?php }
                    } else { ?>

                        <tr class="listing_row_bottom normal_listing_row">
                            <td colspan="6" class="text-center"><span class="txt"><?php _e('Sorry, No Record Found', 'push-notification-for-wp-by-pushassist'); ?></span></td>
                        </tr>

                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
