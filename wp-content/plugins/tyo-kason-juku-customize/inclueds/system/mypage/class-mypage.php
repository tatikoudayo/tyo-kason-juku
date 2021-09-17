<?php

class Tyo_Kason_Juku_Mypage {

	public function __construct() {
		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/mypage/mypage-create_user.php';
		new Tyo_Kason_Juku_Create_User();

		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/mypage/mypage-show.php';
		new Tyo_Kason_Juku_Show_Mypage();
	}
}