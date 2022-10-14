<?php
defined( 'ABSPATH' ) || die();

class STCFQ_Language {
	public static function load_translation() {
		load_plugin_textdomain( 'contact-form-query', false, basename( STCFQ_PLUGIN_DIR_PATH ) . '/languages' );
	}
}
