<?php
/**
 * The login/logout/register links template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage ExS
 * @since 1.1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$header_login_custom_url     = exs_option( 'header_login_custom_url' );
$header_login_custom_text    = exs_option( 'header_login_custom_text' );
$header_logout_custom_url    = exs_option( 'header_logout_custom_url' );
$header_logout_custom_text   = exs_option( 'header_logout_custom_text' );
$header_register_custom_url  = exs_option( 'header_register_custom_url' );
$header_register_custom_text = exs_option( 'header_register_custom_text' );
$header_login_links_new_tab  = exs_option( 'header_login_links_new_tab' );

?>
<span class="login-links icon-inline">
<?php

exs_icon( 'account-outline' );

if ( ! is_user_logged_in() ) :
	//login link
	if ( class_exists( 'WooCommerce' ) ) {
		$login_page_id = get_option( 'woocommerce_myaccount_page_id' );
		$register = ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) );
	}
	$login_url = ! empty( $login_page_id ) ? get_permalink(  $login_page_id ) : wp_login_url( get_permalink() );
	if ( $header_login_custom_url ) {
		$login_url = $header_login_custom_url;
	}
	?>
	<span class="login-link">
		<a href="<?php echo esc_url( $login_url ); ?>"
		<?php if ( ! empty( $header_login_links_new_tab ) ): ?>
			target="_blank"
		<?php endif; ?>>
		<?php
			if ( empty( $header_login_custom_text ) ) {
				esc_html_e( 'Login', 'exs' );
			} else {
				echo esc_html( $header_login_custom_text );
			}
		?>
		</a>
	</span>
	<?php
	//register link
	if ( get_option( 'users_can_register' ) || ( ! empty( $register ) || ! empty( $login_page_id ) ) ) :
		$register_url = ( ! empty( $register ) && ! empty( $login_page_id ) ) ? get_permalink(  $login_page_id ) : wp_registration_url();
		if ( $header_register_custom_url ) {
			$register_url = $header_register_custom_url;
		}
		?>
	<span class="register-link">
		<a href="<?php echo esc_url( $register_url ); ?>"
		<?php if ( ! empty( $header_login_links_new_tab ) ): ?>
			target="_blank"
		<?php endif; ?>>
		<?php
		if ( empty( $header_register_custom_text ) ) {
			esc_html_e( 'Register', 'exs' );
		} else {
			echo esc_html( $header_register_custom_text );
		}
		?>
		</a>
	</span>
	<?php endif; //users_can_register ?>
<?php
else:
	//logout link
	$logout_url = empty( $header_logout_custom_url ) ? wp_logout_url( get_permalink() ) : $header_logout_custom_url;
	?>
	<span class="logout-link">
		<a href="<?php echo esc_url( $logout_url ); ?>"
		<?php if ( ! empty( $header_login_links_new_tab ) ): ?>
			target="_blank"
		<?php endif; ?>>
		<?php
			if ( empty( $header_logout_custom_text ) ) {
				esc_html_e( 'Logout', 'exs' );
			} else {
				echo esc_html( $header_logout_custom_text );
			}
		?>
		</a>
	</span>
<?php endif; // ! is_user_logged_in ?>
</span>
