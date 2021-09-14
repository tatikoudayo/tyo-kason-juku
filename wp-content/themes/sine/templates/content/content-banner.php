<?php
/**
 * Template part for displaying inner banner in pages
 *
 * @since 1.0.0
 * 
 * @package Sine WordPress Theme
 */
?>
<div class="<?php echo esc_attr( Sine_Helper::get_inner_banner_class() ); ?>" <?php Sine_Helper::the_header_image(); ?>> 
	<div class="container">
		<?php
			Sine_Helper::the_inner_banner();
			Sine_Helper::the_breadcrumb();
		?>
	</div>
</div>
