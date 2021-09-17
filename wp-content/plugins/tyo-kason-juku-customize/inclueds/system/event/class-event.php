<?php

class Tyo_Kason_Juku_Event {

	public function __construct() {
		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/event/event-create.php';
		new Tyo_Kason_Juku_Create_Event();

		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/event/event-offer.php';
		new Tyo_Kason_Juku_Offer_Event();
	}
}