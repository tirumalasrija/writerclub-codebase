
<?php

/**

 * Template Name: Em Template

 * Template Post Type: post, page

 *

 * @package WordPress

 * @subpackage Twenty_Twenty

 * @since Twenty Twenty 1.0

 */

get_header(); 



if ( is_user_logged_in() ) {



  wp_redirect( site_url('') );



}

?>







<div class="container">

 Empty page
</div>





<?php get_footer(); ?>


