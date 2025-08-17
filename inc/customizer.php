<?php
/**
 * Lunart Theme Customizer
 *
 * @package Lunart
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lunart_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'lunart_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'lunart_customize_partial_blogdescription',
        ));
    }

    // Hero Section
    $wp_customize->add_section('lunart_hero', array(
        'title' => __('Hero Sekcija', 'lunart'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_title', array(
        'default' => 'Čuvamo Umetnost',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Naslov', 'lunart'),
        'section' => 'lunart_hero',
        'type' => 'text',
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'za Buduće Generacije',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Podnaslov', 'lunart'),
        'section' => 'lunart_hero',
        'type' => 'text',
    ));

    // Contact Information
    $wp_customize->add_section('lunart_contact', array(
        'title' => __('Kontakt Informacije', 'lunart'),
        'priority' => 35,
    ));

    $wp_customize->add_setting('contact_phone', array(
        'default' => '+381 11 123 4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_phone', array(
        'label' => __('Telefon', 'lunart'),
        'section' => 'lunart_contact',
        'type' => 'text',
    ));

    $wp_customize->add_setting('contact_email', array(
        'default' => 'info@lunart.rs',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label' => __('Email', 'lunart'),
        'section' => 'lunart_contact',
        'type' => 'email',
    ));

    $wp_customize->add_setting('contact_address', array(
        'default' => 'Beograd, Srbija',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label' => __('Adresa', 'lunart'),
        'section' => 'lunart_contact',
        'type' => 'text',
    ));

    // Logo Section
    $wp_customize->add_section('lunart_logo_options', array(
        'title' => __('Logo Options', 'lunart'),
        'priority' => 40,
        'description' => __('Customize your logo display options', 'lunart')
    ));

    // Logo Type
    $wp_customize->add_setting('lunart_logo_type', array(
        'default' => 'image',
        'sanitize_callback' => 'lunart_sanitize_logo_type'
    ));

    $wp_customize->add_control('lunart_logo_type', array(
        'label' => __('Logo Type', 'lunart'),
        'section' => 'lunart_logo_options',
        'type' => 'radio',
        'choices' => array(
            'image' => __('Image Logo', 'lunart'),
            'text' => __('Text Logo', 'lunart'),
            'both' => __('Both Image and Text', 'lunart')
        )
    ));

    // Logo Image
    $wp_customize->add_setting('lunart_logo_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'lunart_logo_image', array(
        'label' => __('Logo Image', 'lunart'),
        'section' => 'lunart_logo_options',
        'description' => __('Upload your logo image (recommended size: 400x100px)', 'lunart')
    )));

    // Logo Text
    $wp_customize->add_setting('lunart_logo_text', array(
        'default' => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('lunart_logo_text', array(
        'label' => __('Logo Text', 'lunart'),
        'section' => 'lunart_logo_options',
        'type' => 'text',
        'description' => __('Enter your logo text (if not using image or using both)', 'lunart')
    ));

    // Logo Subtitle
    $wp_customize->add_setting('lunart_logo_subtitle', array(
        'default' => get_bloginfo('description'),
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('lunart_logo_subtitle', array(
        'label' => __('Logo Subtitle', 'lunart'),
        'section' => 'lunart_logo_options',
        'type' => 'text',
        'description' => __('Enter your logo subtitle/tagline', 'lunart')
    ));

    // Logo Typography
    $wp_customize->add_setting('lunart_logo_font_family', array(
        'default' => 'Inria Serif',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('lunart_logo_font_family', array(
        'label' => __('Logo Font Family', 'lunart'),
        'section' => 'lunart_logo_options',
        'type' => 'select',
        'choices' => array(
            'Inria Serif' => 'Inria Serif',
            'Inter' => 'Inter',
            'Playfair Display' => 'Playfair Display',
            'Montserrat' => 'Montserrat',
            'Open Sans' => 'Open Sans',
            'Roboto' => 'Roboto',
            'Lora' => 'Lora',
            'Source Sans Pro' => 'Source Sans Pro'
        )
    ));

    // Logo Font Size
    $wp_customize->add_setting('lunart_logo_font_size', array(
        'default' => '32',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control('lunart_logo_font_size', array(
        'label' => __('Logo Font Size (px)', 'lunart'),
        'section' => 'lunart_logo_options',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 16,
            'max' => 72,
            'step' => 1
        )
    ));

    // Logo Font Weight
    $wp_customize->add_setting('lunart_logo_font_weight', array(
        'default' => '700',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('lunart_logo_font_weight', array(
        'label' => __('Logo Font Weight', 'lunart'),
        'section' => 'lunart_logo_options',
        'type' => 'select',
        'choices' => array(
            '300' => 'Light (300)',
            '400' => 'Regular (400)',
            '500' => 'Medium (500)',
            '600' => 'Semi Bold (600)',
            '700' => 'Bold (700)',
            '900' => 'Black (900)'
        )
    ));

    // Logo Color
    $wp_customize->add_setting('lunart_logo_color', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'lunart_logo_color', array(
        'label' => __('Logo Color', 'lunart'),
        'section' => 'lunart_logo_options'
    )));

    // Logo Subtitle Font Size
    $wp_customize->add_setting('lunart_logo_subtitle_font_size', array(
        'default' => '14',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control('lunart_logo_subtitle_font_size', array(
        'label' => __('Logo Subtitle Font Size (px)', 'lunart'),
        'section' => 'lunart_logo_options',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 10,
            'max' => 24,
            'step' => 1
        )
    ));

    // Logo Subtitle Color
    $wp_customize->add_setting('lunart_logo_subtitle_color', array(
        'default' => '#666666',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'lunart_logo_subtitle_color', array(
        'label' => __('Logo Subtitle Color', 'lunart'),
        'section' => 'lunart_logo_options'
    )));

    // Logo Alignment
    $wp_customize->add_setting('lunart_logo_alignment', array(
        'default' => 'left',
        'sanitize_callback' => 'lunart_sanitize_logo_alignment'
    ));

    $wp_customize->add_control('lunart_logo_alignment', array(
        'label' => __('Logo Alignment', 'lunart'),
        'section' => 'lunart_logo_options',
        'type' => 'select',
        'choices' => array(
            'left' => __('Left', 'lunart'),
            'center' => __('Center', 'lunart'),
            'right' => __('Right', 'lunart')
        )
    ));

    // Logo Spacing
    $wp_customize->add_setting('lunart_logo_spacing', array(
        'default' => '20',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control('lunart_logo_spacing', array(
        'label' => __('Logo Spacing (px)', 'lunart'),
        'section' => 'lunart_logo_options',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 5
        ),
        'description' => __('Space between logo elements', 'lunart')
    ));
}
add_action('customize_register', 'lunart_customize_register');

/**
 * Sanitize logo type
 */
function lunart_sanitize_logo_type($input) {
    $valid_types = array('image', 'text', 'both');
    if (in_array($input, $valid_types)) {
        return $input;
    }
    return 'image';
}

/**
 * Sanitize logo alignment
 */
function lunart_sanitize_logo_alignment($input) {
    $valid_alignments = array('left', 'center', 'right');
    if (in_array($input, $valid_alignments)) {
        return $input;
    }
    return 'left';
}

/**
 * Get logo HTML based on customizer settings
 */
function lunart_get_logo_html() {
    $logo_type = get_theme_mod('lunart_logo_type', 'text');
    $logo_image = get_theme_mod('lunart_logo_image', '');
    $logo_text = get_theme_mod('lunart_logo_text', get_bloginfo('name'));
    $logo_subtitle = get_theme_mod('lunart_logo_subtitle', get_bloginfo('description'));
    $logo_alignment = get_theme_mod('lunart_logo_alignment', 'left');
    $logo_spacing = get_theme_mod('lunart_logo_spacing', '20');

    // Fallback to text logo if no image is set and type is image
    if ($logo_type === 'image' && empty($logo_image)) {
        $logo_type = 'text';
    }

    $logo_class = 'lunart-logo lunart-logo-' . $logo_type . ' lunart-logo-' . $logo_alignment;

    $output = '<div class="' . esc_attr($logo_class) . '">';

    if ($logo_type === 'image' || $logo_type === 'both') {
        if (!empty($logo_image)) {
            $output .= '<div class="lunart-logo-image">';
            $output .= '<img src="' . esc_url($logo_image) . '" alt="' . esc_attr($logo_text) . '" class="lunart-logo-img">';
            $output .= '</div>';
        }
    }

    if ($logo_type === 'text' || $logo_type === 'both') {
        $logo_font_family = get_theme_mod('lunart_logo_font_family', 'Inria Serif');
        $logo_font_size = get_theme_mod('lunart_logo_font_size', '32');
        $logo_font_weight = get_theme_mod('lunart_logo_font_weight', '700');
        $logo_color = get_theme_mod('lunart_logo_color', '#333333');

        $output .= '<div class="lunart-logo-text">';
        $output .= '<h1 class="lunart-logo-title">';
        $output .= esc_html($logo_text);
        $output .= '</h1>';

        if (!empty($logo_subtitle)) {
            $subtitle_font_size = get_theme_mod('lunart_logo_subtitle_font_size', '14');
            $subtitle_color = get_theme_mod('lunart_logo_subtitle_color', '#666666');
            
            $output .= '<p class="lunart-logo-subtitle">';
            $output .= esc_html($logo_subtitle);
            $output .= '</p>';
        }
        $output .= '</div>';
    }

    $output .= '</div>';

    // Debug output (remove in production)
    if (current_user_can('administrator')) {
        $output .= '<!-- Logo Debug: Type=' . esc_html($logo_type) . ', Text=' . esc_html($logo_text) . ', Subtitle=' . esc_html($logo_subtitle) . ' -->';
    }

    return $output;
}

/**
 * Enqueue logo styles
 */
function lunart_logo_styles() {
    $logo_type = get_theme_mod('lunart_logo_type', 'text');
    $logo_font_family = get_theme_mod('lunart_logo_font_family', 'Inria Serif');
    $logo_font_size = get_theme_mod('lunart_logo_font_size', '32');
    $logo_font_weight = get_theme_mod('lunart_logo_font_weight', '700');
    $logo_color = get_theme_mod('lunart_logo_color', '#333333');
    $logo_subtitle_font_size = get_theme_mod('lunart_logo_subtitle_font_size', '14');
    $logo_subtitle_color = get_theme_mod('lunart_logo_subtitle_color', '#666666');
    $logo_alignment = get_theme_mod('lunart_logo_alignment', 'left');
    $logo_spacing = get_theme_mod('lunart_logo_spacing', '20');

    $custom_css = "
        .lunart-logo {
            text-align: {$logo_alignment};
        }
        .lunart-logo-image {
            margin-bottom: {$logo_spacing}px;
        }
        .lunart-logo-image img {
            max-width: 100%;
            height: auto;
        }
        .lunart-logo-text {
            margin-bottom: {$logo_spacing}px;
        }
        .lunart-logo-title {
            font-family: '{$logo_font_family}', serif !important;
            font-size: {$logo_font_size}px !important;
            font-weight: {$logo_font_weight} !important;
            color: {$logo_color} !important;
            margin: 0 !important;
            line-height: 1.2 !important;
        }
        .lunart-logo-subtitle {
            font-family: '{$logo_font_family}', serif !important;
            font-size: {$logo_subtitle_font_size}px !important;
            color: {$logo_subtitle_color} !important;
            margin: 5px 0 0 0 !important;
            line-height: 1.4 !important;
        }
        @media (max-width: 768px) {
            .lunart-logo-title {
                font-size: " . max(20, $logo_font_size - 8) . "px !important;
            }
            .lunart-logo-subtitle {
                font-size: " . max(12, $logo_subtitle_font_size - 2) . "px !important;
            }
        }
    ";

    wp_add_inline_style('lunart-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'lunart_logo_styles');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function lunart_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function lunart_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lunart_customize_preview_js() {
    wp_enqueue_script('lunart-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'lunart_customize_preview_js');
