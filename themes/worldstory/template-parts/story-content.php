  <?php global $post;
$id= get_the_ID();
$colors = array("bordercolor1 img-violet","bordercolor1 img-yellow","bordercolor1 img-red","bordercolor1 img-blue");
$k= array_rand($colors)
   ?>

  <div class="position-relative imgs col-sm-6 col-12 gpp-row">

   <div class="dropdown group-info ">
                  <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                  </button>
	   <?php if ( is_user_logged_in() ) { ?>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                -  <a class="dropdown-item" href="<?php echo site_url('edit-story'); ?>?gpp_action=edit&gpp_id=<?= $id ?>" >
                      <i class="edit"></i>
                      Edit Story
                    </a> 
                    <a class="dropdown-item group-delete" data-id="<?php echo get_the_ID(); ?>" href="#"><i class="delete-info"></i>Delete Story</a>
                  </div>
	   <?php } ?>
                </div>           

                      <?php  
                      if ( has_post_thumbnail() ) {
  echo get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' =>$colors[$k] ) );
  }else{
      $category = get_the_terms( $post->ID, 'category' );
      $taxonomy="category";
   
    ?>
      <img class="<?= $colors[$k] ?>"  src="<?php echo get_field('category_image',$taxonomy . '_' . $category[0]->term_id); ?>" />
  
  <?php } ?>

                <div class="img-content img-content-center shadow">

                    <h5><b><?php echo get_the_title(); ?></b></h5>

                    <p>

                    <?php  

echo wp_trim_words( get_the_content(), 20, '...' );
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

                    </p>

                    <div class="d-flex justify-content-between">

                        <div class="d-flex">

                            <div class="user-pic mr-1">

                           <img src="<?php echo $postprofileurl;  ?>" />

                            </div>

                            <div class="user_name">

                                <p><?php the_author(); ?></p>

                                <p class="auther">Author</p>

                            </div>

                        </div>

                        <div class="read">

                            <a href="<?php echo get_permalink( $post->ID ); ?>">Read more &nbsp;<i class="fas fa-chevron-right"></i>

                            </a>

                        </div>



                    </div>

                    <div class="social-icons d-flex">



                        <small class="likes mr-3"><i class="fas fa-heart mr-1"></i> <?php if(function_exists('the_views')) { the_views(); } ?></small>

                     

    <small class="share"><a href="<?php echo site_url('share-story'); ?>?share=<?php echo $post->ID; ?>"><i class="fas fa-share-alt"></i></a></small>

                    </div>

                </div>

            </div>