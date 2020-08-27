<?php
wp_enqueue_style('gpp-style');
wp_enqueue_script('gpp-script');
wp_enqueue_media();

$current_user = wp_get_current_user();
$status = isset($_GET['gpp_type']) ? $_GET['gpp_type'] : 'publish';
$paged = isset($_GET['gpp_page']) ? $_GET['gpp_page'] : 1;
$per_page =  10;
$author_posts = new WP_Query(array('posts_per_page' => $per_page, 'paged' => $paged, 'orderby' => 'DESC', 'author' => $current_user->ID, 'post_status' => $status,"post_type"=>"any"));
$old_exist = ($paged * $per_page) < $author_posts->found_posts;
$new_exist = $paged > 1;
?>
<div id="gpp-posts">
	<div id="gpp-message"></div>
	<ul>
		<li><a <?php if ($status == 'publish'): ?>class="active"<?php endif; ?>
			   href="?gpp_type=publish"><?php _e('Published', 'guest-post-publish'); ?></a></li>
		<li><a <?php if ($status == 'draft'): ?>class="active"<?php endif; ?>
			   href="?gpp_type=draft"><?php _e('Draft', 'guest-post-publish'); ?></a></li>
	</ul>
	<div id="gpp-post-table-container">
		<?php if (!$author_posts->have_posts()): ?>
			<?php _e('Nothing found.', 'guest-post-publish'); ?>
		<?php else: ?>
			<p><?php printf(__('%s article(s).', 'guest-post-publish'), $author_posts->found_posts); ?></p>
		<?php endif; ?>
		<table>
			<?php
			while ($author_posts->have_posts()) : $author_posts->the_post();
				$postid = get_the_ID();
				?>
				<tr id="gpp-row-<?= $postid ?>" class="gpp-row">
					<td><?php the_title(); ?></td>
					<?php if ($status == 'publish'): ?>
						<td class="gpp-fixed-td"><a href="<?php the_permalink(); ?>"
													title="<?php _e('View Post', 'guest-post-publish'); ?>"><?php _e('View', 'guest-post-publish'); ?></a>
						</td><?php endif; ?>
					
					<td class="post-delete gpp-fixed-td"><img id="gpp-loading-img-<?= $postid ?>"
															  class="gpp-loading-img"
															  src="<?php echo plugins_url('assets/img/ajax-loading.gif', dirname(__FILE__)); ?>"><a
							href="#"><?php _e('Delete', 'guest-post-publish'); ?></a><input type="hidden"
																							 class="post-id"
																							 value="<?= $postid ?>">
					</td>
				</tr>
			<?php endwhile; ?>
		</table>
		<?php wp_nonce_field('gppnonce_delete_action', 'gppnonce_delete'); ?>
		<div class="gpp-nav">
			<?php if ($new_exist): ?>
				<a class="gpp-nav-link gpp-nav-link-left" href="?gpp_type=<?= $status ?>&gpp_page=<?= ($paged - 1) ?>">
					&#10094; <?php _e('Newer Posts', 'guest-post-publish'); ?></a>
			<?php endif; ?>
			<?php if ($old_exist): ?>
				<a class="gpp-nav-link gpp-nav-link-right"
				   href="?gpp_type=<?= $status ?>&gpp_page=<?= ($paged + 1) ?>"><?php _e('Older Posts', 'guest-post-publish'); ?>
					&#10095;</a>
			<?php endif; ?>
			<div style="clear:both;"></div>
		</div>
		<?php wp_reset_query();
		wp_reset_postdata(); ?>
	</div>
</div>