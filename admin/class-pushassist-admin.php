<?php

if (!defined('PUSHASSIST_URL')) {
    define('PUSHASSIST_URL', plugin_dir_url(__FILE__));
}

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://pushassist.com/
 * @since      3.0.8
 *
 * @package    Pushassist
 * @subpackage Pushassist/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pushassist
 * @subpackage Pushassist/admin
 * @author     Team PushAssist <support@pushassist.com>
 */
class Pushassist_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    3.0.8
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    3.0.8
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since      3.0.8
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    //Init Function
    public function pushassist_admin_init()
    {
		// custom code 
	}

    //Actions Function
    public static function pushassist_add_actions()
    {
        if (is_admin()) {

            $pushassist_settings = self::pushassist_settings();

            if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

                add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_admin_menu'));
                add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_sent_notification_details'));
                add_action('pushassist_admin_init', array(__CLASS__, 'send_pushassist_notifications'));
                add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_segment_details'));
                add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_segment'));
                add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_subscribers_details'));

                add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_gcm_setting'));
                add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_create_campaign'));
                
				add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_welcome_notification_setting'));
				add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_optin_setting'));
				add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_childwindow_setting'));
                add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_advance_setting'));
				
                /*    Auto Notification send BY POST      */
				if(isset($pushassist_settings['psaAllowCustomPostTypes'])){
					$psaAllowCustomPostTypes = explode(',', $pushassist_settings['psaAllowCustomPostTypes']);
					if($psaAllowCustomPostTypes){
						foreach ( $psaAllowCustomPostTypes  as $post_type ) {
							add_action('add_meta_boxes_'.$post_type, array(__CLASS__, 'pushassist_publish_post_types_widget'));
						}
					}
				}
				
                add_action('add_meta_boxes', array(__CLASS__, 'pushassist_note_text'), 10, 2);
                add_action('save_post', array(__CLASS__, 'save_pushassist_post_meta_data'));
				
                add_action('wp_dashboard_setup', array(__CLASS__, 'pushassist_dashboard_widget'));
				
				/*	30-10-2019	*/
				add_filter( 'manage_post_posts_columns', array(__CLASS__, 'pushassist_add_columns') );
				add_action( 'quick_edit_custom_box', array(__CLASS__, 'pushassist_quick_edit_add'), 10, 2 );
				
            } else {

                add_action('pushassist_admin_init', array(__CLASS__, 'pushassist_account_create'));
                add_action('pushassist_appkey', array(__CLASS__, 'pushassist_accept_keys'));
            }
        }

        add_action('transition_post_status', array(__CLASS__, 'send_pushassist_post_notification'), 10, 3);
    }
	
    public static function pushassist_dashboard_widget()
    {
        wp_add_dashboard_widget(
            'pushassist_dashboard_widget',
            __('PushAssist Stats', 'push-notification-for-wp-by-pushassist'),
            array(__CLASS__, 'pushassist_dashboard_widget_display'),
            'normal',
            'high'
        );
    }

    public static function pushassist_dashboard_widget_display()
    {
        $pushassist_settings = self::pushassist_settings();
		
		if($pushassist_settings){
		
        $request_data = array("appKey" => trim($pushassist_settings['appKey']),
            "appSecret" => trim($pushassist_settings['appSecret']),
            "action" => 'dashboard/',
            "method" => "GET",
            "remoteContent" => ""
        );

        $dashboard_info = self::puhsassist_decode_request($request_data);

        ?>
			<ul class="psa_stat">
                <li class="total_active_users border_right">
                    <a>
                        <?php if(isset($dashboard_info['active'])){ printf(__("<strong>%s </strong> Active Subscribers", 'push-notification-for-wp-by-pushassist'), $dashboard_info['active']); }else{ printf(__("<strong>%s </strong> Active Subscribers", 'push-notification-for-wp-by-pushassist'), 0); } ?>
                    </a>
                </li>
                <li class="total_unsubscribed_users">
                    <a>
                        <?php if(isset($dashboard_info['total_unsubscribed'])){ printf(__("<strong>%s </strong> Unsubscribed", 'push-notification-for-wp-by-pushassist'), $dashboard_info['total_unsubscribed']); }else{ printf(__("<strong>%s </strong> Unsubscribed", 'push-notification-for-wp-by-pushassist'), 0); } ?>
                    </a>
                </li>
                <li class="total_sent border_right">
                    <a>
                        <?php if(isset($dashboard_info['stats_notification_sent'])){ printf(__("<strong>%s </strong> Total Delivered", 'push-notification-for-wp-by-pushassist'), $dashboard_info['stats_notification_sent']); }else{ printf(__("<strong>%s </strong> Total Delivered", 'push-notification-for-wp-by-pushassist'), 0); } ?>
                    </a>
                </li>
                <li class="total_clicks">
                    <a>
                        <?php if(isset($dashboard_info['stats_clicks'])){ printf(__("<strong>%s </strong> Total Clicks", 'push-notification-for-wp-by-pushassist'), $dashboard_info['stats_clicks']); }else{ printf(__("<strong>%s </strong> Total Clicks", 'push-notification-for-wp-by-pushassist'), 0); } ?>
                    </a>
                </li>
                <li class="total_users border_right">
                    <a>
                        <?php if(isset($dashboard_info['segment_count'])){ printf(__("<strong>%s </strong> Segments", 'push-notification-for-wp-by-pushassist'), $dashboard_info['segment_count']); }else{ printf(__("<strong>%s </strong> Segments", 'push-notification-for-wp-by-pushassist'), 0); } ?>
                    </a>
                </li>
                <li class="total_campaigns">
                    <a>
                        <?php if(isset($dashboard_info['stats_campaigns'])){ printf(__("<strong>%s </strong> Campaigns", 'push-notification-for-wp-by-pushassist'), $dashboard_info['stats_campaigns']); }else{ printf(__("<strong>%s </strong> Campaigns", 'push-notification-for-wp-by-pushassist'), 0); } ?>
                    </a>
                </li>
			</ul>
        <?php
		}
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    3.0.8
     */
	 
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Pushassist_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Pushassist_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
		if (isset($_GET['page'])) {

            if (strpos($_GET['page'], 'pushassist-') !== false) {

                wp_enqueue_style('bootstrap-min', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css', array(), $this->version, 'all');
                wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700|Poppins:500', array(), $this->version, 'all');
                wp_enqueue_style('font-awesome.min', plugin_dir_url(__FILE__) . 'css/font-awesome.min.css', array(), $this->version, 'all');
                wp_enqueue_style('material-design-iconic-font', plugin_dir_url(__FILE__) . 'css/material-design-iconic-font.min.css', array(), $this->version, 'all');//dashabord sent icon only
                wp_enqueue_style('morris', plugin_dir_url(__FILE__) . 'css/morris.css', array(), $this->version, 'all');	// Dashboard graph hover                
                wp_enqueue_style('simple-line-icons', plugin_dir_url(__FILE__) . 'css/simple-line-icons.css', array(), $this->version, 'all');                
                wp_enqueue_style('select2', plugin_dir_url(__FILE__) . 'css/select2.min.css', array(), $this->version, 'all');
                wp_enqueue_style('awesome-bootstrap-checkbox', plugin_dir_url(__FILE__) . 'css/awesome-bootstrap-checkbox.css', array(), $this->version, 'all');                
                wp_enqueue_style('switchery-min', plugin_dir_url(__FILE__) . 'css/switchery.min.css', array(), $this->version, 'all');                
                wp_enqueue_style('jquery-fileupload', plugin_dir_url(__FILE__) . 'css/jquery.fileupload.css', array(), $this->version, 'all');
                wp_enqueue_style('bootstrap-datetimepicker', plugin_dir_url(__FILE__) . 'css/bootstrap-datetimepicker.min.css', array(), $this->version, 'all');                
                wp_enqueue_style('bootstrap-table', plugin_dir_url(__FILE__) . 'css/bootstrap-table.css', array(), $this->version, 'all');                
                wp_enqueue_style('style', plugin_dir_url(__FILE__) . 'css/style.css', array(), $this->version, 'all');
                wp_enqueue_style('pushassist-number-validate', plugin_dir_url(__FILE__) . 'css/intlTelInput.css', array(), $this->version, 'all');
            }
        }
        
		wp_enqueue_style('pushassist-admin', plugin_dir_url(__FILE__) . 'css/pushassist-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    3.0.8
     */
	 
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Pushassist_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Pushassist_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
		
		if (isset($_GET['page'])) {

            if (strpos($_GET['page'], 'pushassist-') !== false) {

                wp_enqueue_script('bootstrap.min', plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('jquery'), $this->version, true);
                wp_enqueue_script('pushassist-intltel', plugin_dir_url(__FILE__) . 'js/intlTelInput.js', array('jquery'), $this->version, true);
                wp_enqueue_script('pushassist-admin', plugin_dir_url(__FILE__) . 'js/pushassist-admin.js', array('jquery'), $this->version, true);                
                wp_enqueue_script('pushassist-isValidNumber', plugin_dir_url(__FILE__) . 'js/isValidNumber.js', array('jquery'), $this->version, true);

                wp_enqueue_script('sparkline', plugin_dir_url(__FILE__) . 'js/jquery.sparkline.min.js', array('jquery'), $this->version, false);
                wp_enqueue_script('chart', plugin_dir_url(__FILE__) . 'js/Chart.min.js', array('jquery'), $this->version, false);

                wp_enqueue_script('raphael', plugin_dir_url(__FILE__) . 'js/raphael.min.js', array('jquery'), $this->version, false);
                wp_enqueue_script('morris', plugin_dir_url(__FILE__) . 'js/morris.min.js', array('jquery'), $this->version, false);

                wp_enqueue_script('jquery-dataTables', plugin_dir_url(__FILE__) . 'js/jquery.dataTables.min.js', array('jquery'), $this->version, true);
            }
        }		
    }

    function pushassist_admin_menu()
    {
        add_menu_page(
            'PushAssist',
            'PushAssist',
            'manage_options',
            'pushassist-admin',
            array(__CLASS__, 'pushassist_admin_dashboard'),
            plugin_dir_url(__FILE__) . 'images/pushassist.png'
        );

        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

            add_submenu_page('pushassist-admin', __('Dashboard', 'push-notification-for-wp-by-pushassist'), __('Dashboard', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-admin');
            add_submenu_page('pushassist-admin', __('Notifications', 'push-notification-for-wp-by-pushassist'), __('Notifications', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-sent-notification-details', array(__CLASS__, 'pushassist_sent_notification_details'));
            add_submenu_page('', __('Send Notification', 'push-notification-for-wp-by-pushassist'), __('Send Notification', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-send-notifications', array(__CLASS__, 'pushassist_send_notifications'));
            add_submenu_page('pushassist-admin', __('Manage Segments', 'push-notification-for-wp-by-pushassist'), __('Segments', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-segment-details', array(__CLASS__, 'pushassist_segment_details'));
            add_submenu_page('', __('Create Segments', 'push-notification-for-wp-by-pushassist'), __('Create Segments', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-segments', array(__CLASS__, 'pushassist_create_segment'));
            add_submenu_page('pushassist-admin', __('Subscribers', 'push-notification-for-wp-by-pushassist'), __('Subscribers', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-subscribers', array(__CLASS__, 'pushassist_subscribers_details'));
            add_submenu_page('pushassist-admin', __('PushAssist Settings', 'push-notification-for-wp-by-pushassist'), __('Settings', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-setting', array(__CLASS__, 'pushassist_setting_details'));
            add_submenu_page('pushassist-admin', __('PushAssist Campaigns', 'push-notification-for-wp-by-pushassist'), __('Campaigns', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-campaigns-details', array(__CLASS__, 'pushassist_campaigns_details'));
			add_submenu_page('', __('PushAssist Campaigns', 'push-notification-for-wp-by-pushassist'), __('Campaigns', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-campaigns', array(__CLASS__, 'pushassist_campaigns'));
			
			/*	New	*/
			add_submenu_page('', __('PushAssist Opt-in Setting', 'push-notification-for-wp-by-pushassist'), __('Opt-in Setting', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-opt-in-setup', array(__CLASS__, 'pushassist_opt_in_setting'));
			
			add_submenu_page('', __('PushAssist Welcome Notification', 'push-notification-for-wp-by-pushassist'), __('Notification Welcome Setting', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-welcome-message-setting', array(__CLASS__, 'pushassist_welcome_setting'));
			
			add_submenu_page('', __('PushAssist Child Window Setup', 'push-notification-for-wp-by-pushassist'), __('PushAssist Child Window Setup', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-child-window-setting', array(__CLASS__, 'pushassist_child_window_setting'));
			
			add_submenu_page('', __('Push Notification Customization', 'push-notification-for-wp-by-pushassist'), __('Push Notification Customization', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-advance-settings', array(__CLASS__, 'pushassist_advance_settings'));
			
			add_submenu_page('', __('PushAssist AMP Integration Steps', 'push-notification-for-wp-by-pushassist'), __('PushAssist AMP Integration Steps', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-amp-settings', array(__CLASS__, 'pushassist_amp_settings'));

        } else {
            add_submenu_page('pushassist-admin', __('Create Account', 'push-notification-for-wp-by-pushassist'), __('Create Account', 'push-notification-for-wp-by-pushassist'), 'manage_options', 'pushassist-create-account', array(__CLASS__, 'pushassist_create_account'));
        }
    }
	
	/*		New		*/	

    public static function pushassist_opt_in_setting()
    {
        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

            $opt_in_template = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'settings/opt-in-content',
                "method" => "GET",
                "remoteContent" => ""
            );

            $opt_in_details = self::puhsassist_decode_request($opt_in_template);
        }

        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-opt-in-setting.php';
    }

    public static function pushassist_welcome_setting()
    {
        $pushassist_settings = self::pushassist_settings();
		
		$url = "";
		$is_checked = false;
		$utm_source = "pushassist";
		$utm_medium = "pushassist_notification";
		$utm_campaign = "pushassist";

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

            $welcome_message = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'settings/welcome-content',
                "method" => "GET",
                "remoteContent" => ""
            );

            $welcome_message_text = self::puhsassist_decode_request($welcome_message);
			
			if (!empty($welcome_message_text['redirect_url'])) {

                $draft_url = explode('?', $welcome_message_text['redirect_url']);

                $url = $draft_url[0];

                if (!empty($draft_url[1])) {

                    $is_checked = true;

                    $utm_params = explode('&', $draft_url[1]);
                    $utm_source = substr($utm_params[0], 11, strlen($utm_params[0]) - 1);
                    $utm_medium = substr($utm_params[1], 11, strlen($utm_params[1]) - 1);
                    $utm_campaign = substr($utm_params[2], 13, strlen($utm_params[2]) - 1);
                }
            }
			
			$action_button = 0;

            if (!empty($welcome_message_text['action_1']) && !empty($welcome_message_text['action_url_1'])) {
                $action_button = 1;
            }
			
            if (!empty($welcome_message_text['action_1']) && !empty($welcome_message_text['action_url_1']) && !empty($welcome_message_text['action_2']) && !empty($welcome_message_text['action_url_2'])) {
                $action_button = 3;
            }
        }

        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-welcome-message-setting.php';
    }

    public static function pushassist_child_window_setting()
    {
        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

            $child_window_content = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'settings/child-window-content',
                "method" => "GET",
                "remoteContent" => ""
            );

            $child_window_details = self::puhsassist_decode_request($child_window_content);
        }

        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-child-window-setting.php';
    }

    public static function pushassist_advance_settings()
    {
        $pushassist_settings = self::pushassist_settings();
        
        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-custom-setting.php';
    }
	
	public static function pushassist_amp_settings()
    {
        $pushassist_settings = self::pushassist_settings();
		
		if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

            $account_info = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'accounts_info/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $account_details = self::puhsassist_decode_request($account_info);
        }
		
        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-amp-integration-steps.php';
    }
	
	/*		End		*/

    // Admin Dashboard
    public static function pushassist_admin_dashboard()
    {
        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {			
			
			$timezones = array(
				'Hawaii' => 'Pacific/Honolulu',
				'Alaska' => 'US/Alaska',
				'Pacific Time (US & Canada)' => 'America/Los_Angeles',
				'Arizona' => 'US/Arizona',
				'Mountain Time (US & Canada)' => 'US/Mountain',
				'Central Time (US & Canada)' => 'US/Central',
				'Eastern Time (US & Canada)' => 'US/Eastern',
				'Indiana (East)' => 'US/East-Indiana',
				'Midway Island' => 'Pacific/Midway',
				'American Samoa' => 'US/Samoa',
				'Tijuana' => 'America/Tijuana',
				'Chihuahua' => 'America/Chihuahua',
				'Mazatlan' => 'America/Mazatlan',
				'Central America' => 'America/Managua',
				'Mexico City' => 'America/Mexico_City',
				'Monterrey' => 'America/Monterrey',
				'Saskatchewan' => 'Canada/Saskatchewan',
				'Bogota' => 'America/Bogota',
				'Lima' => 'America/Lima',
				'Quito' => 'America/Bogota',
				'Atlantic Time (Canada)' => 'Canada/Atlantic',
				'Caracas' => 'America/Caracas',
				'La Paz' => 'America/La_Paz',
				'Santiago' => 'America/Santiago',
				'Newfoundland' => 'Canada/Newfoundland',
				'Brasilia' => 'America/Sao_Paulo',
				'Buenos Aires' => 'America/Argentina/Buenos_Aires',
				'Greenland' => 'America/Godthab',
				'Mid-Atlantic' => 'America/Noronha',
				'Azores' => 'Atlantic/Azores',
				'Cape Verde Is.' => 'Atlantic/Cape_Verde',
				'Casablanca' => 'Africa/Casablanca',
				'Dublin' => 'Europe/Dublin',
				'Lisbon' => 'Europe/Lisbon',
				'London' => 'Europe/London',
				'Monrovia' => 'Africa/Monrovia',
				'UTC' => 'UTC',
				'Amsterdam' => 'Europe/Amsterdam',
				'Belgrade' => 'Europe/Belgrade',
				'Bern' => 'Europe/Berlin',
				'Bratislava' => 'Europe/Bratislava',
				'Brussels' => 'Europe/Brussels',
				'Budapest' => 'Europe/Budapest',
				'Copenhagen' => 'Europe/Copenhagen',
				'Ljubljana' => 'Europe/Ljubljana',
				'Madrid' => 'Europe/Madrid',
				'Paris' => 'Europe/Paris',
				'Prague' => 'Europe/Prague',
				'Rome' => 'Europe/Rome',
				'Sarajevo' => 'Europe/Sarajevo',
				'Skopje' => 'Europe/Skopje',
				'Stockholm' => 'Europe/Stockholm',
				'Vienna' => 'Europe/Vienna',
				'Warsaw' => 'Europe/Warsaw',
				'West Central Africa' => 'Africa/Lagos',
				'Zagreb' => 'Europe/Zagreb',
				'Athens' => 'Europe/Athens',
				'Bucharest' => 'Europe/Bucharest',
				'Cairo' => 'Africa/Cairo',
				'Harare' => 'Africa/Harare',
				'Helsinki' => 'Europe/Helsinki',
				'Istanbul' => 'Europe/Istanbul',
				'Jerusalem' => 'Asia/Jerusalem',
				'Kyiv' => 'Europe/Helsinki',
				'Pretoria' => 'Africa/Johannesburg',
				'Riga' => 'Europe/Riga',
				'Sofia' => 'Europe/Sofia',
				'Tallinn' => 'Europe/Tallinn',
				'Vilnius' => 'Europe/Vilnius',
				'Baghdad' => 'Asia/Baghdad',
				'Kuwait' => 'Asia/Kuwait',
				'Minsk' => 'Europe/Minsk',
				'Nairobi' => 'Africa/Nairobi',
				'Riyadh' => 'Asia/Riyadh',
				'Volgograd' => 'Europe/Volgograd',
				'Tehran' => 'Asia/Tehran',
				'Abu Dhabi' => 'Asia/Muscat',
				'Baku' => 'Asia/Baku',
				'Moscow' => 'Europe/Moscow',
				'Muscat' => 'Asia/Muscat',
				'Tbilisi' => 'Asia/Tbilisi',
				'Yerevan' => 'Asia/Yerevan',
				'Kabul' => 'Asia/Kabul',
				'Karachi' => 'Asia/Karachi',
				'Tashkent' => 'Asia/Tashkent',
				'Chennai' => 'Asia/Calcutta',
				'Kolkata' => 'Asia/Kolkata',
				'Kathmandu' => 'Asia/Katmandu',
				'Almaty' => 'Asia/Almaty',
				'Dhaka' => 'Asia/Dhaka',
				'Ekaterinburg' => 'Asia/Yekaterinburg',
				'Rangoon' => 'Asia/Rangoon',
				'Bangkok' => 'Asia/Bangkok',
				'Jakarta' => 'Asia/Jakarta',
				'Novosibirsk' => 'Asia/Novosibirsk',
				'Beijing' => 'Asia/Hong_Kong',
				'Chongqing' => 'Asia/Chongqing',
				'Krasnoyarsk' => 'Asia/Krasnoyarsk',
				'Kuala Lumpur' => 'Asia/Kuala_Lumpur',
				'Perth' => 'Australia/Perth',
				'Singapore' => 'Asia/Singapore',
				'Taipei' => 'Asia/Taipei',
				'Ulaan Bataar' => 'Asia/Ulan_Bator',
				'Urumqi' => 'Asia/Urumqi',
				'Irkutsk' => 'Asia/Irkutsk',
				'Seoul' => 'Asia/Seoul',
				'Tokyo' => 'Asia/Tokyo',
				'Adelaide' => 'Australia/Adelaide',
				'Darwin' => 'Australia/Darwin',
				'Brisbane' => 'Australia/Brisbane',
				'Canberra' => 'Australia/Canberra',
				'Guam' => 'Pacific/Guam',
				'Hobart' => 'Australia/Hobart',
				'Melbourne' => 'Australia/Melbourne',
				'Port Moresby' => 'Pacific/Port_Moresby',
				'Sydney' => 'Australia/Sydney',
				'Yakutsk' => 'Asia/Yakutsk',
				'Vladivostok' => 'Asia/Vladivostok',
				'Auckland' => 'Pacific/Auckland',
				'Fiji' => 'Pacific/Fiji',
				'International Date Line West' => 'Pacific/Kwajalein',
				'Kamchatka' => 'Asia/Kamchatka',
				'Magadan' => 'Asia/Magadan',
				'Marshall Is.' => 'Pacific/Fiji',
				'New Caledonia' => 'Asia/Magadan',
				'Wellington' => 'Pacific/Auckland',
				'Nuku\'alofa' => 'Pacific/Tongatapu'
			);
			
            $dashboard_info = array();
			
			$header_stats = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'dashboard/stats/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $header_stats_info = self::puhsassist_decode_request($header_stats);
			
			$dashboard_info = array_merge($dashboard_info, $header_stats_info);
			
            $browser_stats = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'dashboard/browser-stats/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $browser_info = self::puhsassist_decode_request($browser_stats);
			
			$dashboard_info = array_merge($dashboard_info, $browser_info);
			
            $notification_stats = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'dashboard/sent-notification-stats/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $sent_notification_info = self::puhsassist_decode_request($notification_stats);
			
			$dashboard_info = array_merge($dashboard_info, $sent_notification_info);
			
            $users_statistics = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'dashboard/users-statistics/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $users_statistics_info = self::puhsassist_decode_request($users_statistics);
			
			$dashboard_info = array_merge($dashboard_info, $users_statistics_info);
			
            $notifications = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'dashboard/notifications/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $latest_notifications_info = self::puhsassist_decode_request($notifications);
			
			$dashboard_info = array_merge($dashboard_info, $latest_notifications_info);

            $account_info = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'accounts_info/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $account_details = self::puhsassist_decode_request($account_info);
			
			if(isset($account_details['gcm_project_number'])){
				$pushassist_settings['senderId'] = $account_details['gcm_project_number'];				
				update_option('pushassist_settings', $pushassist_settings);				
			}

            require_once plugin_dir_path(__FILE__) . 'partials/pushassist-dashboard.php';

        } else {
            require_once plugin_dir_path(__FILE__) . 'partials/pushassist-create-account.php';
        }
    }

    public static function pushassist_campaigns_details()
    {
        $timezones = array(
            'Hawaii' => 'Pacific/Honolulu',
            'Alaska' => 'US/Alaska',
            'Pacific Time (US & Canada)' => 'America/Los_Angeles',
            'Arizona' => 'US/Arizona',
            'Mountain Time (US & Canada)' => 'US/Mountain',
            'Central Time (US & Canada)' => 'US/Central',
            'Eastern Time (US & Canada)' => 'US/Eastern',
            'Indiana (East)' => 'US/East-Indiana',
            'Midway Island' => 'Pacific/Midway',
            'American Samoa' => 'US/Samoa',
            'Tijuana' => 'America/Tijuana',
            'Chihuahua' => 'America/Chihuahua',
            'Mazatlan' => 'America/Mazatlan',
            'Central America' => 'America/Managua',
            'Mexico City' => 'America/Mexico_City',
            'Monterrey' => 'America/Monterrey',
            'Saskatchewan' => 'Canada/Saskatchewan',
            'Bogota' => 'America/Bogota',
            'Lima' => 'America/Lima',
            'Quito' => 'America/Bogota',
            'Atlantic Time (Canada)' => 'Canada/Atlantic',
            'Caracas' => 'America/Caracas',
            'La Paz' => 'America/La_Paz',
            'Santiago' => 'America/Santiago',
            'Newfoundland' => 'Canada/Newfoundland',
            'Brasilia' => 'America/Sao_Paulo',
            'Buenos Aires' => 'America/Argentina/Buenos_Aires',
            'Greenland' => 'America/Godthab',
            'Mid-Atlantic' => 'America/Noronha',
            'Azores' => 'Atlantic/Azores',
            'Cape Verde Is.' => 'Atlantic/Cape_Verde',
            'Casablanca' => 'Africa/Casablanca',
            'Dublin' => 'Europe/Dublin',
            'Lisbon' => 'Europe/Lisbon',
            'London' => 'Europe/London',
            'Monrovia' => 'Africa/Monrovia',
            'UTC' => 'UTC',
            'Amsterdam' => 'Europe/Amsterdam',
            'Belgrade' => 'Europe/Belgrade',
            'Bern' => 'Europe/Berlin',
            'Bratislava' => 'Europe/Bratislava',
            'Brussels' => 'Europe/Brussels',
            'Budapest' => 'Europe/Budapest',
            'Copenhagen' => 'Europe/Copenhagen',
            'Ljubljana' => 'Europe/Ljubljana',
            'Madrid' => 'Europe/Madrid',
            'Paris' => 'Europe/Paris',
            'Prague' => 'Europe/Prague',
            'Rome' => 'Europe/Rome',
            'Sarajevo' => 'Europe/Sarajevo',
            'Skopje' => 'Europe/Skopje',
            'Stockholm' => 'Europe/Stockholm',
            'Vienna' => 'Europe/Vienna',
            'Warsaw' => 'Europe/Warsaw',
            'West Central Africa' => 'Africa/Lagos',
            'Zagreb' => 'Europe/Zagreb',
            'Athens' => 'Europe/Athens',
            'Bucharest' => 'Europe/Bucharest',
            'Cairo' => 'Africa/Cairo',
            'Harare' => 'Africa/Harare',
            'Helsinki' => 'Europe/Helsinki',
            'Istanbul' => 'Europe/Istanbul',
            'Jerusalem' => 'Asia/Jerusalem',
            'Kyiv' => 'Europe/Helsinki',
            'Pretoria' => 'Africa/Johannesburg',
            'Riga' => 'Europe/Riga',
            'Sofia' => 'Europe/Sofia',
            'Tallinn' => 'Europe/Tallinn',
            'Vilnius' => 'Europe/Vilnius',
            'Baghdad' => 'Asia/Baghdad',
            'Kuwait' => 'Asia/Kuwait',
            'Minsk' => 'Europe/Minsk',
            'Nairobi' => 'Africa/Nairobi',
            'Riyadh' => 'Asia/Riyadh',
            'Volgograd' => 'Europe/Volgograd',
            'Tehran' => 'Asia/Tehran',
            'Abu Dhabi' => 'Asia/Muscat',
            'Baku' => 'Asia/Baku',
            'Moscow' => 'Europe/Moscow',
            'Muscat' => 'Asia/Muscat',
            'Tbilisi' => 'Asia/Tbilisi',
            'Yerevan' => 'Asia/Yerevan',
            'Kabul' => 'Asia/Kabul',
            'Karachi' => 'Asia/Karachi',
            'Tashkent' => 'Asia/Tashkent',
            'Chennai' => 'Asia/Calcutta',
            'Kolkata' => 'Asia/Kolkata',
            'Kathmandu' => 'Asia/Katmandu',
            'Almaty' => 'Asia/Almaty',
            'Dhaka' => 'Asia/Dhaka',
            'Ekaterinburg' => 'Asia/Yekaterinburg',
            'Rangoon' => 'Asia/Rangoon',
            'Bangkok' => 'Asia/Bangkok',
            'Jakarta' => 'Asia/Jakarta',
            'Novosibirsk' => 'Asia/Novosibirsk',
            'Beijing' => 'Asia/Hong_Kong',
            'Chongqing' => 'Asia/Chongqing',
            'Krasnoyarsk' => 'Asia/Krasnoyarsk',
            'Kuala Lumpur' => 'Asia/Kuala_Lumpur',
            'Perth' => 'Australia/Perth',
            'Singapore' => 'Asia/Singapore',
            'Taipei' => 'Asia/Taipei',
            'Ulaan Bataar' => 'Asia/Ulan_Bator',
            'Urumqi' => 'Asia/Urumqi',
            'Irkutsk' => 'Asia/Irkutsk',
            'Seoul' => 'Asia/Seoul',
            'Tokyo' => 'Asia/Tokyo',
            'Adelaide' => 'Australia/Adelaide',
            'Darwin' => 'Australia/Darwin',
            'Brisbane' => 'Australia/Brisbane',
            'Canberra' => 'Australia/Canberra',
            'Guam' => 'Pacific/Guam',
            'Hobart' => 'Australia/Hobart',
            'Melbourne' => 'Australia/Melbourne',
            'Port Moresby' => 'Pacific/Port_Moresby',
            'Sydney' => 'Australia/Sydney',
            'Yakutsk' => 'Asia/Yakutsk',
            'Vladivostok' => 'Asia/Vladivostok',
            'Auckland' => 'Pacific/Auckland',
            'Fiji' => 'Pacific/Fiji',
            'International Date Line West' => 'Pacific/Kwajalein',
            'Kamchatka' => 'Asia/Kamchatka',
            'Magadan' => 'Asia/Magadan',
            'Marshall Is.' => 'Pacific/Fiji',
            'New Caledonia' => 'Asia/Magadan',
            'Wellington' => 'Pacific/Auckland',
            'Nuku\'alofa' => 'Pacific/Tongatapu'
        );

        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

            $segment_data = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'segments/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $segment_list = self::puhsassist_decode_request($segment_data);

            $account_info = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'accounts_info/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $account_details = self::puhsassist_decode_request($account_info);
            $account_details['timezone_list'] = $timezones;
			
			$active_campaign_data = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'campaigns/date-based/active',
                "method" => "GET",
                "remoteContent" => ""
            );

            $active_campaign_list = self::puhsassist_decode_request($active_campaign_data);
			
			if(!is_array($active_campaign_list)){	$active_campaign_list = array();  }
			
			$archive_campaign_data = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'campaigns/date-based/archive',
                "method" => "GET",
                "remoteContent" => ""
            );

            $archive_campaign_list = self::puhsassist_decode_request($archive_campaign_data);
			
			if(!is_array($archive_campaign_list)){	$archive_campaign_list = array();  }
        }

        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-campaign-details.php';
    }
	
	public static function pushassist_campaigns()
    {
        $timezones = array(
            'Hawaii' => 'Pacific/Honolulu',
            'Alaska' => 'US/Alaska',
            'Pacific Time (US & Canada)' => 'America/Los_Angeles',
            'Arizona' => 'US/Arizona',
            'Mountain Time (US & Canada)' => 'US/Mountain',
            'Central Time (US & Canada)' => 'US/Central',
            'Eastern Time (US & Canada)' => 'US/Eastern',
            'Indiana (East)' => 'US/East-Indiana',
            'Midway Island' => 'Pacific/Midway',
            'American Samoa' => 'US/Samoa',
            'Tijuana' => 'America/Tijuana',
            'Chihuahua' => 'America/Chihuahua',
            'Mazatlan' => 'America/Mazatlan',
            'Central America' => 'America/Managua',
            'Mexico City' => 'America/Mexico_City',
            'Monterrey' => 'America/Monterrey',
            'Saskatchewan' => 'Canada/Saskatchewan',
            'Bogota' => 'America/Bogota',
            'Lima' => 'America/Lima',
            'Quito' => 'America/Bogota',
            'Atlantic Time (Canada)' => 'Canada/Atlantic',
            'Caracas' => 'America/Caracas',
            'La Paz' => 'America/La_Paz',
            'Santiago' => 'America/Santiago',
            'Newfoundland' => 'Canada/Newfoundland',
            'Brasilia' => 'America/Sao_Paulo',
            'Buenos Aires' => 'America/Argentina/Buenos_Aires',
            'Greenland' => 'America/Godthab',
            'Mid-Atlantic' => 'America/Noronha',
            'Azores' => 'Atlantic/Azores',
            'Cape Verde Is.' => 'Atlantic/Cape_Verde',
            'Casablanca' => 'Africa/Casablanca',
            'Dublin' => 'Europe/Dublin',
            'Lisbon' => 'Europe/Lisbon',
            'London' => 'Europe/London',
            'Monrovia' => 'Africa/Monrovia',
            'UTC' => 'UTC',
            'Amsterdam' => 'Europe/Amsterdam',
            'Belgrade' => 'Europe/Belgrade',
            'Bern' => 'Europe/Berlin',
            'Bratislava' => 'Europe/Bratislava',
            'Brussels' => 'Europe/Brussels',
            'Budapest' => 'Europe/Budapest',
            'Copenhagen' => 'Europe/Copenhagen',
            'Ljubljana' => 'Europe/Ljubljana',
            'Madrid' => 'Europe/Madrid',
            'Paris' => 'Europe/Paris',
            'Prague' => 'Europe/Prague',
            'Rome' => 'Europe/Rome',
            'Sarajevo' => 'Europe/Sarajevo',
            'Skopje' => 'Europe/Skopje',
            'Stockholm' => 'Europe/Stockholm',
            'Vienna' => 'Europe/Vienna',
            'Warsaw' => 'Europe/Warsaw',
            'West Central Africa' => 'Africa/Lagos',
            'Zagreb' => 'Europe/Zagreb',
            'Athens' => 'Europe/Athens',
            'Bucharest' => 'Europe/Bucharest',
            'Cairo' => 'Africa/Cairo',
            'Harare' => 'Africa/Harare',
            'Helsinki' => 'Europe/Helsinki',
            'Istanbul' => 'Europe/Istanbul',
            'Jerusalem' => 'Asia/Jerusalem',
            'Kyiv' => 'Europe/Helsinki',
            'Pretoria' => 'Africa/Johannesburg',
            'Riga' => 'Europe/Riga',
            'Sofia' => 'Europe/Sofia',
            'Tallinn' => 'Europe/Tallinn',
            'Vilnius' => 'Europe/Vilnius',
            'Baghdad' => 'Asia/Baghdad',
            'Kuwait' => 'Asia/Kuwait',
            'Minsk' => 'Europe/Minsk',
            'Nairobi' => 'Africa/Nairobi',
            'Riyadh' => 'Asia/Riyadh',
            'Volgograd' => 'Europe/Volgograd',
            'Tehran' => 'Asia/Tehran',
            'Abu Dhabi' => 'Asia/Muscat',
            'Baku' => 'Asia/Baku',
            'Moscow' => 'Europe/Moscow',
            'Muscat' => 'Asia/Muscat',
            'Tbilisi' => 'Asia/Tbilisi',
            'Yerevan' => 'Asia/Yerevan',
            'Kabul' => 'Asia/Kabul',
            'Karachi' => 'Asia/Karachi',
            'Tashkent' => 'Asia/Tashkent',
            'Chennai' => 'Asia/Calcutta',
            'Kolkata' => 'Asia/Kolkata',
            'Kathmandu' => 'Asia/Katmandu',
            'Almaty' => 'Asia/Almaty',
            'Dhaka' => 'Asia/Dhaka',
            'Ekaterinburg' => 'Asia/Yekaterinburg',
            'Rangoon' => 'Asia/Rangoon',
            'Bangkok' => 'Asia/Bangkok',
            'Jakarta' => 'Asia/Jakarta',
            'Novosibirsk' => 'Asia/Novosibirsk',
            'Beijing' => 'Asia/Hong_Kong',
            'Chongqing' => 'Asia/Chongqing',
            'Krasnoyarsk' => 'Asia/Krasnoyarsk',
            'Kuala Lumpur' => 'Asia/Kuala_Lumpur',
            'Perth' => 'Australia/Perth',
            'Singapore' => 'Asia/Singapore',
            'Taipei' => 'Asia/Taipei',
            'Ulaan Bataar' => 'Asia/Ulan_Bator',
            'Urumqi' => 'Asia/Urumqi',
            'Irkutsk' => 'Asia/Irkutsk',
            'Seoul' => 'Asia/Seoul',
            'Tokyo' => 'Asia/Tokyo',
            'Adelaide' => 'Australia/Adelaide',
            'Darwin' => 'Australia/Darwin',
            'Brisbane' => 'Australia/Brisbane',
            'Canberra' => 'Australia/Canberra',
            'Guam' => 'Pacific/Guam',
            'Hobart' => 'Australia/Hobart',
            'Melbourne' => 'Australia/Melbourne',
            'Port Moresby' => 'Pacific/Port_Moresby',
            'Sydney' => 'Australia/Sydney',
            'Yakutsk' => 'Asia/Yakutsk',
            'Vladivostok' => 'Asia/Vladivostok',
            'Auckland' => 'Pacific/Auckland',
            'Fiji' => 'Pacific/Fiji',
            'International Date Line West' => 'Pacific/Kwajalein',
            'Kamchatka' => 'Asia/Kamchatka',
            'Magadan' => 'Asia/Magadan',
            'Marshall Is.' => 'Pacific/Fiji',
            'New Caledonia' => 'Asia/Magadan',
            'Wellington' => 'Pacific/Auckland',
            'Nuku\'alofa' => 'Pacific/Tongatapu'
        );

        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {
						
			$add_on_info = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'settings/add-ons',
                "method" => "GET",
                "remoteContent" => ""
            );

            $extra_details = self::puhsassist_decode_request($add_on_info);

            $account_info = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'accounts_info/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $account_details = self::puhsassist_decode_request($account_info);

            $account_details['timezone_list'] = $timezones;
			
			$notification_alert = array('0' => 'Silent', '1' => 'Single long buzz', '2' => 'Repetitive buzzing', '3' => 'Super Mario', '4' => 'Star Wars', '5' => 'Shave and a Haircut', '6' => 'Smooth Criminal');

            $notification_ttl = array(86400 => '1 Day', 172800 => '2 Days', 259200 => '3 Days', 345600 => '4 Days', 432000 => '5 Days', 518400 => '6 Days', 604800 => '1 Week', 1209600 => '2 Week', 1814400 => '3 Week', 2419200 => '4 Week');
        }

        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-campaign.php';
    }

    // account creation
    public static function pushassist_create_account()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-create-account.php';
    }

    //  notification details ( History )
    public static function pushassist_sent_notification_details()
    {
        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {
			
			$timezones = array(
				'Hawaii' => 'Pacific/Honolulu',
				'Alaska' => 'US/Alaska',
				'Pacific Time (US & Canada)' => 'America/Los_Angeles',
				'Arizona' => 'US/Arizona',
				'Mountain Time (US & Canada)' => 'US/Mountain',
				'Central Time (US & Canada)' => 'US/Central',
				'Eastern Time (US & Canada)' => 'US/Eastern',
				'Indiana (East)' => 'US/East-Indiana',
				'Midway Island' => 'Pacific/Midway',
				'American Samoa' => 'US/Samoa',
				'Tijuana' => 'America/Tijuana',
				'Chihuahua' => 'America/Chihuahua',
				'Mazatlan' => 'America/Mazatlan',
				'Central America' => 'America/Managua',
				'Mexico City' => 'America/Mexico_City',
				'Monterrey' => 'America/Monterrey',
				'Saskatchewan' => 'Canada/Saskatchewan',
				'Bogota' => 'America/Bogota',
				'Lima' => 'America/Lima',
				'Quito' => 'America/Bogota',
				'Atlantic Time (Canada)' => 'Canada/Atlantic',
				'Caracas' => 'America/Caracas',
				'La Paz' => 'America/La_Paz',
				'Santiago' => 'America/Santiago',
				'Newfoundland' => 'Canada/Newfoundland',
				'Brasilia' => 'America/Sao_Paulo',
				'Buenos Aires' => 'America/Argentina/Buenos_Aires',
				'Greenland' => 'America/Godthab',
				'Mid-Atlantic' => 'America/Noronha',
				'Azores' => 'Atlantic/Azores',
				'Cape Verde Is.' => 'Atlantic/Cape_Verde',
				'Casablanca' => 'Africa/Casablanca',
				'Dublin' => 'Europe/Dublin',
				'Lisbon' => 'Europe/Lisbon',
				'London' => 'Europe/London',
				'Monrovia' => 'Africa/Monrovia',
				'UTC' => 'UTC',
				'Amsterdam' => 'Europe/Amsterdam',
				'Belgrade' => 'Europe/Belgrade',
				'Bern' => 'Europe/Berlin',
				'Bratislava' => 'Europe/Bratislava',
				'Brussels' => 'Europe/Brussels',
				'Budapest' => 'Europe/Budapest',
				'Copenhagen' => 'Europe/Copenhagen',
				'Ljubljana' => 'Europe/Ljubljana',
				'Madrid' => 'Europe/Madrid',
				'Paris' => 'Europe/Paris',
				'Prague' => 'Europe/Prague',
				'Rome' => 'Europe/Rome',
				'Sarajevo' => 'Europe/Sarajevo',
				'Skopje' => 'Europe/Skopje',
				'Stockholm' => 'Europe/Stockholm',
				'Vienna' => 'Europe/Vienna',
				'Warsaw' => 'Europe/Warsaw',
				'West Central Africa' => 'Africa/Lagos',
				'Zagreb' => 'Europe/Zagreb',
				'Athens' => 'Europe/Athens',
				'Bucharest' => 'Europe/Bucharest',
				'Cairo' => 'Africa/Cairo',
				'Harare' => 'Africa/Harare',
				'Helsinki' => 'Europe/Helsinki',
				'Istanbul' => 'Europe/Istanbul',
				'Jerusalem' => 'Asia/Jerusalem',
				'Kyiv' => 'Europe/Helsinki',
				'Pretoria' => 'Africa/Johannesburg',
				'Riga' => 'Europe/Riga',
				'Sofia' => 'Europe/Sofia',
				'Tallinn' => 'Europe/Tallinn',
				'Vilnius' => 'Europe/Vilnius',
				'Baghdad' => 'Asia/Baghdad',
				'Kuwait' => 'Asia/Kuwait',
				'Minsk' => 'Europe/Minsk',
				'Nairobi' => 'Africa/Nairobi',
				'Riyadh' => 'Asia/Riyadh',
				'Volgograd' => 'Europe/Volgograd',
				'Tehran' => 'Asia/Tehran',
				'Abu Dhabi' => 'Asia/Muscat',
				'Baku' => 'Asia/Baku',
				'Moscow' => 'Europe/Moscow',
				'Muscat' => 'Asia/Muscat',
				'Tbilisi' => 'Asia/Tbilisi',
				'Yerevan' => 'Asia/Yerevan',
				'Kabul' => 'Asia/Kabul',
				'Karachi' => 'Asia/Karachi',
				'Tashkent' => 'Asia/Tashkent',
				'Chennai' => 'Asia/Calcutta',
				'Kolkata' => 'Asia/Kolkata',
				'Kathmandu' => 'Asia/Katmandu',
				'Almaty' => 'Asia/Almaty',
				'Dhaka' => 'Asia/Dhaka',
				'Ekaterinburg' => 'Asia/Yekaterinburg',
				'Rangoon' => 'Asia/Rangoon',
				'Bangkok' => 'Asia/Bangkok',
				'Jakarta' => 'Asia/Jakarta',
				'Novosibirsk' => 'Asia/Novosibirsk',
				'Beijing' => 'Asia/Hong_Kong',
				'Chongqing' => 'Asia/Chongqing',
				'Krasnoyarsk' => 'Asia/Krasnoyarsk',
				'Kuala Lumpur' => 'Asia/Kuala_Lumpur',
				'Perth' => 'Australia/Perth',
				'Singapore' => 'Asia/Singapore',
				'Taipei' => 'Asia/Taipei',
				'Ulaan Bataar' => 'Asia/Ulan_Bator',
				'Urumqi' => 'Asia/Urumqi',
				'Irkutsk' => 'Asia/Irkutsk',
				'Seoul' => 'Asia/Seoul',
				'Tokyo' => 'Asia/Tokyo',
				'Adelaide' => 'Australia/Adelaide',
				'Darwin' => 'Australia/Darwin',
				'Brisbane' => 'Australia/Brisbane',
				'Canberra' => 'Australia/Canberra',
				'Guam' => 'Pacific/Guam',
				'Hobart' => 'Australia/Hobart',
				'Melbourne' => 'Australia/Melbourne',
				'Port Moresby' => 'Pacific/Port_Moresby',
				'Sydney' => 'Australia/Sydney',
				'Yakutsk' => 'Asia/Yakutsk',
				'Vladivostok' => 'Asia/Vladivostok',
				'Auckland' => 'Pacific/Auckland',
				'Fiji' => 'Pacific/Fiji',
				'International Date Line West' => 'Pacific/Kwajalein',
				'Kamchatka' => 'Asia/Kamchatka',
				'Magadan' => 'Asia/Magadan',
				'Marshall Is.' => 'Pacific/Fiji',
				'New Caledonia' => 'Asia/Magadan',
				'Wellington' => 'Pacific/Auckland',
				'Nuku\'alofa' => 'Pacific/Tongatapu'
			);
			
            $notification_data = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'notifications/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $notification_list = self::puhsassist_decode_request($notification_data);
			
			if(!is_array($notification_list)){	$notification_list = array();  }
        }

        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-sent-notification-details.php';
    }

    // send new notification
    public static function pushassist_send_notifications()
    {
        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

            $segment_data = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'segments/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $segment_list = self::puhsassist_decode_request($segment_data);

            $account_info = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'accounts_info/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $account_details = self::puhsassist_decode_request($account_info);
			
			$add_on_info = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'settings/add-ons',
                "method" => "GET",
                "remoteContent" => ""
            );

            $extra_details = self::puhsassist_decode_request($add_on_info);

            $notification_alert = array('0' => 'Silent', '1' => 'Single long buzz', '2' => 'Repetitive buzzing', '3' => 'Super Mario', '4' => 'Star Wars', '5' => 'Shave and a Haircut', '6' => 'Smooth Criminal');

            $notification_ttl = array(86400 => '1 Day', 172800 => '2 Days', 259200 => '3 Days', 345600 => '4 Days', 432000 => '5 Days', 518400 => '6 Days', 604800 => '1 Week', 1209600 => '2 Week', 1814400 => '3 Week', 2419200 => '4 Week');
        }

        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-send-notifications.php';
    }

    // segment details
    public static function pushassist_segment_details()
    {
        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

            $segment_data = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'segments/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $segment_list = self::puhsassist_decode_request($segment_data);
        }

        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-segment-details.php';
    }

    // segment create
    public static function pushassist_create_segment()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-segments.php';
    }

    // Pushassist Account subscriber list
    public static function pushassist_subscribers_details()
    {
        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

            $subscriber_info = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'subscribers/stats',
                "method" => "GET",
                "remoteContent" => ""
            );

            $subscriber_details = self::puhsassist_decode_request($subscriber_info);			
        }
		
		$stats = array(array("id" => 1, "name" => "Desktop-Subscribers", "value" => $subscriber_details['desktop']), array("id" => 2, "name" => "Mobile-Subscribers", "value" => $subscriber_details['mobile']), array("id" => 3, "name" => "Subscribers-Yesterday", "value" => $subscriber_details['yesterday']), array("id" => 4, "name" => "Subscribers in Last 7 Day's", "value" => $subscriber_details['last_week']), array("id" => 5, "name" => "Subscribers in Last 15 Day's", "value" => $subscriber_details['last_2_week']), array("id" => 6, "name" => "Subscribers in Last 30 Day's", "value" => $subscriber_details['last_30_days']));

        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-subscribers.php';
    }

    // Pushassist Account Information Or setting
    public static function pushassist_setting_details()
    {
        $pushassist_settings = self::pushassist_settings();

        if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

            $account_info = array("appKey" => trim($pushassist_settings['appKey']),
                "appSecret" => trim($pushassist_settings['appSecret']),
                "action" => 'accounts_info/',
                "method" => "GET",
                "remoteContent" => ""
            );

            $account_details = self::puhsassist_decode_request($account_info);
        }

        require_once plugin_dir_path(__FILE__) . 'partials/pushassist-setting.php';
    }

    public static function pushassist_advance_setting()
    {
        $pushassist_settings = self::pushassist_settings();

        $response_message = '';

        if (isset($_POST['psa-save-settings'])) {

            $pushassist_setting_post_message = __('We have just published an article, check it out!', 'push-notification-for-wp-by-pushassist');

            $auto_push = false;
            $edit_push = false;
            $use_logoimage = false;			
            $use_bigimage = false;
            $auto_push_UTM = false;
            $psaJsRestrict = false;
			$psaAllowCustomPostTypes = '';

            if (isset($_POST['pushassist_auto_push'])) {	//Auto Send Push Notifications When A Post Is Published
                $auto_push = true;
            }

            if (isset($_POST['pushassist_edit_post_push'])) {	//Auto Send Push Notifications When A Post Is Updated
                $edit_push = true;
            }

            if (isset($_POST['pushassist_logo_image'])) {	//Use Logo Image As Post Image (Default Is Featured Image)
                $use_logoimage = true;
            }

            if (isset($_POST['pushassist_big_image'])) {	//Use The Post`S Featured Image For Chrome`S Large Notification Image
                $use_bigimage = true;
            }

            if (isset($_POST['pushassist_setting_is_utm_show'])) {		//Add UTM Parameters In URL For Tracking
                $auto_push_UTM = true;
                $pushassist_settings['psaUTMSource'] = trim($_POST['pushassist_setting_utm_source']);
                $pushassist_settings['psaUTMMedium'] = trim($_POST['pushassist_setting_utm_medium']);
                $pushassist_settings['psaUTMCampaign'] = trim($_POST['pushassist_setting_utm_campaign']);

            } else {
                $pushassist_settings['psaUTMSource'] = 'pushassist';
                $pushassist_settings['psaUTMMedium'] = 'pushassist_notification';
                $pushassist_settings['psaUTMCampaign'] = 'pushassist';
            }

            if (isset($_POST['pushassist_js_restrict'])) {	//Stop Automatic Script Inclusion. (I Will Insert PushAssist JS Manually).
                $psaJsRestrict = true;
            }									

            if (isset($_POST['pushassist_setting_post_message'])) {		//Default Notification Message When A Post Is Published
                $pushassist_setting_post_message = trim($_POST['pushassist_setting_post_message']);
            }
						
			if (isset($_POST['pushassist_post_types'])) {		//Also Send Push Notification For Following Post Types
				$psaAllowCustomPostTypes = implode(",", $_POST['pushassist_post_types']);
			}

            $pushassist_settings['psaAutoPush'] = $auto_push;
            $pushassist_settings['psaEditPostPush'] = $edit_push;
            $pushassist_settings['psaPostLogoImage'] = $use_logoimage;
            $pushassist_settings['psaPostBigImage'] = $use_bigimage;
            $pushassist_settings['psaJsRestrict'] = $psaJsRestrict;
            $pushassist_settings['psaIsAutoPushUTM'] = $auto_push_UTM;
            $pushassist_settings['psaPostMessage'] = $pushassist_setting_post_message;
			$pushassist_settings['psaAllowCustomPostTypes'] = $psaAllowCustomPostTypes;

            update_option('pushassist_settings', $pushassist_settings);

            $response_message = trim('Setting successfully save.');
            wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-advance-settings') . '&response_message=t'));
        }
    }
    
    public static function pushassist_footer_promo()
    {
        echo <<<END_SCRIPT
<!-- Push Notifications for this site is powered by PushAssist. Push Notifications for Chrome, Safari, FireFox, Opera. - Plugin version 3.0.8 - https://pushassist.com/ -->
END_SCRIPT;

    }

    public static function pushassist_gcm_setting()
    {
        $pushassist_settings = self::pushassist_settings();

        if (isset($_POST['psa-gcm-settings'])) {
			
			$appKey = $pushassist_settings['appKey'];
			$secretKey = $pushassist_settings['appSecret'];

            $pushassist_gcm_project_no = $_POST['pushassist_gcm_project_no'];
            $pushassist_gcm_api_key = $_POST['pushassist_gcm_api_key'];

            if (isset($appKey) && isset($secretKey)) {

                $gcm_settings = array("accountgcmsetting" => array("project_number" => $pushassist_gcm_project_no,
                    "project_api_key" => trim($pushassist_gcm_api_key))
                );

                $gcm_request_data = array("appKey" => $appKey,
                    "appSecret" => $secretKey,
                    "action" => "gcmsettings/",
                    "method" => "POST",
                    "remoteContent" => $gcm_settings
                );

                $gcm_settings = self::puhsassist_decode_request($gcm_request_data);

                if ($gcm_settings['status'] == 'Success') {
                    //$response_message = $gcm_settings['response_message'];
                    $response_message = 't';
                } else if ($gcm_settings['errors'] != '') {
                    //$response_message = $gcm_settings['errors'];
                    $response_message = 'f';
                } else if ($gcm_settings['error'] != '') {
                    //$response_message = $gcm_settings['error'];
                    $response_message = 'f';
                } else {
                    //$response_message = $gcm_settings['error_message'];
                    $response_message = 'f';
                }

                $response_message = trim($response_message);

                wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-setting') . '&response_message=' . $response_message));
            }
        }
    }

    public static function pushassist_create_campaign()
    {
        if (isset($_POST['pushassist-create-campaign'])) {

            $utm_source = '';
            $utm_medium = '';
            $utm_campaign = '';
			$big_image_url = '';
			$action_icon_image_1 = '';
            $action_icon_image_2 = '';
            $pushassist_campaign_button_txt_1 = '';
            $pushassist_campaign_url_1 = '';
			$pushassist_campaign_button_txt_2 = '';
            $pushassist_campaign_url_2 = '';

            $title = sanitize_text_field($_POST['pushassist_campaign_title']);
            $message = sanitize_text_field($_POST['pushassist_campaign_message']);
            $utm_string_url = esc_url($_POST['pushassist_campaign_url']);
			
			$pushassist_is_action_button = $_POST['pushassist_is_action_button'];

            $pushassist_campaign_ttl = $_POST['pushassist_campaign_ttl'];
            $pushassist_campaign_priority = $_POST['pushassist_campaign_priority'];
            $pushassist_campaign_alert_type = $_POST['pushassist_campaign_alert_type'];
            
			$pushassist_campaign_date = $_POST['pushassist_campaign_date'];
			$pushassist_campaign_timezone = $_POST['pushassist_campaign_timezone'];
			
			$is_utm_show_hidden = sanitize_text_field($_POST['is_utm_show_hidden']);
			
			if ($pushassist_is_action_button == 1) {

                $pushassist_campaign_button_txt_1 = $_POST['pushassist_campaign_button_txt_1'];
                $pushassist_campaign_url_1 = $_POST['pushassist_campaign_url_1'];
            }

            if ($pushassist_is_action_button == 2) {

                $pushassist_campaign_button_txt_1 = $_POST['pushassist_campaign_button_txt_1'];
                $pushassist_campaign_url_1 = $_POST['pushassist_campaign_url_1'];

                $pushassist_campaign_button_txt_2 = $_POST['pushassist_campaign_button_txt_2'];
                $pushassist_campaign_url_2 = $_POST['pushassist_campaign_url_2'];                
            }
			
			if (isset($_POST['pushassist_campaign_countries'])) {
                $pushassist_countries = $_POST['pushassist_campaign_countries'];
            } else {
                $pushassist_countries = array();
            }

            if (isset($_POST['pushassist_campaign_browsers'])) {
                $pushassist_browsers = $_POST['pushassist_campaign_browsers'];
            } else {
                $pushassist_browsers = array();
            }

            if (isset($_POST['pushassist_campaign_devices'])) {
                $pushassist_devices = $_POST['pushassist_campaign_devices'];
            } else {
                $pushassist_devices = array();
            }

            if (isset($_POST['pushassist_campaign_os_users'])) {
                $pushassist_os_users = $_POST['pushassist_campaign_os_users'];
            } else {
                $pushassist_os_users = array();
            }
			
            if (isset($_POST['pushassist_campaign_segment'])) {
                $segment = $_POST['pushassist_campaign_segment'];
            } else {
                $segment = array();
            }

            if ($title == '') {
                $response_message = 'Please provide title.';
            } else if ($message == '') {
                $response_message = 'Please provide message.';
            }			
			
			if ($_POST['pushassist_campaign_is_utm_show'] == 1) {
				if ($_POST['pushassist_campaign_is_utm_show'] == 1 && $utm_string_url == '') {
					$response_message = 'Please provide notification url.';
				} else if ($_POST['pushassist_campaign_is_utm_show'] == 1 && $_POST['pushassist_campaign_utm_source'] == '') {
					$response_message = 'Please provide UTM source.';
				} else if ($_POST['pushassist_campaign_is_utm_show'] == 1 && $_POST['pushassist_campaign_utm_medium'] == '') {
					$response_message = 'Please provide UTM medium.';
				} else if ($_POST['pushassist_campaign_is_utm_show'] == 1 && $_POST['pushassist_campaign_utm_campaign'] == '') {
					$response_message = 'Please provide UTM campaign.';
				}
			}
			
			if ($_FILES['pushassist_campaign_fileupload']['size'] > 500000) {
                $response_message = 'Image size must be exactly 256x256px.';
            }
			
			/*   image upload   */

			$actual_uploaded_image_path = $image_name = '';
			$tm = time();

			$upload_file_name = $_FILES['pushassist_campaign_fileupload']['name'];
			$upload_tem_file_name = $_FILES['pushassist_campaign_fileupload']['tmp_name'];

			if ($upload_file_name != '' && $upload_tem_file_name != '') {

				$wp_upload_dir = wp_upload_dir();
				$image_name = $tm . '-' . $upload_file_name;
				move_uploaded_file($upload_tem_file_name, $wp_upload_dir['basedir'] . '/' . $tm . '-' . $upload_file_name);
				$actual_uploaded_image_path = $wp_upload_dir['baseurl'] . '/' . $tm . '-' . $upload_file_name;
			}
	
			/* check file extension before file upload */
			if(!empty($image_name)){
				$supported_image = array('gif','jpg','jpeg','png');
				$ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

				if (in_array($ext, $supported_image)){}else{ $response_message = 'Invalid image, try again.'; }
			}
			
			/*	Notification Large Image  */
			if(isset($_POST['pushassist_is_big_image']) && $_POST['pushassist_is_big_image'] == 1 && $actual_uploaded_image_path != ''){				
				$big_image_url = $actual_uploaded_image_path;
				$actual_uploaded_image_path = '';
			}

			/*   image upload  end  */

            if (!empty($response_message)) {
                $response_message = trim($response_message);
                wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-campaigns') . '&response_message=f&class=warning'));

            } else {

                $pushassist_settings = self::pushassist_settings();

                $appKey = $pushassist_settings['appKey'];
                $appSecret = $pushassist_settings['appSecret'];
                
				if($_POST['pushassist_campaign_is_utm_show'] == 1){
					if (isset($_POST['pushassist_campaign_utm_source']) && $_POST['pushassist_campaign_is_utm_show'] == 1 && $utm_string_url != '') {
						$utm_source = sanitize_text_field($_POST['pushassist_campaign_utm_source']);
					}

					if (isset($_POST['pushassist_campaign_utm_medium']) && $_POST['pushassist_campaign_is_utm_show'] == 1 && $utm_string_url != '') {
						$utm_medium = sanitize_text_field($_POST['pushassist_campaign_utm_medium']);
					}

					if (isset($_POST['pushassist_campaign_utm_campaign']) && $_POST['pushassist_campaign_is_utm_show'] == 1 && $utm_string_url != '') {
						$utm_campaign = sanitize_text_field($_POST['pushassist_campaign_utm_campaign']);
					}
				}

                $campaign = array("campaign" => array("title" => $title,
                    "message" => $message,
                    "redirect_url" => $utm_string_url,
                    "image" => $actual_uploaded_image_path,
                    "big_image" => $big_image_url,
					"date_time" => $pushassist_campaign_date,
                    "timezone" => $pushassist_campaign_timezone,
                    "action_1" => $pushassist_campaign_button_txt_1,
                    "action_url_1" => $pushassist_campaign_url_1,
                    "action_2" => $pushassist_campaign_button_txt_2,
                    "action_url_2" => $pushassist_campaign_url_2,
                    "ttl" => $pushassist_campaign_ttl,
                    "priority" => $pushassist_campaign_priority,
                    "alert" => 0),
                    "utm_params" => array("utm_source" => $utm_source,
                        "utm_medium" => $utm_medium,
                        "utm_campaign" => $utm_campaign),
                    "segments" => $segment,
                    "browsers" => $pushassist_browsers,
                    "countries" => $pushassist_countries,
                    "devices" => $pushassist_devices,
                    "os_users" => $pushassist_os_users
                );

                $campaign_request_data = array("appKey" => trim($appKey),
                    "appSecret" => trim($appSecret),
                    "action" => "campaigns/",
                    "method" => "POST",
                    "remoteContent" => $campaign
                );
								
                $campaign_response = self::puhsassist_decode_request($campaign_request_data);
				$class = "warning";
				
                if ($campaign_response['status'] == 'Success') {
                    //$response_message = $campaign_response['response_message'];
                    $response_message = 't';
					$class = "success";
                } else if ($campaign_response['errors'] != '') {
                    //$response_message = $campaign_response['errors'];
					$response_message = 'f';
                } else if ($campaign_response['error'] != '') {
                    //$response_message = $campaign_response['error'];
					$response_message = 'f';
                } else {
                    //$response_message = $campaign_response['error_message'];
					$response_message = 'f';
                }

                $response_message = trim($response_message);

				wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-campaigns') . '&response_message=' . $response_message. '&class=' . $class));                
            }
        }
    }

   public static function pushassist_welcome_notification_setting()
    {		
        if (isset($_POST['psa-welcome-msg-setting'])) {
						
            $response_message = '';
            $utm_source = '';
            $utm_medium = '';
            $utm_campaign = '';
			
			$pushassist_welcome_button_txt_1 = '';
            $pushassist_welcome_url_1 = '';

            $pushassist_welcome_button_txt_2 = '';
            $pushassist_welcome_url_2 = '';
			$actual_uploaded_image_path = '';

            $title = sanitize_text_field($_POST['pushassist_welcome_title']);
            $message = sanitize_text_field($_POST['pushassist_welcome_message']);
            $url = sanitize_text_field($_POST['pushassist_welcome_url']);
            			          
            if ($title == '') {
                $response_message = 'Please provide title.';
            } else if ($message == '') {
                $response_message = 'Please provide message.';
            } else if ($url == '') {
                $response_message = 'Please provide welcome url.';
            }
			
			if (isset($_POST['pushassist_welcome_is_utm_show'])) {
				if ($_POST['pushassist_welcome_is_utm_show'] == 1 && $url == '') {
					$response_message = 'Please provide welcome url.';
				} else if ($_POST['pushassist_welcome_is_utm_show'] == 1 && $_POST['pushassist_welcome_utm_source'] == '') {
					$response_message = 'Please provide UTM source.';
				} else if ($_POST['pushassist_welcome_is_utm_show'] == 1 && $_POST['pushassist_welcome_utm_medium'] == '') {
					$response_message = 'Please provide UTM medium.';
				} else if ($_POST['pushassist_welcome_is_utm_show'] == 1 && $_POST['pushassist_welcome_utm_campaign'] == '') {
					$response_message = 'Please provide UTM campaign.';
				}
			}
			
			if (!empty($response_message)) {
                wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-welcome-message-setting') . '&response_message=f&class=warning'));
            } else {

                $pushassist_settings = self::pushassist_settings();

                $appKey = $pushassist_settings['appKey'];
                $appSecret = $pushassist_settings['appSecret'];
                
				if (isset($_POST['pushassist_welcome_is_utm_show'])) {
					if (isset($_POST['pushassist_welcome_utm_source']) && $_POST['pushassist_welcome_is_utm_show'] == 1 && $url != '') {
						$utm_source = sanitize_text_field($_POST['pushassist_welcome_utm_source']);
					}

					if (isset($_POST['pushassist_welcome_utm_medium']) && $_POST['pushassist_welcome_is_utm_show'] == 1 && $url != '') {
						$utm_medium = sanitize_text_field($_POST['pushassist_welcome_utm_medium']);
					}

					if (isset($_POST['pushassist_welcome_utm_campaign']) && $_POST['pushassist_welcome_is_utm_show'] == 1 && $url != '') {
						$utm_campaign = sanitize_text_field($_POST['pushassist_welcome_utm_campaign']);
					}
					
					$redirect_url = $url.'?utm_source='.$utm_source.'&utm_medium='.$utm_medium.'&utm_campaign='.$utm_campaign;
					
				} else {
					$redirect_url = $url;
				}

                $welcome_data = array("title" => $title,
                    "message" => $message,
                    "redirect_url" => $redirect_url,
                    "image" => $actual_uploaded_image_path,
                    "pushassist_welcome_button_txt_1" => $pushassist_welcome_button_txt_1,
                    "pushassist_welcome_url_1" => $pushassist_welcome_url_1,
                    "pushassist_welcome_button_txt_2" => $pushassist_welcome_button_txt_2,
                    "pushassist_welcome_url_2" => $pushassist_welcome_url_2,
                );

                $welcome_request_data = array("appKey" => trim($appKey),
                    "appSecret" => trim($appSecret),
                    "action" => "settings/welcome-content",
                    "method" => "POST",
                    "remoteContent" => $welcome_data
                );

                $welcome_response = self::puhsassist_decode_request($welcome_request_data);
				$class = 'warning';
				
                if ($welcome_response['status'] == 'Success') {
                    //$response_message = $welcome_response['response_message'];
                    $response_message = 't';
					$class = 'success';
                } else if ($welcome_response['errors'] != '') {
                    //$response_message = $welcome_response['errors'];
					$response_message = 'f';
                } else if ($welcome_response['error'] != '') {
                    //$response_message = $welcome_response['error'];
					$response_message = 'f';
                } else {
                    //$response_message = $welcome_response['error_message'];
					$response_message = 'f';
                }
				
				wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-welcome-message-setting') . '&response_message=' . $response_message . '&class=' . $class));
            }
        }
    }

   public static function pushassist_optin_setting()
    {				
        if (isset($_POST['psa-opt-in-setting'])) {
						
			$pushassist_website_url = sanitize_text_field($_POST['pushassist_website_url']);
			
			$pushassist_opt_in_interval = sanitize_text_field($_POST['pushassist_opt_in_interval']);
            
			$position = sanitize_text_field($_POST['position']);
			$position_1 = sanitize_text_field($_POST['position_1']);
			$position_2 = sanitize_text_field($_POST['position_2']);
			
			$pushassist_opt_in_title = sanitize_text_field($_POST['pushassist_opt_in_title']);
            $pushassist_opt_in_message = sanitize_text_field($_POST['pushassist_opt_in_message']);
            $pushassist_allow_button_text = sanitize_text_field($_POST['pushassist_allow_button_text']);
            $pushassist_disallow_button_text = sanitize_text_field($_POST['pushassist_disallow_button_text']);
			
            $pushassist_template = sanitize_text_field($_POST['pushassist_template']);
			$pushassist_template_location = sanitize_text_field($_POST['pushassist_template_location']);
			
			$pushassist_switch_ssl = 0;
			$pushassist_powered_by = 0;
			/* for while its commented due to wp manifest & service-worker not support issue
			if(isset($_POST['pushassist_switch_ssl'])){
				$pushassist_switch_ssl = sanitize_text_field($_POST['pushassist_switch_ssl']);
			}
			*/
			if(isset($_POST['pushassist_powered_by'])){
				$pushassist_powered_by = sanitize_text_field($_POST['pushassist_powered_by']);
			}
			
			/*   image upload   */

            $image_name = '';            
            $tm = time();
            $actual_uploaded_image_path = '';

            $upload_file_name = $_FILES['pushassist_setting_fileupload']['name'];
            $upload_tem_file_name = $_FILES['pushassist_setting_fileupload']['tmp_name'];

            if ($upload_file_name != '' && $upload_tem_file_name != '') {

                $wp_upload_dir = wp_upload_dir();
                $image_name = $tm . '-' . $upload_file_name;

                move_uploaded_file($upload_tem_file_name, $wp_upload_dir['basedir'] . '/' . $image_name);
                $actual_uploaded_image_path = $wp_upload_dir['baseurl'] . '/' . $tm . '-' . $upload_file_name;				
            }
			
			/* check file extension before file upload */
			if(!empty($image_name)){
				$supported_image = array('gif','jpg','jpeg','png');
				$ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

				if (in_array($ext, $supported_image)){}
				else{
				   $response_message = 'Invalid image, try again.';
				}
			}

            /*   image upload  end  */
									          
            if ($pushassist_opt_in_title == '') {
                $response_message = 'Please provide title.';
            } else if ($pushassist_opt_in_message == '') {
                $response_message = 'Please provide message.';
            } else if ($pushassist_allow_button_text == '') {
                $response_message = 'Please provide allow button text.';
            } else if ($pushassist_disallow_button_text == '') {
                $response_message = 'Please provide disallow button text.';
            }
			
            if (!empty($response_message)) {				
                wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-opt-in-setup') . '&response_message=f&class=warning'));
            } else {

                $pushassist_settings = self::pushassist_settings();

                $appKey = $pushassist_settings['appKey'];
                $appSecret = $pushassist_settings['appSecret'];

                $opt_in_settings = array("website_url" => $pushassist_website_url,
					"interval_time" => $pushassist_opt_in_interval,
                    "opt_in_title" => trim($pushassist_opt_in_title),
                    "opt_in_subtitle" => trim($pushassist_opt_in_message),
                    "allow_button_text" => trim($pushassist_allow_button_text),
                    "disallow_button_text" => trim($pushassist_disallow_button_text),
                    "template" => $pushassist_template,
                    "location" => $pushassist_template_location,
                    "image_name" => trim($image_name),
                    "image_path" => trim($actual_uploaded_image_path),
                    "pushassist_powered_by" => trim($pushassist_powered_by),
                    "switch_ssl" => trim($pushassist_switch_ssl)
                );
				
                $opt_in_request_data = array("appKey" => $appKey,
                    "appSecret" => $appSecret,
                    "action" => "settings/opt-in-template",
                    "method" => "POST",
                    "remoteContent" => $opt_in_settings
                );

                $optin_settings = self::puhsassist_decode_request($opt_in_request_data);
				$class = 'warning';
				$response_message = 't';

                if ($optin_settings['status'] == 'Success') {
                    //$response_message = $optin_settings['response_message'];
                    $response_message = 't';
					$class = 'success';
                } else if ($optin_settings['errors'] != '') {
                    $response_message = $optin_settings['errors'];
                } else if ($optin_settings['error'] != '') {
                    $response_message = $optin_settings['error'];
                } else {
                    //$response_message = $optin_settings['error_message'];
					$class = 'success';
					$response_message = 't';
                }
				
				wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-opt-in-setup') . '&response_message=' . $response_message. '&class=' . $class));
            }
        }
    }
   
   public static function pushassist_childwindow_setting()
    {
        if (isset($_POST['psa-child-window-setting'])) {
						
			$pushassist_child_text = sanitize_text_field($_POST['pushassist_child_text']);			
			$pushassist_child_title = sanitize_text_field($_POST['pushassist_child_title']);
			$pushassist_child_message = sanitize_text_field($_POST['pushassist_child_message']);            
									          
            if ($pushassist_child_text == '') {
                $response_message = 'Please provide Opt-In Text.';
            } else if ($pushassist_child_title == '') {
                $response_message = 'Please provide Opt-In Title.';
            } else if ($pushassist_child_message == '') {
                $response_message = 'Please provide Opt-In Message.';
            }
			
            if (!empty($response_message)) {				
                wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-child-window-setting') . '&response_message=f&class=warning'));
            } else {

                $pushassist_settings = self::pushassist_settings();

                $appKey = $pushassist_settings['appKey'];
                $appSecret = $pushassist_settings['appSecret'];                				

                $child_window_settings = array("text" => $pushassist_child_text,
					"title" => $pushassist_child_title,
                    "message" => trim($pushassist_child_message)
                );
				
                $child_window_request_data = array("appKey" => $appKey,
                    "appSecret" => $appSecret,
                    "action" => "settings/child-window-content",
                    "method" => "POST",
                    "remoteContent" => $child_window_settings
                );			
			
                $child_window_response = self::puhsassist_decode_request($child_window_request_data);
				$class = "warning";

                if ($child_window_response['status'] == 'Success') {
                    //$response_message = $child_window_response['response_message'];
					$response_message = 't';
					$class = 'success';
                } else if ($child_window_response['errors'] != '') {
                    $response_message = $child_window_response['errors'];
                } else if ($child_window_response['error'] != '') {
                    $response_message = $child_window_response['error'];
                } else {
                    $response_message = $child_window_response['error_message'];
                }

				wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-child-window-setting') . '&response_message=' . $response_message. '&class=' . $class));
            }
        }
    }

    // Check Pushassist Account valid or not
    public static function pushassist_settings()
    {
        $pushassist = get_option('pushassist_settings');

        return $pushassist;
    }

    // if already registered then accept API keys
    public static function pushassist_accept_keys()
    {
        $response_message = '';

        if (isset($_POST['pushassist_api_key']) || isset($_POST['pushassist_secret_key'])) {

            $appKey = $_POST['pushassist_api_key'];
            $secretKey = $_POST['pushassist_secret_key'];
			
			$remoteContent = array("account" => array("is_wordpress" => 1));

            $request_data = array("appKey" => $appKey,
                "appSecret" => $secretKey,
                "action" => 'accounts_info/',
                "method" => "GET",
                "remoteContent" => $remoteContent
            );

            $account_info = self::puhsassist_decode_request($request_data);

            if (isset($account_info['apiKey']) && isset($account_info['apiSecret'])) {

                $pushassist_settings = array(

                    'appKey' => trim($account_info['apiKey']),
                    'appSecret' => trim($account_info['apiSecret']),
                    'jsPath' => trim($account_info['jsPath']),
                    'subDomain' => trim($account_info['account_name']),
                    'psaAutoPush' => false,
                    'psaEditPostPush' => false,
                    'psaIsAutoPushUTM' => false,
                    'psaJsRestrict' => false,
                    'psaPostLogoImage' => false,
                    'psaPostBigImage' => false,
                    'psaAllowCustomPostTypes' => 'post',
                    'psaUTMSource' => 'pushassist',
                    'psaUTMMedium' => 'pushassist_notification',
                    'psaUTMCampaign' => 'pushassist',
                    'psaPostMessage' => 'We have just published an article, check it out!'
                );

                wp_enqueue_script('pushassist-js', trim($account_info['jsPath']), array('jquery'), "", true);

                add_option('pushassist_settings', $pushassist_settings);

                //$response_message = trim("PushAssist is installed, no additional step is needed. Completely Purge Site Cache once to see it in action. Your Account Details have already been emailed to you. Also check under SPAM if you don't find it.");

                wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-admin') . '&response_message=t'));

            } else {

                if (isset($account_info['error'])) {
                    $response_message = trim($account_info['error']);
                }

                wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-create-account') . '&response_message=f'));
            }
        }
    }

    // function to create an new account
    public static function pushassist_account_create()
    {
        if (isset($_POST['pushassist_api_form']) && $_POST['pushassist_api_form'] == 'pushassist_account_creation') {

            if (isset($_POST['pushassist_name']) || isset($_POST['pushassist_email']) || isset($_POST['pushassist_contact']) || isset($_POST['pushassist_password']) || isset($_POST['pushassist_protocol']) || isset($_POST['pushassist_site_url']) || isset($_POST['pushassist_sub_domain'])) {

                $response_message_error = '';

                $name = sanitize_text_field($_POST['pushassist_name']);
                $company_name = sanitize_text_field($_POST['pushassist_company_name']);
                $email = sanitize_text_field($_POST['pushassist_email']);
                $contact = sanitize_text_field($_POST['pushassist_contact']);
                $hidden_psa_error_msg = sanitize_text_field($_POST['hidden_psa_error_msg']);
                $password = sanitize_text_field($_POST['pushassist_password']);
                $protocol = sanitize_text_field($_POST['pushassist_protocol']);
                $site_url = sanitize_text_field($_POST['pushassist_site_url']);

                $url = $protocol . $site_url;

                $sub_domain = sanitize_text_field($_POST['pushassist_sub_domain']);

                if ($hidden_psa_error_msg == 0 && !empty($contact)) {
                    $response_message_error = trim('Please Provide valid contact no.');
                }

                $flag = self::url_validator($url);

                if ($flag == 0) {
                    $response_message_error = trim('Please Provide valid site URL.');
                }

                if (!empty($response_message_error)) {
                    wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-create-account') . '&response_message=' . $response_message_error. '&class=error'));
                } else {
                    /*   account creation   */
                    $remoteContent = array("account" => array("name" => trim($name),
                        "company_name" => trim($company_name),
                        "contact" => $contact,
                        "email" => trim($email),
                        "password" => trim($password),
                        "protocol" => trim($protocol),
                        "siteurl" => trim($site_url),
                        "subdomain" => trim($sub_domain),
                        "psa_source" => 'WordPress',
						"is_wordpress" => 1)
                    );

                    $account_request_data = array("action" => "accounts/",
                        "method" => "POST",
                        "remoteContent" => $remoteContent
                    );

                    $account_create = self::puhsassist_decode_request($account_request_data);

                    if ($account_create['status'] == 'Success') {

                        $dashboard_request_data = array("appKey" => $account_create['api_key'],
                            "appSecret" => $account_create['auth_secret'],
                            "action" => "accounts_info/",
                            "method" => "GET",
                            "remoteContent" => ""
                        );

                        $account_info = self::puhsassist_decode_request($dashboard_request_data);

                        if (isset($account_info['apiKey']) && isset($account_info['apiSecret'])) {

                            $pushassist_settings = array(
                                'appKey' => trim($account_info['apiKey']),
                                'appSecret' => trim($account_info['apiSecret']),
                                'jsPath' => trim($account_info['jsPath']),
                                'subDomain' => trim($account_info['account_name']),
                                'psaAutoPush' => false,
                                'psaEditPostPush' => false,
                                'psaIsAutoPushUTM' => false,
                                'psaJsRestrict' => false,
								'psaPostLogoImage' => false,
								'psaPostBigImage' => false,
								'psaAllowCustomPostTypes' => 'post',
                                'psaUTMSource' => 'pushassist',
                                'psaUTMMedium' => 'pushassist_notification',
                                'psaUTMCampaign' => 'pushassist',
                                'psaPostMessage' => 'We have just published an article, check it out!',
                            );

                            wp_enqueue_script('pushassist-js', trim($account_info['jsPath']), array('jquery'), "", true);

                            add_option('pushassist_settings', $pushassist_settings);

                            if ($account_create['status'] == 'Success') {
                                $response_message = $account_create['response_message'];
                            }

                            $response_message = trim("PushAssist is installed, no additional step is needed. Completely Purge Site Cache once to see it in action.  Your Account Details have already been emailed to you. Also check under SPAM if you don't find it.");

                            wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-admin') . '&response_message=' . $response_message));
                        }

                    } else {

                        if ($account_create['error'] != '') {
                            $response_message = $account_create['error'];
                        } else if ($account_create['errors'] != '') {
                            $response_message = $account_create['errors'];
                        } else {
                            $response_message = $account_create['error_message'];
                        }

                        $response_message = trim($response_message);

                        wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-create-account') . '&response_message=' . $response_message . '&class=error'));
                    }
                }
            }
        } else {

            self::pushassist_accept_keys();
        }
    }

    /*   notification send    */

    public static function send_pushassist_notifications()
    {
        if (isset($_POST['pushassist_notification_title']) || isset($_POST['pushassist_notification_message'])) {

            $utm_source = '';
            $utm_medium = '';
            $utm_campaign = '';
			$big_image_url = '';
			$action_icon_image_1 = '';
            $action_icon_image_2 = '';
            $pushassist_notification_button_txt_1 = '';
            $pushassist_notification_url_1 = '';
			$pushassist_notification_button_txt_2 = '';
            $pushassist_notification_url_2 = '';

            $title = sanitize_text_field($_POST['pushassist_notification_title']);
            $message = sanitize_text_field($_POST['pushassist_notification_message']);
            $utm_string_url = esc_url($_POST['pushassist_notification_url']);
			
			$pushassist_is_action_button = $_POST['pushassist_is_action_button'];

            $pushassist_notification_ttl = $_POST['pushassist_notification_ttl'];
            $pushassist_notification_priority = $_POST['pushassist_notification_priority'];
            $pushassist_notification_alert_type = $_POST['pushassist_notification_alert_type'];
			
			if ($pushassist_is_action_button == 1) {

                $pushassist_notification_button_txt_1 = $_POST['pushassist_notification_button_txt_1'];
                $pushassist_notification_url_1 = $_POST['pushassist_notification_url_1'];
            }

            if ($pushassist_is_action_button == 2) {

                $pushassist_notification_button_txt_1 = $_POST['pushassist_notification_button_txt_1'];
                $pushassist_notification_url_1 = $_POST['pushassist_notification_url_1'];

                $pushassist_notification_button_txt_2 = $_POST['pushassist_notification_button_txt_2'];
                $pushassist_notification_url_2 = $_POST['pushassist_notification_url_2'];                
            }
			
			if (isset($_POST['pushassist_notification_countries'])) {
                $pushassist_countries = $_POST['pushassist_notification_countries'];
            } else {
                $pushassist_countries = array();
            }

            if (isset($_POST['pushassist_notification_browsers'])) {
                $pushassist_browsers = $_POST['pushassist_notification_browsers'];
            } else {
                $pushassist_browsers = array();
            }

            if (isset($_POST['pushassist_notification_devices'])) {
                $pushassist_devices = $_POST['pushassist_notification_devices'];
            } else {
                $pushassist_devices = array();
            }

            if (isset($_POST['pushassist_notification_os_users'])) {
                $pushassist_os_users = $_POST['pushassist_notification_os_users'];
            } else {
                $pushassist_os_users = array();
            }
			
            if (isset($_POST['pushassist_notification_segment'])) {
                $segment = $_POST['pushassist_notification_segment'];
            } else {
                $segment = array();
            }

            if ($title == '') {
                $response_message = 'Please provide title.';
            } else if ($message == '') {
                $response_message = 'Please provide message.';
            }			
			
			if ($_POST['pushassist_notification_is_utm_show'] == 1) {
				if ($_POST['pushassist_notification_is_utm_show'] == 1 && $utm_string_url == '') {
					$response_message = 'Please provide notification url.';
				} else if ($_POST['pushassist_notification_is_utm_show'] == 1 && $_POST['pushassist_notification_utm_source'] == '') {
					$response_message = 'Please provide UTM source.';
				} else if ($_POST['pushassist_notification_is_utm_show'] == 1 && $_POST['pushassist_notification_utm_medium'] == '') {
					$response_message = 'Please provide UTM medium.';
				} else if ($_POST['pushassist_notification_is_utm_show'] == 1 && $_POST['pushassist_notification_utm_campaign'] == '') {
					$response_message = 'Please provide UTM campaign.';
				}
			}
			
			if ($_FILES['pushassist_notification_fileupload']['size'] > 500000) {
                $response_message = 'Image size must be exactly 256x256px.';
            }
			
			/*   image upload   */

			$actual_uploaded_image_path = $image_name = '';
			$tm = time();

			$upload_file_name = $_FILES['pushassist_notification_fileupload']['name'];
			$upload_tem_file_name = $_FILES['pushassist_notification_fileupload']['tmp_name'];

			if ($upload_file_name != '' && $upload_tem_file_name != '') {

				$wp_upload_dir = wp_upload_dir();
				$image_name = $tm . '-' . $upload_file_name;
				move_uploaded_file($upload_tem_file_name, $wp_upload_dir['basedir'] . '/' . $tm . '-' . $upload_file_name);
				$actual_uploaded_image_path = $wp_upload_dir['baseurl'] . '/' . $tm . '-' . $upload_file_name;
			}
	
			/* check file extension before file upload */
			if(!empty($image_name)){
				$supported_image = array('gif','jpg','jpeg','png');
				$ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

				if (in_array($ext, $supported_image)){}
				else{
				   $response_message = 'Invalid image, try again.';
				}
			}
			
			/*	Notification Large Image  */
			if(isset($_POST['pushassist_is_big_image']) && $_POST['pushassist_is_big_image'] == 1 && $actual_uploaded_image_path != ''){				
				$big_image_url = $actual_uploaded_image_path;
				$actual_uploaded_image_path = '';
			}

			/*   image upload  end  */

            if (!empty($response_message)) {

                $response_message = trim($response_message);
                wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-send-notifications') . '&response_message=f&class=warning'));

            } else {

                $pushassist_settings = self::pushassist_settings();

                $appKey = $pushassist_settings['appKey'];
                $appSecret = $pushassist_settings['appSecret'];
                
				if($_POST['pushassist_notification_is_utm_show'] == 1){
					if (isset($_POST['pushassist_notification_utm_source']) && $_POST['pushassist_notification_is_utm_show'] == 1 && $utm_string_url != '') {
						$utm_source = sanitize_text_field($_POST['pushassist_notification_utm_source']);
					}

					if (isset($_POST['pushassist_notification_utm_medium']) && $_POST['pushassist_notification_is_utm_show'] == 1 && $utm_string_url != '') {
						$utm_medium = sanitize_text_field($_POST['pushassist_notification_utm_medium']);
					}

					if (isset($_POST['pushassist_notification_utm_campaign']) && $_POST['pushassist_notification_is_utm_show'] == 1 && $utm_string_url != '') {
						$utm_campaign = sanitize_text_field($_POST['pushassist_notification_utm_campaign']);
					}
				}

                $notification = array("notification" => array("title" => $title,
                    "message" => $message,
                    "redirect_url" => $utm_string_url,
                    "image" => $actual_uploaded_image_path,
                    "big_image" => $big_image_url,
                    "action_1" => $pushassist_notification_button_txt_1,
                    "action_url_1" => $pushassist_notification_url_1,
                    "action_2" => $pushassist_notification_button_txt_2,
                    "action_url_2" => $pushassist_notification_url_2,
                    "ttl" => $pushassist_notification_ttl,
                    "priority" => $pushassist_notification_priority,
					"alert" => 0),
                    "utm_params" => array("utm_source" => $utm_source,
                        "utm_medium" => $utm_medium,
                        "utm_campaign" => $utm_campaign),
                    "segments" => $segment,
                    "browsers" => $pushassist_browsers,
                    "countries" => $pushassist_countries,
                    "devices" => $pushassist_devices,
                    "os_users" => $pushassist_os_users
                );

                $notification_request_data = array("appKey" => trim($appKey),
                    "appSecret" => trim($appSecret),
                    "action" => "notifications/",
                    "method" => "POST",
                    "remoteContent" => $notification
                );			
				
                $notification_response = self::puhsassist_decode_request($notification_request_data);
				$class = "warning";
				$response_message = 'f';
				
                if ($notification_response['status'] == 'Success') {
                    //$response_message = $notification_response['response_message'];
                    $response_message = 't';
					$class = "success";
                } else if ($notification_response['errors'] != '') {
                    //$response_message = $notification_response['errors'];
                } else if ($notification_response['error'] != '') {
                    $response_message = $notification_response['error'];
                } else {
                    $response_message = $notification_response['error_message'];
                }			
			
                $response_message = trim($response_message);
				wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-send-notifications') . '&response_message=' . $response_message. '&class=' . $class));
            }
        }
    }

    /*   end notification   */

    /*   add segment   */

    public static function pushassist_segment()
    {
        $pushassist_settings = self::pushassist_settings();

        if (isset($_POST['pushassist_segment_name'])) {

            $pushassit_segmentname = sanitize_text_field($_POST['pushassist_segment_name']);

            if ($pushassit_segmentname != '') {
				
                $pushassit_segmentname = str_replace(" ", "", $pushassit_segmentname);				
                $segment = array("segment" => array("segment_name" => $pushassit_segmentname));

                $segment_request_data = array("appKey" => trim($pushassist_settings['appKey']),
                    "appSecret" => trim($pushassist_settings['appSecret']),
                    "action" => "segments/",
                    "method" => "POST",
                    "remoteContent" => $segment
                );
				
                $add_segment = self::puhsassist_decode_request($segment_request_data);
				$class = 'warning';
								
                if ($add_segment['status'] == 'Success') {
                    $response_message = $add_segment['response_message'];
					$class = 'success';
                } else if ($add_segment['errors'] != '') {
                    $response_message = $add_segment['errors'];
                } else if ($add_segment['error'] != '') {
                    $response_message = $add_segment['error'];
                } else {
                    $response_message = $add_segment['error_message'];
                }

                if ($add_segment['status'] == 'Success') {
                    wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-segment-details') . '&response_message=t&class=' . $class));
                } else {
                    $response_message = trim($response_message);
                    wp_redirect(esc_url_raw(admin_url('admin.php?page=pushassist-segments') . '&response_message=f&class=' . $class));
                }
            }
        }
    }

    /*   segment end  */

    /*  New post publish notification  */

    public static function pushassist_publish_post_types_widget()
    {		
		$pushassist_settings = self::pushassist_settings();
				
		if(isset($pushassist_settings['psaAllowCustomPostTypes'])){
			
			$psaAllowCustomPostTypes = explode(',', $pushassist_settings['psaAllowCustomPostTypes']);
			
			if($psaAllowCustomPostTypes){
				foreach ( $psaAllowCustomPostTypes  as $post_type ) {
									
					add_meta_box(
						'pushassist_notif_on_post',
						'PushAssist Push Notification',
						array( __CLASS__, 'pushassist_post_sidebar' ),
						$post_type,
						'side',
						'high'
					);
				}
			}
		}
    }
    
    public static function pushassist_post_sidebar()
    {
        $newpostChecked = '';
        $updatepostChecked = '';

        $pushassist_settings = self::pushassist_settings();
        
        $psa_auto_push = $pushassist_settings['psaAutoPush'];
		
		$psa_auto_push_edit = $pushassist_settings['psaEditPostPush'];

		$psaAllowCustomPostTypes = array();

		if(isset($pushassist_settings['psaAllowCustomPostTypes'])){
			$psaAllowCustomPostTypes = explode(',', $pushassist_settings['psaAllowCustomPostTypes']);
		}
		
        global $post;
		
		if(!in_array($post->post_type, $psaAllowCustomPostTypes)){return;}
								
        printf('<div id="pushassist_segment_checkboxes" class="misc-pub-section">');
		
		if ('publish' === $post->post_status) {	//while updating post
			
			$checkbox_title = 'Send Push Notification on Update';
			$checkbox_name = 'pushassist-checkbox';
			$updatepostChecked = '';

			if($psa_auto_push_edit === true){
				$updatepostChecked = 'checked';
			}
			
			if(get_post_meta($post->ID, '_pushassist_checkbox_override', true)) {
				$updatepostChecked = 'checked';
			}
			
			if(get_post_meta($post->ID, '_pushassist_donot_send_checkbox_override', true)) {
				$updatepostChecked = 'checked';
			}
			
			printf('<label><input type="checkbox" ' . $updatepostChecked . ' value="1" id="pushassist-forced-checkbox" name="'.$checkbox_name.'" style="margin: -3px 9px 0 1px;" />');
			_e($checkbox_title, 'push-notification-for-wp-by-pushassist');
			echo ' </label><input type="hidden" name="pushassist_update_post" value="1" id="pushassist_update_post">';

		} else if ('auto-draft' === $post->post_status) {	//while creating new post
		
			$checkbox_title = 'Send Push Notification';
			$checkbox_name = 'pushassist-checkbox';
			$updatepostChecked = '';
			
			if($psa_auto_push === true){
				$updatepostChecked = 'checked';
			}
			
			printf('<label><input type="checkbox" ' . $updatepostChecked . ' value="1" id="pushassist-forced-checkbox" name="'.$checkbox_name.'" style="margin: -3px 9px 0 1px;" />');
			_e($checkbox_title, 'push-notification-for-wp-by-pushassist');
			echo ' </label><input type="hidden" name="pushassist_new_post" value="1" id="pushassist_new_post">';
					
		} else if('draft' === $post->post_status || 'future' === $post->post_status) {	//while publishing draft/future post
												
			$checkbox_title = 'Send Push Notification';
			$checkbox_name = 'pushassist-checkbox';
			$updatepostChecked = '';
			
			if($psa_auto_push === true){
				$updatepostChecked = 'checked';
			}
			
			if(get_post_meta($post->ID, '_pushassist_checkbox_override', true)) {
				$updatepostChecked = 'checked';
			}
			// right down below to skip above code
			if((get_post_meta($post->ID, '_pushassist_checkbox_override', true) != "") && $psa_auto_push === true){
				$updatepostChecked = '';
				$checkbox_title = 'Don\'t Send Push Notification';
				$checkbox_name = 'pushassist-donot-send-checkbox';
			}
			
			if(get_post_meta($post->ID, '_pushassist_donot_send_checkbox_override', true)) {
				$updatepostChecked = 'checked';
			}
			
			printf('<label><input type="checkbox" ' . $updatepostChecked . ' value="1" id="pushassist-forced-checkbox" name="'.$checkbox_name.'" style="margin: -3px 9px 0 1px;" />');
			_e($checkbox_title, 'push-notification-for-wp-by-pushassist');
			echo ' </label><input type="hidden" name="pushassist_draft_future_post" value="1" id="pushassist_draft_future_post">';
		}
		
        wp_nonce_field('pushassist_save_post', 'hidden_pushassist');

        echo '</div>';
				
        if (($psa_auto_push === false && 'publish' !== $post->post_status) || ('publish' === $post->post_status && $psaEditPostPush === false) || ('draft' === $post->post_status && $psa_auto_push === false) || in_array( $post->post_type, $psaAllowCustomPostTypes)) {

            if (isset($pushassist_settings['appKey']) && isset($pushassist_settings['appSecret'])) {

                $segment_data = array("appKey" => trim($pushassist_settings['appKey']),
                    "appSecret" => trim($pushassist_settings['appSecret']),
                    "action" => 'segments/',
                    "method" => "GET",
                    "remoteContent" => ""
                );

                $pushassist_segmets_data = self::puhsassist_decode_request($segment_data);

            } else {
                $pushassist_segmets_data = '';
            }

            if (!empty($pushassist_segmets_data)) {

                printf('<div style="padding-left:37px;padding-top:0px; line-height: 25px" id="pushassist_post_categories"><span style="font-weight:bold;">');
                _e('Select PushAssist Segments', 'push-notification-for-wp-by-pushassist');
                printf('</span>');

                echo '<br><input type="checkbox" id="pushassist_checkbox" onclick="pushassist_check_all();"><span  style="margin-left:10px;">';
                _e('All', 'push-notification-for-wp-by-pushassist');
                echo '</span>';

                foreach ($pushassist_segmets_data as $segment_list) {

                    echo '<div style="margin:5px 10px 5px 0px !important;"><input type="checkbox" class="pushassist-segments" name="pushassist_segment_categories[]" value="' . $segment_list["id"] . '"><span style="margin-left:10px;">' . $segment_list["name"] . '</span></div>';
                }
                echo '</div>';

                echo '<script>
				function pushassist_check_all()
				{
					var pushassist_all_checkbox = document.getElementById("pushassist_checkbox").checked;

					var pushassist_segments = document.getElementsByClassName("pushassist-segments");

					for (var key in pushassist_segments)
					{
					  if (pushassist_segments.hasOwnProperty(key))
					  {
						if(!pushassist_all_checkbox)
						{
							pushassist_segments[key].checked = false;
						}
						else
						{
							pushassist_segments[key].checked = true;
						}
					  }
					}
				}
				</script>';
            }
        }
    }

    public static function pushassist_note_text($post_type, $post)
    {
		$pushassist_settings = self::pushassist_settings();
		
		$psaAllowCustomPostTypes = array();
		
		if(isset($pushassist_settings['psaAllowCustomPostTypes'])){
			$psaAllowCustomPostTypes = explode(',', $pushassist_settings['psaAllowCustomPostTypes']);
		}
		
        if (in_array( $post_type, $psaAllowCustomPostTypes)) {

			add_meta_box(
				'pushassist_meta',
				__('PushAssist Notification Message', 'push-notification-for-wp-by-pushassist'),
				array(__CLASS__, 'pushassist_custom_headline_content'),
				'',
				'normal',
				'high'
			);
        }
    }
		
	public static function pushassist_add_columns( $columns ) {
		$columns['pushassist_donot_send_notification'] = __( 'Don\'t Send Notification', 'push-notification-for-wp-by-pushassist' );
		return $columns;
	}
	
	public static function pushassist_quick_edit_add( $column_name, $post_type ) {
		
		if($column_name != "pushassist_donot_send_notification") return;
				
		printf( '<input type="checkbox" value="1" checked name="pushassist-donot-send-checkbox" class="" style="margin:6px 4px 10px 7px"> %s',
                    __( 'Don\'t Send Notification', 'push-notification-for-wp-by-pushassist' )
            );
	}
	
    public static function pushassist_custom_headline_content($post)
    {
        $pushassist_note_text = get_post_meta($post->ID, '_pushassist_custom_text', true);

        ?>
        <div id="pushassist_custom_note" class="form-field form-required">

            <input type="text" id="pushassist_post_notification_message" maxlength="138"
                   placeholder="<?php _e('Notification Message', 'push-notification-for-wp-by-pushassist'); ?>"
                   name="pushassist_post_notification_message"
                   value="<?php echo !empty($pushassist_note_text) ? esc_attr($pushassist_note_text) : ''; ?>"/><br>
            <span
                id="pushassist-post-description"><?php _e('Limit 138 Characters', 'push-notification-for-wp-by-pushassist'); ?>
                <br/> <?php _e('When using a custom headline, this text will be used in place of the default blog post message for your push notification.', 'push-notification-for-wp-by-pushassist'); ?></span>
        </div>
        <?php
    }

    public static function save_pushassist_post_meta_data($post_id)
    {				
		$pushassist_settings = self::pushassist_settings();
		$psa_auto_push = $pushassist_settings['psaAutoPush'];

		$checkbox_setting = sanitize_text_field($_POST['pushassist-checkbox']);		
		update_post_meta($post_id, '_pushassist_checkbox_override', $checkbox_setting);

		$donot_send_checkbox_setting = sanitize_text_field($_POST['pushassist-donot-send-checkbox']);
		update_post_meta($post_id, '_pushassist_donot_send_checkbox_override', $donot_send_checkbox_setting);

		if (isset($_POST['pushassist_post_notification_message']) || true === $psa_auto_push) {
		
			if ((isset($_POST['pushassist_post_notification_message']))){					
				update_post_meta($post_id, '_pushassist_custom_text', sanitize_text_field($_POST['pushassist_post_notification_message']));
			}
		}
    }
    
	/*  post publish notification  */			
	
    public static function send_pushassist_post_notification($new_status, $old_status, $post)
    {		
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {return;}
		
		$pushassist_post_id = $post->ID;
		$pushassist_settings = self::pushassist_settings();
		
		// IF empty post or PA setting is empty return
		if ( empty( $post ) || empty($pushassist_settings)) {return;}
		// IF PA API keys are empty return		
		$appKey = $pushassist_settings['appKey'];
		$appSecret = $pushassist_settings['appSecret'];
		if (!isset($appKey) || !isset($appSecret)) {return;}
		// IF post is future/schedule return
		if ( ! current_user_can( 'publish_posts' ) && ! DOING_CRON  ) {return;}
		
		$pushassist_donot_send_checkbox = false;
		if(isset($_POST['pushassist-donot-send-checkbox'])){$pushassist_donot_send_checkbox = true;}
		// user forcefully don't want to send notification
		if (empty($post) || ($pushassist_donot_send_checkbox === true)) {return;}
		
		// IF post is not listed in allowed post type in PA settings return
		$psaAllowCustomPostTypes = array();
		if(isset($pushassist_settings['psaAllowCustomPostTypes'])){
			$psaAllowCustomPostTypes = explode(',', $pushassist_settings['psaAllowCustomPostTypes']);
		}
		
		if(!in_array($post->post_type, $psaAllowCustomPostTypes)){return;}
		
		// specific plugins found return
		$skipp_notification = array("broken-links", "link-checker");
		
		if(isset($_GET["page"])){
			$page = $_GET["page"];
			foreach ($skipp_notification as $value) {
				if (strpos($page, $value) !== FALSE) {return;}
			}
		}
		
		$psa_auto_push = $pushassist_settings['psaAutoPush'];
		$psa_edit_post_push = $pushassist_settings['psaEditPostPush'];		
		
		$psaIsAutoPushUTM = $pushassist_settings['psaIsAutoPushUTM'];
		$psaPostLogoImage = $pushassist_settings['psaPostLogoImage'];
		$psaPostBigImage = $pushassist_settings['psaPostBigImage'];

		$pushassit_note = '';
		$utm_source = '';
		$utm_medium = '';
		$utm_campaign = '';
		
		$pushassist_checkbox = false;
		$pushassist_post_notification_message = "";
		$pushassist_segment_categories = array();
				
		if(isset($_POST['pushassist-checkbox'])){$pushassist_checkbox = true;}
		
		if(isset($_POST['pushassist_post_notification_message'])){
			$pushassist_post_notification_message = sanitize_text_field($_POST['pushassist_post_notification_message']);
		}
		
		if(isset($_POST['pushassist_segment_categories'])){
			$pushassist_segment_categories = $_POST['pushassist_segment_categories'];
		}
		
		if(isset($_POST['pushassist_new_post'])) {	// New Post
			if($pushassist_checkbox === false){return;}
		}elseif(isset($_POST['pushassist_update_post'])) {	// Edit Post
			if($pushassist_checkbox === false && $new_status === $old_status){return;}
		}else if(isset($_POST['pushassist_draft_future_post'])) {	// Draft / Future Post
			if($pushassist_checkbox === false){return;}
		}
				
		if ('publish' === $new_status && 'publish' === $old_status){
			if ($pushassist_checkbox === true || (true === $psa_auto_push) || (true === $psa_edit_post_push && isset($_GET['action']) && $_GET['action'] == 'edit')){
				$pushassit_note = true;
			}
		}
		
		if ($new_status !== $old_status || !empty($pushassit_note)) {
			
			if ('publish' === $new_status) {
								
				$segments = array();
				$image_url = null;
				$big_image_url = null;

				if (('publish' === $new_status && 'future' === $old_status)) {

					$pushassist_checkbox_array = get_post_meta($pushassist_post_id, '_pushassist_checkbox_override', true);
					$pushassist_post_notification_text = get_post_meta($pushassist_post_id, '_pushassist_custom_text', true);

				} else {

					if ($pushassist_checkbox != "") {
						$pushassist_checkbox_array = sanitize_text_field($pushassist_checkbox);
					}

					if ($pushassist_post_notification_message != "" && !empty($pushassist_post_notification_message)) {
						$pushassist_post_notification_text = sanitize_text_field($pushassist_post_notification_message);
					}
				}

				if (!empty($pushassist_checkbox_array) || (true === $psa_auto_push) || (true === $psa_edit_post_push && isset($_GET['action']) && $_GET['action'] == 'edit')) {

					if ($pushassist_segment_categories != "" and !empty($pushassist_segment_categories)) {
						$segments = $pushassist_segment_categories;
					}

					if (!empty($pushassist_post_notification_text)) {
						$notification_title_text = sanitize_text_field(substr(get_the_title($pushassist_post_id), 0, 100));
						$notification_message_text = sanitize_text_field(substr(stripslashes($pushassist_post_notification_text), 0, 138));
					} else {

						$notification_title_text = sanitize_text_field(substr(get_the_title($pushassist_post_id), 0, 100));

						if (isset($pushassist_settings['psaPostMessage'])) {
							$notification_message_text = sanitize_text_field(substr(stripslashes($pushassist_settings['psaPostMessage']), 0, 138));
						} else {
							$notification_message_text = sanitize_text_field(substr(stripslashes(__('We have just published an article, check it out!', 'push-notification-for-wp-by-pushassist')), 0, 138));
						}
					}

					if (((isset($pushassist_settings['psaPostBigImage']) && $psaPostBigImage == true) && (isset($pushassist_settings['psaPostLogoImage']) && $psaPostLogoImage == true)) || $psaPostLogoImage == false) {

						if (has_post_thumbnail($pushassist_post_id)) {

							$thumbnail_image = wp_get_attachment_image_src(get_post_thumbnail_id($pushassist_post_id));
							$image_url = $thumbnail_image[0];
						}
					}

					if (isset($pushassist_settings['psaPostBigImage']) && $psaPostBigImage == true && (isset($pushassist_settings['psaPostLogoImage']) && $psaPostLogoImage == false)) {
						
						$big_image_url = $image_url;
						$image_url = null;
					}
					
					if ((isset($pushassist_settings['psaPostBigImage']) && $psaPostBigImage == true) && (isset($pushassist_settings['psaPostLogoImage']) && $psaPostLogoImage == true)) {
						
						$big_image_url = $image_url;
						$image_url = null;
					}
					
					if (isset($pushassist_settings['psaUTMSource']) && $psaIsAutoPushUTM == true) {
						$utm_source = sanitize_text_field($pushassist_settings['psaUTMSource']);
					}

					if (isset($pushassist_settings['psaUTMMedium']) && $psaIsAutoPushUTM == true) {
						$utm_medium = sanitize_text_field($pushassist_settings['psaUTMMedium']);
					}

					if (isset($pushassist_settings['psaUTMCampaign']) && $psaIsAutoPushUTM == true) {
						$utm_campaign = sanitize_text_field($pushassist_settings['psaUTMCampaign']);
					}

					$pushassist_link = get_permalink($pushassist_post_id);
					
					$notification = array("notification" => array("title" => $notification_title_text,
						"message" => $notification_message_text,
						"redirect_url" => $pushassist_link,
						"image" => $image_url,
						"big_image" => $big_image_url,
						"action_1" => "",
						"action_url_1" => "",
						"action_2" => "",
						"action_url_2" => "",
						"ttl" => 259200,
						"priority" => "normal",
						"alert" => 0),
						"utm_params" => array("utm_source" => $utm_source,
							"utm_medium" => $utm_medium,
							"utm_campaign" => $utm_campaign),
						"segments" => $segments,
						"browsers" => "",
						"countries" => "",
						"devices" => "",
						"os_users" => ""
					);
					
					$notification_request_data = array("appKey" => trim($appKey),
						"appSecret" => trim($appSecret),
						"action" => "notifications/",
						"method" => "POST",
						"remoteContent" => $notification
					);
					
					$notification_response = self::puhsassist_decode_request($notification_request_data);
					exit;
				}
			}
		}
	}
	
	/*  end post publish notification  */

    public static function pushassist_removeSpecialCharacters($string)
    {
        return preg_replace('/[^A-Za-z0-9\- ]/', '', $string);
    }

    /*     API Functions start     */
    public static function puhsassist_remote_request($remote_data)
    {					
        $remote_url = 'https://api2.pushassist.com/v2/' . $remote_data['action'];

        if ($remote_data['action'] == "accounts/") {
            $headers = array("Content-Type" => 'application/json');
        } else {

            $headers = array(
                'X-Auth-Token' => $remote_data['appKey'],
                'X-Auth-Secret' => $remote_data['appSecret'],
                "Content-Type" => 'application/json'
            );
        }

        if ($remote_data['method'] != 'GET') {

            $remote_array = array(
                'method' => $remote_data['method'],
                'headers' => $headers,
                'body' => json_encode($remote_data['remoteContent']),
            );

        } else {

            $remote_array = array(
                'method' => $remote_data['method'],
                'headers' => $headers
            );
        }
		
        $response = wp_remote_request(esc_url_raw($remote_url), $remote_array);
		
        return $response;
    }

    public static function puhsassist_decode_request($remote_data)
    {
        $remote_request_response = self::puhsassist_remote_request($remote_data);

        $retrieve_body_content = wp_remote_retrieve_body($remote_request_response);

        $response_array = json_decode($retrieve_body_content, true);

        return $response_array;
    }

    public static function url_validator($url)
    {
        $regex = "((https?|ftp)\:\/\/)?"; // SCHEME
        $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
        $regex .= "([a-z0-9-.]*)\.([a-z]{2,4})"; // Host or IP
        $regex .= "(\:[0-9]{2,5})?"; // Port
        $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path
        $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
        $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor

        if (preg_match("/^$regex$/", $url)) { return 1; } else { return 0; }
    }    
}