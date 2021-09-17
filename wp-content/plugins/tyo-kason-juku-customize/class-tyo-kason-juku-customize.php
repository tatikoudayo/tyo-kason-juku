<?php

class Tyo_Kason_Juku_Customize {

	public function __construct() {

		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/template/template-redirect.php';
		new Tyo_Kason_Juku_Template();

		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/mypage/class-mypage.php';
		new Tyo_Kason_Juku_Mypage();

		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/event/class-event.php';
		new Tyo_Kason_Juku_Event();
	}
}