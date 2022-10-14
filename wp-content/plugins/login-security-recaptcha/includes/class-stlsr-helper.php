<?php
defined( 'ABSPATH' ) || die();

class STLSR_Helper {
	public static function captcha_list() {
		return array(
			'google_recaptcha_v2'  => esc_html__( 'Google reCAPTCHA Version 2', 'login-security-recaptcha' ),
			'google_recaptcha_v3'  => esc_html__( 'Google reCAPTCHA Version 3', 'login-security-recaptcha' ),
		);
	}

	public static function google_recaptcha_v2_themes() {
		return array(
			'light' => esc_html__( 'Light', 'login-security-recaptcha' ),
			'dark'  => esc_html__( 'Dark', 'login-security-recaptcha' ),
		);
	}

	public static function google_recaptcha_v3_scores() {
		return array(
			'0.1' => esc_html__( '0.1', 'login-security-recaptcha' ),
			'0.2' => esc_html__( '0.2', 'login-security-recaptcha' ),
			'0.3' => esc_html__( '0.3', 'login-security-recaptcha' ),
			'0.4' => esc_html__( '0.4', 'login-security-recaptcha' ),
			'0.5' => esc_html__( '0.5', 'login-security-recaptcha' ),
		);
	}

	public static function google_recaptcha_v3_badges() {
		return array(
			'inline'      => esc_html__( 'Inline', 'login-security-recaptcha' ),
			'bottomleft'  => esc_html__( 'Bottom - Left', 'login-security-recaptcha' ),
			'bottomright' => esc_html__( 'Bottom - Right', 'login-security-recaptcha' ),
		);
	}

	public static function get_steps_url() {
		return 'https://scriptstown.com/how-to-get-site-and-secret-key-for-google-recaptcha/';
	}

	public static function get_pro_detail_url() {
		return 'https://scriptstown.com/wordpress-plugins/login-security-pro/';
	}

	public static function get_pro_url() {
		return 'https://scriptstown.com/account/signup/login-security-pro';
	}

	public static function get_ip_address() {
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = sanitize_text_field( $_SERVER['HTTP_CLIENT_IP'] );
		} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = sanitize_text_field( $_SERVER['HTTP_X_FORWARDED_FOR'] );
		} else {
			$ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '0.0.0.0';
		}

		$ip = filter_var( $ip, FILTER_VALIDATE_IP );
		$ip = ( false === $ip ) ? '0.0.0.0' : $ip;

		return $ip;
	}

	public static function wp_date( $format, $timestamp = null, $timezone = null ) {
		if ( function_exists( '\\wp_date' ) ) {
			return wp_date( $format, $timestamp, $timezone );
		}

		global $wp_locale;

		if ( null === $timestamp ) {
			$timestamp = time();
		} elseif ( ! is_numeric( $timestamp ) ) {
			return false;
		}

		if ( ! $timezone ) {
			$timezone = wp_timezone();
		}

		$datetime = date_create( '@' . $timestamp );
		$datetime->setTimezone( $timezone );

		if ( empty( $wp_locale->month ) || empty( $wp_locale->weekday ) ) {
			$date = $datetime->format( $format );
		} else {
			$format = preg_replace( '/(?<!\\\\)r/', DATE_RFC2822, $format );

			$new_format    = '';
			$format_length = strlen( $format );
			$month         = $wp_locale->get_month( $datetime->format( 'm' ) );
			$weekday       = $wp_locale->get_weekday( $datetime->format( 'w' ) );

			for ( $i = 0; $i < $format_length; $i ++ ) {
				switch ( $format[ $i ] ) {
					case 'D':
						$new_format .= addcslashes( $wp_locale->get_weekday_abbrev( $weekday ), '\\A..Za..z' );
						break;
					case 'F':
						$new_format .= addcslashes( $month, '\\A..Za..z' );
						break;
					case 'l':
						$new_format .= addcslashes( $weekday, '\\A..Za..z' );
						break;
					case 'M':
						$new_format .= addcslashes( $wp_locale->get_month_abbrev( $month ), '\\A..Za..z' );
						break;
					case 'a':
						$new_format .= addcslashes( $wp_locale->get_meridiem( $datetime->format( 'a' ) ), '\\A..Za..z' );
						break;
					case 'A':
						$new_format .= addcslashes( $wp_locale->get_meridiem( $datetime->format( 'A' ) ), '\\A..Za..z' );
						break;
					case '\\':
						$new_format .= $format[ $i ];

						if ( $i < $format_length ) {
							$new_format .= $format[ ++$i ];
						}
						break;
					default:
						$new_format .= $format[ $i ];
						break;
				}
			}

			$date = $datetime->format( $new_format );
			$date = wp_maybe_decline_date( $date, $format );
		}

		$date = apply_filters( 'wp_date', $date, $format, $timestamp, $timezone );

		return $date;
	}

	public static function is_wp_login() {
		$abspath = str_replace( array( '\\', '/' ), DIRECTORY_SEPARATOR, ABSPATH );
		return ( ( in_array( $abspath . 'wp-login.php', get_included_files() ) ) || ( isset( $_GLOBALS['pagenow'] ) && 'wp-login.php' === $GLOBALS['pagenow'] ) || '/wp-login.php' === $_SERVER['PHP_SELF'] );
	}
}
