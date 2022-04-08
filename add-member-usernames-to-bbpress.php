<?php
/*
Plugin Name: Add Member Usernames to BBPress Forum Posts
Description: Add @user_nicename where it is missing from forum posts within BBPress
Version:     0.1
Author:      The team at PIE
Author URI:  http://pie.co.de
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

/* WooCommerce/Stripe Add New Card as Default is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.

WooCommerce/Stripe Add New Card as Default is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with WooCommerce/Stripe Add New Card as Default. If not, see https://www.gnu.org/licenses/gpl-3.0.en.html */

namespace PIE\AddMemberUsernamesToBBPress;

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
add_filter( 'bbp_get_reply_author_role', '\PIE\AddMemberUsernamesToBBPress\add_username_to_forum_posts', 10, 2 );
