=== Push Notifications for WordPress by PushAssist ===
Contributors: pushassist
Donate link: https://pushassist.com/
Tags: chrome push notifications, push notification, marketing, push notifications, safari push notification, safari push notifications, web push notification, firefox push notifications, subscribe via push, web push notifications, mobile push, mobile notification, mobile notifications, WordPress notifications, WooCommerce notifications, android notification, android notifications, android push, desktop notification, desktop notifications, push messages, push alert, messages, automatic push notifications, offline notifications, WP push notifications, chrome notifications, chrome notification, firefox notifications, firefox notification, push notification for chrome,  push notification for firefox,  push notification for safari, notifications, notification, push, WordPress push notifications, WordPress push notification, WordPress notification, chrome, forefox, safari, firefox push, chrome push, notify, web push, safari push, gcm notification, gcm notifications, browser notification, browser notifications.
Requires at least: 4.1.5
Tested up to: 6.4.2
Stable tag: 6.4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows you to send push notification when a post is published, updated. Web Push Notifications for Android, Desktop on Chrome, Safari, Firefox.

== Description ==

PushAssist is a comprehensive [push notification for WordPress](https://pushassist.com) blogs and websites, trusted by thousands of developers, WordPress & WooCommerce site owners and marketers across the globe. It allows your website to re-engage your most loyal customers with targeted push notifications.

This plugin will automatically install the required library into your website post account verification. You can either create your free account or provide your API Keys & Secret Keys to start using PushAssist. All the major functionalities, dashboard, metrics  are displayed within your WordPress Admin Panel. 

Post setup, your visitors can opt-in to receive push notifications when you publish a new post, and visitors receive these notifications even when they are not browsing your site. These notifications are delivered on all devices i.e. desktops, tablets and even mobile phones.

When customers visit your site, they can opt-in to receive push notifications from your website. To engage you can alert your visitors when new content is published, send them offers, tips or anything else and eventually convert them to regular and loyal readers. It's like a newsletter, but more efficient and effective in keeping your audience engaged. Push Notifications for WordPress by PushAssist allows you to focus on building beautiful website without developing the core push notification API driven code within your WordPress website.

Push notifications are an incredibly user-friendly communication channel, has a higher opt-in rate and click-through rate in the range of 12-18%, which is dramatically better than other channels, such as email or Twitter.

= Features =

* **Instant notifications**: Notifications appear as message alerts and even sound alerts depending upon OS.
* **Powerful APIs**: Provides easy to use REST APIs, available via secure HTTPS to send and receive data.
* **Segments**: Smart segmentation divides your users in groups with segmentation.
* **HTTP/HTTPS**: It works for both HTTP or HTTPS WordPress websites.
* **GCM**: It also allows you to use your own GCM keys for push notification.
* **Campaigns**: Premium  accounts can send or schedule marketing notification campaigns from PushAssist control account Panel.
* **Automatic**: Automatically send notifications on new posts and updated posts.
* **Site Logo**: Quick Setting to send post image or site logo when sending push notifications automatically..

= Who Is This Plugin For? =

This plugin is primarily intended for WordPress site owners, marketers  who do not want to develop their own server-side back-end since it's a complicated and time consuming thing. This plugin handles all and lets you focus on your marketing efforts to re-engage your customers & visitors without any hassle.


== Installation ==

1.	Install PushAssist from the WordPress.org plugin directory or by uploading the PushAssist plugin folder to your "wp-content/plugins" directory. 
1.	Install the plugin through the "Plugins" menu in WordPress.
1.	Activate the plugin through the "Plugins" menu in WordPress.
1. **Purge your site Cache** to see it in action. Just once!
1. Configure the look and feel of your opt-in box from your account panel.
1. Account details will be emailed post signup. Didn't Get Our Email? Check Your Spam Folder.


== Frequently Asked Questions ==

= Do I need to sign up to PushAssist to use this plugin? =

Yes, you can create a FREE account from the plugin itself. If you are already using PushAssist just copy your **API Key** & **Secret Key** from PushAssist control panel and paste in WordPress dashboard once.

= I can't see any code added to my header or footer when I view my page source =

Your theme needs to have the header and footer actions in place before the `</head>` and before the `</body>`

= I can't see opt-in box on my site =

If you are using cache plugins like W3 Total Cache, Super Cache etc. Just purge the cache one. Also purge CloudFlare or CDN once to see it.

= Can PushAssist be implemented on HTTP Websites? = 

Yes, PushAssist can be implemented on a HTTP or HTTPS websites. In case you want to use your own GCM keys we welcome you to add those in your PushAssist control panel. To add your own GCM API keys please follow the instructions by Google on how to create a GCM key [here](https://developers.google.com/web/fundamentals/getting-started/push-notifications/step-04?hl=en) . Please note that in step 3 you should select **Server Key**.

Since Push Notifications requires the website be on SSL aka HTTPS we create a sub domain for you which is a valid HTTPS sub domain like **https://accountname.pushassist.com**. We can also help you setup PushAssist if you have your own Https domain and want to send notifications from your domain name.

= What will happen when i reach 3000 subscribers in my FREE account?  =

Once you reach 3000 subscribers, PushAssist will continue to work and let you collect subscribers but will not let you send notifications to these new subscribers. You can send unlimited notifications to your first 3000 subscriber but to send notifications to all subscribers you need to upgrade to premium (Paid) account. Check our [pricing plans](https://pushassist.com/pricing-plans/).

= What will push notifications look like? =

That depends on the browser! Each browser will display your notifications somewhat differently, but in general the notifications will look appropriate for the device/OS/browser on which they are displayed

= Are there any design templates to choose for opt-in box? =

Yes, there are many templates for opt-in box. Configuration is possible within your PushAssist control panel.

= Targeting Subscribers with Segments  =

You can quickly categorize subscribers into different segments. This helps you efficiently target a particular set of subscribers registered under particular segments (group). A typical use case could be one segment each for your categories i.e. Sports, Fitness, Homepage, Pricing etc. 

1. **Step 1:** Create segments from Segments tab. 

1. **Step 2:** Add the following JS code on your category pages or on any pages of your site

**Subscribing for Single Segment**

`<script>
    var _pa = [];
    _pa.push('Sports');
</script>`

**Subscribing for Multiple Segments</h3>

`<script>
    var _pa = [];
    _pa.push('Sports', 'Fitness');
</script>`

Soon, you have some subscribers under segments, you would be able to send personalized messages to specific segments. Users interested in **Sports** are more likely to click on your notifications about **Sports** than **Politics**.


== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png
3. screenshot-3.png
4. screenshot-4.png
5. screenshot-5.png
6. screenshot-6.png


== Changelog ==

= 3.0.8 =
* Support for wordpress 5.9.3

= 2.2.5 =
* Fixed image upload size issue from pushassist setting option.

= 2.1.10 =
* Dashboard widget added.
* Recurring notifications functionality introduced.

= 2.1.8 =
* Added more options under settings.
* Fixed scheduled post auto push notifications issue.

= 2.1.7 =
* Fixed http_query_build warning for WordPress 4.6

= 2.1.1 =
* Fixed future post issue
* Fixed CDN

= 2.0.2 =
Upgrade to get bootstrap css issue fixed.

= 2.0.1 =
* Fixed minor bugs related to file upload.
* Fixed minor bugs related to jQuery conflicts.

== Upgrade Notice ==

= 2.0.1 =
Upgrade to get upload image issue fixed.
