<?php


// kintoneから呼び出されるWebhook
class Tyo_Kason_Juku_Create_Event {

	const CREATE_EVENT_FORM = 82;


	public function __construct() {
		add_action( 'wpcf7_submit', array( $this, 'create_event' ), 10, 1 );
	}

	public function create_event( $contact_form ) {

		$submission = WPCF7_Submission::get_instance();
		if ( $contact_form && $submission ) {
			if ( $contact_form->id() !== self::CREATE_EVENT_FORM ) {
				return false;
			}

			$user_id   = wp_get_current_user() -> ID;
			$user_info = get_user_meta( $user_id, 'kintone_row_data_basic_info', true );

			$kintone = array(
				'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
				'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['ID'],
				'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['TOKEN'],
			);

			$query = 'order by $id desc';

			$records = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );
			if ( is_wp_error( $records ) ) {
				error_log( $records -> get_error_message() );
			}

			$record  = reset( $records );

			$app_id  = TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['ID'];

			$management_number            = $app_id . '-' . $record['$id']['value'];
			$enterprise_management_number = $user_info['management_number']['value'];

			$add_data = array(
				'management_number' => array(
					'value' => $management_number
				),
				'企業管理番号' => array(
					'value' => $enterprise_management_number
				)
			);

			$update_kintone = array(
				'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
				'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['ID'],
				'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['TOKEN'],
				'id'     => $record['$id']['value']
			);

			$update_result = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::put( $update_kintone, $add_data );
			if ( is_wp_error( $update_result ) ) {
				error_log( $update_result -> get_error_message() );
			}
		}
	}
}