<?php
/**
 * The default index
 *
 * @package Inti
 * @subpackage Templates
 * @since 1.0.0
 */

$layout = inti_get_layout('');

get_header(); ?>


	<div id="primary" class="site-content">
	
		<?php inti_hook_content_before(); ?>
	
		<div id="content" role="main" class="<?php apply_filters('inti_filter_content_classes', ''); ?>">
			<div class="row">
				<?php switch ( $layout ) { 

					case '1c': ?>

				<div class="small-12 medium-12 large-12 columns">
				


				<?php break;
					case '2c-l': ?>

				<div class="small-12 medium-7 large-8 columns">
				


				<?php break;
					case '2c-r': ?>

				<div class="small-12 medium-7 medium-push-5 large-8 large-push-4 columns">
				


				<?php break;
					case '1c-thin': ?>

				<div class="small-12 medium-10 medium-centered large-9 columns">
				

				<?php } //end switch ?>
				
				<?php inti_hook_inner_content_before(); ?>

<!-- Image Content -->

				<?php while ( have_posts() ) : the_post(); ?>
		
						<article id="post-<?php the_ID(); ?>" <?php post_class('image-attachment'); ?>>
							<header class="entry-header">
								<h1 class="entry-title"><?php the_title(); ?></h1>
		
								<footer class="entry-meta">
									<?php
										$metadata = wp_get_attachment_metadata();
										printf( __('<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>.', 'inti'),
											esc_attr( get_the_date('c') ),
											esc_html( get_the_date() ),
											esc_url( wp_get_attachment_url() ),
											$metadata['width'],
											$metadata['height'],
											esc_url( get_permalink( $post->post_parent ) ),
											esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
											get_the_title( $post->post_parent )
										);
									?>
									<?php edit_post_link( __('Edit', 'inti'), '<span class="edit-link">', '</span>'); ?>
								</footer><!-- .entry-meta -->
		
								<nav id="image-navigation" class="navigation" role="navigation">
									<span class="previous-image"><?php previous_image_link( false, __('&larr; Previous', 'inti') ); ?></span>
									<span class="next-image"><?php next_image_link( false, __('Next &rarr;', 'inti') ); ?></span>
								</nav><!-- #image-navigation -->
							</header><!-- .entry-header -->
		
							<div class="entry-content">
		
								<div class="entry-attachment">
									<div class="attachment">
		<?php
		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
		 * or the first image ( if we're looking at the last image in a gallery ), or, in a gallery of one, just the link to that image file
		 */
		$attachments = array_values( get_children( array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') ) );
		foreach ( $attachments as $k => $attachment ) :
			if ( $attachment->ID == $post->ID )
				break;
		endforeach;
		
		$k++;
		// If there is more than 1 attachment in a gallery
		if ( count( $attachments ) > 1 ) :
			if ( isset( $attachments[$k] ) ) :
				// get the URL of the next image attachment
				$next_attachment_url = get_attachment_link( $attachments[$k]->ID );
			else :
				// or get the URL of the first image attachment
				$next_attachment_url = get_attachment_link( $attachments[0]->ID );
			endif;
		else :
			// or, if there's only 1 image, get the URL of the image
			$next_attachment_url = wp_get_attachment_url();
		endif;
		?>
										<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
										$attachment_size = apply_filters('inti_attachment_size', array( 960, 960 ) );
										echo wp_get_attachment_image( $post->ID, $attachment_size );
										?></a>
		
										<?php if ( !empty( $post->post_excerpt ) ) : ?>
										<div class="entry-caption">
											<?php the_excerpt(); ?>
										</div>
										<?php endif; ?>
									</div><!-- .attachment -->
		
								</div><!-- .entry-attachment -->
		
								<div class="entry-description">
									<?php the_content(); ?>
								</div><!-- .entry-description -->
		
							</div><!-- .entry-content -->
		
						</article><!-- #post -->
		
						<?php comments_template(); ?>
		
					<?php endwhile; // end of the loop ?>

<!-- Image Content -->
				
				<?php inti_hook_inner_content_after(); ?>
				
				</div><!-- .columns -->
				
				<?php get_sidebar(); ?>
				
			</div><!-- .row -->
		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>