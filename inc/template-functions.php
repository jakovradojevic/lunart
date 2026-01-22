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

/**
 * Add Open Graph meta tags for better social sharing
 */
function lunart_og_tags() {
    // Ne dodajemo og tagove ako je u pitanju admin panel ili feed
    if (is_admin() || is_feed()) {
        return;
    }

    $title = '';
    $description = '';
    $image = '';
    $url = '';
    $type = 'website';

    if (is_front_page() || is_home()) {
        $title = get_bloginfo('name');
        $description = get_bloginfo('description');
        $url = home_url('/');
        $type = 'website';
    } elseif (is_singular()) {
        $title = get_the_title();
        $url = get_permalink();
        $type = 'article';
        
        // Description
        $post = get_post();
        if (has_excerpt($post->ID)) {
            $description = get_the_excerpt();
        } else {
            $description = wp_trim_words(strip_shortcodes($post->post_content), 25);
        }
        
        // Image
        if (has_post_thumbnail()) {
            $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            if ($image_src) {
                $image = $image_src[0];
            }
        }
    } elseif (is_tax() || is_category() || is_tag()) {
        $term = get_queried_object();
        $title = $term->name;
        $description = $term->description;
        $url = get_term_link($term);
        
        // Specifična provera za gallery_category - pokušaj da uzmeš sliku iz najnovijeg posta u toj kategoriji
        if ($term->taxonomy === 'gallery_category') {
            $latest_post = get_posts(array(
                'post_type' => 'gallery_item',
                'posts_per_page' => 1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'gallery_category',
                        'field' => 'term_id',
                        'terms' => $term->term_id,
                    ),
                ),
            ));
            if (!empty($latest_post)) {
                $image_id = get_post_thumbnail_id($latest_post[0]->ID);
                if ($image_id) {
                    $image_src = wp_get_attachment_image_src($image_id, 'full');
                    if ($image_src) {
                        $image = $image_src[0];
                    }
                }
            }
        }
    } elseif (is_archive()) {
        $title = get_the_archive_title();
        $description = get_the_archive_description();
        $url = home_url(add_query_arg(null, null));
    }

    // Fallbacks
    if (empty($title)) {
        $title = get_bloginfo('name');
    }
    
    if (empty($description)) {
        $description = get_bloginfo('description');
    }

    if (empty($image)) {
        // Prvo pokušaj sa Customizer logotipom
        $logo_image = get_theme_mod('lunart_logo_image', '');
        if (empty($logo_image)) {
            $custom_logo_id = get_theme_mod('custom_logo');
            if ($custom_logo_id) {
                $logo_src = wp_get_attachment_image_src($custom_logo_id, 'full');
                if ($logo_src) {
                    $logo_image = $logo_src[0];
                }
            }
        }
        
        if (!empty($logo_image)) {
            $image = $logo_image;
        } else {
            // Skroz krajnji fallback na neku sliku iz aseta ako postoji
            $image = get_template_directory_uri() . '/assets/placeholder-logo.png';
        }
    }

    // Čišćenje opisa
    $description = wp_strip_all_tags(strip_shortcodes($description));

    // Output tagova
    echo "\n" . '<!-- Open Graph Meta Tags -->' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr($type) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
    echo '<!-- End Open Graph Meta Tags -->' . "\n";
}
add_action('wp_head', 'lunart_og_tags', 5);
