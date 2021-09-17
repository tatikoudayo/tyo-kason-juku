<?php


// kintoneから呼び出されるWebhook
class Tyo_Kason_Juku_Offer_Lesson {

	const OFFER_LESSON_FORM = 98;


	public function __construct() {
		add_action( 'wpcf7_submit', array( $this, 'offer_lesson' ), 10, 1 );
		add_action( 'wp_footer', array( $this, 'redirect_mypage') );
	}

	public function offer_lesson( $contact_form ) {

		$submission = WPCF7_Submission::get_instance();
		if ( $contact_form && $submission ) {
			if ( $contact_form->id() !== self::OFFER_LESSON_FORM ) {
				return false;
			}

			$form_data  = $submission -> get_posted_data();
			$user_id    = wp_get_current_user() -> ID;
			$user_info  = get_user_meta( $user_id, 'kintone_row_data_basic_info', true );


			$family_management_number = $user_info['management_number']['value'];
			$lesson_management_number = $form_data['lesson_management_number'];

			$kintone = array(
				'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
				'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['LESSON_RELATION_MANAGEMENT']['ID'],
				'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['LESSON_RELATION_MANAGEMENT']['TOKEN'],
			);

			$post_data = array(
				'授業管理番号' => array(
					'value' => $lesson_management_number
				),
				'家庭管理番号' => array(
					'value' => $family_management_number
				)
			);

			$post_result = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::post( $kintone, $post_data );
			if ( is_wp_error( $post_result ) ) {
				error_log( $post_result -> get_error_message() );
			}
		}
	}

	public function redirect_mypage() {
?>
	<script>
		document.addEventListener( 'wpcf7mailsent', function( event ) {
			if ( event.detail.contactFormId == '<?php echo self::OFFER_LESSON_FORM ?>' ) {
				location = '<?php echo home_url( '/mypage/' ); ?>';
			}
		}, false );
	</script>
<?php
	}
}