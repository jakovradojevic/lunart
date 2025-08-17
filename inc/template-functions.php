<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Lunart
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function lunart_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    // Add custom CSS classes to body
    if (is_page_template('page-fullwidth.php')) {
        $classes[] = 'full-width-page';
    }

    return $classes;
}
add_filter('body_class', 'lunart_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function lunart_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'lunart_pingback_header');
