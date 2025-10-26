<?php
/**
 * Lunart functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lunart
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function lunart_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('lunart', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Add support for custom line height controls.
    add_theme_support('custom-line-height');

    // Add support for experimental link color control.
    add_theme_support('experimental-link-color');

    // Add support for custom units.
    add_theme_support('custom-units');

    // Add support for custom logo.
    add_theme_support('custom-logo');

    // Add support for navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'lunart'),
        'footer' => esc_html__('Footer Menu', 'lunart'),
    ));

    // Add support for HTML5 markup.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add demo import menu
    add_action('admin_menu', 'lunart_add_demo_import_menu');

    /**
     * Add support for core custom header image.
     *
     * @link https://developer.wordpress.org/themes/functionality/custom-headers/
     */
    add_theme_support('custom-header', apply_filters('lunart_custom_header_args', array(
        'default-image'      => '',
        'default-text-color' => '000000',
        'width'              => 1000,
        'height'             => 250,
        'flex-height'        => true,
    )));

    /**
     * Add support for core custom logo.
     *
     * @link https://developer.wordpress.org/themes/functionality/custom-logo/
     */
    add_theme_support('custom-logo', apply_filters('lunart_custom_logo_args', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    )));

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'lunart_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for Gutenberg
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'lunart_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lunart_content_width() {
    $GLOBALS['content_width'] = apply_filters('lunart_content_width', 1200);
}
add_action('after_setup_theme', 'lunart_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lunart_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'lunart'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'lunart'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    // Footer widget area for fully editable footer
    register_sidebar(
        array(
            'name'          => esc_html__('Footer', 'lunart'),
            'id'            => 'footer-1',
            'description'   => esc_html__('Add footer widgets/blocks here to fully control footer content.', 'lunart'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'lunart_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function lunart_scripts() {
    wp_enqueue_style('lunart-style', get_stylesheet_uri(), array(), _S_VERSION);
    
    // Enqueue Google Fonts
    wp_enqueue_style('lunart-google-fonts', 'https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    wp_enqueue_script('lunart-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
    wp_enqueue_script('lunart-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'lunart_scripts');

// Load theme styles inside the block editor so SSR previews look correct
add_action('after_setup_theme', function(){
    add_theme_support('editor-styles');
    // Load main theme stylesheet and editor tweaks
    if (function_exists('add_editor_style')) {
        add_editor_style(array('style.css', 'editor.css'));
    }
});

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Gutenberg Blocks (Lunart)
 */
if (file_exists(get_template_directory() . '/inc/blocks.php')) {
    require get_template_directory() . '/inc/blocks.php';
}

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Add theme support for WooCommerce
 */
function lunart_woocommerce_support() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'lunart_woocommerce_support');

/**
 * Shortcode: Services Grid
 * Usage: [lunart_services limit="6"]
 */
function lunart_services_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 6,
    ), $atts);

    $args = array(
        'post_type' => 'service',
        'posts_per_page' => intval($atts['limit']),
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $query = new WP_Query($args);
    $output = '<div class="services-grid">';

    if ($query->have_posts()) {
        while ($query->have_posts()) { $query->the_post();
            $taksativne_opcije = get_post_meta(get_the_ID(), '_taksativne_opcije', true);
            $output .= '<div class="service-card elegant-border elegant-hover">';
            $output .= '<div class="card-header">';
            $output .= lunart_get_service_icon_html(get_the_ID());
            $output .= '<h3 class="service-title">' . esc_html(get_the_title()) . '</h3>';
            $output .= '<p class="service-description">' . esc_html(get_the_excerpt()) . '</p>';
            $output .= '</div>';
            $output .= '<div class="card-content">';
            if (!empty($taksativne_opcije) && is_array($taksativne_opcije)) {
                $output .= '<ul class="service-details">';
                foreach ($taksativne_opcije as $opcija) {
                    $output .= '<li>' . esc_html($opcija) . '</li>';
                }
                $output .= '</ul>';
            }
            $output .= '<a href="' . esc_url(get_permalink()) . '" class="btn btn-outline w-full elegant-hover border-primary text-primary hover:bg-primary hover:text-primary-foreground bg-transparent">Saznajte više</a>';
            $output .= '</div>';
            $output .= '</div>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<div class="col-span-full text-center py-12">';
        $output .= '<p class="text-muted-foreground text-lg">Trenutno nema usluga. Dodajte ih kroz admin panel.</p>';
        $output .= '<a href="' . esc_url(admin_url('edit.php?post_type=service')) . '" class="btn btn-primary mt-4 elegant-hover">Dodaj Uslugu</a>';
        $output .= '</div>';
    }

    $output .= '</div>';
    return $output;
}
add_shortcode('lunart_services', 'lunart_services_shortcode');

/**
 * Block Patterns: Lunart Homepage Sections
 */
function lunart_register_block_patterns() {
    if (!function_exists('register_block_pattern')) {
        return;
    }

    // Category
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category('lunart', array(
            'label' => __('Lunart Obrasci', 'lunart'),
        ));
    }

    // Hero Pattern
    register_block_pattern('lunart/hero', array(
        'title'       => __('Lunart Hero', 'lunart'),
        'description' => __('Hero sekcija sa naslovom, podnaslovom i dugmadima.', 'lunart'),
        'categories'  => array('lunart'),
        'content'     =>
            '<!-- wp:group {"className":"hero-section hero-background vintage-paper-texture","layout":{"type":"constrained"}} -->
            <div class="wp-block-group hero-section hero-background vintage-paper-texture"><div class="container text-center relative z-10 pt-20 pb-20">
            <!-- wp:group {"className":"hero-content","layout":{"type":"constrained"}} -->
            <div class="wp-block-group hero-content">
            <!-- wp:heading {"textAlign":"center","level":1,"className":"hero-title"} -->
            <h1 class="wp-block-heading has-text-align-center hero-title"><span class="gradient-text">Čuvamo Umetnost</span><span class="block mt-4 text-foreground">za Buduće Generacije</span></h1>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","className":"hero-subtitle max-w-4xl mx-auto"} -->
            <p class="has-text-align-center hero-subtitle max-w-4xl mx-auto">Stručna konzervacija i restauracija umetničkih dela na papiru - crteža, akvarela, knjiga i plakata.</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:buttons {"className":"hero-buttons"} -->
            <div class="wp-block-buttons hero-buttons"><!-- wp:button {"className":"btn btn-primary btn-xl elegant-hover shadow-lg"} -->
            <div class="wp-block-button btn btn-primary btn-xl elegant-hover shadow-lg"><a class="wp-block-button__link wp-element-button" href="#gallery">Pogledajte Naše Radove</a></div>
            <!-- /wp:button -->
            
            <!-- wp:button {"className":"btn btn-outline btn-xl border-2 border-primary\/40 hover:bg-primary\/10 hover:border-primary\/60 bg-background\/90 backdrop-blur-sm elegant-hover shadow-lg text-foreground"} -->
            <div class="wp-block-button btn btn-outline btn-xl border-2 border-primary/40 hover:bg-primary/10 hover:border-primary/60 bg-background/90 backdrop-blur-sm elegant-hover shadow-lg text-foreground"><a class="wp-block-button__link wp-element-button" href="#services">Saznajte o Konzervaciji</a></div>
            <!-- /wp:button --></div>
            <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->
            </div></div>
            <!-- /wp:group -->'
    ));

    // Services Pattern (uses shortcode block)
    register_block_pattern('lunart/services', array(
        'title'       => __('Lunart Usluge', 'lunart'),
        'description' => __('Sekcija sa dinamičkim gridom usluga.', 'lunart'),
        'categories'  => array('lunart'),
        'content'     =>
            '<!-- wp:group {"className":"services-section","layout":{"type":"constrained"}} -->
            <div class="wp-block-group services-section"><div class="container relative z-10">
            <!-- wp:heading {"textAlign":"center","level":2,"className":"text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text"} -->
            <h2 class="wp-block-heading has-text-align-center text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">Naše Usluge</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","className":"text-xl text-muted-foreground max-w-3xl mx-auto"} -->
            <p class="has-text-align-center text-xl text-muted-foreground max-w-3xl mx-auto">Pružamo kompletne usluge konzervacije i restauracije sa više od 15 godina iskustva.</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:shortcode -->[lunart_services limit="6"]<!-- /wp:shortcode -->
            </div></div>
            <!-- /wp:group -->'
    ));

    // Gallery Pattern (uses existing shortcode)
    register_block_pattern('lunart/gallery', array(
        'title'       => __('Lunart Galerija', 'lunart'),
        'description' => __('Sekcija sa dinamičkom galerijom radova (pre/posle).', 'lunart'),
        'categories'  => array('lunart'),
        'content'     =>
            '<!-- wp:group {"className":"gallery-section","layout":{"type":"constrained"}} -->
            <div class="wp-block-group gallery-section"><div class="container relative z-10">
            <!-- wp:heading {"textAlign":"center","level":2,"className":"text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text"} -->
            <h2 class="wp-block-heading has-text-align-center text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">Galerija Radova</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","className":"text-xl text-muted-foreground max-w-3xl mx-auto"} -->
            <p class="has-text-align-center text-xl text-muted-foreground max-w-3xl mx-auto">Pogledajte transformacije koje smo ostvarili — svaki projekat je jedinstvena priča.</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:shortcode -->[lunart_gallery limit="12"]<!-- /wp:shortcode -->
            </div></div>
            <!-- /wp:group -->'
    ));

    // About Pattern
    register_block_pattern('lunart/about', array(
        'title'       => __('Lunart O nama', 'lunart'),
        'description' => __('Sekcija „O nama“ sa citatom.', 'lunart'),
        'categories'  => array('lunart'),
        'content'     =>
            '<!-- wp:group {"className":"about-section","layout":{"type":"constrained"}} -->
            <div class="wp-block-group about-section"><div class="container text-center relative z-10">
            <!-- wp:heading {"textAlign":"center","level":2,"className":"text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text"} -->
            <h2 class="wp-block-heading has-text-align-center text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">O Lunart-u</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","className":"text-lg text-muted-foreground leading-relaxed mb-8"} -->
            <p class="has-text-align-center text-lg text-muted-foreground leading-relaxed mb-8">Lunart je specijalizovana ustanova posvećena očuvanju kulturnog nasleđa kroz stručnu konzervaciju i restauraciju umetničkih dela na papiru.</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:quote {"className":"about-quote"} -->
            <blockquote class="wp-block-quote about-quote"><p class="about-quote-text">“Svaki rad koji prođe kroz naše ruke nije samo restauriran - on je vraćen u život, spreman da inspiriše buduće generacije.”</p><cite class="about-quote-author">Tim Lunart</cite></blockquote>
            <!-- /wp:quote -->
            </div></div>
            <!-- /wp:group -->'
    ));

    // Blog Placeholder Pattern
    register_block_pattern('lunart/blog', array(
        'title'       => __('Lunart Blog', 'lunart'),
        'description' => __('Sekcija blog najave sa CTA.', 'lunart'),
        'categories'  => array('lunart'),
        'content'     =>
            '<!-- wp:group {"className":"blog-section","layout":{"type":"constrained"}} -->
            <div class="wp-block-group blog-section"><div class="container text-center relative z-10">
            <!-- wp:heading {"textAlign":"center","level":2,"className":"text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text"} -->
            <h2 class="wp-block-heading has-text-align-center text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">Blog o Konzervaciji</h2>
            <!-- /wp:heading -->
            
            <!-- wp:paragraph {"align":"center","className":"text-lg text-muted-foreground max-w-2xl mx-auto mb-8"} -->
            <p class="has-text-align-center text-lg text-muted-foreground max-w-2xl mx-auto mb-8">Saznajte više o tehnikama konzervacije, istoriji umetnosti i našim najnovijim projektima.</p>
            <!-- /wp:paragraph -->
            
            <!-- wp:buttons -->
            <div class="wp-block-buttons"><!-- wp:button {"className":"btn btn-primary btn-lg elegant-hover"} -->
            <div class="wp-block-button btn btn-primary btn-lg elegant-hover"><a class="wp-block-button__link wp-element-button" href="#blog">Pratite Blog</a></div>
            <!-- /wp:button --></div>
            <!-- /wp:buttons -->
            </div></div>
            <!-- /wp:group -->'
    ));
}
add_action('init', 'lunart_register_block_patterns');

/**
 * Customize WooCommerce wrapper
 */
function lunart_woocommerce_wrapper_before() {
    echo '<div class="container">';
    echo '<div class="woocommerce-wrapper">';
}

function lunart_woocommerce_wrapper_after() {
    echo '</div>';
    echo '</div>';
}

/**
 * Add custom post types for gallery items
 */
function lunart_custom_post_types() {
    // Register Gallery Category taxonomy (hierarchical)
    register_taxonomy('gallery_category', 'gallery_item', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => __('Kategorije Galerije', 'lunart'),
            'singular_name' => __('Kategorija Galerije', 'lunart'),
            'search_items' => __('Pretraži kategorije', 'lunart'),
            'all_items' => __('Sve kategorije', 'lunart'),
            'parent_item' => __('Nadređena kategorija', 'lunart'),
            'parent_item_colon' => __('Nadređena kategorija:', 'lunart'),
            'edit_item' => __('Uredi kategoriju', 'lunart'),
            'update_item' => __('Ažuriraj kategoriju', 'lunart'),
            'add_new_item' => __('Dodaj novu kategoriju', 'lunart'),
            'new_item_name' => __('Naziv nove kategorije', 'lunart'),
            'menu_name' => __('Kategorije', 'lunart'),
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'galerija/kategorija'),
        'show_in_rest' => true,
    ));

    // Gallery Post Type
    register_post_type('gallery_item',
        array(
            'labels' => array(
                'name' => __('Galerija', 'lunart'),
                'singular_name' => __('Galerija Item', 'lunart'),
                'add_new' => __('Dodaj novi', 'lunart'),
                'add_new_item' => __('Dodaj novi galerija item', 'lunart'),
                'edit_item' => __('Uredi galerija item', 'lunart'),
                'new_item' => __('Novi galerija item', 'lunart'),
                'view_item' => __('Pogledaj galerija item', 'lunart'),
                'search_items' => __('Pretraži galeriju', 'lunart'),
                'not_found' => __('Nema pronađenih galerija', 'lunart'),
                'not_found_in_trash' => __('Nema pronađenih galerija u kanti', 'lunart'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-format-gallery',
            'rewrite' => array('slug' => 'galerija'),
            'taxonomies' => array('gallery_category'),
            'show_in_rest' => true,
        )
    );

    // Services Post Type
    register_post_type('service',
        array(
            'labels' => array(
                'name' => __('Usluge', 'lunart'),
                'singular_name' => __('Usluga', 'lunart'),
                'add_new' => __('Dodaj novu', 'lunart'),
                'add_new_item' => __('Dodaj novu uslugu', 'lunart'),
                'edit_item' => __('Uredi uslugu', 'lunart'),
                'new_item' => __('Nova usluga', 'lunart'),
                'view_item' => __('Pogledaj uslugu', 'lunart'),
                'search_items' => __('Pretraži usluge', 'lunart'),
                'not_found' => __('Nema pronađenih usluga', 'lunart'),
                'not_found_in_trash' => __('Nema pronađenih usluga u kanti', 'lunart'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-admin-tools',
            'rewrite' => array('slug' => 'usluge'),
        )
    );
}
add_action('init', 'lunart_custom_post_types');

/**
 * Flush rewrite rules on theme activation
 */
function lunart_flush_rewrite_rules() {
    lunart_custom_post_types();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'lunart_flush_rewrite_rules');

/**
 * Add custom meta boxes for gallery items
 */
function lunart_add_gallery_meta_boxes() {
    add_meta_box(
        'gallery_details',
        __('Detalji Galerije', 'lunart'),
        'lunart_gallery_meta_box_callback',
        'gallery_item',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'lunart_add_gallery_meta_boxes');

/**
 * Add custom meta boxes for services
 */
function lunart_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        __('Detalji Usluge', 'lunart'),
        'lunart_service_meta_box_callback',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'lunart_add_service_meta_boxes');

function lunart_gallery_meta_box_callback($post) {
    wp_nonce_field('lunart_save_gallery_meta', 'lunart_gallery_meta_nonce');

    // Ensure WP media scripts are available
    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    }

    $before_image = get_post_meta($post->ID, '_before_image', true);
    $after_image = get_post_meta($post->ID, '_after_image', true);
    $category = get_post_meta($post->ID, '_category', true);
    $subtitle = get_post_meta($post->ID, '_subtitle', true);

    echo '<table class="form-table">';

    // Before image selector
    echo '<tr>';
    echo '<th><label for="before_image">' . __('Pre restauracije', 'lunart') . '</label></th>';
    echo '<td>';
    echo '<div class="lunart-image-field">';
    $before_style = empty($before_image) ? 'style="display:none;"' : '';
    echo '<img id="before_image_preview" src="' . esc_url($before_image) . '" ' . $before_style . ' />';
    echo '<input type="text" id="before_image" name="before_image" value="' . esc_attr($before_image) . '" class="regular-text" placeholder="' . esc_attr__('URL slike', 'lunart') . '" /> ';
    echo '<button type="button" class="button lunart-select-image" data-target="before_image" data-preview="before_image_preview">' . esc_html__('Izaberi sliku', 'lunart') . '</button> ';
    echo '<button type="button" class="button lunart-remove-image" data-target="before_image" data-preview="before_image_preview">' . esc_html__('Ukloni', 'lunart') . '</button>';
    echo '</div>';
    echo '</td>';
    echo '</tr>';

    // After image selector
    echo '<tr>';
    echo '<th><label for="after_image">' . __('Posle restauracije', 'lunart') . '</label></th>';
    echo '<td>';
    echo '<div class="lunart-image-field">';
    $after_style = empty($after_image) ? 'style="display:none;"' : '';
    echo '<img id="after_image_preview" src="' . esc_url($after_image) . '" ' . $after_style . ' />';
    echo '<input type="text" id="after_image" name="after_image" value="' . esc_attr($after_image) . '" class="regular-text" placeholder="' . esc_attr__('URL slike', 'lunart') . '" /> ';
    echo '<button type="button" class="button lunart-select-image" data-target="after_image" data-preview="after_image_preview">' . esc_html__('Izaberi sliku', 'lunart') . '</button> ';
    echo '<button type="button" class="button lunart-remove-image" data-target="after_image" data-preview="after_image_preview">' . esc_html__('Ukloni', 'lunart') . '</button>';
    echo '</div>';
    echo '</td>';
    echo '</tr>';


    // Subtitle
    echo '<tr>';
    echo '<th><label for="subtitle">' . __('Podnaslov', 'lunart') . '</label></th>';
    echo '<td><input type="text" id="subtitle" name="subtitle" value="' . esc_attr($subtitle) . '" class="regular-text" /></td>';
    echo '</tr>';

    echo '</table>';

    // Inline JS to handle media selection
    echo '<script>
    jQuery(document).ready(function($){
        function openMediaFrame(targetInputId, previewImgId){
            var frame = wp.media({
                title: "' . esc_js(__('Izaberite sliku', 'lunart')) . '",
                multiple: false,
                library: { type: ["image"] },
                button: { text: "' . esc_js(__('Koristi ovu sliku', 'lunart')) . '" }
            });
            frame.on("select", function(){
                var attachment = frame.state().get("selection").first().toJSON();
                var url = attachment.url || "";
                $("#"+targetInputId).val(url).trigger("change");
                if(previewImgId){
                    var $img = $("#"+previewImgId);
                    $img.attr("src", url);
                    if(url){ $img.show(); } else { $img.hide(); }
                }
            });
            frame.open();
        }
        $(document).on("click", ".lunart-select-image", function(e){
            e.preventDefault();
            var target = $(this).data("target");
            var preview = $(this).data("preview");
            openMediaFrame(target, preview);
        });
        $(document).on("click", ".lunart-remove-image", function(e){
            e.preventDefault();
            var target = $(this).data("target");
            var preview = $(this).data("preview");
            $("#"+target).val("");
            if(preview){ $("#"+preview).attr("src", "").hide(); }
        });
    });
    </script>';

    // Minimal styling for preview
    echo '<style>
    .lunart-image-field img{ max-width:150px; height:auto; display:block; margin-bottom:8px; border:1px solid #ddd; border-radius:4px; }
    .lunart-image-field .button{ margin-top:4px; margin-right:6px; }
    </style>';
}

function lunart_save_gallery_meta($post_id) {
    if (!isset($_POST['lunart_gallery_meta_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['lunart_gallery_meta_nonce'], 'lunart_save_gallery_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['post_type']) && 'gallery_item' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (isset($_POST['before_image'])) {
        update_post_meta($post_id, '_before_image', esc_url_raw($_POST['before_image']));
    }

    if (isset($_POST['after_image'])) {
        update_post_meta($post_id, '_after_image', esc_url_raw($_POST['after_image']));
    }


    if (isset($_POST['subtitle'])) {
        update_post_meta($post_id, '_subtitle', sanitize_text_field($_POST['subtitle']));
    }
}
add_action('save_post', 'lunart_save_gallery_meta');

/**
 * Service meta box callback
 */
function lunart_service_meta_box_callback($post) {
    wp_nonce_field('lunart_save_service_meta', 'lunart_service_meta_nonce');

    $icon_name = get_post_meta($post->ID, '_service_icon_name', true);
    $icon_color = get_post_meta($post->ID, '_service_icon_color', true);
    
    // Taksativne opcije - dinamički input polja
    $taksativne_opcije = get_post_meta($post->ID, '_taksativne_opcije', true);
    if (!is_array($taksativne_opcije)) {
        $taksativne_opcije = array();
    }

    echo '<div class="service-meta-box">';
    
    // Icon selection
    echo '<h3>Izbor Ikonice</h3>';
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="icon_name">Ikonica</label></th>';
    echo '<td>';
    echo '<select id="icon_name" name="icon_name" class="regular-text">';
    echo '<option value="">Izaberite ikonicu</option>';
    
    // Heroicons biblioteka
    $heroicons = array(
        'light-bulb' => '💡 Lampica (Ideja)',
        'star' => '⭐ Zvezda',
        'book-open' => '📖 Knjiga',
        'image' => '🖼️ Slika',
        'search' => '🔍 Pretraga',
        'shield-check' => '🛡️ Zaštita',
        'paint-brush' => '🎨 Četka',
        'scissors' => '✂️ Makaze',
        'eye' => '👁️ Oko',
        'heart' => '❤️ Srce',
        'leaf' => '🍃 List',
        'moon' => '🌙 Mesec',
        'sun' => '☀️ Sunce',
        'home' => '🏠 Kuća',
        'user' => '👤 Korisnik',
        'cog' => '⚙️ Zupčanik',
        'wrench' => '🔧 Ključ',
        'hammer' => '🔨 Čekić',
        'truck' => '🚚 Kamion',
        'phone' => '📞 Telefon'
    );
    
    foreach ($heroicons as $icon_key => $icon_label) {
        $selected = ($icon_name == $icon_key) ? 'selected' : '';
        echo '<option value="' . esc_attr($icon_key) . '" ' . $selected . '>' . esc_html($icon_label) . '</option>';
    }
    echo '</select>';
    echo '<p class="description">Izaberite ikonicu iz Heroicons biblioteke</p>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="icon_color">Boja Ikonice</label></th>';
    echo '<td><select id="icon_color" name="icon_color">';
    echo '<option value="primary"' . selected($icon_color, 'primary', false) . '>Primary</option>';
    echo '<option value="accent"' . selected($icon_color, 'accent', false) . '>Accent</option>';
    echo '<option value="secondary"' . selected($icon_color, 'secondary', false) . '>Secondary</option>';
    echo '</select></td>';
    echo '</tr>';
    echo '</table>';
    
    // Dinamičke taksativne opcije
    echo '<h3>Taksativne Opcije</h3>';
    echo '<div id="taksativne-opcije-container">';
    echo '<p class="description">Dodajte usluge koje se pružaju. Možete dodati proizvoljan broj opcija.</p>';
    
    if (!empty($taksativne_opcije)) {
        foreach ($taksativne_opcije as $index => $opcija) {
            echo '<div class="taksativna-opcija-row">';
            echo '<input type="text" name="taksativne_opcije[]" value="' . esc_attr($opcija) . '" class="regular-text" placeholder="Unesite naziv usluge">';
            echo '<button type="button" class="button remove-opcija">Ukloni</button>';
            echo '</div>';
        }
    }
    
    echo '</div>';
    echo '<button type="button" class="button add-opcija">+ Dodaj Novu Opciju</button>';
    
    echo '</div>';
    
    // JavaScript za dinamičko dodavanje/uklanjanje opcija
    echo '<script>
    jQuery(document).ready(function($) {
        $(".add-opcija").click(function() {
            var newRow = \'<div class="taksativna-opcija-row">\' +
                         \'<input type="text" name="taksativne_opcije[]" value="" class="regular-text" placeholder="Unesite naziv usluge">\' +
                         \'<button type="button" class="button remove-opcija">Ukloni</button>\' +
                         \'</div>\';
            $("#taksativne-opcije-container").append(newRow);
        });
        
        $(document).on("click", ".remove-opcija", function() {
            $(this).closest(".taksativna-opcija-row").remove();
        });
    });
    </script>';
    
    echo '<style>
    .taksativna-opcija-row {
        margin-bottom: 10px;
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .taksativna-opcija-row input {
        flex: 1;
    }
    .remove-opcija {
        background: #dc3232 !important;
        border-color: #dc3232 !important;
        color: white !important;
    }
    .add-opcija {
        margin-top: 10px !important;
    }
    </style>';
}

/**
 * Save service meta data
 */
function lunart_save_service_meta($post_id) {
    if (!isset($_POST['lunart_service_meta_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['lunart_service_meta_nonce'], 'lunart_save_service_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['post_type']) && 'service' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Save icon data
    if (isset($_POST['icon_name'])) {
        update_post_meta($post_id, '_service_icon_name', sanitize_text_field($_POST['icon_name']));
    }
    if (isset($_POST['icon_color'])) {
        update_post_meta($post_id, '_service_icon_color', sanitize_text_field($_POST['icon_color']));
    }

    // Save dinamičke taksativne opcije
    if (isset($_POST['taksativne_opcije']) && is_array($_POST['taksativne_opcije'])) {
        $taksativne_opcije = array_filter(array_map('sanitize_text_field', $_POST['taksativne_opcije']));
        update_post_meta($post_id, '_taksativne_opcije', $taksativne_opcije);
    }
}
add_action('save_post', 'lunart_save_service_meta');

/**
 * Helper function to get service icon HTML
 */
function lunart_get_service_icon_html($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $icon_name = get_post_meta($post_id, '_service_icon_name', true);
    $icon_color = get_post_meta($post_id, '_service_icon_color', true);
    
    if (!$icon_name) {
        return '';
    }
    
    $color_class = $icon_color ? 'text-' . $icon_color : 'text-primary';
    
    // Heroicons biblioteka
    $heroicons_svg = lunart_get_heroicon_svg($icon_name);
    
    if (!$heroicons_svg) {
        return '';
    }
    
    return sprintf(
        '<div class="service-icon">
            <svg class="h-8 w-8 %s" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                %s
            </svg>
        </div>',
        esc_attr($color_class),
        $heroicons_svg
    );
}

/**
 * Get Heroicon SVG code by icon name
 */
function lunart_get_heroicon_svg($icon_name) {
    $heroicons = array(
        'light-bulb' => '<path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 1 1 7.072 0l-.548.547A3.374 3.374 0 0 1 14 18.469V19a2 2 0 0 1-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>',
        'star' => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>',
        'book-open' => '<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>',
        'image' => '<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21,15 16,10 5,21"></polyline>',
        'search' => '<circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path>',
        'shield-check' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="m9 12 2 2 4-4"></path>',
        'paint-brush' => '<path d="M18.37 2.63 14 7l-1.59-1.59a2 2 0 0 0-2.82 0L10 7l-1.59-1.59a2 2 0 0 0-2.82 0L6 7l-1.59-1.59a2 2 0 0 0-2.82 0L2 7v5c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V7l-1.63-4.37z"></path>',
        'scissors' => '<circle cx="6" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><line x1="20" y1="4" x2="8.12" y2="15.88"></line><line x1="14.47" y1="14.48" x2="20" y2="20"></line><line x1="8.12" y1="8.12" x2="12" y2="12"></line>',
        'eye' => '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle>',
        'heart' => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>',
        'leaf' => '<path d="M6 3c5.5 2.5 5.5 16.5 0 19 1.5-5.5 1.5-10.5 0-19z"></path><path d="M6 3c5.5 2.5 5.5 16.5 0 19 1.5-5.5 1.5-10.5 0-19z" opacity=".3"></path>',
        'moon' => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>',
        'sun' => '<circle cx="12" cy="12" r="4"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path><path d="m4.93 4.93 1.41 1.41"></path><path d="m17.66 17.66 1.41 1.41"></path><path d="M2 12h2"></path><path d="M20 12h2"></path><path d="m6.34 6.34-1.41 1.41"></path><path d="m19.07 19.07-1.41 1.41"></path>',
        'home' => '<path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9,22 9,12 15,12 15,22"></polyline>',
        'user' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>',
        'cog' => '<path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle>',
        'wrench' => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>',
        'hammer' => '<path d="M15 12V9a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1z"></path><path d="M9 12V9a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1z"></path><path d="M12 6v6"></path><path d="M12 18v-6"></path>',
        'truck' => '<path d="M1 3h15v13H1z"></path><path d="M16 8h4l3 3v5h-7V8z"></path><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle>',
        'phone' => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>'
    );
    
    return isset($heroicons[$icon_name]) ? $heroicons[$icon_name] : false;
}

/**
 * Helper function to get service taksativne opcije HTML
 */
function lunart_get_service_taksativne_opcije_html($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $taksativne_opcije = get_post_meta($post_id, '_taksativne_opcije', true);
    
    if (empty($taksativne_opcije) || !is_array($taksativne_opcije)) {
        return '';
    }
    
    $output = '<div class="service-taksativne-opcije">';
    $output .= '<h4>Uključene usluge:</h4>';
    $output .= '<ul class="taksativne-lista">';
    
    foreach ($taksativne_opcije as $opcija) {
        if (!empty($opcija)) {
            $output .= '<li class="taksativna-opcija">✓ ' . esc_html($opcija) . '</li>';
        }
    }
    
    $output .= '</ul>';
    $output .= '</div>';
    
    return $output;
}

/**
 * Add custom shortcodes
 */
function lunart_gallery_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category' => '', // slug or comma-separated slugs of gallery_category
        'limit' => 6,
    ), $atts);

    $args = array(
        'post_type' => 'gallery_item',
        'posts_per_page' => intval($atts['limit']),
        'post_status' => 'publish',
    );

    if (!empty($atts['category'])) {
        // Support comma-separated list of slugs
        $slugs = array_filter(array_map('trim', explode(',', $atts['category'])));
        if (!empty($slugs)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'gallery_category',
                    'field'    => 'slug',
                    'terms'    => $slugs,
                ),
            );
        } else {
            // Back-compat: keep meta fallback if category provided but not valid slugs
            $args['meta_query'] = array(
                array(
                    'key' => '_category',
                    'value' => $atts['category'],
                    'compare' => '=',
                ),
            );
        }
    }

    $gallery_query = new WP_Query($args);
    $output = '';

    if ($gallery_query->have_posts()) {
        $output .= '<div class="gallery-grid">';
        
        while ($gallery_query->have_posts()) {
            $gallery_query->the_post();
            $before_image = get_post_meta(get_the_ID(), '_before_image', true);
            $after_image = get_post_meta(get_the_ID(), '_after_image', true);
            $subtitle = get_post_meta(get_the_ID(), '_subtitle', true);
            // Prefer taxonomy terms; fallback to legacy meta
            $terms = get_the_terms(get_the_ID(), 'gallery_category');
            $category_html = '';
            if (!is_wp_error($terms) && !empty($terms)) {
                foreach ($terms as $t) {
                    $link = get_term_link($t);
                    if (!is_wp_error($link)) {
                        $category_html .= '<a class="gallery-category" href="' . esc_url($link) . '">' . esc_html($t->name) . '</a>';
                    } else {
                        $category_html .= '<span class="gallery-category">' . esc_html($t->name) . '</span>';
                    }
                }
            } else {
                $legacy = get_post_meta(get_the_ID(), '_category', true);
                if (!empty($legacy)) { $category_html = '<span class="gallery-category">' . esc_html($legacy) . '</span>'; }
            }

            $output .= '<div class="gallery-item elegant-border overflow-hidden elegant-hover">';
            $output .= '<div class="gallery-images">';
            if (!empty($before_image)) {
                $output .= '<div class="gallery-image">';
                $output .= '<img src="' . esc_url($before_image) . '" alt="' . esc_attr(get_the_title() . ' - pre restauracije') . '">';
                $output .= '<div class="gallery-image-overlay"><span>PRE</span></div>';
                $output .= '</div>';
            }
            if (!empty($after_image)) {
                $output .= '<div class="gallery-image">';
                $output .= '<img src="' . esc_url($after_image) . '" alt="' . esc_attr(get_the_title() . ' - posle restauracije') . '">';
                $output .= '<div class="gallery-image-overlay"><span>POSLE</span></div>';
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '<div class="gallery-content">';
            if (!empty($category_html)) {
                $output .= '<div class="gallery-tags mb-3">' . $category_html . '</div>';
            }
            $output .= '<h3 class="gallery-title">' . get_the_title() . '</h3>';
            if (!empty($subtitle)) {
                $output .= '<div class="gallery-subtitle" style="opacity:0.8; margin-top: -0.5rem;">' . esc_html($subtitle) . '</div>';
            }
            $output .= '<p class="gallery-description">' . get_the_excerpt() . '</p>';
            $output .= '<div class="gallery-actions mt-3">';
            $output .= '<a href="' . esc_url(get_permalink()) . '" class="btn btn-outline text-muted-foreground hover:text-primary">';
            $output .= '<svg class="h-4 w-4 mr-1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
            $output .= '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>';
            $output .= '<circle cx="12" cy="12" r="3"></circle>';
            $output .= '</svg>';
            $output .= 'Detalji';
            $output .= '</a>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
        
        $output .= '</div>';
        wp_reset_postdata();
    }

    return $output;
}
add_shortcode('lunart_gallery', 'lunart_gallery_shortcode');

/**
 * Customize the main query for gallery items
 */
function lunart_pre_get_posts($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    $is_gallery_archive = is_post_type_archive('gallery_item');
    $is_gallery_tax = is_tax('gallery_category');

    if ($is_gallery_archive || $is_gallery_tax) {
        // Default ordering
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');

        // Per-page control via GET param `pp` (1–48, default 12)
        $pp = isset($_GET['pp']) ? intval($_GET['pp']) : 12;
        if ($pp < 1) { $pp = 12; }
        if ($pp > 48) { $pp = 48; }
        $query->set('posts_per_page', $pp);

        // Allow filtering by gallery_category on the post type archive via GET param `gallery_category`
        if ($is_gallery_archive && !empty($_GET['gallery_category'])) {
            $raw = sanitize_text_field(wp_unslash($_GET['gallery_category']));
            $slugs = array_filter(array_map('trim', explode(',', $raw)));
            if (!empty($slugs)) {
                $tax_query = (array) $query->get('tax_query');
                $tax_query[] = array(
                    'taxonomy' => 'gallery_category',
                    'field'    => 'slug',
                    'terms'    => $slugs,
                );
                $query->set('tax_query', $tax_query);
            }
        }
    }
}
add_action('pre_get_posts', 'lunart_pre_get_posts');

/**
 * Custom excerpt length
 */
function lunart_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'lunart_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function lunart_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'lunart_excerpt_more');

/**
 * Add preconnect for Google Fonts.
 */
function lunart_resource_hints($urls, $relation_type) {
    if (wp_style_is('lunart-google-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'lunart_resource_hints', 10, 2);

/**
 * Demo Content for Gallery (Galerija radova)
 */
function lunart_get_demo_gallery_data() {
    return array(
        array(
            'title' => 'Restauracija crteža (ugalj)',
            'subtitle' => 'Konzervacija i restauracija crteža',
            'excerpt' => 'Uklanjanje diskoloracije i stabilizacija papira.',
            'content' => '<p>Ovaj crtež izveden u tehnici uglja prošao je kroz složen proces čišćenja i stabilizacije. Površinske nečistoće i kiseline uklonjene su mehaničkim i hemijskim metodama, uz poštovanje principa reversibilnosti.</p><p>Nakon toga urađena je konsolidacija vlakana papira i lokalna nivelacija nabora. Korišćeni su arhivski, pH-neutralni materijali koji obezbeđuju dugoročnu stabilnost rada.</p>',
            'category' => 'Crtež',
            'before_image' => 'faded-charcoal-drawing.png',
            'after_image'  => 'conserved-charcoal-drawing.png'
        ),
        array(
            'title' => 'Restauracija akvarela',
            'subtitle' => 'Vraćanje originalnog sjaja boja',
            'excerpt' => 'Delikatan tretman akvarel papira i pigmenata.',
            'content' => '<p>Akvarel je osetljiva tehnika koja zahteva minimalno invazivne postupke. Bojeni sloj stabilizovan je fiksativima kompatibilnim sa pigmentima, dok su mrlje i žutilo tretirani selektivno kako bi se očuvao originalni karakter.</p><p>Posebna pažnja posvećena je ravnanju papira i korekciji talasanja, kako bi rad ponovo zadobio čitkost i vizuelnu ravnotežu.</p>',
            'category' => 'Akvarel',
            'before_image' => 'damaged-watercolor.png',
            'after_image'  => 'restored-watercolor-painting.png'
        ),
        array(
            'title' => 'Vintage plakat — popravka',
            'subtitle' => 'Uklanjanje cepotina i ojačavanje',
            'excerpt' => 'Stabilizacija vlakana i estetska rekonstrukcija.',
            'content' => '<p>Plakat je imao više mehaničkih oštećenja i cepotina duž ivica. Izvršena je dezacidifikacija papira i lokalna rekonstrukcija nedostajućih delova uz pomoć toniranih japanskih papira.</p><p>Na kraju je urađena zaštitna montaža na arhivski karton kako bi se obezbedila stabilnost tokom izlaganja i skladištenja.</p>',
            'category' => 'Plakat',
            'before_image' => 'vintage-torn-poster.png',
            'after_image'  => 'restored-vintage-poster.png'
        ),
        array(
            'title' => 'Konzervacija rukopisnih strana',
            'subtitle' => 'Arhivsko očuvanje dokumenata',
            'excerpt' => 'Čišćenje, neutralizacija kiselosti i zaštita.',
            'content' => '<p>Rukopisne strane tretirane su suvim i mokrim čišćenjem, uz pažljivo testiranje stabilnosti mastila. Kiselost je neutralisana tamponiranim rastvorima kako bi se usporilo dalje propadanje.</p><p>Nakon konzervacije, dokumenti su smešteni u zaštitne omote od bezkiselinskih materijala, spremni za dugoročno arhivsko čuvanje.</p>',
            'category' => 'Rukopis',
            'before_image' => 'preserved-manuscript-pages.png',
            'after_image'  => 'conserved-manuscript-pages.png'
        )
    );
}

/**
 * Import demo gallery items
 */
function lunart_import_demo_gallery($overwrite = false) {
    $items = lunart_get_demo_gallery_data();
    $imported = 0;
    $skipped = 0;

    foreach ($items as $item) {
        $existing = get_page_by_title($item['title'], OBJECT, 'gallery_item');
        if ($existing && !$overwrite) {
            $skipped++;
            continue;
        }

        $post_args = array(
            'post_title'   => $item['title'],
            'post_content' => isset($item['content']) ? $item['content'] : $item['excerpt'],
            'post_excerpt' => $item['excerpt'],
            'post_status'  => 'publish',
            'post_type'    => 'gallery_item',
            'post_author'  => 1
        );

        if ($existing && $overwrite) {
            $post_args['ID'] = $existing->ID;
            $post_id = wp_update_post($post_args);
        } else {
            $post_id = wp_insert_post($post_args);
        }

        if (is_wp_error($post_id)) {
            continue;
        }

        // Helper to upload an asset image from theme assets folder
        $upload_asset = function($filename) use ($post_id) {
            $source_path = get_template_directory() . '/assets/' . $filename;
            if (!file_exists($source_path)) {
                return array('id' => 0, 'url' => '');
            }
            $bits = wp_upload_bits($filename, null, file_get_contents($source_path));
            if ($bits['error']) {
                return array('id' => 0, 'url' => '');
            }
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title'     => preg_replace('/\.[^.]+$/', '', $filename),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );
            $attach_id = wp_insert_attachment($attachment, $bits['file'], $post_id);
            if (!is_wp_error($attach_id)) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                $attach_data = wp_generate_attachment_metadata($attach_id, $bits['file']);
                wp_update_attachment_metadata($attach_id, $attach_data);
            } else {
                $attach_id = 0;
            }
            return array('id' => (int)$attach_id, 'url' => $bits['url']);
        };

        // Upload before/after images and store URLs in meta
        $before = $upload_asset($item['before_image']);
        $after  = $upload_asset($item['after_image']);

        if (!empty($before['url'])) {
            update_post_meta($post_id, '_before_image', esc_url_raw($before['url']));
        }
        if (!empty($after['url'])) {
            update_post_meta($post_id, '_after_image', esc_url_raw($after['url']));
            // Use AFTER as featured image for nicer preview
            if ($after['id']) {
                set_post_thumbnail($post_id, $after['id']);
            }
        }

        if (!empty($item['category'])) {
            // Create/find taxonomy term and assign to post
            $term_name = sanitize_text_field($item['category']);
            $term = term_exists($term_name, 'gallery_category');
            if (!$term) {
                $term = wp_insert_term($term_name, 'gallery_category');
            }
            if (!is_wp_error($term)) {
                $term_id = is_array($term) ? (int)$term['term_id'] : (int)$term;
                wp_set_post_terms($post_id, array($term_id), 'gallery_category', false);
            }
            // Keep legacy meta for backward compatibility
            update_post_meta($post_id, '_category', $term_name);
        }
        if (!empty($item['subtitle'])) {
            update_post_meta($post_id, '_subtitle', sanitize_text_field($item['subtitle']));
        }

        $imported++;
    }

    return array(
        'imported' => $imported,
        'skipped'  => $skipped,
        'total'    => count($items)
    );
}

/**
 * Demo Content Importer for Services
 */
function lunart_get_demo_services_data() {
    return array(
        array(
            'title' => 'Restauracija Crteža',
            'content' => 'Stručna restauracija crteža različitih tehnika - olovka, ugalj, pastel, tuš. Uklanjamo mrlje, popravljamo oštećenja papira i stabilizujemo medijum.',
            'excerpt' => 'Restauracija crteža različitih tehnika sa očuvanjem originalnog izgleda.',
            'featured_image' => 'faded-charcoal-drawing.png',
            'icon_name' => 'light-bulb',
            'icon_color' => 'primary',
            'taksativne_opcije' => array('Uklanjanje mrlja i diskoloracije', 'Popravka oštećenja papira', 'Stabilizacija medijuma')
        ),
        array(
            'title' => 'Konzervacija Akvarela',
            'content' => 'Stručna restauracija akvarelnih slika i ilustracija sa očuvanjem originalnih boja i tekstura. Koristimo najsavremenije tehnike konzervacije za zaštitu vaših dragocenih umetničkih dela.',
            'excerpt' => 'Delikatan tretman akvarelnih slika sa očuvanjem originalnih boja i tekstura.',
            'featured_image' => 'restored-watercolor-painting.png',
            'icon_name' => 'star',
            'icon_color' => 'accent',
            'taksativne_opcije' => array('Fiksiranje boja', 'Uklanjanje kiselosti', 'Zaštita od UV zračenja')
        ),
        array(
            'title' => 'Restauracija Knjiga',
            'content' => 'Profesionalna nega retkih knjiga, rukopisa i istorijskih dokumenata. Pružamo kompletne usluge konzervacije koje obuhvataju čišćenje, stabilizaciju i zaštitu od daljeg propadanja.',
            'excerpt' => 'Profesionalna nega retkih knjiga, rukopisa i istorijskih dokumenata.',
            'featured_image' => 'conserved-manuscript-pages.png',
            'icon_name' => 'book-open',
            'icon_color' => 'secondary',
            'taksativne_opcije' => array('Popravka korica', 'Restauracija stranica', 'Rebinding istorijskih knjiga')
        ),
        array(
            'title' => 'Vintage Plakati',
            'content' => 'Specializovana restauracija starih plakata i grafičkih radova. Uklanjamo lepak, popravljamo preklopljene delove i montiramo na arhivski karton.',
            'excerpt' => 'Restauracija starih plakata i grafičkih radova sa očuvanjem istorijskog značaja.',
            'featured_image' => 'restored-vintage-poster.png',
            'icon_name' => 'image',
            'icon_color' => 'primary',
            'taksativne_opcije' => array('Uklanjanje lepka', 'Popravka preklopljenih delova', 'Montiranje na arhivski karton')
        ),
        array(
            'title' => 'Analiza Materijala',
            'content' => 'Detaljno ispitivanje materijala pre početka restauracije. Identifikujemo pigmente, analiziramo papir i procenjujemo stanje umetničkog dela.',
            'excerpt' => 'Detaljna analiza materijala za optimalan pristup restauraciji.',
            'featured_image' => 'damaged-watercolor-painting.png',
            'icon_name' => 'search',
            'icon_color' => 'accent',
            'taksativne_opcije' => array('Identifikacija pigmenata', 'Analiza papira', 'Procena stanja')
        ),
        array(
            'title' => 'Preventivna Zaštita',
            'content' => 'Saveti i usluge za dugoročno očuvanje umetničkih dela. Uključujemo klimatske uslove, pravilno čuvanje i redovne preglede.',
            'excerpt' => 'Saveti za dugoročno očuvanje i zaštitu umetničkih dela.',
            'featured_image' => 'preserved-manuscript-pages.png',
            'icon_name' => 'shield-check',
            'icon_color' => 'secondary',
            'taksativne_opcije' => array('Preventivna zaštita', 'Analiza materijala')
        )
    );
}

/**
 * Import demo services
 */
function lunart_import_demo_services($overwrite = false) {
    $services_data = lunart_get_demo_services_data();
    $imported_count = 0;
    $skipped_count = 0;
    
    foreach ($services_data as $service_data) {
        // Check if service already exists
        $existing_service = get_page_by_title($service_data['title'], OBJECT, 'service');
        
        if ($existing_service && !$overwrite) {
            $skipped_count++;
            continue;
        }
        
        // Prepare service data
        $service_args = array(
            'post_title' => $service_data['title'],
            'post_content' => $service_data['content'],
            'post_excerpt' => $service_data['excerpt'],
            'post_status' => 'publish',
            'post_type' => 'service',
            'post_author' => 1
        );
        
        // Insert or update service
        if ($existing_service && $overwrite) {
            $service_args['ID'] = $existing_service->ID;
            $service_id = wp_update_post($service_args);
        } else {
            $service_id = wp_insert_post($service_args);
        }
        
        if (!is_wp_error($service_id)) {
            // Set featured image
            $image_path = get_template_directory() . '/assets/' . $service_data['featured_image'];
            if (file_exists($image_path)) {
                $upload = wp_upload_bits($service_data['featured_image'], null, file_get_contents($image_path));
                if (!$upload['error']) {
                    $wp_filetype = wp_check_filetype($service_data['featured_image'], null);
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => preg_replace('/\.[^.]+$/', '', $service_data['featured_image']),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );
                    
                    $attach_id = wp_insert_attachment($attachment, $upload['file'], $service_id);
                    if (!is_wp_error($attach_id)) {
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
                        wp_update_attachment_metadata($attach_id, $attach_data);
                        set_post_thumbnail($service_id, $attach_id);
                    }
                }
            }
            
            // Save icon data as custom meta
            if (isset($service_data['icon_name'])) {
                update_post_meta($service_id, '_service_icon_name', $service_data['icon_name']);
            }
            if (isset($service_data['icon_color'])) {
                update_post_meta($service_id, '_service_icon_color', $service_data['icon_color']);
            }
            
            // Save taksativne opcije
            if (isset($service_data['taksativne_opcije'])) {
                update_post_meta($service_id, '_taksativne_opcije', $service_data['taksativne_opcije']);
            }
            
            $imported_count++;
        }
    }
    
    return array(
        'imported' => $imported_count,
        'skipped' => $skipped_count,
        'total' => count($services_data)
    );
}

/**
 * Import demo pages (O nama, Kontakt)
 */
// Demo blog posts dataset (related to conservation/restoration)
function lunart_get_demo_posts_data() {
    return array(
        array(
            'title' => 'Kako čuvati akvarele: vodič za vlasnike',
            'slug' => 'kako-cuvati-akvarele',
            'excerpt' => 'Praktični saveti za očuvanje akvarela – od pravilnog uokvirivanja do kontrole vlage.',
            'content' => "<p>Akvarel je izuzetno osetljiva tehnika. Pigmenti su vodorastvorljivi i lako reaguju na vlagu i UV svetlo. Pravilno uokvirivanje sa paspartuom bez kiseline (acid-free) i staklom sa UV zaštitom je prvi korak.</p><p>Održavajte ujednačenu vlažnost (oko 45–55%) i izbegavajte nagle temperaturne promene. Ne kačite radove iznad radijatora ili u kupatilu.</p>",
            'featured_image' => 'restored-watercolor-painting.png'
        ),
        array(
            'title' => 'Restauracija starih plakata: šta je moguće popraviti?',
            'slug' => 'restauracija-starih-plakata',
            'excerpt' => 'Od cepanja do diskoloracije – mogućnosti i granice restauracije vintage postera.',
            'content' => "<p>Vintage plakati često stižu sa naborima, cepanjima i žutim flekama. Konzervatorske intervencije mogu stabilizovati papir, sanirati poderotine i estetski integrišiti nedostajuće delove.</p><p>Važno je razlikovati konzervaciju (stabilizaciju) od retuširanja (estetske korekcije). Naš pristup je minimalno invazivan i reverzibilan.</p>",
            'featured_image' => 'restored-vintage-poster.png'
        ),
        array(
            'title' => 'Konzervacija rukopisa i knjiga: osnovni principi',
            'slug' => 'konzervacija-rukopisa-i-knjiga',
            'excerpt' => 'Kako pristupamo starim rukopisima i knjigama i koje materijale koristimo.',
            'content' => "<p>Rukopisi zahtevaju specifičan režim čuvanja. Koristimo materijale bez kiseline, neutralne mapne kutije i specijalne lepkove koji ne oštećuju celulozna vlakna.</p><p>Pre intervencije radi se detaljna procena stanja i plan tretmana koji uključuje suvo čišćenje, ispravljanje deformacija i lokalne zahvate.</p>",
            'featured_image' => 'preserved-manuscript-pages.png'
        ),
        array(
            'title' => 'Ugalj i olovka: razlike u restauraciji crteža',
            'slug' => 'ugalj-i-olovka-restauracija',
            'excerpt' => 'Zašto crteži ugljem traže drugačiji tretman u odnosu na olovku.',
            'content' => "<p>Crteži ugljem imaju labav pigment koji se lako razmazuje. Fiksiranje se radi pažljivo i ciljano, a intervencije su minimalne.</p><p>Kod olovke je pigment stabilniji, pa je fokus na stabilizaciji papira i uklanjanju mrlja.</p>",
            'featured_image' => 'conserved-charcoal-drawing.png'
        ),
        array(
            'title' => 'Šta znači „acid-free“ i zašto je važno?',
            'slug' => 'sta-znaci-acid-free',
            'excerpt' => 'Kratko objašnjenje pojma „bez kiseline“ u materijalima za uokviravanje i arhiviranje.',
            'content' => "<p>„Acid-free“ označava materijale sa neutralnim pH koji ne izazivaju ubrzano starenje papira. Za mapne kutije, paspartue i pozadine birajte isključivo arhivske, acid-free varijante.</p>",
            'featured_image' => 'preserved-manuscript-pages.png'
        ),
    );
}

function lunart_import_demo_posts($overwrite = false) {
    $posts_data = lunart_get_demo_posts_data();
    $imported = 0; $skipped = 0;

    // Ensure categories exist
    $cat_names = array('Konzervacija', 'Restauracija');
    $cat_ids = array();
    foreach ($cat_names as $cn) {
        $term = term_exists($cn, 'category');
        if (!$term) { $term = wp_insert_term($cn, 'category'); }
        if (!is_wp_error($term)) { $cat_ids[] = (int) (is_array($term) ? $term['term_id'] : $term); }
    }

    $tags = array('konzervacija', 'restauracija', 'papir');

    foreach ($posts_data as $pd) {
        $existing = get_page_by_path($pd['slug'], OBJECT, 'post');
        if ($existing && !$overwrite) { $skipped++; continue; }

        $post_args = array(
            'post_title' => $pd['title'],
            'post_name' => $pd['slug'],
            'post_excerpt' => $pd['excerpt'],
            'post_content' => $pd['content'],
            'post_status' => 'publish',
            'post_type' => 'post',
            'post_author' => 1,
            'post_category' => $cat_ids,
            'tags_input' => $tags,
        );

        if ($existing && $overwrite) { $post_args['ID'] = $existing->ID; $post_id = wp_update_post($post_args); }
        else { $post_id = wp_insert_post($post_args); }

        if (!is_wp_error($post_id)) {
            // Mark as demo
            update_post_meta($post_id, '_lunart_demo', 1);
            // Set featured image from theme assets
            if (!empty($pd['featured_image'])) {
                $image_path = get_template_directory() . '/assets/' . $pd['featured_image'];
                if (file_exists($image_path)) {
                    $upload = wp_upload_bits($pd['featured_image'], null, file_get_contents($image_path));
                    if (!$upload['error']) {
                        $wp_filetype = wp_check_filetype($pd['featured_image'], null);
                        $attachment = array(
                            'post_mime_type' => $wp_filetype['type'],
                            'post_title' => preg_replace('/\.[^.]+$/', '', $pd['featured_image']),
                            'post_content' => '',
                            'post_status' => 'inherit'
                        );
                        $attach_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
                        if (!is_wp_error($attach_id)) {
                            require_once(ABSPATH . 'wp-admin/includes/image.php');
                            $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
                            wp_update_attachment_metadata($attach_id, $attach_data);
                            set_post_thumbnail($post_id, $attach_id);
                        }
                    }
                }
            }
            $imported++;
        }
    }

    return array('imported' => $imported, 'skipped' => $skipped, 'total' => count($posts_data));
}

function lunart_import_demo_pages() {
    $pages_data = array(
        array(
            'title' => 'Početna',
            'slug' => 'pocetna',
            'content' => '<!-- wp:lunart/hero /--><!-- wp:lunart/services /--><!-- wp:lunart/gallery /--><!-- wp:lunart/blog-teaser /--><!-- wp:lunart/about /-->',
            'template' => 'page'
        ),
        array(
            'title' => 'Blog',
            'slug' => 'blog',
            'content' => '',
            'template' => 'page'
        ),
        array(
            'title' => 'O nama',
            'slug' => 'o-nama',
            'content' => '
<h2>O Lunart-u</h2>
<p>Lunart je specijalizovana ustanova posvećena očuvanju kulturnog nasleđa kroz stručnu konzervaciju i restauraciju umetničkih dela na papiru.</p>

<h3>Naša Misija</h3>
<p>Naša misija je očuvanje i restauracija umetničkih dela na papiru, čime doprinosimo očuvanju kulturnog nasleđa i omogućavamo budućim generacijama da uživaju u lepoti originalnih umetničkih dela.</p>

<h3>Naše Vrednosti</h3>
<ul>
<li><strong>Stručnost:</strong> Više od 15 godina iskustva u konzervaciji</li>
<li><strong>Preciznost:</strong> Pažljivo i detaljno rukovanje svakim umetničkim delom</li>
<li><strong>Inovacije:</strong> Korišćenje najsavremenijih tehnika i materijala</li>
<li><strong>Održivost:</strong> Korišćenje ekološki prihvatljivih materijala</li>
</ul>

<h3>Naš Tim</h3>
<p>Naš tim čine stručnjaci sa iskustvom u konzervaciji i restauraciji umetničkih dela na papiru. Svaki član tima je posvećen očuvanju umetnosti i kulturnog nasleđa.</p>

<h3>Naša Uverenja</h3>
<p>Svaki rad koji prođe kroz naše ruke nije samo restauriran - on je vraćen u život, spreman da inspiriše buduće generacije.</p>
            ',
            'template' => 'page'
        ),
        array(
            'title' => 'Kontakt',
            'slug' => 'kontakt',
            'content' => '
<h2>Kontaktirajte Nas</h2>
<p>Javite nam se za besplatnu konsultaciju i procenu vašeg umetničkog dela.</p>

<h3>Kontakt Informacije</h3>
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin: 2rem 0;">
    <div>
        <h4>Adresa</h4>
        <p>Beograd-Zvezdara<br>Republika Srbija</p>
    </div>
    <div>
        <h4>Email</h4>
        <p><a href="mailto:info@lunart.rs">info@lunart.rs</a></p>
    </div>
    <div>
        <h4>Telefon</h4>
        <p>+381 XX XXX XXXX</p>
    </div>
    <div>
        <h4>Radno Vreme</h4>
        <p>Pon-Pet: 9:00 - 17:00<br>Sub: 9:00 - 13:00</p>
    </div>
</div>

<h3>Poslovni Podaci</h3>
<p><strong>Naziv:</strong> LUNART</p>
<p><strong>Poslovno ime:</strong> Mila Borak preduzetnik Umetničko stvaralaštvo Lunart Beograd-Zvezdara</p>
<p><strong>PIB:</strong> 115033613</p>
<p><strong>Matični broj:</strong> 68039665</p>

<h3>Kako do Nas</h3>
<p>Nalazimo se u Beogradu, u opštini Zvezdara. Za detaljnije informacije o tačnoj lokaciji, kontaktirajte nas telefonom ili emailom.</p>

<h3>Besplatna Konsultacija</h3>
<p>Pružamo besplatnu konsultaciju za sve vrste umetničkih dela na papiru. Kontaktirajte nas i dogovorite termin za procenu.</p>
            ',
            'template' => 'page'
        )
    );
    
    $created_count = 0;
    
    $home_id = 0;
    $blog_id = 0;

    foreach ($pages_data as $page_data) {
        // Check if page already exists
        $existing_page = get_page_by_path($page_data['slug']);
        
        if ($existing_page) {
            $page_id = $existing_page->ID;
        } else {
            $page_args = array(
                'post_title' => $page_data['title'],
                'post_content' => $page_data['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_name' => $page_data['slug']
            );
            
            $page_id = wp_insert_post($page_args);
            
            if (!is_wp_error($page_id)) {
                $created_count++;
            }
        }

        // Track home/blog IDs
        if ($page_data['slug'] === 'pocetna') {
            $home_id = intval($page_id);
        } elseif ($page_data['slug'] === 'blog') {
            $blog_id = intval($page_id);
        }
    }

    // Assign Front Page and Posts Page if available
    if ($home_id && $blog_id) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
        update_option('page_for_posts', $blog_id);
    }
    
    return $created_count;
}

/**
 * Create demo menus (primary and footer) and assign to locations
 */
function lunart_import_demo_menus() {
    // Ensure theme locations exist
    $locations = get_theme_mod('nav_menu_locations');
    if (!is_array($locations)) {
        $locations = array();
    }

    // Helper to get or create a menu
    $ensure_menu = function($menu_name) {
        $menu = wp_get_nav_menu_object($menu_name);
        if (!$menu) {
            $menu_id = wp_create_nav_menu($menu_name);
        } else {
            $menu_id = $menu->term_id;
        }
        return (int)$menu_id;
    };

    // Create Primary menu with common items
    $primary_menu_id = $ensure_menu(__('Glavni meni', 'lunart'));

    // Collect target pages if they exist
    $home_url   = home_url('/');
    $about_page = get_page_by_path('o-nama');
    $contact_page = get_page_by_path('kontakt');
    $blog_page = get_page_by_path('blog');

    // Try to get services and gallery archive links if CPTs are registered
    $services_archive = get_post_type_archive_link('service');
    $gallery_archive = get_post_type_archive_link('gallery_item');

    // Helper to ensure a menu item exists (by title + url) before creating
    $ensure_menu_item = function($menu_id, $title, $url) {
        $items = wp_get_nav_menu_items($menu_id);
        if ($items) {
            foreach ($items as $item) {
                if ($item->title === $title && untrailingslashit($item->url) === untrailingslashit($url)) {
                    return $item->ID; // exists
                }
            }
        }
        return wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => $title,
            'menu-item-url'   => $url,
            'menu-item-status'=> 'publish'
        ));
    };

    // Build primary items
    $ensure_menu_item($primary_menu_id, __('Početna', 'lunart'), $home_url);
    if ($gallery_archive) {
        $ensure_menu_item($primary_menu_id, __('Galerija', 'lunart'), $gallery_archive);
    }
    if ($services_archive) {
        $ensure_menu_item($primary_menu_id, __('Usluge', 'lunart'), $services_archive);
    }
    if ($about_page) {
        $ensure_menu_item($primary_menu_id, __('O nama', 'lunart'), get_permalink($about_page));
    }
    if ($blog_page) {
        $ensure_menu_item($primary_menu_id, __('Blog', 'lunart'), get_permalink($blog_page));
    }
    if ($contact_page) {
        $ensure_menu_item($primary_menu_id, __('Kontakt', 'lunart'), get_permalink($contact_page));
    }

    // Assign to primary location
    $registered_locations = get_registered_nav_menus();
    if (isset($registered_locations['primary'])) {
        $locations['primary'] = $primary_menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    // Create Footer menu (optional)
    $footer_menu_id = $ensure_menu(__('Footer meni', 'lunart'));
    if ($contact_page) {
        $ensure_menu_item($footer_menu_id, __('Kontakt', 'lunart'), get_permalink($contact_page));
    }
    // Privacy Policy page if exists
    if (function_exists('get_privacy_policy_url')) {
        $pp_url = get_privacy_policy_url();
        if (!empty($pp_url)) {
            $ensure_menu_item($footer_menu_id, __('Politika privatnosti', 'lunart'), $pp_url);
        }
    }

    // Assign to footer location if available
    if (isset($registered_locations['footer'])) {
        $locations['footer'] = $footer_menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    return array(
        'primary_menu_id' => $primary_menu_id,
        'footer_menu_id' => $footer_menu_id,
    );
}

/**
 * Admin page for demo content import
 */
function lunart_add_demo_import_menu() {
    add_management_page(
        'Demo Content Importer',
        'Demo Content',
        'manage_options',
        'demo-content-importer',
        'lunart_demo_import_page'
    );
}
add_action('admin_menu', 'lunart_add_demo_import_menu');

// Helper: Purge existing demo content (services, gallery items, specific pages, menus)
if (!function_exists('lunart_purge_demo_content')) {
    function lunart_purge_demo_content() {
        // Delete CPT posts: service, gallery_item and demo blog posts
        $types = array('service', 'gallery_item');
        foreach ($types as $pt) {
            $posts = get_posts(array('post_type' => $pt, 'numberposts' => -1, 'post_status' => 'any'));
            foreach ($posts as $p) {
                wp_delete_post($p->ID, true);
            }
        }
        // Delete demo blog posts (flagged by meta)
        $demo_posts = get_posts(array(
            'post_type' => 'post',
            'numberposts' => -1,
            'post_status' => 'any',
            'meta_key' => '_lunart_demo',
            'meta_value' => 1,
        ));
        foreach ($demo_posts as $dp) { wp_delete_post($dp->ID, true); }
        // Delete specific pages by slug
        $slugs = array('pocetna', 'blog', 'o-nama', 'kontakt');
        foreach ($slugs as $slug) {
            $page = get_page_by_path($slug);
            if ($page) {
                wp_delete_post($page->ID, true);
            }
        }
        // Delete demo menus by name if they exist
        $menu_names = array(__('Primary meni', 'lunart'), __('Footer meni', 'lunart'));
        foreach ($menu_names as $mn) {
            $menu = wp_get_nav_menu_object($mn);
            if ($menu) {
                wp_delete_nav_menu($menu->term_id);
            }
        }
        // Clear menu locations to avoid pointing to deleted menus
        $locations = get_theme_mod('nav_menu_locations');
        if (is_array($locations)) {
            foreach ($locations as $loc => $term_id) {
                $locations[$loc] = 0;
            }
            set_theme_mod('nav_menu_locations', $locations);
        }
        // Optionally reset front page settings (will be set by import again)
        update_option('show_on_front', 'posts');
        delete_option('page_on_front');
        delete_option('page_for_posts');
    }
}

function lunart_demo_import_page() {
    // Handle ALL content import first (aggregate action)
    if (isset($_POST['import_all'])) {
        $did_purge = false;
        if (!empty($_POST['confirm_delete_all'])) {
            if (function_exists('lunart_purge_demo_content')) {
                lunart_purge_demo_content();
                $did_purge = true;
            }
        }

        // Run individual importers
        $services = lunart_import_demo_services(true);
        $gallery = lunart_import_demo_gallery(true);
        $pages_created = lunart_import_demo_pages();
        $posts = lunart_import_demo_posts(true);
        $menus = lunart_import_demo_menus();
        // CF7 is optional; attempt but ignore if plugin not active
        $cf7_msg = '';
        if (function_exists('lunart_import_contact_form7')) {
            $cf7_result = lunart_import_contact_form7();
            $cf7_msg = $cf7_result['message'];
        }

        echo '<div class="notice notice-success"><p>';
        echo ($did_purge ? 'Postojeći demo sadržaj je obrisan.<br>' : '');
        echo 'Usluge: uvezeno ' . intval($services['imported']) . ', preskočeno ' . intval($services['skipped']) . ', ukupno ' . intval($services['total']) . '.<br>';
        echo 'Galerija: uvezeno ' . intval($gallery['imported']) . ', preskočeno ' . intval($gallery['skipped']) . ', ukupno ' . intval($gallery['total']) . '.<br>';
        echo 'Stranice: kreirano/obnovljeno ' . intval($pages_created) . '.<br>';
        echo 'Blog postovi: uvezeno ' . intval($posts['imported']) . ', preskočeno ' . intval($posts['skipped']) . ', ukupno ' . intval($posts['total']) . '.<br>';
        echo 'Meniji: kreirani/dodeljeni.<br>';
        if (!empty($cf7_msg)) { echo 'Kontakt forma: ' . esc_html($cf7_msg) . '<br>'; }
        echo 'ALL import završen.';
        echo '</p></div>';
    }
    if (isset($_POST['import_services'])) {
        $overwrite = isset($_POST['overwrite_existing']);
        $result = lunart_import_demo_services($overwrite);
        echo '<div class="notice notice-success"><p>';
        echo 'Uspešno uvezeno: ' . $result['imported'] . ' usluga<br>';
        echo 'Preskočeno: ' . $result['skipped'] . ' usluga<br>';
        echo 'Ukupno: ' . $result['total'] . ' usluga';
        echo '</p></div>';
    }

    if (isset($_POST['import_gallery'])) {
        $overwrite = isset($_POST['overwrite_existing_gallery']);
        $result = lunart_import_demo_gallery($overwrite);
        echo '<div class="notice notice-success"><p>';
        echo 'Uspešno uvezeno: ' . $result['imported'] . ' radova<br>';
        echo 'Preskočeno: ' . $result['skipped'] . ' radova<br>';
        echo 'Ukupno: ' . $result['total'] . ' radova';
        echo '</p></div>';
    }
    
    if (isset($_POST['import_posts'])) {
        $overwrite = isset($_POST['overwrite_existing_posts']);
        $result = lunart_import_demo_posts($overwrite);
        echo '<div class="notice notice-success"><p>';
        echo 'Uspešno uvezeno: ' . $result['imported'] . ' postova<br>';
        echo 'Preskočeno: ' . $result['skipped'] . ' postova<br>';
        echo 'Ukupno: ' . $result['total'] . ' postova';
        echo '</p></div>';
    }

    if (isset($_POST['import_pages'])) {
        $result = lunart_import_demo_pages();
        echo '<div class="notice notice-success"><p>Demo stranice su uspešno kreirane!</p></div>';
    }

    if (isset($_POST['import_menus'])) {
        $menus = lunart_import_demo_menus();
        echo '<div class="notice notice-success"><p>Demo meniji su kreirani i dodeljeni lokacijama (Primary i Footer).</p></div>';
    }

    if (isset($_POST['import_cf7'])) {
        $cf7_result = lunart_import_contact_form7();
        if ($cf7_result['status'] === 'success') {
            echo '<div class="notice notice-success"><p>' . esc_html($cf7_result['message']) . '</p></div>';
        } else {
            echo '<div class="notice notice-warning"><p>' . esc_html($cf7_result['message']) . '</p></div>';
        }
    }
    
    ?>
    <div class="wrap">
        <h1>Demo Content Importer</h1>
        <p>Uvezite demo sadržaj za vašu temu.</p>

        <form method="post">
            <h2>Uvezi SAV Sadržaj</h2>
            <p>Jednim klikom uvezite: Galeriju, Usluge, Stranice (Početna, Blog, O nama, Kontakt), Blog postove, Menije i Kontakt formu (ako je CF7 aktivan).</p>
            <label style="display:inline-flex;align-items:center;gap:8px;">
                <input type="checkbox" name="confirm_delete_all" value="1">
                Obriši postojeći sadržaj (potvrda)
            </label>
            <br><br>
            <input type="submit" name="import_all" class="button button-primary" value="Uvezi SAV Sadržaj">
        </form>
        
        <hr style="margin: 30px 0;">
        
        <form method="post">
            <h2>Galerija radova</h2>
            <p>Uvezite demo radove sa pre/posle slikama, kategorijama i podnaslovima.</p>
            <label>
                <input type="checkbox" name="overwrite_existing_gallery" value="1">
                Prepiši postojeće radove galerije
            </label>
            <br><br>
            <input type="submit" name="import_gallery" class="button button-primary" value="Uvezi Galeriju">
        </form>
        
        <hr style="margin: 30px 0;">
        
        <form method="post">
            <h2>Usluge</h2>
            <p>Uvezite demo usluge sa slikama, ikonicama i taksativnim opcijama.</p>
            <label>
                <input type="checkbox" name="overwrite_existing" value="1">
                Prepiši postojeće usluge
            </label>
            <br><br>
            <input type="submit" name="import_services" class="button button-primary" value="Uvezi Usluge">
        </form>
        
        <hr style="margin: 30px 0;">
        
        <form method="post">
            <h2>Blog postovi</h2>
            <p>Uvezite demo blog postove sa temama iz oblasti konzervacije i restauracije.</p>
            <label>
                <input type="checkbox" name="overwrite_existing_posts" value="1">
                Prepiši postojeće demo postove
            </label>
            <br><br>
            <input type="submit" name="import_posts" class="button button-primary" value="Uvezi Blog Postove">
        </form>
        
        <hr style="margin: 30px 0;">
        
        <form method="post">
            <h2>Stranice</h2>
            <p>Kreirajte demo stranice: O nama i Kontakt.</p>
            <input type="submit" name="import_pages" class="button button-primary" value="Kreiraj Stranice">
        </form>

        <hr style="margin: 30px 0;">

        <form method="post">
            <h2>Meniji</h2>
            <p>Kreirajte i dodelite demo menije za lokacije: Primary i Footer.</p>
            <input type="submit" name="import_menus" class="button button-primary" value="Kreiraj Menije">
        </form>

        <hr style="margin: 30px 0;">

        <form method="post">
            <h2>Kontakt forma (Contact Form 7)</h2>
            <p>Dodaje osnovnu kontakt formu i ubacuje shortcode na stranicu Kontakt (ako je plugin aktivan).</p>
            <input type="submit" name="import_cf7" class="button" value="Kreiraj Kontakt Formu">
            <p style="margin-top:8px;color:#666;">Napomena: Ne može automatski instalirati plugin. Prvo instalirajte i aktivirajte „Contact Form 7“ kroz Plugins.</p>
        </form>
    </div>
    <?php
}

// Helper: Create a Contact Form 7 default form and inject into Kontakt page
if (!function_exists('lunart_import_contact_form7')) {
    function lunart_import_contact_form7() {
        if (!class_exists('WPCF7_ContactForm')) {
            return array(
                'status' => 'error',
                'message' => 'Contact Form 7 nije aktivan. Molimo instalirajte i aktivirajte plugin, pa pokušajte ponovo.'
            );
        }

        // Check if a form with our title already exists
        $form_title = 'Kontakt forma (Lunart)';
        $existing = get_posts(array(
            'post_type' => 'wpcf7_contact_form',
            'title' => $form_title,
            'numberposts' => 1,
        ));

        if (!empty($existing)) {
            $form_id = $existing[0]->ID;
        } else {
            $form = WPCF7_ContactForm::get_template();
            $form->set_properties(array(
                'title' => $form_title,
                'form' => "[text* your-name placeholder\"Ime i prezime\"]\n[email* your-email placeholder\"Email\"]\n[tel your-phone placeholder\"Telefon (opciono)\"]\n[textarea your-message placeholder\"Poruka\"]\n[submit \"Pošalji\"]",
                'mail' => array(
                    'active' => true,
                ),
            ));
            $form->save();
            $form_id = $form->id();
        }

        // Insert shortcode into Kontakt page if it exists
        $contact_page = get_page_by_path('kontakt');
        if ($contact_page) {
            $shortcode = '[contact-form-7 id="' . intval($form_id) . '" title="' . esc_attr($form_title) . '"]';
            // Append if not already present
            if (strpos($contact_page->post_content, '[contact-form-7') === false) {
                $updated = array(
                    'ID' => $contact_page->ID,
                    'post_content' => $contact_page->post_content . "\n\n" . $shortcode,
                );
                wp_update_post($updated);
            }
        }

        return array(
            'status' => 'success',
            'message' => 'Kontakt forma je spremna. Ako Kontakt stranica postoji, shortcode je dodat.'
        );
    }
}
