<?php
/*
The settings page
*/

function menu_item()
{
	global $gpp_settings_page_hook;
	$gpp_settings_page_hook = add_menu_page(
		__('Guest Post Shortcodes', 'guest-post-publish'),
		__('Guest Post Shortcodes', 'guest-post-publish'),
		'manage_options',
		'gpp_settings',
		'gpp_render_settings_page'
	);
}

add_action('admin_menu', 'menu_item');

function gpp_scripts_styles($hook)
{
	global $gpp_settings_page_hook;
	if ($gpp_settings_page_hook != $hook)
		return;


}

add_action('admin_enqueue_scripts', 'gpp_scripts_styles');

function gpp_render_settings_page()
{
	?>
	<div class="wrap">
		<div id="icon-options-general" class="icon32"></div>
		<h3><?php _e('Guest Post Shortcodes', 'guest-post-publish'); ?></h3>
		<div class="form-shortcodes-container">
			<p><input readonly="readonly"
					       name="shortcode" id="shortcode" class="shortcode" type="text"
					       value="[gpp_submission_form]"></p>
			<p>	<input readonly="readonly"
					       name="shortcode" id="shortcode" class="shortcode" type="text"
					       value="[gpp_article_list]">
				</p>
		</div>

	
	</div>
<?php }
?>