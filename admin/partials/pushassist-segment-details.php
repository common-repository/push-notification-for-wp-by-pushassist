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
			<?php
				if(isset($_REQUEST['response_message'])){
			?>
			<div class="alert alert-<?php echo esc_attr($_REQUEST['class']);?> alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Segment created successfully.
			</div>
			<?php 
				}
			?>
            <h5 class="txt-dark"><?php _e('Manage Segments', 'push-notification-for-wp-by-pushassist'); ?></h5>
        </div>
        <div class="col-md-3 col-xs-6">
            <a href="admin.php?page=pushassist-segments" class="btn btn-success btn-anim pull-right"><i
                    class="fa fa-send"></i><span class="btn-text"><?php _e('Create Segment', 'push-notification-for-wp-by-pushassist'); ?></span></a>
        </div>
    </div>

    <!-- Row -->
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
                                        <col width="10%"/>
                                        <col width="30%"/>
                                        <col width="25%"/>
                                        <col width="35%"/>
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php _e('Segment Name', 'push-notification-for-wp-by-pushassist'); ?></th>
                                        <th><?php _e('Subscribers Count', 'push-notification-for-wp-by-pushassist'); ?></th>
                                        <th><?php _e('Created Date', 'push-notification-for-wp-by-pushassist'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if ($segment_list) {

                                        $no = 1;
                                        foreach ($segment_list as $segment) {
                                            ?>

                                            <tr>
                                                <td><span class="title"><?php echo $no; ?></span></td>
                                                <td><span class="title"><?php echo $segment['name']; ?></span></td>
                                                <td><span
                                                        class="title"><?php echo number_format($segment['subscriber_count']); ?></span>
                                                </td>
                                                <td><span class="title"><?php echo $segment['created_at']; ?></span>
                                                </td>
                                            </tr>
                                            <?php $no++;
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="4" class="text-center"><span
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
    </div>
</div>
<!-- Content End -->