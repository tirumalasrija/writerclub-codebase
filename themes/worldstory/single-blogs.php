<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); 
if ( !is_user_logged_in() ) {

  wp_redirect( site_url('login') );

}
 wp_get_current_user();
  //  $profile_img  = @json_decode(get_user_meta( $current_user->ID, 'mm_profile_image', true));
  //  $profile_img  = !$profile_img ? '' : $profile_img;
   // if(!empty($profile_img))
  //  {
  //$profileurl = wp_get_attachment_thumb_url( $profile_img->attachment_id ); 
  //  } else {
   //    $profileurl = "https://worldwidestorytellers.com/wp-content/uploads/2020/06/default_avatar.jpg";
  //  }
  global $post;
  $author_id=$post->post_author;

 $postsprofile_img  = @json_decode(get_user_meta( $author_id, 'mm_profile_image', true));
    $postsprofile_img  = !$postsprofile_img ? '' : $postsprofile_img;
    if(!empty($postsprofile_img))
    {
  $postprofileurl = wp_get_attachment_thumb_url( $postsprofile_img->attachment_id ); 
    } else {
       $postprofileurl = "https://worldwidestorytellers.com/wp-content/uploads/2020/06/default_avatar.jpg";
    }
?>
<div  class="container single-story">
    <div  class="bg-white">
    	<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post(); ?>
        <div  class="d-flex flex-column col-lg-12">

                <div  class="share_story mt-3">
                    <b  class="story_feed d-flex">
                        <a  href="<?php echo site_url('blog'); ?>"><i  class="fas fa-arrow-left"></i></a>&nbsp;<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                    </b>
                </div>
            <div  class="w-100">
                <?php 
                        the_content(
                        sprintf(
                            /* translators: %s: Post title. */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
                            get_the_title()
                        )
                    );
                        ?>
               
            </div>
        </div>

        <div  class="d-flex flex-column mb-5 col-lg-8">
            <div >
            	<?php the_post_thumbnail( 'large' ); ?>
              
            </div>
            <div  class="d-flex justify-content-between align-items-center mt-3 mb-5">
                <div class="d-flex" >
                    <div  class="user-pic">
                        <img  src="<?php echo $postprofileurl; ?>">
                    </div>
                    <div  class="user_name ml-1">
                        <p ><?php the_author(); ?></p>
                        <p  class="auther">Author</p>
                    </div>
                </div>
              
            </div>
        </div>
           <?php wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				)
			   );

			  endwhile; // End the loop.
			?>
    </div>
</div>    




<?php
get_footer();
