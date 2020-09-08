<?php

/**

 * Template Name: Story Feed Template

 * @package WordPress

 * @subpackage Twenty_Twenty

 * @since Twenty Twenty 1.0

 */

get_header(); 

$current_cat_id = (isset($_GET['cat'])?$_GET['cat']:'');


?>

<div class="feed_bg">

<div class="container">

    <div class="spacer">

        <div class="d-flex justify-content-between align-items-center mb-5 mt-5 mfdc">

            <div class="flex-grow-1 story_feed"><b> <?php if($cat) {  echo get_cat_name( $cat ).' : '; } ?> Story Feeds</b></div>

            <div class="d-flex justify-content-between align-items-center">

                <div class="mr-3">Sort By:</div>
  
               
                <div class="dropdown">
  <button class="btn y customdd dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Category  <i class="fas fa-chevron-down"></i>
  </button>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="<?php echo site_url('story-feed'); ?>">All </a>
 <?php
  $allcat=get_categories(array( 'exclude'  => array(1),'number' => 6, 'hide_empty' =>false,'orderby' => 'name','order' => 'ASC',));
    $taxonomy="category";
    $i=0;

foreach($allcat as $value) { ?>
    <a class="dropdown-item" href="<?php echo site_url('story-feed'); ?>?cat=<?php echo $value->term_id; ?>"><?= $value->name; ?> </a>
<?php } ?>
  </div>
</div>

            </div>

        </div>

        <div class="d-flex flex-wrap flex-row row">



      <?php  $args = array(

                'post_type' => 'post',

                   'post_status' => array('publish'),          
                   'cat' => $current_cat_id
                );



         $ajaxposts = new WP_Query($args);

                // The Query

 				$response='';
                if ($ajaxposts->have_posts()) {

                while ($ajaxposts->have_posts()) {

                    $ajaxposts->the_post();

                    $response .=  get_template_part('template-parts/story-content');

                }

                } else {

                $response .=  "No Story Feed<br><br>";

                }
         echo $response;         ?>
          

        </div>

    </div>

</div>
</div>

<?php get_footer(); ?>