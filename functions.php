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

function lunart_gallery_meta_box_callback($post) {
    wp_nonce_field('lunart_save_gallery_meta', 'lunart_gallery_meta_nonce');

    $before_image = get_post_meta($post->ID, '_before_image', true);
    $after_image = get_post_meta($post->ID, '_after_image', true);
    $category = get_post_meta($post->ID, '_category', true);

    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="before_image">' . __('Pre Restauracije (URL slike)', 'lunart') . '</label></th>';
    echo '<td><input type="text" id="before_image" name="before_image" value="' . esc_attr($before_image) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="after_image">' . __('Posle Restauracije (URL slike)', 'lunart') . '</label></th>';
    echo '<td><input type="text" id="after_image" name="after_image" value="' . esc_attr($after_image) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="category">' . __('Kategorija', 'lunart') . '</label></th>';
    echo '<td><input type="text" id="category" name="category" value="' . esc_attr($category) . '" class="regular-text" /></td>';
    echo '</tr>';
    echo '</table>';
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
        update_post_meta($post_id, '_before_image', sanitize_text_field($_POST['before_image']));
    }

    if (isset($_POST['after_image'])) {
        update_post_meta($post_id, '_after_image', sanitize_text_field($_POST['after_image']));
    }

    if (isset($_POST['category'])) {
        update_post_meta($post_id, '_category', sanitize_text_field($_POST['category']));
    }
}
add_action('save_post', 'lunart_save_gallery_meta');

/**
 * Add custom shortcodes
 */
function lunart_gallery_shortcode($atts) {
    $atts = shortcode_atts(array(
        'category' => '',
        'limit' => 6,
    ), $atts);

    $args = array(
        'post_type' => 'gallery_item',
        'posts_per_page' => $atts['limit'],
        'post_status' => 'publish',
    );

    if (!empty($atts['category'])) {
        $args['meta_query'] = array(
            array(
                'key' => '_category',
                'value' => $atts['category'],
                'compare' => '=',
            ),
        );
    }

    $gallery_query = new WP_Query($args);
    $output = '';

    if ($gallery_query->have_posts()) {
        $output .= '<div class="gallery-grid">';
        
        while ($gallery_query->have_posts()) {
            $gallery_query->the_post();
            $before_image = get_post_meta(get_the_ID(), '_before_image', true);
            $after_image = get_post_meta(get_the_ID(), '_after_image', true);
            $category = get_post_meta(get_the_ID(), '_category', true);

            $output .= '<div class="gallery-item elegant-border overflow-hidden elegant-hover">';
            $output .= '<div class="gallery-images">';
            $output .= '<div class="gallery-image">';
            $output .= '<img src="' . esc_url($before_image) . '" alt="' . get_the_title() . ' - pre restauracije">';
            $output .= '<div class="gallery-image-overlay"><span>PRE</span></div>';
            $output .= '</div>';
            $output .= '<div class="gallery-image">';
            $output .= '<img src="' . esc_url($after_image) . '" alt="' . get_the_title() . ' - posle restauracije">';
            $output .= '<div class="gallery-image-overlay"><span>POSLE</span></div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="gallery-content">';
            $output .= '<span class="gallery-category">' . esc_html($category) . '</span>';
            $output .= '<h3 class="gallery-title">' . get_the_title() . '</h3>';
            $output .= '<p class="gallery-description">' . get_the_excerpt() . '</p>';
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
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive('gallery_item')) {
            $query->set('posts_per_page', 12);
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
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
 * Demo Content Importer for Services
 */
function lunart_get_demo_services_data() {
    return array(
        array(
            'title' => 'Restauracija Akvarela',
            'content' => 'Stručna restauracija akvarelnih slika i ilustracija sa očuvanjem originalnih boja i tekstura. Koristimo najsavremenije tehnike konzervacije za zaštitu vaših dragocenih umetničkih dela.',
            'excerpt' => 'Delikatan tretman akvarelnih slika sa očuvanjem originalnih boja i tekstura.',
            'featured_image' => 'restored-watercolor-painting.png'
        ),
        array(
            'title' => 'Konzervacija Knjiga',
            'content' => 'Profesionalna nega retkih knjiga, rukopisa i istorijskih dokumenata. Pružamo kompletne usluge konzervacije koje obuhvataju čišćenje, stabilizaciju i zaštitu od daljeg propadanja.',
            'excerpt' => 'Profesionalna nega retkih knjiga, rukopisa i istorijskih dokumenata.',
            'featured_image' => 'conserved-manuscript-pages.png'
        ),
        array(
            'title' => 'Restauracija Crteža',
            'content' => 'Stručna restauracija crteža različitih tehnika - olovka, ugalj, pastel, tuš. Uklanjamo mrlje, popravljamo oštećenja papira i stabilizujemo medijum.',
            'excerpt' => 'Restauracija crteža različitih tehnika sa očuvanjem originalnog izgleda.',
            'featured_image' => 'faded-charcoal-drawing.png'
        ),
        array(
            'title' => 'Vintage Plakati',
            'content' => 'Specializovana restauracija starih plakata i grafičkih radova. Uklanjamo lepak, popravljamo preklopljene delove i montiramo na arhivski karton.',
            'excerpt' => 'Restauracija starih plakata i grafičkih radova sa očuvanjem istorijskog značaja.',
            'featured_image' => 'restored-vintage-poster.png'
        ),
        array(
            'title' => 'Analiza Materijala',
            'content' => 'Detaljno ispitivanje materijala pre početka restauracije. Identifikujemo pigmente, analiziramo papir i procenjujemo stanje umetničkog dela.',
            'excerpt' => 'Detaljna analiza materijala za optimalan pristup restauraciji.',
            'featured_image' => 'damaged-watercolor-painting.png'
        ),
        array(
            'title' => 'Preventivna Zaštita',
            'content' => 'Saveti i usluge za dugoročno očuvanje umetničkih dela. Uključujemo klimatske uslove, pravilno čuvanje i redovne preglede.',
            'excerpt' => 'Saveti za dugoročno očuvanje i zaštitu umetničkih dela.',
            'featured_image' => 'preserved-manuscript-pages.png'
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

function lunart_demo_import_page() {
    if (isset($_POST['import_services'])) {
        $overwrite = isset($_POST['overwrite_existing']);
        $result = lunart_import_demo_services($overwrite);
        
        echo '<div class="notice notice-success"><p>';
        echo 'Uspešno uvezeno: ' . $result['imported'] . ' usluga<br>';
        echo 'Preskočeno: ' . $result['skipped'] . ' usluga<br>';
        echo 'Ukupno: ' . $result['total'] . ' usluga';
        echo '</p></div>';
    }
    
    ?>
    <div class="wrap">
        <h1>Demo Content Importer</h1>
        <p>Uvezite demo sadržaj za vašu temu.</p>
        
        <form method="post">
            <h2>Usluge</h2>
            <p>Uvezite demo usluge sa slikama i opisima.</p>
            <label>
                <input type="checkbox" name="overwrite_existing" value="1">
                Prepiši postojeće usluge
            </label>
            <br><br>
            <input type="submit" name="import_services" class="button button-primary" value="Uvezi Usluge">
        </form>
    </div>
    <?php
}
