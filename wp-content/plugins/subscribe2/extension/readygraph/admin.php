<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   ReadyGraph
 * @author    dan@readygraph.com
 * @license   GPL-2.0+
 * @link      http://www.readygraph.com
 * @copyright 2014 Your Name or Company Name
 */
 
function s2_disconnectReadyGraph(){
$app_id = get_option('readygraph_application_id');
wp_remote_get( "http://readygraph.com/api/v1/tracking?event=disconnect_readygraph&app_id=$app_id" );
s2_delete_rg_options();
echo '<div class="updated"><p>We are sorry to see you go. ReadyGraph is now disconnected.</p></div>';
}
function s2_deleteReadyGraph(){
$app_id = get_option('readygraph_application_id');
wp_remote_get( "http://readygraph.com/api/v1/tracking?event=uninstall_readygraph&app_id=$app_id" );
s2_delete_rg_options();
$dir = plugin_dir_path( __FILE__ );
s2_rrmdir($dir);
}

	if(isset($_GET["action"]) && base64_decode($_GET["action"]) == "changeaccount")s2_disconnectReadyGraph();
	if(isset($_GET["action"]) && base64_decode($_GET["action"]) == "deleteaccount")s2_deleteReadyGraph();
	if(isset($_GET["tutorial"]) && $_GET["tutorial"] == "true"){update_option('readygraph_tutorial',"true");}
	else{update_option('readygraph_tutorial',"false");}
	if(isset($_GET["readygraph_upgrade_notice"]) && $_GET["readygraph_upgrade_notice"] == "dismiss") {update_option('readygraph_upgrade_notice', 'false');}
	if(isset($_GET["popup_position"]) && $_GET["popup_position"] == "bottom-right"){update_option('readygraph_enable_notification', 'true');update_option('readygraph_enable_popup', 'false');}
	if(isset($_GET["popup_position"]) && $_GET["popup_position"] == "center"){update_option('readygraph_enable_notification', 'true');update_option('readygraph_enable_popup', 'true');}
	if(isset($_GET["popup_position"]) && $_GET["popup_position"] == "disabled"){update_option('readygraph_enable_notification', 'false');update_option('readygraph_enable_popup', 'false');}
	if(isset($_GET["popup_delay"])){update_option('readygraph_delay', intval($_GET["popup_delay"]));}
	global $main_plugin_title;
	if (!get_option('readygraph_access_token') || strlen(get_option('readygraph_access_token')) <= 0) {
	if (isset($_POST["readygraph_access_token"])) update_option('readygraph_access_token', $_POST["readygraph_access_token"]);
	if (isset($_POST["readygraph_refresh_token"])) update_option('readygraph_refresh_token', $_POST["readygraph_refresh_token"]);
	if (isset($_POST["readygraph_email"])) update_option('readygraph_email', $_POST["readygraph_email"]);
	if (isset($_POST["readygraph_application_id"])){ update_option('readygraph_application_id', $_POST["readygraph_application_id"]);/*s2_wordpress_sync_users($_POST["readygraph_application_id"]);*/}
	if (isset($_POST["readygraph_settings"])) update_option('readygraph_settings', $_POST["readygraph_settings"]);
	if (isset($_POST["readygraph_delay"])) update_option('readygraph_delay', 10000);
	if (isset($_POST["readygraph_enable_notification"])) update_option('readygraph_enable_notification', 'true');	
	if (isset($_POST["readygraph_enable_popup"])) update_option('readygraph_enable_popup', 'true');
	if (isset($_POST["readygraph_enable_sidebar"])) update_option('readygraph_enable_sidebar', 'false');
	if (isset($_POST["readygraph_auto_select_all"])) update_option('readygraph_auto_select_all', 'true');
	if (isset($_POST["readygraph_enable_branding"])) update_option('readygraph_enable_branding', 'false');
	if (isset($_POST["readygraph_send_blog_updates"])) update_option('readygraph_send_blog_updates', 'true');
	if (isset($_POST["readygraph_send_real_time_post_updates"])) update_option('readygraph_send_real_time_post_updates', 'false');
	if (isset($_POST["readygraph_popup_template"])) update_option('readygraph_popup_template', 'default-template');
	update_option('readygraph_upgrade_notice', 'true');
	update_option('readygraph_tutorial',"true");
	}
	else {
	}
?>	

<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'assets/css/admin.css', __FILE__ ) ?>">
<script type="text/javascript" src="<?php echo plugins_url( 'assets/js/admin.js', __FILE__ ) ?>"></script>
<form method="post" id="myForm">
<input type="hidden" name="readygraph_access_token" value="<?php echo get_option('readygraph_access_token', '') ?>">
<input type="hidden" name="readygraph_refresh_token" value="<?php echo get_option('readygraph_refresh_token', '') ?>">
<input type="hidden" name="readygraph_email" value="<?php echo get_option('readygraph_email', '') ?>">
<input type="hidden" name="readygraph_application_id" value="<?php echo get_option('readygraph_application_id', '') ?>">
<input type="hidden" name="readygraph_delay" value="<?php echo get_option('readygraph_delay', '5000') ?>">
<input type="hidden" name="readygraph_enable_notification" value="<?php echo get_option('readygraph_enable_notification', 'true') ?>">
<input type="hidden" name="readygraph_enable_popup" value="<?php echo get_option('readygraph_enable_popup', 'true') ?>">

<div class="authenticate" style="display: none;">
	    <div class="wrap1" style="min-height: 600px;">

      <div id="icon-plugins" class="icon32"></div>
      <h2>We've enhanced <?php echo $main_plugin_title ?> with ReadyGraph's User Growth Engine</h2>
      
      <p style="display:none;color:red;" id="error"></p>
      <div class="register-left">
	<div class="alert" style="margin: 0px auto; padding: 15px; text-align: center;">
			<h3>Activate ReadyGraph to get more traffic to your site</h3>
<!--		<h3 style="margin-top: 0px; font-weight: 300;"><?php //echo $main_plugin_title ?>, Now with ReadyGraph</h3> -->
		<p style="padding: 50px 0px 30px 0px;"><a class="btn btn-primary connect" href="javascript:void(0);" style="font-size: 15px; line-height: 40px; padding: 0 30px;">Connect ReadyGraph</a></p>
		<!--<p style="padding: 0px 0px;"><a class="btn btn-default skip" href="javascript:void(0);" style="font-size: 10px; line-height: 20px; padding: 0 30px;">Skip ReadyGraph</a></p>-->
		<p>Readygraph adds more ways to connect to your users. </p>
		<p style="text-align: left; padding: 0 20px;">
			- Get more traffic<br>
			- Send automatic email digests of all your site posts<br>
			- Get better deliverablility<br>
			- Track performace and user activity
			- Automatically synchs with your current subscriber list
		</p>
	</div>
          
      </div>

        <div class="register-right">
          <div class="form-wrap alert" style="font-size:12px;">
          <p><h3>ReadyGraph grows your site</h3></p>
<p>ReadyGraph delivers audience growth and motivates users to come back.</p><br /><p><span class="rg-signup-icon"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/icon_fb.png"></span><b>Optimized Signup Form –</b> ReadyGraph’s signup form has one click signup and integration with Facebook so you can get quick and easy signups from your users.<br /><br /><span class="rg-signup-icon"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/icon_heart.png"></span>
<b>Viral Friend Invites –</b>Loyal site visitors who love your site can easily invite all their friends. Readygraph encourages your visitors' friends to come and signup for your site too.<br /><br /><b><span class="rg-signup-icon"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/icon_mail.png"></span>Automated Re-engagement Emails –</b> ReadyGraph’s automated emails keep visitors coming back. Send a daily or weekly digest of all your new posts and keep them informed about site activity, events, etc.<br /><br /><b><span class="rg-signup-icon"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/icon_chart.png"></span>Analytics -</b> Track new subscribers, invites, traffic, and other key metrics that quantify growth and user engagement.  ReadyGraph safely stores user data on the cloud so you can access from anywhere.<br /><br />
If you have questions or concerns contact us anytime at <a href="mailto:info@readygraph.com" target="_blank">info@readygraph.com</a> Feel free to check out our <a href="http://readygraph.com/faq/" target="_blank">FAQ</a> for a more comprehensive overview.  You can also completely <a class="delete" href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&action=<?php echo base64_encode("deleteaccount");?>">Delete ReadyGraph</a> if you don't want access to our amazing growth tools.  Either way, good luck building a massive userbase!</p>
          </div>
      </div>
	  </div>
</div>
<div class="authenticating" style="display: none;">
	<div style="color: #ffffff; width: 350px; margin: 100px auto 0px; padding: 15px; border: solid 1px #2a388f; text-align: center; background-color: #2961cb; -webkit-border-radius: 7px; -moz-border-radius: 7px; border-radius: 7px;">
		<h3 style="margin-top: 0px; font-weight: 300;"><?php echo $main_plugin_title ?>, Now with ReadyGraph</h3>
		<h4 style="padding: 50px 0; line-height: 42px;">Retrieving Your Account..</h4>
		<p>Activate Readygraph features to optimize <?php echo $main_plugin_title ?> functionality. Signup For These Benefits:</p>
		<p style="text-align: left; padding: 0 20px;">
			- Grow your subscribers faster<br>
			- Engage users with automated email updates<br>
			- Enhanced email deliverablility<br>
			- Track performace with user-activity analytics
		</p>
	</div>
</div>
<style>a.help-tooltip {outline:none; }a.help-tooltip strong {line-height:30px;}a.help-tooltip:hover {text-decoration:none;} a.help-tooltip span {    z-index:10;display:none; padding:14px 20px;    margin-top:40px; margin-left:-150px;    width:300px; line-height:16px;}a.help-tooltip:hover span{    display:inline; position:absolute;     border:2px solid #FFF;    background:#fff;	text-align: justify;	z-index:1000000000;}.callout {z-index:1000000000;position:absolute;border:0;top:-14px;left:120px;}    /*CSS3 extras*/a.help-tooltip span{    border-radius:2px;    -moz-border-radius: 2px;    -webkit-border-radius: 2px;            -moz-box-shadow: 0px 0px 8px 4px #666;    -webkit-box-shadow: 0px 0px 8px 4px #666;    box-shadow: 0px 0px 8px 4px #666;}</style>
<div class="authenticated" style="display: none;">
	<div style="background-color: #2691CB; min-width: 90%; height: 50px;margin-right: 1%;">
		<img src="<?php echo plugin_dir_url( __FILE__ );?>assets/white-logo.png" style="width: 138px; height: 30px; margin: 10px 0 0 15px; float: left;">
		<div class="btn-group pull-right" style="margin: 8px 10px 0 0;">
			<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="background: transparent; border-color: #ffffff; color: #ffffff; ">
				<span class="email-address" style="text-shadow: none;"></span> <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a class="change-account" href="#">Change Account</a></li>
				<li><a class="disconnect" href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&action=<?php echo base64_encode("changeaccount");?>">Disconnect</a></li>
				<li><a class="delete" href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&action=<?php echo base64_encode("deleteaccount");?>">Delete ReadyGraph</a></li>
			</ul>
		</div>
		<div class="btn-group pull-right" style="margin: 8px 10px 0 0;">
			<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="background: transparent; border-color: #ffffff; color: #ffffff; ">
				<span class="result" style="text-shadow: none;">...</span> <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a href="http://readygraph.com/application/insights/" target="_blank">Insights</a></li>
			</ul>
		</div>
		<div style="clear: both;"></div>
	</div>
		<!-- write menu code-->

	<div class="readygraph-nav-menu">
	<ul><li>Grow Users
	  <ul>
		<li><a href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&ac=signup-popup">Signup Popup</a></li>
		<li><a href="https://readygraph.com/application/insights/" target="_blank">User Statistics</a></li>
		<li><a href="#"></a></li>
	  </ul>
	</li>
  <li>Email Users
	<ul>
		<li><a href="https://readygraph.com/application/customize/settings/email/welcome/" target="_blank">Retention Email</a></li>
		<li><a href="https://readygraph.com/application/customize/settings/email/invitation/" target="_blank">Invitation Email</a></li>
		<li><a href="http://readygraph.com/application/insights/" target="_blank">Custom Email</a></li>
    </ul>
  </li>
  <li>
    Engage Users
    <ul>
		<li><a href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&ac=social-feed">Social Feed</a></li>
		<li><a href="#">Social Followers</a></li>
		<li><a href="#">Feedback Survey</a></li>
    </ul>
  </li>
  <li>Basic Settings
    <ul>
		<li><a href="#">Site Profile</a></li>
		<li><a href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&ac=feature-settings">Feature Settings</a></li>
	</ul>
  </li>
</ul>
	<div class="btn-group" style="margin: 8px 10px 0 10px;">
		<p><a href="mailto:info@readygraph.com" style="color: #b1c1ca" >Help <img src="<?php echo plugin_dir_url( __FILE__ );?>assets/9.png"/></a></p>
	</div>
	<div class="btn-group" style="margin: 8px 10px 0 10px;">
		<p>
		<a href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&ac=faq" style="color: #b1c1ca" >FAQ  <img src="<?php echo plugin_dir_url( __FILE__ );?>assets/10.png" /></a></p>
	</div>
	<div class="btn-group" style="">
		<p><a href="https://readygraph.com/accounts/payment/?email=<?php echo get_option('readygraph_email', '') ?>" target="_blank" style="color: #b1c1ca" ><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/go-premium.png" height="40px" style="margin:5px" /></a></p>
	</div>
	</div>
	<?php if(get_option('readygraph_tutorial') && get_option('readygraph_tutorial') == "true"){ ?>
	<div class="tutorial-true" style="margin: 5% auto;">
		<h3 style="font-weight: normal; text-align: center;"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/check.png"/>Congratulations! <?php echo $main_plugin_title; ?>'s ReadyGraph growth engine is now active.</h3>
		<h3 style="font-weight: normal; text-align: center;">Consider going premium to grow even faster!</h3>
			<div style="width: 60%; margin: 0 auto;"><h4 class="rg-h4"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/round-check.png" class="rg-small-icon"/>Your site promoted to 10,000 New Users Every Month in our Community Email Update</h4>
			<h4 class="rg-h4"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/round-check.png" class="rg-small-icon"/>Unlimited Viral Email/Facebook Invites</h4>
			<h4 class="rg-h4"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/round-check.png" class="rg-small-icon"/>Unlimited Blog Post Notifications and More!</h4>
			
			<div class="save-changes" style="font-weight: normal; text-align: center;"><a class="btn btn-large btn-warning save-next" href="https://readygraph.com/accounts/payment/?email=<?php echo get_option('readygraph_email', '') ?>" target="_blank" style="margin: 15px">Learn more about Premium</a><br>
			<strong>Or take <a href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&ac=signup-popup&source=basic-settings">the tutorial</a> to customize your ReadyGraph settings</strong>
			</div></div>
	</div>
	<?php } else { ?>
	
	<div class="tutorial-false" style="margin: 2% auto; width: 90%">
		<h3 style="font-weight: normal; text-align: center;">Settings - Make adjustments to grow and engage your userbase</h3>
			<div style="float: left;width: 75%;">
			<div style="display: block;min-height: 250px;">
				<div style="width: 45%; margin: 0 auto; float: left;"><h4 class="rg-h4"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/11.png" class="rg-big-icon"/>Email</h4>
				<button type="button" class="btn btn-large btn-warning save-next" onclick="window.open('http://readygraph.com/application/customize/settings/advance/');return false;" style="margin: 15px" formtarget="_blank">Automated Email Settings</button>
				<button type="button" class="btn btn-large btn-warning save-next" onclick="window.open('http://readygraph.com/application/insights/');return false;" style="margin: 15px"formtarget="_blank">Mass Email Users</button>
				<br>
				<a href="https://readygraph.com/application/customize/settings/email/welcome/" target="_blank" style="margin: 15px;color:#093e7d;">Welcome</a>
				<a href="https://readygraph.com/application/customize/settings/email/invitation/" target="_blank" style="margin: 15px;color:#093e7d;">Invite</a>
				<a href="https://readygraph.com/application/customize/settings/email/follow/" target="_blank" style="margin: 15px;color:#093e7d;">Follow</a>
				<a href="https://readygraph.com/application/customize/settings/email/base/" target="_blank" style="margin: 15px;color:#093e7d;">Content Update Digest</a>
				</div>
				<div style="width: 45%; margin: 0 auto; float: right;"><h4 class="rg-h4"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/6.png" class="rg-big-icon"/>Analytics</h4>
				<button type="button" class="btn btn-large btn-warning save-next" onclick="window.open('https://readygraph.com/application/insights/');return false;" style="margin: 15px">User Statistics</button>

				</div>
			</div>
			<div style="display: block;min-height: 250px;">
				<div style="width: 45%; margin: 0 auto; float: left;"><h4 class="rg-h4"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/7.png" class="rg-big-icon"/>Signup Overlay</h4>
				<p>Signup Popup Activated?
									<select class="signup-popup" name="signup-popup" class="form-control" onchange="return popup_position(this)">
										<option value="yes-center">Yes, in Center</option>
										<option value="yes-bottom-right">Yes, in Bottom Right</option>
										<option value="no">No</option>
									</select></p>
				<p>Signup Popup Delay?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
									<select class="popup-delay" name="popup-delay" class="form-control" onchange="return popup_delay(this)">
										<option value="0">0 seconds</option>
										<option value="5000">5 seconds</option>
										<option value="10000">10 seconds</option>
										<option value="15000">15 seconds</option>
										<option value="20000">20 seconds</option>
										<option value="30000">30 seconds</option>
										<option value="60000">1 minute</option>
										<option value="120000">2 minutes</option>
										<option value="180000">3 minutes</option>
										<option value="240000">4 minutes</option>
										<option value="300000">5 minutes</option>
										<option value="600000">10 minutes</option>
										<option value="900000">15 minutes</option>
										<option value="1200000">20 minutes</option>
									</select>
				</div>
				<div style="width: 45%; margin: 0 auto; float: right;"><h4 class="rg-h4"><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/8.png" class="rg-big-icon"/>Help</h4>
				<a href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&ac=faq" style="margin: 15px;color:#093e7d;">FAQ</a>
				<br>
				<a href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&ac=basic-settings&tutorial=true" style="margin: 15px;color:#093e7d;">Tutorial</a>
				<br>
				<a href="mailto:info@readygraph.com" style="margin: 15px;color:#093e7d;">Contact Us</a>
				<br>
				<a href="<?php $current_url = explode("&", $_SERVER['REQUEST_URI']); echo $current_url[0];?>&ac=deactivate-readygraph" style="margin: 15px;color:#093e7d;">Deactivate ReadyGraph</a>

				</div>
			</div>
			</div>
			<div style="width: 23%; display: block; min-height: 200px; float: right;">
				<div class="readygraph_upgrade_right_sidebar">
					<div style="background: #0B3E7F; padding: 5px; color: #fff; "><h4>ReadyGraph Premium</h4></div>
					<p class="centered-image">All the tools you need to grow your audience.<br><br><a href="https://readygraph.com/accounts/payment/?email=<?php echo get_option('readygraph_email', '') ?>" target="_blank" style="color: #b1c1ca" ><img src="<?php echo plugin_dir_url( __FILE__ );?>assets/go-premium.png" height="40px" style="margin:5px" /></a></p>
				</div>
				<div class="readygraph_upgrade_right_sidebar" style="margin-top: 10px;">
					<p class="centered-image">
					<em><strong>Top 3 benefits you can get!</strong></em><br>
					<img src="<?php echo plugin_dir_url( __FILE__ );?>assets/7.png" width="50px" style="margin:5px" /><br>
					1. Promotion to 10,000+ new users/month<br>
					<img src="<?php echo plugin_dir_url( __FILE__ );?>assets/11.png" width="50px" style="margin:5px" /><br>
					2. Unlimited post update emails<br>
					<img src="<?php echo plugin_dir_url( __FILE__ );?>assets/icon_fb.png" width="50px" style="margin:5px" /><br>
					3. Unlimited Facebook invite referrals<br>
					
					</p>
				</div>
			</div>
	</div>
	<?php } ?>
</div>
</form>
<script type="text/javascript" src="https://readygraph.com/scripts/readygraph.js"></script>
<script type="text/javascript" charset="utf-8">
function popup_position(n){
	<?php 	$current_url = explode("&", $_SERVER['REQUEST_URI']); ?>
  if(n.selectedIndex === 0){
  // show a div (id)  // alert(n.value);
	
    window.location.replace("<?php echo $current_url[0].'&popup_position=center';?>");
   }else if(n.selectedIndex === 1){
     window.location.replace("<?php echo $current_url[0].'&popup_position=bottom-right';?>");
   }
    // this last one is not what you ask but for completeness 
    // hide the box div if the first option is selected again
    else if (n.selectedIndex == 2){ // alert(n[1].value);
    window.location.replace("<?php echo $current_url[0].'&popup_position=disabled';?>");
    }
  }
function popup_delay(n){
	<?php 	$current_url = explode("&", $_SERVER['REQUEST_URI']); ?>
    window.location.replace("<?php echo $current_url[0].'&popup_delay=';?>"+n.value);
  }

	var $ = jQuery;
	$(function () {
		var settings =
			{
				'host':     "www.readygraph.com"
			, 'clientId': "9838eb84c6da2fc44ab9"
			};

		var authHost     = "https://" + settings.host;
		var resourceHost = "https://" + settings.host;
		
		// OAuth 2.0 Popup
		//
		var popupWindow=null;
		function openPopup(url)
		{
			if(popupWindow && !popupWindow.closed) popupWindow.focus();
			else popupWindow = window.open(url,"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=515, height=330,top=" + (screen.height - 330)/2 + ",left=" + (screen.width - 515)/2);
		}
		function parent_disable() {
			if(popupWindow && !popupWindow.closed) popupWindow.focus();
		}
		
		$("a.connect").click(function() {
			var url = authHost + '/oauth/authenticate?client_id=' + settings.clientId + '&redirect_uri=' + encodeURIComponent(location.href.replace('#' + location.hash,"")) + '&response_type=token';
			openPopup(url);
			$(document.body).bind('focus', parent_disable);
			$(document.body).bind('click', parent_disable);
		});
		$(".change-account").click(function() {
			document.cookie="readygraph_tutorial=true"
			var url = authHost + '/oauth/authenticate?client_id=' + settings.clientId + '&redirect_uri=' + encodeURIComponent(location.href.replace('#' + location.hash,"")) + '&response_type=token';
			var logout = authHost + '/oauth/logout?redirect=' + encodeURIComponent(url);
			openPopup(logout);
			$(document.body).bind('focus', parent_disable);
			$(document.body).bind('click', parent_disable);
		});
		
		// User Interface
		//
		$('.template').click(function() {
			$('#preview').attr('src', $(this).find('img').attr('src'));
		});
		
		// Manage OAuth 2.0 Redirect
		//
		var extractCode = function(hash) {
			var match = hash.match(/code=(\w+)/);
			return !!match && match[1];
		};
		var extractToken = function(hash) {
			var match = hash.match(/access_token=(\w+)/);
			return !!match && match[1];
		};
		var extractError = function(hash) {
			var match = hash.match(/error=(\w+)/);
			return !!match && match[1];
		};
		
		var code = extractCode(window.location.href);
		if (extractError(window.location.href) == 'access_denied') {
			window.close();
		}
		else if(code) {
			try { window.opener.setCode(code); }
			catch(ex) { }
			window.close();
		}
		else {
			$('.rgw-fb-login-button-iframe').hide();
			$('div.authenticate').show();
			
			if ($('[name="readygraph_access_token"]').val()) {
				$('.rgw-fb-login-button-iframe').show();
				$('div.authenticate').hide();
				$('div.authenticating').hide();
				$('div.authenticated').show();
				
				$('.email-address').text($('[name="readygraph_email"]').val());
				
				window.setup_readygraph($('[name="readygraph_application_id"]').val());
				$('.popup-delay').val($('[name="readygraph_delay"]').val());
				if ($('[name="readygraph_enable_popup"]').val() == "true"){
				$('.signup-popup').val('yes-center');
				}
				else if ($('[name="readygraph_enable_notification"]').val() == "true"){
				$('.signup-popup').val('yes-bottom-right');
				}
				else{
				$('.signup-popup').val('no');
				}
				
				//$('[name="readygraph_ad_format"][value="' + $('[name="_readygraph_ad_format"]').val() + '"]').parent().click();
				//$('[name="readygraph_ad_timing"][value="' + $('[name="_readygraph_ad_timing"]').val() + '"]').parent().click();
				
				//$('[name="readygraph_ad_delay"]').val($('[name="_readygraph_ad_delay"]').val());
				//$('[name="readygraph_ad_scroll"]').val($('[name="_readygraph_ad_scroll"]').val());
				
				$('.result').text('...');
				if ($('[name="readygraph_access_token"]').val()) {
					$.ajax({
							url: resourceHost + '/api/v1/insight_info'
						, beforeSend: function (xhr) {
								xhr.setRequestHeader('Authorization', "Bearer " + $('[name="readygraph_access_token"]').val());
								xhr.setRequestHeader('Accept',        "application/json");
							}
						, method: 'POST'
						, success: function (response) {
								if (response.data) {
									$('.result').text(response.data.subscribers + ((response.data.subscribers == 0) ? ' Subscriber' : ' Subscribers'));
								} else {
									$('.result').text('Insight');
								}
							}
						, error: function (response) {
								refresh_access_token();
						}
					});
				}
			}
		}
		
		// Manage OAuth 2.0 Results
		//
		function refresh_access_token() {
			var refresh_token = $('[name="readygraph_refresh_token"]').val();
			if (refresh_token) {
				$('div.authenticate').hide();
				$('div.authenticating').show();
				$('div.authenticated').hide();
				
				$.ajax({
						url: resourceHost + '/oauth/access_token'
					, data: {
						grant_type: 'refresh_token',
            refresh_token: $('[name="readygraph_refresh_token"]').val(),
            redirect_uri: encodeURIComponent(location.href.replace('#' + location.hash,"")),
            client_id: settings.clientId
					}
					, method: 'POST'
					, success: function (response) {
							$('[name="readygraph_access_token"]').val(response.access_token);
							$('[name="readygraph_refresh_token"]').val(response.refresh_token);
              window.setAccessToken(response.access_token);
							$('.result').text(response.data.subscribers + ((response.data.subscribers == 0) ? ' Subscriber' : ' Subscribers'));
						}
					, error: function (response) {
							alert('We couldn\'t authenticate your account. Please check your internet connection.');
							$('div.authenticate').show();
							$('div.authenticating').hide();
							$('div.authenticated').hide();
						}
				});
			}
		}
		window.setCode = function(code) {
			$('.rgw-fb-login-button-iframe').hide();
      $('div.authenticate').hide();
			$('div.authenticating').show();
			$('div.authenticated').hide();
      
      $.ajax({
					url: resourceHost + '/oauth/access_token'
        , data: {
            grant_type: 'authorization_code',
            code: code,
            redirect_uri: encodeURIComponent(location.href.replace('#' + location.hash,"")),
            client_id: settings.clientId
        }
        , method: 'POST'
				, success: function (response) {
						if (response) {
							$('[name="readygraph_access_token"]').val(response.access_token);
							$('[name="readygraph_refresh_token"]').val(response.refresh_token);
              window.setAccessToken(response.access_token);
						} else {
							$('div.authenticating').hide();
							$('div.authenticate').show();
						}
					}
			});
    }
		window.setAccessToken = function(token) {
			$('.rgw-fb-login-button-iframe').hide();
			$('div.authenticate').hide();
			$('div.authenticating').show();
			$('div.authenticated').hide();
			
			$.ajax({
					url: resourceHost + '/api/v1/account_info'
				, beforeSend: function (xhr) {
						xhr.setRequestHeader('Authorization', "Bearer " + token);
						xhr.setRequestHeader('Accept',        "application/json");
					}
        , method: 'POST'
				, success: function (response) {
						if (response.data) {
							$('[name="readygraph_access_token"]').val(token);
							$('[name="readygraph_email"]').val(response.data.email);
							$('[name="readygraph_application_id"]').val(response.data.application_id);
							$('#myForm')[0].submit();
						} else {
							$('div.authenticating').hide();
							$('div.authenticate').show();
							$('.rgw-fb-login-button-iframe').hide();
						}
					}
			});
		}
	});
</script>
<script>
window.setup = false;
window.refresh_readygraph = function() {};
window.setup_readygraph = function(app_id) {
    if (window.setup) {
        window.refresh_readygraph();
        return;
    }
    window.setup = true;
    readygraph.setup({
      applicationId: app_id,
      isPreview: true,
      enableLoginWall: false,
      enableDistraction: false,
      enableAutoLogin: false,
      enableSidebar: false,
      enableNotification: false,
      enableInvite: false,
      enableOpenGraph: false,
      enableRgSeo: false
    });
    readygraph.ready(function() {
      readygraph.framework.require(['compact.sdk', 'facebook.sdk'], function() {
        var $ = readygraph.framework.jQuery;
        $.cookie('RGAuth', null);
        readygraph.framework.facebook.logout(function() {
          readygraph.framework.require(['invite'], function() {
            var VIEW_TYPE = {
              LOADING: 0,
              LOGIN_REQUIRE: 1,
              PERMISSION_REQUIRE: 2,
              DEFAULT: 3,
              LOGIN_WITH_EMAIL: 4,
              SIGNUP_WITH_EMAIL: 5,
              IMPORT_WITH_EMAIL: 6,
              FINISH: 10
            };
        
            var auth = new readygraph.framework.ui.AuthModel({
              dialog: true,
              'inviter_profile_picture': 'https://graph.facebook.com/4/picture?type=normal&width=400&height=400'
            });
            $('.rg-preview-widget').html('');
            $('.rg-preview-widget').append(auth.lightbox.view.$el);
            $('.rgw-content').attr('style', 'position: relative !important;');
            
            var view = VIEW_TYPE.LOGIN_REQUIRE;
            auth.on('switch', function() {
              if (auth.view.currentView != view) { auth.view.switchView(view); }
              else auth.view.render();
              if (view == VIEW_TYPE.DEFAULT) {
                auth.view.$el.find('.rgw-invite-view').showAndAnimate();
                auth.view.$el.find('.rgw-follow-view').hideAndAnimate();
                auth.view.$el.commitTransition();
              }
            });
            auth.view.switchView(view);
            
            $(window).scroll(function() {
              $(window).trigger('rgw-invalidate');
            });
            $('.rg-preview-widget, .content-warp').scroll(function() {
              $(window).trigger('rgw-invalidate');
            });
            $(window).trigger('rgw-invalidate');
            
            $('.rg-vertical-tab').click(function() {
                saveContent(auth, $('.rg-preview-widget-container'), true);
								
                $('.rg-vertical-tab').removeClass('active');
                $(this).addClass('active');
                view = VIEW_TYPE[$(this).attr('tab')];
                if (auth.view.currentView != view) { auth.view.switchView(view); }
                
                $('.rg-preview-widget, .content-warp').scrollTop(10000);
            });
            
            enableContentEditable(auth, $('.rg-preview-widget-container'));
            restoreContent(auth, $('.rg-preview-widget-container'));
            
            $('.save').click(function() {
                $('.save').css('opacity', 0.4);
                saveContent(auth, $('.rg-preview-widget-container'), false);
            });
            
            window.refresh_readygraph = function() {
                restoreContent(auth, $('.rg-preview-widget-container'));
            }
          });
        });
      });
    });
}
function enableContentEditable(model, container) {
    model.view.$el.find('[rgw-data-key]').each(function() {
        var element = $(this);
        if (element.attr('rgw-data-editable') == 'false') return;
        
          if (element.attr('editing') != null) return;
          container.find('.special-button-container button').attr('disabled', 'disabled');
          element.text(readygraph.getSettings().get(element.attr('rgw-data-key')));
          element.attr('editing', '1');
          element.css({
            'border': '2px dashed orange',
            'position': 'relative',
            'top': '-2px',
            'margin-bottom': '-4px',
            'background-color': '#FAFAC5'
          });
          element.attr('contenteditable', true);
          element.bind('paste', function(e) {
            e.preventDefault();
          });
          element.bind('keydown', function() { $('.save').css('opacity', '1.0'); });
      });
}
function saveContent(model, container, fake) {
    var settings = {};
    model.view.$el.find('[rgw-data-key]').each(function() {
        var element = $(this);
        if (element.attr('rgw-data-editable') == 'false') return;
        settings[element.attr('rgw-data-key')] = element.text();
        readygraph.getSettings().set(element.attr('rgw-data-key'), element.text());
    });
    if (!fake) {
				$('input[name="readygraph_settings"]').val(JSON.stringify(settings));
        $('#myForm')[0].submit();
    }
}
function restoreContent(model, container) {
    eval('window._TEMP='+$('input[name="readygraph_settings"]').val());
		var settings = window._TEMP;
    if (settings) {
        model.view.$el.find('[rgw-data-key]').each(function() {
            var element = $(this);
            if (element.attr('rgw-data-editable') == 'false') return;
            element.text(settings[element.attr('rgw-data-key')]);
            readygraph.getSettings().set(element.attr('rgw-data-key'), element.text());
        });
    }
}
</script>
<style>
/* FOR INLINE WIDGET */
.rgw-overlay {
    display: none !important;
}
.rgw-content-frame {
    left: 0 !important;
    top: 0 !important;
    position: relative !important;
    margin: 0 auto !important;
    border: solid 1px #cccccc;
}
.rgw-preview-warning {
    display: none !important;
}
.rgw-content {
    position: relative !important;
}
</style>