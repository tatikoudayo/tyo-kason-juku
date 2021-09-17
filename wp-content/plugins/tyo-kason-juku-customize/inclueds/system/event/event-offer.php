<?php


// kintoneから呼び出されるWebhook
class Tyo_Kason_Juku_Offer_Event {

	const OFFER_EVENT_FORM = 86;


	public function __construct() {
		add_action( 'wpcf7_submit', array( $this, 'offer_event' ), 10, 1 );
	}

	public function offer_event( $contact_form ) {

		$submission = WPCF7_Submission::get_instance();
		if ( $contact_form && $submission ) {
			if ( $contact_form->id() !== self::OFFER_EVENT_FORM ) {
				return false;
			}

			$form_data   = $submission -> get_posted_data();

			$user_id   = wp_get_current_user() -> ID;
			$user_info = get_user_meta( $user_id, 'kintone_row_data_basic_info', true );

			$event_id = $form_data['event_id'];
			error_log( $event_id );
		}
	}
}