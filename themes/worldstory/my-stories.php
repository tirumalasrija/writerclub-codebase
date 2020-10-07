

<?php

/**

 * Template Name: Mystories Template

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
wp_enqueue_style('gpp-style');
?>

<div class="feed_bg">
<div class="container">

    <div class="spacer">

        <div class="d-flex justify-content-between align-items-center mb-5 mt-5 mfdc">

            <div class="flex-grow-1 story_feed"><b> My Story Feeds</b></div>

        

        </div>
	<div><div id="gpp-message"></div></div>
        <div class="d-flex flex-wrap flex-row row">



      <?php  $args = array(

                'post_type' => 'post',
                   'author'        =>  $current_user->ID,
				    'orderby'       =>  'post_date',
				    'order'         =>  'DESC',
				    'posts_per_page' => -1,

                   'post_status' => array('publish','pending','draft'),          

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

                $response .=  "No Stories <br><br>";

                }
         echo $response;         ?>
          

        </div>

    </div>

</div>
</div>
<?php wp_nonce_field('gppnonce_delete_action', 'gppnonce_delete'); ?>

<script>
 var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
  	$(".group-delete").click(function (event) {
		var id = $(this).data("id"),
			nonce = $('#gppnonce_delete').val(),
			loading_image = $(this).siblings('.gpp-loading-img').first(),
			row = $(this).closest('.gpp-row'),
			message_box = $('#gpp-message'),
			post_count = $('.count', $('#gpp-posts')),
			confirmation = confirm("Are you want to delete Story");

		if (!confirmation)
			return;

		$(this).hide();
		loading_image.show().css({'float': 'none', 'box-shadow': 'none'});
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'gpp_delete_posts',
				post_id: id,
				delete_nonce: nonce
			},
			success: function (data) {
				var arr = $.parseJSON(data);
				message_box.html('');
				if (arr.success) {
					row.hide();
					message_box.show().addClass('success').append(arr.message);
					post_count.html(Number(post_count.html()) - 1);
				}
				else {
					message_box.show().addClass('warning').append(arr.message);
				}
				if (message_box.offset().top < $(window).scrollTop()) {
					$('html, body').animate({scrollTop: message_box.offset().top - 10}, 'slow');
				}
			},
			error: function (MLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
		event.preventDefault();
	});

</script>


<?php get_footer(); ?>