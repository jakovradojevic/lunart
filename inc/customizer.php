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

    // Social Media Section
    $wp_customize->add_section('lunart_social_media', array(
        'title' => __('Društvene Mreže', 'lunart'),
        'priority' => 36,
    ));

    $wp_customize->add_setting('social_facebook', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('social_facebook', array(
        'label' => __('Facebook URL', 'lunart'),
        'section' => 'lunart_social_media',
        'type' => 'url',
        'description' => __('Unesite URL vaše Facebook stranice', 'lunart'),
    ));

    $wp_customize->add_setting('social_instagram', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('social_instagram', array(
        'label' => __('Instagram URL', 'lunart'),
        'section' => 'lunart_social_media',
        'type' => 'url',
        'description' => __('Unesite URL vaše Instagram stranice', 'lunart'),
    ));

    $wp_customize->add_setting('social_linkedin', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('social_linkedin', array(
        'label' => __('LinkedIn URL', 'lunart'),
        'section' => 'lunart_social_media',
        'type' => 'url',
        'description' => __('Unesite URL vaše LinkedIn stranice', 'lunart'),
    ));

    $wp_customize->add_setting('social_youtube', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('social_youtube', array(
        'label' => __('YouTube URL', 'lunart'),
        'section' => 'lunart_social_media',
        'type' => 'url',
        'description' => __('Unesite URL vaše YouTube stranice', 'lunart'),
    ));

    // Footer Section
    $wp_customize->add_section('lunart_footer', array(
        'title' => __('Footer Opcije', 'lunart'),
        'priority' => 37,
    ));

    $wp_customize->add_setting('footer_copyright', array(
        'default' => '© 2024 LUNART. Sva prava zadržana.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_copyright', array(
        'label' => __('Copyright Tekst', 'lunart'),
        'section' => 'lunart_footer',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_show_social', array(
        'default' => true,
        'sanitize_callback' => 'lunart_sanitize_checkbox',
    ));

    $wp_customize->add_control('footer_show_social', array(
        'label' => __('Prikaži društvene mreže u footeru', 'lunart'),
        'section' => 'lunart_footer',
        'type' => 'checkbox',
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

    // Move all Logo controls to the core Site Identity section (title_tagline)
    $lunart_logo_controls = array(
        'lunart_logo_type',
        'lunart_logo_image',
        'lunart_logo_text',
        'lunart_logo_subtitle',
        'lunart_logo_font_family',
        'lunart_logo_font_size',
        'lunart_logo_font_weight',
        'lunart_logo_color',
        'lunart_logo_subtitle_font_size',
        'lunart_logo_subtitle_color',
        'lunart_logo_alignment',
        'lunart_logo_spacing'
    );
    foreach ($lunart_logo_controls as $control_id) {
        $control = $wp_customize->get_control($control_id);
        if ($control) {
            $control->section = 'title_tagline';
            // Keep them grouped after core fields
            if (!isset($control->priority) || $control->priority < 60) {
                $control->priority = 60;
            }
        }
    }
    // Remove the old custom Logo section so options are only under Site Identity
    if ($wp_customize->get_section('lunart_logo_options')) {
        $wp_customize->remove_section('lunart_logo_options');
    }
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
 * Sanitize checkbox
 */
function lunart_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Get logo HTML based on customizer settings
 */
function lunart_get_logo_html() {
    // Read legacy Logo Options first
    $logo_type = get_theme_mod('lunart_logo_type', 'text');
    $logo_image = get_theme_mod('lunart_logo_image', '');
    $logo_text = get_theme_mod('lunart_logo_text', get_bloginfo('name'));
    $logo_subtitle = get_theme_mod('lunart_logo_subtitle', get_bloginfo('description'));
    $logo_alignment = get_theme_mod('lunart_logo_alignment', 'left');
    $logo_spacing = get_theme_mod('lunart_logo_spacing', '20');

    // If user selected an image in Logo Options, honor it for everyone (logged-in or not)
    $has_legacy_image = (!empty($logo_image) && ($logo_type === 'image' || $logo_type === 'both'));

    if ($has_legacy_image) {
        $logo_class = 'lunart-logo lunart-logo-' . $logo_type . ' lunart-logo-' . $logo_alignment;
        $output = '<div class="' . esc_attr($logo_class) . '">';
        // Image part
        $output .= '<div class="lunart-logo-image">';
        $output .= '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link" rel="home">';
        $output .= '<img src="' . esc_url($logo_image) . '" alt="' . esc_attr($logo_text) . '" class="lunart-logo-img">';
        $output .= '</a>';
        $output .= '</div>';
        // Optional text part if type is both
        if ($logo_type === 'both') {
            $output .= '<div class="lunart-logo-text">';
            $output .= '<span class="lunart-logo-title">' . esc_html($logo_text) . '</span>';
            if (!empty($logo_subtitle)) {
                $output .= '<span class="lunart-logo-subtitle">' . esc_html($logo_subtitle) . '</span>';
            }
            $output .= '</div>';
        }
        $output .= '</div>';
        return $output;
    }

    // Otherwise prefer core Site Identity (Custom Logo)
    if (function_exists('has_custom_logo') && has_custom_logo()) {
        // Prefer building custom logo manually to avoid edge cases where get_custom_logo() returns empty outside Customizer
        $logo_id = (int) get_theme_mod('custom_logo');
        if ($logo_id) {
            $img = wp_get_attachment_image_src($logo_id, 'full');
            if ($img && !empty($img[0])) {
                $logo_url = $img[0];
                $logo_class = 'lunart-logo lunart-logo-image lunart-logo-' . $logo_alignment;
                $output = '<div class="' . esc_attr($logo_class) . '">';
                $output .= '<div class="lunart-logo-image">';
                $output .= '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link" rel="home">';
                $output .= '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="custom-logo lunart-logo-img">';
                $output .= '</a>';
                $output .= '</div>';
                $output .= '</div>';
                return $output;
            }
        }
    }

    // Fallback to text logo (from Logo Options or site title/tagline)
    $logo_class = 'lunart-logo lunart-logo-text lunart-logo-' . $logo_alignment;
    $output = '<div class="' . esc_attr($logo_class) . '">';
    $output .= '<div class="lunart-logo-text">';
    $output .= '<a href="' . esc_url(home_url('/')) . '" class="lunart-logo-title" rel="home">' . esc_html($logo_text) . '</a>';
    if (!empty($logo_subtitle)) {
        $output .= '<span class="lunart-logo-subtitle">' . esc_html($logo_subtitle) . '</span>';
    }
    $output .= '</div>';
    $output .= '</div>';
    return $output;
}

/**
 * Get social media links HTML
 */
function lunart_get_social_media_html() {
    $social_links = array();
    
    if (get_theme_mod('social_facebook')) {
        $social_links['facebook'] = array(
            'url' => get_theme_mod('social_facebook'),
            'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
            'label' => 'Facebook'
        );
    }
    
    if (get_theme_mod('social_instagram')) {
        $social_links['instagram'] = array(
            'url' => get_theme_mod('social_instagram'),
            'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4z"/></svg>',
            'label' => 'Instagram'
        );
    }
    
    if (get_theme_mod('social_linkedin')) {
        $social_links['linkedin'] = array(
            'url' => get_theme_mod('social_linkedin'),
            'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.047-1.852-3.047-1.853 0-2.136 1.445-2.136 2.939v5.677H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
            'label' => 'LinkedIn'
        );
    }
    
    if (get_theme_mod('social_youtube')) {
        $social_links['youtube'] = array(
            'url' => get_theme_mod('social_youtube'),
            'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
            'label' => 'YouTube'
        );
    }
    
    if (empty($social_links)) {
        return '';
    }
    
    $output = '<div class="social-media-links">';
    $output .= '<h4>Pratite nas</h4>';
    $output .= '<div class="social-icons">';
    
    foreach ($social_links as $platform => $data) {
        $output .= sprintf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" class="social-icon %s" aria-label="%s">%s</a>',
            esc_url($data['url']),
            esc_attr($platform),
            esc_attr($data['label']),
            $data['icon']
        );
    }
    
    $output .= '</div></div>';
    
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
add_action('wp_enqueue_scripts', 'lunart_logo_styles', 20);

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
