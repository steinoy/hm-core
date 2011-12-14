<?php

/**
 * Create the rewrite rules for the user accounts section
 *
 * Will only create rules for the template files that exist
 *
 * @return null
 */
function hma_rewrite_rules() {

	if ( file_exists( $login = hma_get_login_template() ) )
		hm_add_rewrite_rule( '^' . hma_get_login_rewrite_slug() .'/?$', 'is_login=1', $login, array( 'post_query_properties' => array( 'is_home' => false, 'is_404' => false, 'is_login' => true ) ) );

	if ( file_exists( $login_inline = hma_get_login_inline_template() ) )
		hm_add_rewrite_rule( '^' . hma_get_login_inline_rewrite_slug() . '/?$', 'is_login=1', $login_inline, array( 'post_query_properties' => array( 'is_home' => false, 'is_404' => false, 'is_login' => true ) ) );

	if ( file_exists( $lost_pass = hma_get_lost_password_template() ) )
		hm_add_rewrite_rule( '^' . hma_get_lost_password_rewrite_slug() . '/?$', 'is_lost_password=1',  $lost_pass, array( 'post_query_properties' => array( 'is_home' => false, 'is_404' => false, 'is_lost_password' => true ) ) );

	if ( file_exists( $lost_pass_inline =  hma_get_lost_password_inline_template() ) )
		hm_add_rewrite_rule( '^' . hma_get_lost_password_inline_rewrite_slug() . '/?$', 'is_lost_password=1',  $lost_pass_inline, array( 'post_query_properties' => array( 'is_home' => false, 'is_404' => false, 'is_lost_password' => true ) ) );

	if ( file_exists( $register = hma_get_register_template() ) )
		hm_add_rewrite_rule( '^' . hma_get_register_rewrite_slug() . '/?$', 'is_register=1', $register, array( 'post_query_properties' => array( 'is_home' => false, 'is_404' => false, 'is_register' => true ) ) );

	if ( file_exists( $register_inline = hma_get_register_inline_template() ) )
		hm_add_rewrite_rule( '^' . hma_get_register_inline_rewrite_slug() . '/?$', 'is_register=1', $register_inline, array( 'post_query_properties' => array( 'is_home' => false, 'is_404' => false, 'is_register' => true ) ) );

	if ( file_exists( $edit_profile = hma_get_edit_profile_template() ) )
		hm_add_rewrite_rule( '^' . hma_get_edit_profile_rewrite_slug() . '/?$', 'is_profile=1', $edit_profile, array( 'post_query_properties' => array( 'is_home' => false, 'is_edit_profile' => true ) ) );

	if ( file_exists( $profile = hma_get_user_profile_template() ) )
		hm_add_rewrite_rule( '^' . hma_get_user_profile_rewrite_slug() . '/([^\/]*)(/page/([\d]*))?/?$', 'author_name=$matches[1]&paged=$matches[3]', $profile, array( 'post_query_properties' => array( 'is_home' => false, 'is_user_profile' => true ) ) );

	// Single Sign On
	hm_add_rewrite_rule( '^login/sso/twitter/authenticate/?$', 'is_login=1&is_twitter_popup=1', null, array( 'post_query_properties' => array( 'is_login' => true ) ) );
	hm_add_rewrite_rule( '^login/sso/twitter/authenticate/callback/?$', 'is_login=1&is_twitter_popup=1', null, array( 'post_query_properties' => array( 'is_login' => true ) ) );
	hm_add_rewrite_rule( '^login/sso/authenticated/?$', 'is_login=1', null, array( 'post_query_properties' => array( 'is_login' => true ) ) );
	hm_add_rewrite_rule( '^register/sso/authenticated/?$', 'is_register=1', null, array( 'post_query_properties' => array( 'is_register' => true ) ) );

	hm_add_rewrite_rule( '^profile/sso/authenticated/?$', 'is_login=1' );
	hm_add_rewrite_rule( '^profile/sso/deauthenticate/?$', 'is_login=1' );

	do_action( 'hma_added_rewrite_rules' );

}
add_action( 'init', 'hma_rewrite_rules', 2 );

/**
 * Return the rewrite slug for the login page
 *
 * @return string
 */
function hma_get_login_rewrite_slug() {
	return apply_filters( 'hma_login_rewrite_slug', 'login' );
}

/**
 * Return the rewrite slug for the inline login page
 *
 * @return string
 */
function hma_get_login_inline_rewrite_slug() {
	return apply_filters( 'hma_login_inline_rewrite_slug', 'login-inline' );
}

/**
 * Return the rewrite slug for the lost password page
 *
 * @return string
 */
function hma_get_lost_password_rewrite_slug() {
	return apply_filters( 'hma_lost_password_rewrite_slug', 'login/lost-password' );
}

/**
 * Return the rewrite slug for the inline lost password page
 *
 * @return string
 */
function hma_get_lost_password_inline_rewrite_slug() {
	return apply_filters( 'hma_lost_password_inline_rewrite_slug', 'login/lost-password-inline' );
}

/**
 * Return the rewrite slug for the register page
 *
 * @return string
 */
function hma_get_register_rewrite_slug() {
	return apply_filters( 'hma_register_rewrite_slug', 'register' );
}

/**
 * Return the rewrite slug for the inline register page
 *
 * @return string
 */
function hma_get_register_inline_rewrite_slug() {
	return apply_filters( 'hma_register_inline_rewrite_slug', 'register-inline' );
}

/**
 * Return the rewrite slug for the edit profile page
 *
 * @return string
 */
function hma_get_edit_profile_rewrite_slug() {
	return apply_filters( 'hma_edit_profile_rewrite_slug', 'profile' );
}

/**
 * Return the rewrite slug for the user profile page
 *
 * @return string
 */
function hma_get_user_profile_rewrite_slug() {
	return apply_filters( 'hma_user_profile_rewrite_slug', 'users' );
}

/**
 * Return the path to the login template
 *
 * @return string
 */
function hma_get_login_template() {
	return apply_filters( 'hma_login_template', get_stylesheet_directory() . '/login.php' );
}

/**
 * Return the path to the login inline template
 *
 * @return string
 */
function hma_get_login_inline_template() {
	return  apply_filters( 'hma_login_inline_template', get_stylesheet_directory() . '/login-popup.php' );
}

/**
 * Return the path to the lost password template
 *
 * @return string
 */
function hma_get_lost_password_template() {
	return  apply_filters( 'hma_lost_password_template', get_stylesheet_directory() . '/login.lost-password.php' );
}

/**
 * Return the path to the lost password inline template
 *
 * @return string
 */
function hma_get_lost_password_inline_template() {
	return  apply_filters( 'hma_lost_password_inline_template', get_stylesheet_directory() . '/login.lost-password-popup.php' );
}

/**
 * Return the path to the register template
 *
 * @return string
 */
function hma_get_register_template() {
	return  apply_filters( 'hma_register_template', get_stylesheet_directory() . '/register.php' );
}

/**
 * Return the path to the register inline template
 *
 * @return string
 */
function hma_get_register_inline_template() {
	return  apply_filters( 'hma_register_inline_template', get_stylesheet_directory() . '/register-popup.php' );
}

/**
 * Return the path to the user profile template
 *
 * @return string
 */
function hma_get_user_profile_template() {
	return apply_filters( 'hma_user_profile_template', get_stylesheet_directory() . '/profile.php' );
}

/**
 * Return the path to the edit profile template
 *
 * @return string
 */
function hma_get_edit_profile_template() {
	return apply_filters( 'hma_edit_profile_template', get_stylesheet_directory() . '/profile.edit.php' );
}

/**
 * Some rewrites can only be accessed by logged out users
 *
 * @param string $template
 * @param string $rule
 * @return null
 */
function hma_restrict_access_for_logged_in_users_to_pages( $template, $rule ) {

	if ( is_user_logged_in() && in_array( $template, array( hma_get_login_template(), hma_get_lost_password_template(), hma_get_register_template() ) ) ) {

		// If there is a "redirect_to" redirect there
		if ( $_REQUEST['redirect_to'] )
			$redirect = hm_parse_redirect( urldecode( $_REQUEST['redirect_to'] ) );

		elseif ( wp_get_referer() && !in_array( preg_replace( '/\?[\s\S]*/', '', wp_get_referer() ), array( get_bloginfo( 'login_url', 'display' ), get_bloginfo( 'lost_password_url', 'display' ), get_bloginfo( 'register_url', 'display' ) ) ) )
			$redirect = wp_get_referer();

		else
			$redirect =  get_bloginfo( 'url' );

		wp_redirect( $redirect );
		exit;
	}

}
add_action( 'hm_load_custom_template', 'hma_restrict_access_for_logged_in_users_to_pages', 10, 2 );

/**
 * Some rewrites can only be accessed by logged in users
 *
 * @param string $template
 * @param string $rule
 * @return null
 */
function hma_restrict_access_for_logged_out_users_to_pages( $template, $rule ) {

	if ( !is_user_logged_in() && in_array( $template, array( hma_get_edit_profile_template() ) ) ) {

		wp_redirect( wp_get_referer() && !in_array( preg_replace( '/\?[\s\S]*/', '', wp_get_referer() ), array( get_bloginfo( 'edit_profile_url', 'display' ) ) ) ? wp_get_referer() : get_bloginfo( 'url' ) );
		exit;

	}

}
add_action( 'hm_load_custom_template', 'hma_restrict_access_for_logged_out_users_to_pages', 10, 2 );