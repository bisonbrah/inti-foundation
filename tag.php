<?php
/**
 * The main template file and posts page
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
					
					<?php if ( have_posts() ) : ?>
						<header class="archive-header">
							<h1 class="archive-title"><?php printf( __('Tag: %s', 'reactor'), '<span>' . single_tag_title('', false) . '</span>'); ?></h1>
			
						<?php // show an optional tag description
						if ( tag_description() ) : ?>
							<div class="archive-meta">
							<?php echo tag_description(); ?>
							</div>
						<?php endif; ?>
						</header><!-- .archive-header -->
					<?php endif; // end have_posts() check ?> 

					<?php // get the loop
					get_template_part('loops/loop', 'index'); ?>
				
				<?php inti_hook_inner_content_after(); ?>
				
				</div><!-- .columns -->
				
				<?php get_sidebar(); ?>
				
			</div><!-- .row -->
		</div><!-- #content -->
		
		<?php inti_hook_content_after(); ?>
		
	</div><!-- #primary -->


<?php get_footer(); ?>