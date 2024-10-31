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

<div class="wrapper theme-1-active pimary-color-red">
    <!-- Top Menu Items -->
		
	<?php if (isset($_REQUEST['response_message']) && $_REQUEST['response_message'] != '') { ?>
        <div class="updated notice notice-success is-dismissible margin-l-0 margin-r-0">
			<p style='font-size: 15px; margin:15px 0px;'><?php if($_REQUEST['response_message'] == 't'){echo esc_html("PushAssist is installed, no additional step is needed. Completely Purge Site Cache once to see it in action. Your Account Details have already been emailed to you. Also check under SPAM if you don't find it.");}else{echo esc_html("Oop`s something went wrong, Please try again.");} ?> </p>
		</div>
		<div class="clearfix"></div>
    <?php } ?>
	
    <div class="container-fluid pt-25">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="browser_pie_chart">
                <div class="panel panel-default card-view panel-refresh">
                    <div class="refresh-container">
                        <div class="la-anim-1"></div>
                    </div>
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark"><?php _e('Subscribers By Browsers', 'push-notification-for-wp-by-pushassist'); ?></h6>
                        </div>
                        <div class="pull-right">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div>
                                <canvas id="chart_6" height="143"></canvas>
                            </div>
                            <hr class="light-grey-hr row mt-10 mb-15"/>
                            <div class="label-chatrs">
                                <div class="">
                                    <span class="clabels clabels-lg inline-block bg-blue mr-10 pull-left"></span>
                                    <span
                                        class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span
                                            class="block font-15 weight-500 mb-5"><?php echo $dashboard_info['chrome_browser_weekly_percentage']; ?>
                                            % <?php _e('Chrome', 'push-notification-for-wp-by-pushassist'); ?></span><span
                                            class="block txt-grey"><?php echo $dashboard_info['chrome_browser_weekly_stats']; ?>
                                            <?php _e('Subscribers', 'push-notification-for-wp-by-pushassist'); ?></span></span>
                                    <div id="sparkline_1" class="pull-right"
                                         style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <hr class="light-grey-hr row mt-10 mb-15"/>
                            <div class="label-chatrs">
                                <div class="">
                                    <span class="clabels clabels-lg inline-block bg-green mr-10 pull-left"></span>
                                    <span
                                        class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span
                                            class="block font-15 weight-500 mb-5"><?php echo $dashboard_info['firefox_browser_weekly_percentage']; ?>
                                            % <?php _e('Firefox', 'push-notification-for-wp-by-pushassist'); ?></span><span
                                            class="block txt-grey"><?php echo $dashboard_info['firefox_browser_weekly_stats']; ?>
                                            <?php _e('Subscribers', 'push-notification-for-wp-by-pushassist'); ?></span></span>
                                    <div id="sparkline_2" class="pull-right"
                                         style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <hr class="light-grey-hr row mt-10 mb-15"/>
                            <div class="label-chatrs">
                                <div class="">
                                    <span class="clabels clabels-lg inline-block bg-yellow mr-10 pull-left"></span>
                                    <span
                                        class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span
                                            class="block font-15 weight-500 mb-5"><?php echo $dashboard_info['safari_browser_weekly_percentage']; ?>
                                            % <?php _e('Safari', 'push-notification-for-wp-by-pushassist'); ?></span><span
                                            class="block txt-grey"><?php echo $dashboard_info['safari_browser_weekly_stats']; ?>
                                            <?php _e('Subscribers', 'push-notification-for-wp-by-pushassist'); ?></span></span>
                                    <div id="sparkline_3" class="pull-right"
                                         style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <hr class="light-grey-hr row mt-10 mb-15"/>
                            <div class="label-chatrs">
                                <div class="">
                                    <span class="clabels clabels-lg inline-block bg-red mr-10 pull-left"></span>
                                    <span
                                        class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span
                                            class="block font-15 weight-500 mb-5"><?php echo $dashboard_info['opera_browser_weekly_percentage']; ?>
                                            % <?php _e('Opera', 'push-notification-for-wp-by-pushassist'); ?></span><span
                                            class="block txt-grey"><?php echo $dashboard_info['opera_browser_weekly_stats']; ?>
                                            <?php _e('Subscribers', 'push-notification-for-wp-by-pushassist'); ?></span></span>
                                    <div id="sparkline_4" class="pull-right"
                                         style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" id="sent_graph">

                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">
                            <span class="panel-title txt-dark"><?php _e('Sent Notification', 'push-notification-for-wp-by-pushassist'); ?></span>
                            <div class="panel-body">
                                <div id="morris_extra_line_chart_2" class="morris-chart" style="height:175px;"></div>
                                <ul class="flex-stat mt-5">
                                    <li>
                                        <span class="block"><?php _e('Previous', 'push-notification-for-wp-by-pushassist'); ?></span>
                                        <span class="block txt-dark weight-500 font-18"><span
                                                class="counter-anim"><?php echo $dashboard_info['last_week_sent_stat']; ?></span></span>
                                    </li>
                                    <li>
                                        <span class="block">% <?php _e('Change', 'push-notification-for-wp-by-pushassist'); ?></span>
                                        <span
                                            class="block txt-dark weight-500 font-18"><?php echo $dashboard_info['sent_percentage']; ?>
                                            %</span>
                                    </li>
                                    <li>
                                        <span class="block"><?php _e('Trend', 'push-notification-for-wp-by-pushassist'); ?></span>
											<span class="block">
                                                <?php if ($dashboard_info['sent_percentage'] > 0) { ?>
                                                    <i class="zmdi zmdi-trending-up txt-success font-24"></i>
                                                <?php } else { ?>
                                                    <i class="zmdi zmdi-trending-down txt-danger font-24"></i>
                                                <?php } ?>
											</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark"><?php _e('Device stats', 'push-notification-for-wp-by-pushassist'); ?></h6>
                        </div>
                        <div class="pull-right">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                <span class="pull-left inline-block capitalize-font txt-dark">
                    <?php _e('Desktop', 'push-notification-for-wp-by-pushassist'); ?>
                </span>
                            <span
                                class="label label-warning pull-right"><?php echo $dashboard_info['desktop']; ?></span>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr row mt-10 mb-10"/>
                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    <?php _e('Mobile', 'push-notification-for-wp-by-pushassist'); ?>
                                </span>
                            <span class="label label-danger pull-right"><?php echo $dashboard_info['mobile']; ?></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="statistics">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark"><?php _e('user statistics', 'push-notification-for-wp-by-pushassist'); ?></h6>
                        </div>
                        <div class="pull-right">
                                <span class="no-margin-switcher">
                                    <input type="checkbox" id="morris_switch" class="js-switch" data-color="#ea6c41"
                                           data-secondary-color="#177ec1" data-size="small"/>
                                </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div id="morris_extra_line_chart" class="morris-chart" style="height:293px;"></div>
                            <ul class="flex-stat mt-40">
                                <li>
                                    <span class="block"><?php _e('Last 2 Week Users', 'push-notification-for-wp-by-pushassist'); ?></span>
                                    <span class="block txt-dark weight-500 font-18"><span class="counter-anim"><?php echo $dashboard_info['weekly_browsers']; ?></span></span>
                                </li>
                                <li>
                                    <span class="block"><?php _e('Yearly Users', 'push-notification-for-wp-by-pushassist'); ?></span>
                                    <span class="block txt-dark weight-500 font-18"><span class="counter-anim"><?php echo $dashboard_info['month_wise_subscribers_data']; ?></span></span>
                                </li>
                                <li>
                                    <span class="block"><?php _e('Trend', 'push-notification-for-wp-by-pushassist'); ?></span>
                                        <span class="block">
                                            <i class="zmdi zmdi-trending-up txt-success font-24"></i>
                                        </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-red">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span
                                            class="counter-anim"><?php echo $dashboard_info['subscribers']; ?></span></span>
                                            <span
                                                class="weight-500 uppercase-font txt-light block font-13"><?php _e('Subscribers', 'push-notification-for-wp-by-pushassist'); ?></span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="icon-people txt-light data-right-rep-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-yellow">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span
                                            class="counter-anim"><?php echo $dashboard_info['active']; ?></span></span>
                                                    <span
                                                        class="weight-500 uppercase-font txt-light block"><?php _e('Active', 'push-notification-for-wp-by-pushassist'); ?></span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="icon-user-following txt-light data-right-rep-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-blue">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span
                                            class="counter-anim"><?php echo $dashboard_info['sent']; ?></span></span>
                                            <span class="weight-500 uppercase-font txt-light block"><?php _e('Sent', 'push-notification-for-wp-by-pushassist'); ?></span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                                            <i class="zmdi zmdi-mail-send txt-light data-right-rep-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-green">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-light block counter"><span
                                                    class="counter-anim"><?php echo $dashboard_info['clicked']; ?></span></span>
                                                    <span
                                                        class="weight-500 uppercase-font txt-light block"><?php _e('Clicks', 'push-notification-for-wp-by-pushassist'); ?></span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="icon-like txt-light data-right-rep-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

                    if ($dashboard_info['last_notifications']) {

                        foreach ($dashboard_info['last_notifications'] as $notification) {

                            ?>

                            <tr class="listing_row listing_row-dash">
                                <td>
                                    <?php if ($notification['is_campaign'] == 2) { ?>
                                        <div class="campaign_tag">
                                            <span class="campaign"><?php _e('Campaign', 'push-notification-for-wp-by-pushassist'); ?></span>
                                            <?php if ($notification['event_id'] == '') { ?>
                                                <span class="campaign_title">
                                                    <?php 
														echo $notification['campaign_date_time']; 														
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
                                    <div class="div_txt">
                                        <span class="title"><?php echo wp_encode_emoji($notification['title']); ?></span>
                                        <span class="message"><?php echo wp_encode_emoji($notification['message']); ?></span>
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
</div>

<?php //if($dashboard_info){ ?>

<script src="<?php echo '../wp-content/plugins/push-notification-for-wp-by-pushassist/admin/js/switchery.min.js';?>"></script>

<script language="JavaScript">

    "use strict";
	/* Switchery Init*/
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    jQuery('.js-switch-1').each(function () {
        new Switchery(jQuery(this)[0], jQuery(this).data());
    });

    jQuery(document).ready(function () {

        var browser_labels = <?php echo $browser_info['browser_label'];?>;
        var browser_stats = <?php echo $browser_info['browser_stats'];?>;

        if (jQuery('#chart_6').length > 0) {
            var ctx6 = document.getElementById("chart_6").getContext("2d");
            var data6 = {
                labels: browser_labels,
                datasets: [
                    {
                        data: browser_stats,
                        backgroundColor: [
                            "#177ec1",
                            "#469408",
                            "#e69a2a",
                            "#ea6c41"
                        ],
                        hoverBackgroundColor: [
                            "#177ec1",
                            "#469408",
                            "#e69a2a",
                            "#ea6c41"
                        ]
                    }]
            };

            var pieChart = new Chart(ctx6, {
                type: 'pie',
                data: data6,
                options: {
                    animation: {
                        duration: 3000
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(33,33,33,1)',
                        cornerRadius: 0,
                        footerFontFamily: "'Roboto'"
                    },
                    elements: {
                        arc: {
                            borderWidth: 0
                        }
                    }
                }
            });
        }


        /*  Chart 2  */

        if(jQuery('#morris_extra_line_chart_2').length > 0) {

            var sent_data = <?php echo $dashboard_info['current_week_sent_stat'];?>;

            var lineChart = Morris.Line({
                element: 'morris_extra_line_chart_2',
                data: sent_data,
                xkey: 'period',
                ykeys: ['Sent'],
                labels: ['Sent'],
                pointSize: 2,
                fillOpacity: 0,
                lineWidth:2,
                pointStrokeColors:['#469408'],
                behaveLikeLine: true,
                gridLineColor: '#878787',
                hideHover: 'auto',
                lineColors: ['#469408'],
                resize: true,
                redraw: true,
                gridTextColor:'#878787',
                gridTextFamily:"Roboto",
                parseTime: false
            });
        }

        var swichMorris = function() {

            lineChart.setData(sent_data);
            lineChart.redraw();
        };

        swichMorris();

        /* chart 3 */

        if(jQuery('#morris_extra_line_chart').length > 0) {

            /*  Weekly  */

            var weekly_data = <?php echo $dashboard_info['chart_data'];?>;

            var monthly_data = <?php echo $dashboard_info['monthly_chart_data'];?>;

            var lineChart_1 = Morris.Line({
                element: 'morris_extra_line_chart',
                data: weekly_data ,
                xkey: 'period',
                ykeys: ['Subscribers', 'Unsubscribe'],
                labels: ['Subscribers', 'Unsubscribe'],
                pointSize: 2,
                fillOpacity: 0,
                lineWidth:2,
                pointStrokeColors:['#469408', '#ea6c41'],
                behaveLikeLine: true,
                gridLineColor: '#878787',
                hideHover: 'auto',
                lineColors: ['#469408', '#ea6c41'],
                resize: true,
                redraw: true,
                gridTextColor:'#878787',
                gridTextFamily:"Roboto",
                parseTime: false
            });

        }
        /* Switchery Init*/
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        jQuery('#morris_switch').each(function() {
            new Switchery(jQuery(this)[0], jQuery(this).data());
        });

        var swichMorris_1 = function() {

            if(jQuery("#morris_switch").is(":checked")) {
                lineChart_1.setData(monthly_data);
                lineChart_1.redraw();
            } else {
                lineChart_1.setData(weekly_data);
                lineChart_1.redraw();
            }
        };

        swichMorris_1();

        jQuery(document).on('change', '#morris_switch', function () {
            swichMorris_1();
        });

    });

    var sparklineLogin = function () {

        jQuery("#sparkline_1").sparkline(<?php echo $dashboard_info['chrome_stats'];?>, {
            type: 'line',
            width: '100%',
            height: '35',
            lineColor: '#177ec1',
            fillColor: 'rgba(23,126,193,.2)',
            maxSpotColor: '#177ec1',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#177ec1'
        });

        jQuery("#sparkline_2").sparkline(<?php echo $dashboard_info['firefox_stats'];?>, {
            type: 'line',
            width: '100%',
            height: '35',
            lineColor: '#177ec1',
            fillColor: 'rgba(23,126,193,.2)',
            maxSpotColor: '#177ec1',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#177ec1'
        });

        jQuery("#sparkline_3").sparkline(<?php echo $dashboard_info['safari_stats'];?>, {
            type: 'line',
            width: '100%',
            height: '35',
            lineColor: '#177ec1',
            fillColor: 'rgba(23,126,193,.2)',
            maxSpotColor: '#177ec1',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#177ec1'
        });

        if (jQuery('#sparkline_4').length > 0) {

            jQuery("#sparkline_4").sparkline(<?php echo $dashboard_info['opera_stats'];?>, {
                type: 'line',
                width: '100%',
                height: '35',
                lineColor: '#ea6c41',
                fillColor: 'rgba(23,126,193,.2)',
                maxSpotColor: '#ea6c41',
                highlightLineColor: 'rgba(0, 0, 0, 0.2)',
                highlightSpotColor: '#ea6c41'
            });
        }
    };

    var sparkResize;
    jQuery(window).resize(function (e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineLogin, 200);
    });
    sparklineLogin();

</script>
<?php //} ?>