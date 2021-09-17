<?php

class Tyo_Kason_Juku_Template {
	public function __construct() {
		add_action( 'template_redirect', array( $this, 'page_transition' ) );
	}

	public function page_transition() {
	}
}