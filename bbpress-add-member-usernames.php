<?php
/*
Plugin Name: bbPress: Add Member Usernames
Description: Append @user_nicename to the author name on forum posts
Version:     1.0.2
Author:      The team at PIE
Author URI:  http://pie.co.de
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

/* PIE\BBPressAddMemberUsernames is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.

PIE\BBPressAddMemberUsernames is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with PIE\BBPressAddMemberUsernames. If not, see https://www.gnu.org/licenses/gpl-3.0.en.html */

namespace PIE\BBPressAddMemberUsernames;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Load Composer autoloader
 */
require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$update_checker = PucFactory::buildUpdateChecker(
    'https://pie.github.io/bbpress-add-member-usernames/update.json',
    __FILE__,
    'bbpress-add-member-usernames'
);

/**
 * Add the user's @name to the author role on forum posts
 *
 * @param string $author_role HTML markup for the author role
 * @param array $args array of arguments for display
 * 
 * @return string $author_role
 */
function add_username_to_forum_posts( $author_role, $args ) {
    if ( ! function_exists( 'bbp_get_reply_author_id' ) || ! function_exists( 'bbp_get_reply_id' ) ) {
        return $author_role;
    }
    $user_id = \bbp_get_reply_author_id( \bbp_get_reply_id( $args['reply_id'] ) );
    if ( $user_id ) {
        $user        = get_user_by( 'id', $user_id );
        $author_role = '<span class="user-nicename">@' . esc_html( $user->user_nicename ) . '</span>' . $author_role;
    }
    return $author_role;
}
add_filter( 'bbp_get_reply_author_role', __NAMESPACE__ . '\add_username_to_forum_posts', 10, 2 );
