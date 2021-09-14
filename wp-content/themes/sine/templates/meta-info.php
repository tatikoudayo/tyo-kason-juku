<?php
/**
 * Displays the meta information
 *
 * @since 1.0.0
 *
 * @package Guternbiz WordPress Theme
 */?>

<?php if ( 'post' === get_post_type() ) : ?>
	<?php 
		$category = sine_get( 'post-category' );
		$author   = sine_get( 'post-author' );
		$date     = sine_get( 'post-date' );
	if( $category || $author || $date ) : ?>
		<div class="entry-meta 
			<?php 
				if( is_single() ){
					echo esc_attr( 'single' );
				} 
			?>"
		>
			<?php Sine_Helper::get_author_image(); ?>
			<?php if( $author || $date ) : ?>
				<div class="author-info">
					<?php
						Sine_Helper::the_date();			
						Sine_Helper::posted_by();
					?>
				</div>
			<?php endif; ?>
		</div>
		<?php Sine_Helper::the_category(); ?>	
	<?php endif; ?>
<?php endif; ?>