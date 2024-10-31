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
            <h5 class="txt-dark"><?php _e('Subscribers Details', 'push-notification-for-wp-by-pushassist'); ?></h5>
        </div>
    </div>
    <div class="row mt-20">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default card-view panel-refresh">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body row">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="all_domains" class="table table-hover mb-0">
                                    <colgroup>
                                        <col width="20%"/>
                                        <col width="40%"/>
                                        <col width="40%"/>
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php _e('NAME', 'push-notification-for-wp-by-pushassist');?></th>
                                        <th><?php _e('AUDIENCE REACH', 'push-notification-for-wp-by-pushassist');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if ($stats) {

                                        $no = 1;

                                        foreach ($stats as $stat) {
                                            ?>

                                            <tr>
                                                <td><span class="title"><?php echo $no; ?></span></td>
                                                <td><span class="title"><?php echo $stat['name']; ?></span>
                                                </td>                                                
                                                <td>
													<span class="title">														
														<span class="stats_<?php echo $no; ?>" style="font-size: 21px; padding: 3px 0; background-color: transparent; border: 0px;"><?php echo $stat['value']; ?></span>
													</span>
												</td>
                                            </tr>
                                            <?php $no++;
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="8" class="text-center"><span
                                                    class="txt"><?php _e('Sorry, No Record Found', 'push-notification-for-wp-by-pushassist'); ?></span></td>
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
		
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default card-view mb-0">
				<?php 
					$wp_special_plan_title = $subscriber_details['pricing_plan']['title'];
					
					if($subscriber_details['subscriber_limit'] == 65000 && $subscriber_details['plan_id'] == 0){
						$wp_special_plan_title = "PushAssist WordPress Special";
					}
				?>
				<div class="panel-heading">
					<div class="pull-left" style="display: inline-flex">
						<h4 class="txt-dark mr-20" style="line-height: 40px;"><?php echo $wp_special_plan_title;?> Plan - $<?php echo $subscriber_details['pricing_plan']['price'];?> </h4> <a class="btn btn-primary btn-anim" target="_blank" href="<?php echo 'https://'.$subscriber_details['sub_domain'].'.pushassist.com/pricing/'.$subscriber_details['sub_domain'].'/';?>"><i class="fa fa-rocket"></i><span class="btn-text">UPGRADE</span></a>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="panel-wrapper collapse in">
					<div class="panel-body">

						<?php 
							$remain_percentage = $used_subscribers = $total_subscribers = 0;							
							
							if (($subscriber_details['subscribers_left'] > 0) && ($subscriber_details['subscriber_limit'] > 0)){
								$remain_percentage = number_format((($subscriber_details['subscribers_left'] / $subscriber_details['subscriber_limit']) * 100), 2);					$used_subscribers = number_format((100 - $remain_percentage), 2);
								$total_subscribers = $subscriber_details['subscriber_limit'] - $subscriber_details['subscribers_left'];
							}
						?>
						
						<div class="row">
							<div class="col-sm-4 hidden-xs hidden-sm">
								<div class="panel panel-default card-view" style="padding: 0px; margin-bottom:0px; border: none;">
									<div class="panel-wrapper collapse in">
										<div class="panel-body" style="padding: 5px 15px 0px 15px">
											<span class="font-15 head-font weight-500 txt-dark">Usage<span class="pull-right font-13 weight-500"><?php echo number_format($total_subscribers); ?> of <?php echo number_format($subscriber_details['subscriber_limit']); ?> Subscribers</span></span>
											<div class="progress mt-0 mt-5" style="background: #b3caa2">
												<div class="progress-bar progress-bar-orange" aria-valuenow="<?php echo $used_subscribers;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $used_subscribers;?>%" role="progressbar"> <span class="sr-only"><?php echo $used_subscribers;?>% Complete (success)</span> </div>
											</div>
											<span class="font-12 weight-500 txt-dark"><?php echo number_format($subscriber_details['subscribers_left']); ?> Available</span><span class="pull-right font-13 weight-500"><a class="" style="color: #ea6c41;" target="_blank" href="<?php echo 'https://'.$subscriber_details['sub_domain'].'.pushassist.com/pricing/'.$subscriber_details['sub_domain'].'/';?>">Upgrade Plan</a></span>
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
<!-- Content End -->
