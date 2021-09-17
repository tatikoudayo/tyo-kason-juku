<?php

class Tyo_Kason_Juku_Content_Mypage {

	public function __construct() {
	}

	public static function family() {

		$kintone = array(
			'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
			'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['ID'],
			'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['TOKEN'],
		);

		$query = 'order by $id desc';

		$records = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );
?>
		<h2>募集中のイベント</h2>
		<table>
			<thead>
				<tr>
				<th>イベント名</th>
				<th>開催場所</th>
				<th>開催日</th>
				<th>参加ボタン</th>
				</tr>
			</thead>
<?php
		foreach( $records as $record ) {
			$url = '/family/offer_event/?event_id=' . $record['management_number']['value'];
?>
			<tbody>
				<tr>
				<td><?php echo $record['イベント名']['value']; ?></td>
				<td><?php echo $record['開催場所']['value']; ?></td>
				<td><?php echo $record['開催日']['value']; ?></td>
				<td><a class="send_btn_event" href="<?php echo esc_url( home_url( $url ) ); ?>" target="_blank">参加</a></td>
				</tr>
			</tbody>
<?php
		}
?>
		</table>
<?php

		Tyo_Kason_Juku_Content_Mypage::basic_info();
	}

	public static function teacher() {
		Tyo_Kason_Juku_Content_Mypage::basic_info();
	}
	public static function enterprise() {
		Tyo_Kason_Juku_Content_Mypage::basic_info();
	}

	public static function basic_info() {
		$user_id   = wp_get_current_user() -> ID;
		$user_info = get_user_meta( $user_id, 'kintone_row_data_basic_info', true );

		ob_start();
?>
		<h2>基本情報</h2>
		<table>
			<thead>
				<tr>
				<th>メタ情報</th>
				<th>値</th>
				</tr>
			</thead>
<?php
		foreach( $user_info as $info_name => $info_value ) {
			if ( $info_name != 'management_number' and $info_name != '更新者' and $info_name != '作成者' and $info_name != '更新日時' and $info_name != '$id' and $info_name != 'login_type' and $info_name != 'レコード番号' and $info_name != '$revision' and $info_name != '作成日時' ) {
?>
				<tbody>
					<tr>
					<td><?php echo $info_name; ?></td>
					<td><?php echo $info_value['value']; ?></td>
					</tr>
				</tbody>
<?php
			}
		}
?>
		</table>
<?php
	}

}