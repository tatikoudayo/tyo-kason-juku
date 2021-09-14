<?php
/**
 * Register font size and choice to display logo or title.
 *
 * @since 1.0.0
 *
 * @package Sine WordPress theme
 */

/**
* Register Site Identity Options
*
* @return void
* @since 1.0.0
*
* @package Sine WordPress theme
*/
function sine_site_identity(){
	Sine_Customizer::set(array(
		# Site Identity > title size || title or logo
		'section' => array(
			'id' => 'title_tagline',
			'prefix' => false,
		),
		'fields'  => array(
		    array(
		        'id'	  	  => 'title-size',
		        'label'   	  => esc_html__( 'Title Size', 'sine' ),
		        'description' => esc_html__( 'The value is in px.' , 'sine' ),
		        'default' => array(
		    		'desktop' => 22,
		    		'tablet'  => 22,
		    		'mobile'  => 22,
		    	),
				'input_attrs' =>  array(
		            'min'   => 1,
		            'max'   => 60,
		            'step'  => 1,
		        ),
		        'type'    => 'sine-slider',
		    ),
	        array(
	            'id'	  	  => 'tagline-size',
	            'label'   	  => esc_html__( 'Tagline Size', 'sine' ),
	            'description' => esc_html__( 'The value is in px.' , 'sine' ),
	            'default' => array(
	        		'desktop' => 14,
	        		'tablet'  => 14,
	        		'mobile'  => 14,
	        	),
	    		'input_attrs' =>  array(
	                'min'   => 1,
	                'max'   => 35,
	                'step'  => 1,
	            ),
	            'type'    => 'sine-slider',
	        ),
            array(
    	        'id'	  	  => 'logo-size',
    	        'label'   	  => esc_html__( 'Logo Size', 'sine' ),
    	        'description' => esc_html__( 'The value is in px.' , 'sine' ),
    	        'default' => array(
    	    		'desktop' => 200,
    	    		'tablet'  => 200,
    	    		'mobile'  => 200,
    	    	),
    			'input_attrs' =>  array(
    	            'min'   => 1,
    	            'max'   => 500,
    	            'step'  => 1,
    	        ),
    	        'type'    => 'sine-slider',
    	    )
		)	
	));
}
add_action( 'init', 'sine_site_identity' );