<?php
defined( 'ABSPATH' ) || die();
require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';

$captcha_list = STCFQ_Helper::captcha_list();

$steps_url = STCFQ_Helper::get_steps_url();

$google_recaptcha_v2_themes = STCFQ_Helper::google_recaptcha_v2_themes();

$captcha = get_option( 'stcfq_captcha' );

$google_recaptcha_v2 = STCFQ_Helper::google_recaptcha_v2();
?>

<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="stcfq-save-captcha-form">

	<?php $nonce = wp_create_nonce( 'save-captcha' ); ?>
	<input type="hidden" name="save-captcha" value="<?php echo esc_attr( $nonce ); ?>">

	<input type="hidden" name="action" value="stcfq-save-captcha">

	<table class="form-table">
		<tbody>

			<tr>
				<th scope="row"><?php esc_html_e( 'Captcha', 'contact-form-query' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Select Captcha', 'contact-form-query' ); ?></span>
						</legend>
						<?php
						foreach ( $captcha_list as $key => $value ) {
							?>
						<label>
							<input <?php checked( $captcha, $key, true ); ?> type="radio" name="captcha" value="<?php echo esc_attr( $key ); ?>">
							<span><?php echo esc_html( $value ); ?></span>
						</label>
							<?php
							end( $captcha_list );
							if ( key( $captcha_list ) !== $key ) {
								echo '<br>';
							}
						}
						?>
					</fieldset>
				</td>
			</tr>

			<tr class="stcfq_captcha stcfq_google_recaptcha_v2">
				<th scope="row">
					<label for="stcfq_google_recaptcha_v2_site_key"><?php esc_html_e( 'Site Key', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="google_recaptcha_v2_site_key" type="text" id="stcfq_google_recaptcha_v2_site_key" value="<?php echo esc_attr( $google_recaptcha_v2['site_key'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter Google reCAPTCHA v2 Site Key.', 'contact-form-query' ); ?>&nbsp;
						<a target="_blank" href="<?php echo esc_url( $steps_url ); ?>"><?php esc_html_e( 'Click Here', 'contact-form-query' ); ?></a>
					</p>
				</td>
			</tr>

			<tr class="stcfq_captcha stcfq_google_recaptcha_v2">
				<th scope="row">
					<label for="stcfq_google_recaptcha_v2_secret_key"><?php esc_html_e( 'Secret Key', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="google_recaptcha_v2_secret_key" type="text" id="stcfq_google_recaptcha_v2_secret_key" value="<?php echo esc_attr( $google_recaptcha_v2['secret_key'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter Google reCAPTCHA v2 Secret Key.', 'contact-form-query' ); ?>&nbsp;
						<a target="_blank" href="<?php echo esc_url( $steps_url ); ?>"><?php esc_html_e( 'Click Here', 'contact-form-query' ); ?></a>
					</p>
				</td>
			</tr>

			<tr class="stcfq_captcha stcfq_google_recaptcha_v2">
				<th scope="row">
					<label for="stcfq_google_recaptcha_v2_theme"><?php esc_html_e( 'Theme', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Select Google reCAPTCHA Version 2 Theme.', 'contact-form-query' ); ?></span>
						</legend>
						<?php
						foreach ( $google_recaptcha_v2_themes as $key => $value ) {
							?>
						<label>
							<input <?php checked( $google_recaptcha_v2['theme'], $key, true ); ?> type="radio" name="google_recaptcha_v2_theme" value="<?php echo esc_attr( $key ); ?>">
							<span><?php echo esc_html( $value ); ?></span>
						</label>
							<?php
							end( $google_recaptcha_v2_themes );
							if ( key( $google_recaptcha_v2_themes ) !== $key ) {
								echo '<br>';
							}
						}
						?>
					</fieldset>
					<p class="description"><?php esc_html_e( 'Select Google reCAPTCHA Version 2 Theme.', 'contact-form-query' ); ?></p>
				</td>
			</tr>

		</tbody>
	</table>

	<button type="submit" class="button button-primary" id="stcfq-save-captcha-btn"><?php esc_html_e( 'Save Changes', 'contact-form-query' ); ?></button>

</form>
