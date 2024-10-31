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
                <a href="admin.php?page=pushassist-campaigns" class="btn btn-success btn-anim pull-right"><i class="fa fa-send"></i><span
                        class="btn-text"><?php _e('New Campaign', 'push-notification-for-wp-by-pushassist'); ?></span></a>
            </div>
        </div>

		<div  class="pills-struct mt-40">
			<ul role="tablist" class="nav nav-pills" id="myTabs_6">
				<li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="home_tab_6" href="#home_6">Active</a></li>
				<li role="presentation" class=""><a  data-toggle="tab" id="profile_tab_6" role="tab" href="#profile_6" aria-expanded="false">Archive</a></li>				
			</ul>
			<div class="tab-content" id="myTabContent_6">
				<div  id="home_6" class="tab-pane fade active in" role="tabpanel">					
					<div class="notification-list-table bootstrap-table mt-20">
						<div class="table-responsive">
							<table class="table hidden-sm hidden-xs">
								<colgroup>
									<col width="50%"/>									
									<col width="30%"/>									
									<col width="20%"/>
								</colgroup>
								<thead class="listing_heading">
								<tr>
									<th><?php _e('Notification', 'push-notification-for-wp-by-pushassist'); ?></th>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
								</tr>
								</thead>
								<tbody>

								<?php

								if ($active_campaign_list) {

									foreach ($active_campaign_list as $active_campaign) {
											$timezone_txt = '';
											foreach($timezones as $key => $value){
												if($value == $active_campaign['timezone']){
													$timezone_txt = $key;
												}
											}
										?>
										<tr class="listing_row listing_row-dash">
											<td>
												<div class="campaign_tag">
													<span class="campaign"><?php _e('Campaign', 'push-notification-for-wp-by-pushassist'); ?></span>
													<span class="campaign_title">
														<?php echo $active_campaign['campaign_datetime'] . " (" . $timezone_txt . ")"; ?>
													</span>													
													<span class="campaign_title">&nbsp;</span>
												</div>												
												
												<div class="image_wrapper">
													<img src="<?php echo $active_campaign['logo']; ?>" alt="<?php echo $active_campaign['title']; ?>">
												</div>
												<div class="div_txt">
													<span class="title"><?php echo $active_campaign['title']; ?></span>
													<span class="message"><?php echo $active_campaign['message']; ?></span>
												</div>
											</td>
											<td>&nbsp;</td>
										</tr>
										<tr class="listing_row_bottom">
											<td colspan="1">
												<?php if (!empty($active_campaign['redirecturl'])) { ?>
													<a href="<?php echo $active_campaign['redirecturl']; ?>"
													   title="<?php echo $active_campaign['title']; ?>"
													   target="_blank"><?php echo substr($active_campaign['redirecturl'], 0, 70); ?>...</a>
												<?php } ?>
											</td>
											<td colspan="1">
												<?php
													$segment_string = "";
													if ($segment_list && isset($active_campaign['segments'])) {
														$campaign_segment_arr = explode(',', $active_campaign['segments']);														
														foreach ($segment_list as $segment) {
															if(in_array($segment['id'], $campaign_segment_arr)){
																$segment_string = $segment_string . $segment['name'] . ', ';
															}
														}
														$segment_string = substr($segment_string, 0, -2);
													}
												?>
												<span class="segments">
													<?php echo $segment_string; ?>
												</span>
											</td>
											<td colspan="1">
												<div class="notification_date"><i
														class="icon icon-clock"></i><?php echo $active_campaign['created_at']; ?></div>
											</td>
										</tr>
										<tr class="blank-row">
											<td colspan="3">&nbsp;</td>
										</tr>

									<?php }
								} else { ?>

									<tr class="listing_row_bottom normal_listing_row">
										<td colspan="3" class="text-center"><span class="txt"><?php _e('Sorry, No Record Found', 'push-notification-for-wp-by-pushassist'); ?></span></td>
									</tr>

								<?php } ?>

								</tbody>
							</table>
						</div>
					</div>
					
				</div>
				<div  id="profile_6" class="tab-pane fade" role="tabpanel">					
					<div class="notification-list-table bootstrap-table mt-20">
						<div class="table-responsive">
							<table class="table hidden-sm hidden-xs">
								<colgroup>
									<col width="50%"/>									
									<col width="30%"/>									
									<col width="20%"/>
								</colgroup>
								<thead class="listing_heading">
								<tr>
									<th><?php _e('Notification', 'push-notification-for-wp-by-pushassist'); ?></th>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
								</tr>
								</thead>
								<tbody>

								<?php

								if ($archive_campaign_list) {

									foreach ($archive_campaign_list as $archive_campaign) {
											$timezone_txt = '';
											foreach($timezones as $key => $value){
												if($value == $archive_campaign['timezone']){
													$timezone_txt = $key;
												}
											}
										?>
										<tr class="listing_row listing_row-dash">
											<td>												
												<div class="campaign_tag">
													<span class="campaign"><?php _e('Campaign', 'push-notification-for-wp-by-pushassist'); ?></span>
													<span class="campaign_title">
														<?php echo $archive_campaign['campaign_datetime'] . " (" . $timezone_txt . ")"; ?>
													</span>													
													<span class="campaign_title">&nbsp;</span>
												</div>												
												
												<div class="image_wrapper">
													<img src="<?php echo $archive_campaign['logo']; ?>" alt="<?php echo $archive_campaign['title']; ?>">
												</div>
												<div class="div_txt">
													<span class="title"><?php echo $archive_campaign['title']; ?></span>
													<span class="message"><?php echo $archive_campaign['message']; ?></span>
												</div>
											</td>
											<td>&nbsp;</td>
										</tr>
										<tr class="listing_row_bottom">
											<td colspan="1">
												<?php if (!empty($archive_campaign['redirecturl'])) { ?>
													<a href="<?php echo $archive_campaign['redirecturl']; ?>"
													   title="<?php echo $archive_campaign['title']; ?>"
													   target="_blank"><?php echo substr($archive_campaign['redirecturl'], 0, 70); ?>...</a>
												<?php } ?>
											</td>
											<td colspan="1">
												<?php
													$segment_string = "";
													if ($segment_list && isset($archive_campaign['segments'])) {
														$campaign_segment_arr = explode(',', $archive_campaign['segments']);														
														foreach ($segment_list as $segment) {
															if(in_array($segment['id'], $campaign_segment_arr)){
																$segment_string = $segment_string . $segment['name'] . ', ';
															}
														}
														$segment_string = substr($segment_string, 0, -2);
													}
												?>
												<span class="segments">
													<?php echo $segment_string; ?>
												</span>
											</td>
											<td colspan="1">
												<div class="notification_date"><i
														class="icon icon-clock"></i><?php echo $archive_campaign['created_at']; ?></div>
											</td>
										</tr>
										<tr class="blank-row">
											<td colspan="3">&nbsp;</td>
										</tr>

									<?php }
								} else { ?>

									<tr class="listing_row_bottom normal_listing_row">
										<td colspan="3" class="text-center"><span class="txt"><?php _e('Sorry, No Record Found', 'push-notification-for-wp-by-pushassist'); ?></span></td>
									</tr>

								<?php } ?>

								</tbody>
							</table>
						</div>
					</div>					
					
				</div>				
			</div>
		</div>        
    </div>
