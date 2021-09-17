<?php


// kintoneから呼び出されるWebhook
class Tyo_Kason_Juku_Create_User {

	const FAMILY_REGISTER_FORM     = 49;
	const TEACHER_REGISTER_FORM    = 51;
	const ENTERPRISE_REGISTER_FORM = 47;


	public function __construct() {
		add_action( 'wpcf7_submit', array( $this, 'my_kintone_page_start' ), 10, 1 );
	}

	public function my_kintone_page_start( $contact_form ) {

		$submission = WPCF7_Submission::get_instance();
		if ( $contact_form && $submission ) {
			if ( $contact_form->id() !== self::FAMILY_REGISTER_FORM and $contact_form->id() !== self::TEACHER_REGISTER_FORM and $contact_form->id() !== self::ENTERPRISE_REGISTER_FORM ) {
				return false;
			}

			$form_data = $submission -> get_posted_data();

			$userdata  = array(
				'user_login' => $form_data['your-email'],
				'user_pass'  => $form_data['password'],
				'user_email' => $form_data['your-email']
			);

			$user_id    = wp_insert_user( $userdata );

			$login_type = '';

			if ( $contact_form->id() == self::FAMILY_REGISTER_FORM ) {
				$kintone = array(
					'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
					'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['FAMILY_MANAGEMENT']['ID'],
					'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['FAMILY_MANAGEMENT']['TOKEN'],
				);

				$login_type = 'family';
				$app_id     = TYO_KASON_JUKU_KINTONE_INFOR['APP']['FAMILY_MANAGEMENT']['ID'];

			} else if ( $contact_form->id() == self::TEACHER_REGISTER_FORM ) {
				$kintone = array(
					'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
					'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['TEACHER_MANAGEMENT']['ID'],
					'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['TEACHER_MANAGEMENT']['TOKEN'],
				);

				$login_type = 'teacher';
				$app_id     = TYO_KASON_JUKU_KINTONE_INFOR['APP']['TEACHER_MANAGEMENT']['ID'];

			} else if ( $contact_form->id() == self::ENTERPRISE_REGISTER_FORM ) {
				$kintone = array(
					'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
					'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['ENTERPRISE_MANAGEMENT']['ID'],
					'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['ENTERPRISE_MANAGEMENT']['TOKEN'],
				);

				$login_type = 'enterprise';
				$app_id     = TYO_KASON_JUKU_KINTONE_INFOR['APP']['ENTERPRISE_MANAGEMENT']['ID'];
			}

			$query   = 'メールアドレス = "' . $form_data['your-email'] . '"';

			$records = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );
			if ( is_wp_error( $records ) ) {
				error_log( $records -> get_error_message() );
			}

			$record  = reset( $records );

			if ( empty( $record ) ) {
				error_log( 'empty' );
				return;
			}

			$management_number = $app_id . '-' . $record['$id']['value'];

			$add_data = array(
				'management_number' => array(
					'value' => $management_number
				),
				'login_type' => array(
					'value' => $login_type
				)
			);

			$record = array_merge( $record, $add_data );
			update_user_meta( $user_id, 'kintone_row_data_basic_info', $record );

			if ( $contact_form->id() == self::FAMILY_REGISTER_FORM ) {
				$update_kintone = array(
					'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
					'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['FAMILY_MANAGEMENT']['ID'],
					'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['FAMILY_MANAGEMENT']['TOKEN'],
					'id'     => $record['$id']['value']
				);

			} else if ( $contact_form->id() == self::TEACHER_REGISTER_FORM ) {
				$update_kintone = array(
					'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
					'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['TEACHER_MANAGEMENT']['ID'],
					'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['TEACHER_MANAGEMENT']['TOKEN'],
					'id'     => $record['$id']['value']
				);

			} else if ( $contact_form->id() == self::ENTERPRISE_REGISTER_FORM ) {
				$update_kintone = array(
					'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
					'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['ENTERPRISE_MANAGEMENT']['ID'],
					'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['ENTERPRISE_MANAGEMENT']['TOKEN'],
					'id'     => $record['$id']['value']
				);
			}

			$update_result = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::put( $update_kintone, $add_data );
			if ( is_wp_error( $update_result ) ) {
				error_log( $update_result -> get_error_message() );
			}
		}
	}
}