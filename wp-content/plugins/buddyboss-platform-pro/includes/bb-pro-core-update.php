<?php
/**
 * BuddyBoss Platform Pro Core Update functions.
 *
 * @package BuddyBossPro/Core
 * @since   1.0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Is this a fresh installation of BuddyBoss Platform Pro?
 *
 * If there is no raw DB version, we infer that this is the first installation.
 *
 * @since 1.0.4
 *
 * @return bool True if this is a fresh install, otherwise false.
 */
function bbp_pro_is_install() {
	return ! bbp_pro_get_db_version_raw();
}

/**
 * Is this a BuddyBoss Platform pro update?
 *
 * Determined by comparing the registered BB Platform pro version to the version
 * number stored in the database. If the registered version is greater, it's
 * an update.
 *
 * @since 1.0.4
 *
 * @return bool True if update, otherwise false.
 */
function bbp_pro_is_update() {

	// Current DB version of this site (per site in a multisite network).
	$current_db   = bp_get_option( '_bbp_pro_db_version' );
	$current_live = bbp_pro_get_db_version();

	// Compare versions (cast as int and bool to be safe).
	$is_update = (bool) ( (int) $current_db < (int) $current_live );

	// Return the product of version comparison.
	return $is_update;
}

/**
 * Update the BB Platform pro version stored in the database to the current version.
 *
 * @since 1.0.4
 */
function bbp_pro_version_bump() {
	bp_update_option( '_bbp_pro_db_version', bbp_pro_get_db_version() );
}

/**
 * Set up the BB PLatform pro updater.
 *
 * @since 1.0.4
 */
function bbp_pro_setup_updater() {

	// Are we running an outdated version of BB Platform pro?
	if ( ! bbp_pro_is_update() ) {
		return;
	}

	bbp_pro_version_updater();
}

/**
 * Initialize an update or installation of BB Platform pro.
 *
 * BB Platform pro's version updater looks at what the current database version is,
 * and runs whatever other code is needed - either the "update" or "install"
 * code.
 *
 * This is most often used when the data schema changes, but should also be used
 * to correct issues with BB Platform pro metadata silently on software update.
 *
 * @since 1.0.4
 */
function bbp_pro_version_updater() {

	// Get the raw database version.
	$raw_db_version = (int) bbp_pro_get_db_version_raw();
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$switched_to_root_blog = false;

	// Make sure the current blog is set to the root blog.
	if ( ! bp_is_root_blog() ) {
		switch_to_blog( bp_get_root_blog_id() );

		$switched_to_root_blog = true;
	}

	if ( bbp_pro_is_install() ) {

		// Run the schema install to update tables.
		bbp_pro_core_install();

		// Upgrades.
	} else {

		// Run the schema install to update tables.
		bbp_pro_core_install();

		// Version 1.0.2 .
		if ( $raw_db_version < 111 ) {
			bbp_pro_update_to_1_0_4();
		}

		// Version 1.0.7 .
		if ( $raw_db_version < 217 ) {
			bbp_pro_update_to_1_0_7();
		}

		// Version 1.0.9 .
		if ( $raw_db_version < 231 ) {
			/**
			 * BuddyBoss Pro Update to version 1.0.9.
			 *
			 * @since 1.0.9
			 */
			do_action( 'bbp_pro_update_to_1_0_9' );
		}

		// Version 1.2.0 .
		if ( $raw_db_version < 241 ) {
			do_action( 'bbp_pro_update_to_1_2_0' );
		}
	}

	/* All done! *************************************************************/

	// Bump the version.
	bbp_pro_version_bump();

	if ( $switched_to_root_blog ) {
		restore_current_blog();
	}
}

/**
 * Main installer.
 *
 * @since 1.0.4
 */
function bbp_pro_core_install() {
	/**
	 * BuddyBoss Pro core install.
	 *
	 * @since 1.0.4
	 */
	do_action( 'bbp_pro_core_install' );
}

/**
 * Update migration for version 1.0.4
 *
 * @since 1.0.4
 */
function bbp_pro_update_to_1_0_4() {
	/**
	 * BuddyBoss Pro Update to version 1.0.4.
	 *
	 * @since 1.0.4
	 */
	do_action( 'bbp_pro_update_to_1_0_4' );
}

/**
 * Update migration for version 1.0.7
 *
 * @since 1.0.7
 */
function bbp_pro_update_to_1_0_7() {
	/**
	 * BuddyBoss Pro Update to version 1.0.7.
	 *
	 * @since 1.0.7
	 */
	do_action( 'bbp_pro_update_to_1_0_7' );
}
