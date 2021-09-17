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

			$user_id = wp_insert_user( $userdata );

			update_user_meta( $user_id, 'kintone_row_data_basic_info', $form_data );
			if ( $contact_form->id() == self::FAMILY_REGISTER_FORM ) {
				update_user_meta( $user_id, 'login_type', 'Family' );
			} else if ( $contact_form->id() == self::TEACHER_REGISTER_FORM ) {
				update_user_meta( $user_id, 'login_type', 'Teacher' );
			} else if ( $contact_form->id() == self::ENTERPRISE_REGISTER_FORM ) {
				update_user_meta( $user_id, 'login_type', 'Enterprise' );
			}
		}
	}
}