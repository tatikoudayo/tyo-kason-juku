<?php

class Tyo_Kason_Juku_Customize {

	public function __construct() {
		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/create_user.php';
		new Tyo_Kason_Juku_Create_User();
	}
}