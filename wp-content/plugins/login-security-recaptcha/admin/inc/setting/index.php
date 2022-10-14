<?php
defined( 'ABSPATH' ) || die();

$menu_tab = ( ! empty( $_GET['tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'captcha';

$menu_tabs = array(
	'captcha'    => esc_html__( 'Captcha', 'login-security-recaptcha' ),
	'error_logs' => esc_html__( 'Error Logs', 'login-security-recaptcha' ),
	'reset'      => esc_html__( 'Reset', 'login-security-recaptcha' ),
);
?>

<div class="wrap stlsr">
	<?php if ( ! class_exists( 'STLSP_Login_Security_Pro' ) ) { ?>
	<div class="stlsr-pro stlsr-pro--top">
		<div class="stlsr-pro-description">
			<div class="stlsr-pro-heading">
			<?php
			echo wp_kses(
				__( '<span class="stlsr-pro-light">GET</span> <span class="stlsr-pro-bold">Login Security <span class="stlsr-pro-bold stlsr-pro-underline">Pro</span>', 'login-security-recaptcha' ),
				array( 'span' => array( 'class' => array() ) )
			);
			?>
			</div>
			<p class="stlsr-pro-desc"><?php esc_html_e( 'Limit Login Attempts by IP Address, Secure WooCommerce Login, Registration and Checkout Form, Check Login History by Username, Check and Monitor Last Login, Role-Based Redirection after Login and Logout, Plugin Documentation.', 'login-security-recaptcha' ); ?></p>
		</div>
		<div class="stlsr-pro-links">
			<a target="_blank" href="<?php echo esc_url( STLSR_Helper::get_pro_url() ); ?>" class="stlsr-pro-link stlsr-pro-bold"><?php esc_html_e( 'Buy Now', 'login-security-recaptcha' ); ?></a>
			<a target="_blank" href="<?php echo esc_url( STLSR_Helper::get_pro_detail_url() ); ?>" class="stlsr-pro-link stlsr-pro-link--alt"><?php esc_html_e( 'Learn More', 'login-security-recaptcha' ); ?></a>
		</div>
	</div>
	<?php } ?>

	<div class="stlsr-page-heading"><?php esc_html_e( 'Login Security reCAPTCHA', 'login-security-recaptcha' ); ?></div>

	<h2 class="nav-tab-wrapper">
	<?php
	foreach ( $menu_tabs as $key => $value ) {
		$class = ( $menu_tab === $key ) ? ' nav-tab-active' : '';
		?>
		<a class="nav-tab<?php echo esc_attr( $class ); ?>" href="?page=stlsr_settings&tab=<?php echo esc_attr( $key ); ?>">
			<?php echo esc_html( $value ); ?>
		</a>
		<?php
	}
	?>
	</h2>

	<div class="stlsr-section">
	<?php
	if ( 'captcha' === $menu_tab ) {
		require_once STLSR_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/captcha.php';
	} elseif ( 'error_logs' === $menu_tab ) {
		require_once STLSR_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/error-logs.php';
	} elseif ( 'reset' === $menu_tab ) {
		require_once STLSR_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/reset.php';
	}
	?>
	</div>
</div>
