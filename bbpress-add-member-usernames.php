<?php
/*
Plugin Name: bbPress: Add Member Usernames
Description: Add @user_nicename where it is missing from forum posts within bbPress
Version:     0.1
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
 * Adjust HTML for author role on forum posts to add in the user's @ name
 */
function add_username_to_forum_posts( $author_role, $r ) {
    $user_id = bbp_get_reply_author_id( bbp_get_reply_id( $r['reply_id'] ) );
    if ( $user_id ) {
        $user        = get_user_by( 'id', $user_id );
        $author_role = '<span class="user-nicename">@' . $user->user_nicename . '</span>' . $author_role;
    }
    return $author_role;
}
add_filter( 'bbp_get_reply_author_role', __NAMESPACE__ . '\add_username_to_forum_posts', 10, 2 );
