<?php

class Tyo_Kason_Juku_Content_Mypage {

	public function __construct() {
	}

	public static function family() {

		$user_id   = wp_get_current_user() -> ID;
		$user_info = get_user_meta( $user_id, 'kintone_row_data_basic_info', true );

		$kintone = array(
			'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
			'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['LESSON_MANAGEMENT']['ID'],
			'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['LESSON_MANAGEMENT']['TOKEN'],
		);

		$query = 'order by $id desc';

		$records = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );

		$kintone = array(
			'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
			'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['LESSON_RELATION_MANAGEMENT']['ID'],
			'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['LESSON_RELATION_MANAGEMENT']['TOKEN'],
		);
?>
		<h2>授業のスケジュール</h2>
		<table>
			<thead>
				<tr>
				<th>授業名</th>
				<th>開催日</th>
				<th>食事の有無</th>
				<th>参加状況</th>
				</tr>
			</thead>
<?php
		foreach( $records as $record ) {
			$query                  = '家庭管理番号 = "' . $user_info['management_number']['value'] . '" and 授業管理番号 = "' . $record['management_number']['value'] . '"';
			$lesson_relation_records = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );

			if ( empty( $lesson_relation_records ) ) {
				$url            = '/family/offer_lesson/?lesson_management_number=' . $record['management_number']['value'];
				$class          = 'send_btn_event_cancel';
				$button_message = '不参加';
			} else {
				$url            = '/family/delete_lesson/?lesson_management_number=' . $record['management_number']['value'];
				$class          = 'send_btn_event_offer';
				$button_message = '参加';
			}
?>
			<tbody>
				<tr>
				<td><?php echo $record['授業タイトル']['value']; ?></td>
				<td><?php echo $record['開催日']['value']; ?></td>
				<td><?php echo $record['食事の提供']['value']; ?></td>
				<td><a class=<?php echo $class; ?> href="<?php echo esc_url( home_url( $url ) ); ?>"><?php echo $button_message; ?></a></td>
				</tr>
			</tbody>
<?php
		}
?>
		</table>
<?php
		$kintone = array(
			'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
			'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['ID'],
			'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['TOKEN'],
		);

		$query = 'order by $id desc';

		$records = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );

		$kintone = array(
			'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
			'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_RELATION_MANAGEMENT']['ID'],
			'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_RELATION_MANAGEMENT']['TOKEN'],
		);
?>
		<h2>募集中のイベント</h2>
		<table>
			<thead>
				<tr>
				<th>イベント名</th>
				<th>開催場所</th>
				<th>開催日</th>
				<th>参加状況</th>
				</tr>
			</thead>
<?php
		foreach( $records as $record ) {
			$query                  = '家庭管理番号 = "' . $user_info['management_number']['value'] . '" and イベント管理番号 = "' . $record['management_number']['value'] . '"';
			$event_relation_records = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );

			if ( empty( $event_relation_records ) ) {
				$url            = '/family/offer_event/?event_management_number=' . $record['management_number']['value'];
				$class          = 'send_btn_event_cancel';
				$button_message = '不参加';
			} else {
				$url            = '/family/delete_event/?event_management_number=' . $record['management_number']['value'];
				$class          = 'send_btn_event_offer';
				$button_message = '参加';
			}
?>
			<tbody>
				<tr>
				<td><?php echo $record['イベント名']['value']; ?></td>
				<td><?php echo $record['開催場所']['value']; ?></td>
				<td><?php echo $record['開催日']['value']; ?></td>
				<td><a class=<?php echo $class; ?> href="<?php echo esc_url( home_url( $url ) ); ?>"><?php echo $button_message; ?></a></td>
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
		$user_id   = wp_get_current_user() -> ID;
		$user_info = get_user_meta( $user_id, 'kintone_row_data_basic_info', true );

		$kintone = array(
			'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
			'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['LESSON_MANAGEMENT']['ID'],
			'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['LESSON_MANAGEMENT']['TOKEN'],
		);

		$query = '塾管理番号 = "' . $user_info['management_number']['value']  . '"';

		$records = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );


		$kintone = array(
			'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
			'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['LESSON_RELATION_MANAGEMENT']['ID'],
			'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['LESSON_RELATION_MANAGEMENT']['TOKEN'],
		);
?>
		<a class='send_btn' href="<?php echo esc_url( home_url( '/class/create_lesson/' ) ); ?>">授業を作成する</a>
		<h1>掲載している授業</h1>
		<table>
			<thead>
				<tr>
				<th>授業名</th>
				<th>開催日</th>
				<th>食事の提供</th>
				<th>現在の参加者数</th>
				</tr>
			</thead>
<?php
		foreach( $records as $record ) {
			$query        = '授業管理番号 = "' . $record['management_number']['value'] . '"';
			$participants = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );
?>
		<tbody>
			<tr>
			<td><?php echo $record['授業タイトル']['value']; ?></td>
			<td><?php echo $record['開催日']['value']; ?></td>
			<td><?php echo $record['食事の提供']['value']; ?></td>
			<td><?php echo count( $participants ); ?></td>
			</tr>
		</tbody>
<?php
		}
?>
		</table>
<?php

		Tyo_Kason_Juku_Content_Mypage::basic_info();
	}
	public static function enterprise() {

		$user_id   = wp_get_current_user() -> ID;
		$user_info = get_user_meta( $user_id, 'kintone_row_data_basic_info', true );

		$kintone = array(
			'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
			'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['ID'],
			'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_MANAGEMENT']['TOKEN'],
		);

		$query = '企業管理番号 = "' . $user_info['management_number']['value']  . '"';

		$records = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );


		$kintone = array(
			'domain' => TYO_KASON_JUKU_KINTONE_INFOR['DOMAIN'],
			'app'    => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_RELATION_MANAGEMENT']['ID'],
			'token'  => TYO_KASON_JUKU_KINTONE_INFOR['APP']['EVENT_RELATION_MANAGEMENT']['TOKEN'],
		);
?>
		<a class='send_btn' href="<?php echo esc_url( home_url( '/class/create_event/' ) ); ?>">イベントを作成する</a>
		<h1>掲載しているイベント</h1>
		<table>
			<thead>
				<tr>
				<th>イベント名</th>
				<th>開催場所</th>
				<th>開催日</th>
				<th>現在の参加者数</th>
				</tr>
			</thead>
<?php
		foreach( $records as $record ) {
			$query        = 'イベント管理番号 = "' . $record['management_number']['value'] . '"';
			$participants = Tkc49\Kintone_SDK_For_WordPress\Kintone_API::getRecords( $kintone, $query, - 1 );
?>
		<tbody>
			<tr>
			<td><?php echo $record['イベント名']['value']; ?></td>
			<td><?php echo $record['開催場所']['value']; ?></td>
			<td><?php echo $record['開催日']['value']; ?></td>
			<td><?php echo count( $participants ); ?></td>
			</tr>
		</tbody>
<?php
		}
?>
		</table>
<?php
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
				<th>情報名</th>
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