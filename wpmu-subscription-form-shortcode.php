<?php
/*
Plugin Name: Subscription Form Shortcode
Plugin URI: https://github.com/ShoboySnr/wpmu-shortcode
Description: Display subscription form
Version: 1.0.0
Author: Damilare Shobowale
Contributors: Damilare Shobowale
Author URI: https://github.com/ShoboySnr
License: GPL2
*/

// Add Shortcode
function subform() {
    
    $user_display_name = __('Guest', 'wpmu-shortcode');
    
    // Check if the user is logged in
    if(is_user_logged_in()) {
      
      // check if the user_firstname is not empty and then set the current user's display name
      if(!empty(wp_get_current_user()->user_firstname)) {
          $user_display_name = wp_get_current_user()->user_firstname;
      } else {
          // if the user_firstname is empty, use User to indicate logged in user
          $user_display_name = __('User', 'wpmu-shortcode');
      }
    }
    
    // Get the blog name
    $blog_name = get_bloginfo( 'name' );
    
    ob_start();
    
    // Display the welcome message and subscription form
    echo '<p>Hey ' . $user_display_name . ', welcome to ' . $blog_name . '! You can subscribe to our newsletter here:</p>';
    ?>
    <form action="/thank-you">
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email">
        <input type="submit" value="Submit">
    </form>
    <?php
    
    return ob_get_clean();
}
add_shortcode( 'subscriptionform', 'subform' );