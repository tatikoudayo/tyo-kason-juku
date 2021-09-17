<?php
/**
 * Plugin Name: Tyokasonjuku Customize
 * Plugin URI:
 * Description: 松下村塾用のプラグインです
 * Version:     1.0.0
 * Author:      Tachibana Koki
 * Author URI:  https://www.facebook.com/tachibana.koki.ti0
 * License:     GPLv2
 * Text Domain: tyo-kason-juku-customize
 * Domain Path: /languages
 */

define( 'TYO_KASON_JUKU_CUSTOMIZE_URL',  plugins_url( '', __FILE__ ) );
define( 'TYO_KASON_JUKU_CUSTOMIZE_PATH', dirname( __FILE__ ) );

$data = get_file_data(
	__FILE__,
	array(
		'ver'   => 'Version',
		'langs' => 'Domain Path',
	)
);

define( 'TYO_KASON_JUKU_CUSTOMIZE_VERSION', $data['ver'] );
define( 'TYO_KASON_JUKU_CUSTOMIZE_LANGS',   $data['langs'] );

function tyo_kason_juku_customize_init() {
	require_once dirname( __FILE__ ) . '/../../../wp-load.php';
	
	require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/class-tyo-kason-juku-customize.php';
	require_once TYO_KASON_JUKU_CUSTOMIZE_PATH . '/inclueds/define.php';
	require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );

	new Tyo_Kason_Juku_Customize();
}

add_action( 'plugins_loaded', 'tyo_kason_juku_customize_init', 10 );