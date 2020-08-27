<?php

/**
 * Creates shortcode gpp_submission_form
 *
 * @return string: HTML content for the shortcode
 */
function gpp_add_new_post()
{
	$gpp_misc = get_option('gpp_misc');
	$gpp_roles = get_option('gpp_role_settings');
	if (!is_user_logged_in()) 
     wp_redirect( site_url('login') );
	 
	ob_start();
	
	include(dirname(dirname(__FILE__)) . '/views/post_submission.php');
	
	return ob_get_clean();
}

add_shortcode('gpp_submission_form', 'gpp_add_new_post');

/**
 * Creates shortcode gpp_article_list
 *
 * @return string: HTML content for the shortcode
 */
function gpp_manage_posts()
{
	$gpp_misc = get_option('gpp_misc');
	if (!is_user_logged_in())
		 auth_redirect();
	
	ob_start();
	if ( isset( $_GET['gpp_id'] ) && isset( $_GET['gpp_action'] ) && $_GET['gpp_action'] == 'edit' ) {
		?>
		<span class="gpp-back-to-list-link">
			<a href="<?php echo site_url('my-stories') ?>">
				&#10094; <?php esc_html_e( 'Back to My Stories ', 'guest-post-publish' ) ?>
			</a>
		</span>
		<?php
		include( dirname( dirname( __FILE__ ) ) . '/views/post_submission.php' );
	} else {
		include( dirname( dirname( __FILE__ ) ) . '/views/post-list.php' );
	}
	return ob_get_clean();
}

add_shortcode('gpp_article_list', 'gpp_manage_posts');

?>