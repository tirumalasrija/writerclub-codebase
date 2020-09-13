<?php

/**

 * Template Name: Blog Paged Template

 * @package WordPress

 * @subpackage Twenty_Twenty

 * @since Twenty Twenty 1.0

 */

get_header(); 




?>

<div class="feed_bg">

<div class="container">

    <div class="spacer">

        <div class="d-flex justify-content-between align-items-center mb-5 mt-5 mfdc">

        <div class="flex-grow-1 story_feed"><b> Worldwide storytellers Blogs</b></div>


        </div>

        <div class="d-flex flex-wrap flex-row row">



      <?php  $args = array(

                'post_type' => 'blogs',

                   'post_status' => array('publish'),          
                   
                );



         $ajaxposts = new WP_Query($args);

                // The Query

 				$response='';
                if ($ajaxposts->have_posts()) {

                while ($ajaxposts->have_posts()) {

                    $ajaxposts->the_post();

                    $response .=  get_template_part('template-parts/blog-content');

                }

                } else {

                $response .=  "No Blog<br><br>";

                }
         echo $response;         ?>
          

        </div>

    </div>

</div>
</div>

<?php get_footer(); ?>