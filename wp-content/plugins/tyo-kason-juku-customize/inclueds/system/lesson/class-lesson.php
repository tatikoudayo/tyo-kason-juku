<?php

class Tyo_Kason_Juku_Lesson {

	public function __construct() {
		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/lesson/lesson-create.php';
		new Tyo_Kason_Juku_Create_Lesson();

		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/lesson/lesson-offer.php';
		new Tyo_Kason_Juku_Offer_Lesson();
	}
}