<?php

function gpp_post_has_errors($content)
{
	$gpp_plugin_options = get_option('gpp_post_restrictions');
	$gpp_messages = gpp_messages();
	$min_words_title = 1;
	$min_words_content = 2;
	$error_string = '';
	$format = '%s<br/>';

	if (($min_words_title && empty($content['post_title'])) || ($min_words_content && empty($content['post_content'])) || ($min_words_bio && empty($content['about_the_author']))) {
		$error_string .= sprintf($format, $gpp_messages['required_field_error']);
		
	}

	$stripped_bio = strip_tags($content['about_the_author']);
	$stripped_content = strip_tags($content['post_content']);

	if (!empty($content['post_title']) && str_word_count($content['post_title']) < $min_words_title)
		$error_string .= sprintf($format, $gpp_messages['title_short_error']);
	if (!empty($content['post_content']) && str_word_count($stripped_content) < $min_words_content)
		$error_string .= sprintf($format, $gpp_messages['post_short_error']);
	
		if (str_word_count($error_string) < 2)
		return false;
		else
		return $error_string;
}

/**
 * Ajax function for fetching a featured image
 *
 * @uses array $_POST The id of the image
 * @return string: A JSON encoded string
 */
function gpp_fetch_featured_image()
{
	$image_id = $_POST['img'];
	echo wp_get_attachment_image($image_id, array(200, 200));
	die();
}

add_action('wp_ajax_gpp_fetch_featured_image', 'gpp_fetch_featured_image');

/**
 * Ajax function for deleting a post
 *
 * @uses array $_POST The id of the post and a nonce value
 * @return string: A JSON encoded string
 */
function gpp_delete_posts()
{
	try {
		if (!wp_verify_nonce($_POST['delete_nonce'], 'gppnonce_delete_action'))
			throw new Exception(__('Sorry! You failed the security check', 'guest-post-publish'), 1);

	/*	if (!current_user_can('delete_post', $_POST['post_id']))
			throw new Exception(__("You don't have permission to delete this post", 'guest-post-publish'), 1); */

		$result = wp_delete_post($_POST['post_id']);
		if (!$result)
			throw new Exception(__("The Story could not be deleted", 'guest-post-publish'), 1);

		$data['success'] = true;
		$data['message'] = __('The Story has been deleted successfully!', 'guest-post-publish');
	} catch (Exception $ex) {
		$data['success'] = false;
		$data['message'] = $ex->getMessage();
	}
	die(json_encode($data));
}

add_action('wp_ajax_gpp_delete_posts', 'gpp_delete_posts');
add_action('wp_ajax_nopriv_gpp_delete_posts', 'gpp_delete_posts');

/**
 * Mail function for Admin when a new post draft.
 *
 * @new_post_id for post
 */

function wp_notify_mail($new_post_id)
{
	  // get email from custom field
	$emailto = get_option( 'admin_email' );
    $subject = 'New ' . get_the_title($new_post_id);
    // Email body
    $message = 'View it: ' . get_permalink($new_post_id ) . "\n Edit it: " . get_edit_post_link( $new_post_id );
	wp_mail( $emailto, $subject, $message );
}

/**
 * Ajax function for adding a new post.
 *
 * @uses array $_POST The user submitted post
 * @return string: A JSON encoded string
 */
function gpp_process_form_input()
{
	$gpp_messages = gpp_messages();
	try {
		if (!wp_verify_nonce($_POST['post_nonce'], 'gppnonce_action'))
			throw new Exception(
				__("Sorry! You failed the security check", 'guest-post-publish'),
				1
			);

	

		$gpp_misc = get_option('gpp_misc');		

		if ($errors)
			throw new Exception($errors, 1);

		if ($gpp_misc['nofollow_body_links'])
			$post_content = wp_rel_nofollow($_POST['post_content']);
		else
			$post_content = $_POST['post_content'];

		$current_post = empty($_POST['post_id']) ? null : get_post($_POST['post_id']);
		$current_post_date = is_a($current_post, 'WP_Post') ? $current_post->post_date : '';
		$current_user = wp_get_current_user();
 		$location = get_user_meta( $current_user->ID, 'mm_user_country_code' , true );
		$new_post = array(
			'post_title'     => sanitize_text_field($_POST['post_title']),	
			'post_content'   => wp_kses_post($post_content),
			'post_date'      => $current_post_date,
			'post_excerpt'   => sanitize_text_field($_POST['excert']),
			'post_type'      => sanitize_text_field($_POST['customcategory']),
			
			
		);

		if(current_user_can('administrator') ) {
			$post_action = __('published', 'guest-post-publish');
			$new_post['post_status'] = 'publish';
		} else {
			$post_action = __('submitted', 'guest-post-publish');
			$new_post['post_status'] = 'publish';
		}

		if ($_POST['post_id'] != -1) {
			$new_post['ID'] = $_POST['post_id'];
			$post_action = __('updated', 'guest-post-publish');
		}

		$new_post_id = wp_insert_post($new_post, true);
		 add_post_meta( $new_post_id, '_country_code', $location, true ); 


		wp_set_post_categories( $new_post_id, $_POST['categoriesall']);

		if (is_wp_error($new_post_id))
			throw new Exception($new_post_id->get_error_message(), 1);
			wp_notify_mail($new_post_id);
	

		if ($_POST['featured_img'] != -1)
			set_post_thumbnail($new_post_id, $_POST['featured_img']);

		$data['success'] = true;
		$data['post_id'] = $new_post_id;
		$data['message'] = sprintf(
			'%s<br/><a href="#" id="gpp-continue-editing">%s</a>',
			sprintf(__('Your Story has been %s successfully!', 'guest-post-publish'), $post_action),
			__(' ', 'guest-post-publish')
		);
	} catch (Exception $ex) {
		$data['success'] = false;
		$data['message'] = sprintf(
			'<strong>%s</strong><br/>%s',
			$gpp_messages['general_form_error'],
			$ex->getMessage()
		);
	}
	die(json_encode($data));
}

add_action('wp_ajax_gpp_process_form_input', 'gpp_process_form_input');
add_action('wp_ajax_nopriv_gpp_process_form_input', 'gpp_process_form_input');