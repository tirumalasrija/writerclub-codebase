<?php
/**
 * Template Name: Write a Story Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
get_header(); 



if ( !is_user_logged_in() ) {

  wp_redirect( site_url('login') );

}

?>
<style>
	.media-frame-actions-heading{
		font-size:1em !important;
	}
</style>
<?php echo do_shortcode('[gpp_submission_form]'); ?>

 

<?php get_footer(); ?>