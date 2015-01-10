<?php
/*
Plugin Name: WP Translate
Plugin URI: http://labs.hahncreativegroup.com/wp-translate-pro/
Description: Add Google Translate to your WordPress site
Author: HahnCreativeGroup
Version: 4.7
Author URI: http://labs.hahncreativegroup.com/google-translate-wordpress-plugin/
*/

register_activation_hook( __FILE__,  'wpTranslate_install' );

function wpTranslate_install() {
	if(!get_option("wpTranslateOptions")) {
	$wpTranslateOptions = array(
								"default_language" => "auto",
								"tracking_enabled" => false,
								"tracking_id" => "", 
								"auto_display" => true,
								"exclude_mobile" => true
								);
	
	add_option("wpTranslateOptions", $wpTranslateOptions);
	}
	else {
		$wpTranlsateOptions	= get_option("wpTranslateOptions");
		$keys = array_keys($wpTranlsateOptions);		
		
		if (!in_array('default_language', $keys)) {
			$wpTranlsateOptions['default_language'] = "auto";	
		}
		if (!in_array('auto_display', $keys)) {
			$wpTranlsateOptions['auto_display'] = true;	
		}
		if (!in_array('exclude_mobile', $keys)) {
			$wpTranlsateOptions['exclude_mobile'] = true;	
		}
		
		update_option("wpTranslateOptions", $wpTranlsateOptions);
	}
}

function translate_Init() {
	$wpTranslateOptions = get_option("wpTranslateOptions");
	$doTranslate = true;
	if ($wpTranslateOptions["exclude_mobile"]) {		
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/iPhone|Android|Blackberry|Windows Phone/i', $agent)){
			$doTranslate = false;
		}
	}
	$agent = $_SERVER['HTTP_USER_AGENT'];  
if($doTranslate){
	?>
	<!-- WP Translate - Google Translate: http://labs.hahncreativegroup.com/google-translate-wordpress-plugin/ -->
    <script type='text/javascript'>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: '<?php echo $wpTranslateOptions["default_language"]; ?>',
    <?php if ($wpTranslateOptions["tracking_enabled"]) { ?>
	gaTrack: true,
    gaId: '<?php echo $wpTranslateOptions["tracking_id"]; ?>',
	<?php } ?>
    floatPosition: google.translate.TranslateElement.FloatPosition.TOP_RIGHT,
	autoDisplay: <?php echo ($wpTranslateOptions["auto_display"]) ? "true" : "false"; ?>
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <?php
}	
}
add_action('wp_footer', 'translate_Init');

function admin_positioning() {
	if (current_user_can('manage_options')) {
		_e('<style>.goog-te-ftab-float {right: 250px !important;}</style>');	
	}
}
add_action('wp_head', 'admin_positioning');

function create_translate_plugin_links($links, $file) {			
	if ( $file == plugin_basename(__FILE__) ) {			
		$links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=EJVXJP3V8GE2J">' . __('Donate', 'wp-translate') . '</a>';
	}
	return $links;
}
add_filter('plugin_row_meta', 'create_translate_plugin_links', 10, 2);

function add_wp_translate_menu() {
	add_menu_page(__('WP Translate','wp-translate'), __('WP Translate','wp-translate'), 'manage_options', 'wptranslate-admin', 'show_translate_menu' );
}
add_action( 'admin_menu', 'add_wp_translate_menu' );

function show_translate_menu()
{
	include("admin/overview.php");
}

?>