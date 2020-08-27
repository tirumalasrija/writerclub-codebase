<?php
wp_enqueue_style('gpp-style');
wp_enqueue_script('gpp-script');
wp_enqueue_media();
/*
All post Type List 
*/
function generate_post_select() {
		$args=array(
				'public'   => true,
				'_builtin' => false
				); 
		$output = 'names';
		$operator = 'and';
		$post_types=get_post_types($args,$output,$operator); 
		echo '<select name="customcategory" id="customcategory">';
		echo '<option value = "post" >Default Post Type </option>';
		foreach ($post_types  as $post_type ) {
		echo '<option value="'. $post_type.'">'. $post_type. '</option>';
		}
		echo '</select>';

}
$current_user = wp_get_current_user();
$post = false;
$post_id = -1;
$featured_img_html = '';
if (isset($_GET['gpp_id']) && isset($_GET['gpp_action']) && $_GET['gpp_action'] == 'edit') {
	$post_id = $_GET['gpp_id'];
	$p = get_post($post_id, 'ARRAY_A');
	if ($p['post_author'] != $current_user->ID) return __("You don't have permission to edit this post", 'guest-post-publish');
	$category = get_the_category($post_id);
	$tags = wp_get_post_tags($post_id, array('fields' => 'names'));
	$featured_img = get_post_thumbnail_id($post_id);
	$featured_img_html = (!empty($featured_img)) ? wp_get_attachment_image($featured_img, array(200, 200)) : '';
	$post = array(
		'title'            => $p['post_title'],
		'content'          => $p['post_content'],
		'about_the_author' => get_post_meta($post_id, 'about_the_author', true)
	);
	if (isset($category[0]) && is_array($category))
		$post['category'] = $category[0]->cat_ID;
	if (isset($tags) && is_array($tags))
		$post['tags'] = implode(', ', $tags);
}
?>
<noscript>
	<div id="no-js"
		 class="warning"><?php _e('This form needs JavaScript to function properly. Please turn on JavaScript and try again!', 'guest-post-publish'); ?></div>
</noscript>
<div class="container" id="gpp-new-post">
	<div id="gpp-message" class="warning"></div>
     <form id="gpp-submission-form">
            <!-- test-->
            <div class="my-custom-class">
                <div class="container">
                    <div class="row bg-white">
                        
                            <div class="col-lg-4 mt-3">
                                <ul class="nav nav-tabs story_editor" role="tablist">
                                    <ul class="d-flex justify-content-between story_container w-100">
                                        <li>Story Editor</li>
                                        <li><i class="fas fa-eye"></i>&nbsp;Preview</li>
                                    </ul>
                                
                                    <li class="nav-item category">
                                        <a class="nav-link active show" href="#buzz" role="tab" data-toggle="tab">Categories</a>
                                    </li>
                                
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3">
                            
                                    <div role="tabpanel" class="tab-pane active" id="buzz">
                                        <div [innerHtml]="htmlToAdd" ></div>  
                                        <ul class="images_container">
                                            <?php $allcat=get_categories(array( 'exclude'  => array(1 ), 'hide_empty' =>false,'orderby' => 'name','order' => 'ASC',));
$taxonomy="category";
foreach($allcat as $value)
{ ?>
  
<li ><input  type="checkbox"   name="categories" value="<?= $value->term_id ?>" />
   <?= $value->name ?> <label for="cb1"><img src="<?php echo get_field('category_image',$taxonomy . '_' . $value->term_id); ?>" class="img-fluid" /></label>
</li>
<?php }

  ?>
                                            
                                          
                                        
                                            
                                        </ul>
                                    </div>
                                
                                </div>

                            </div>
                            <div class="col-lg-8 mt-3">

                                <div class="d-flex rightside_con">
                                	 <div class="form-group">
                                    		<input type="text" name="post_title" id="gpp-post-title" placeholder="Story Name *" class="form-control" value="<?php echo ($post) ? $post['title'] : ''; ?>">
                                      
                                    </div>
                                    <div class="form-group">  
                                       	<div id="gpp-featured-image">
			<div id="gpp-featured-image-container"><?php echo $featured_img_html; ?></div>
			<a id="gpp-featured-image-link" href="#"><?php _e('Choose Covered Image', 'guest-post-publish'); ?></a>
			<input type="hidden" id="gpp-featured-image-id" value="<?php echo (!empty($featured_img)) ? $featured_img : '-1'; ?>"/>
		</div>
                                    </div>


                                   
                                
                                    <div class="form-group">
                                     		<?php
		$enable_media = (isset($gpp_roles['enable_media']) && $gpp_roles['enable_media']) ? current_user_can($gpp_roles['enable_media']) : 1;
		wp_editor($post['content'], 'gpp-post-content', $settings = array('textarea_name' => 'post_content', 'textarea_rows' => 10, 'media_buttons' => true,'drag_drop_upload' => true,  ));
		wp_nonce_field('gppnonce_action', 'gppnonce');
		?>
	
                                    </div>
<input type="hidden" name="post_id" id="gpp-post-id" value="<?php echo $post_id ?>">
                                    <div class="form-group w-100 d-flex justify-content-end">
                                          
                                            	<img class="gpp-loading-img" src="<?php echo plugins_url('assets/img/ajax-loading.gif', dirname(__FILE__)); ?>"/>
                                            	<button type="button" id="gpp-submit-post" class="active-btn btn publish"><?php _e('Publish', 'guest-post-publish'); ?></button>
                                            	<button type="button" id="gpp-private-post" class="active-btn btn draft"><?php _e('Save Draft', 'guest-post-publish'); ?></button>
                                         
                                    </div>

                                </div>

                                

                            </div>
                        
                    </div>
                </div>
            </div>

        </form>
    </div>
