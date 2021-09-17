<?php

class Tyo_Kason_Juku_Show_Mypage {

	public function __construct() {

		require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/system/mypage/mypage-content.php';

		add_filter( 'wpmem_member_links', array( $this, 'display_mypage' ) );
		add_filter( 'wpmem_default_text', array( $this, 'wpmem_default_text' ) );
	}

	public function wpmem_default_text( $text ) {

		$text['login_heading']      = '';
		$text['login_username']     = 'メールアドレス<span style="color: red;">（※）</span>';
		$text['pwdreset_username']  = 'ユーザー名（初回登録時のメールアドレス）';
		$text['pwdreset_email']     = 'メールアドレス（変更していなければ、初回登録時のメールアドレスと同じ）';
		$text['forgot_link_before'] = 'パスワードを忘れた場合、パスワードをリセットできます。';
		$text['forgot_link']        = 'リセット';
		$text['login_failed']       = 'メールアドレスまたはパスワードに間違いがあります。';
		$text['login_button']       = 'ログイン';
		$text['remember_me']        = '次回からは自動ログイン';
		$text['login_password']     = 'パスワード';
		$text['profile_edit']       = 'プロフィールの変更はこちら';
		$text['profile_password']   = 'パスワードの変更はこちら';
		$text['menu_logout']          = 'ログアウト';

		return $text;
	}

	public function display_mypage( $content ) {
		$user_id   = wp_get_current_user() -> ID;
		$user_info = get_user_meta( $user_id, 'kintone_row_data_basic_info', true );

		$html = '';

		if ( $user_info['login_type']['value'] == 'family' ) {
			$html .= Tyo_Kason_Juku_Content_Mypage::family();
		} else if ( $user_info['login_type']['value'] == 'teacher' ) {
			$html .= Tyo_Kason_Juku_Content_Mypage::teacher();
		} else if ( $user_info['login_type']['value'] == 'enterprise' ) {
			$html .= Tyo_Kason_Juku_Content_Mypage::enterprise();
		}

		$content .= $html;
		return $content;
	}

	public static function family() {
		ob_start();
		?>
		<h1>家族</h1>
		<h1>家族</h1>
		<h1>家族</h1>
		<h1>家族</h1>
		<h1>家族</h1>
		<h1>家族</h1>
<?php
	}

	public static function teacher() {
		ob_start();
		?>
		<h1>先生</h1>
<?php
	}
	public static function enterprise() {
		ob_start();
		?>
		<h1>企業</h1>
<?php
	}
}