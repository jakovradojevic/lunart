<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <nav class="navigation">
            <div class="container">
                <div class="logo">
                    <?php echo lunart_get_logo_html(); ?>
                </div>

                <div class="nav-menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'nav-menu-list',
                        'container' => false,
                        'fallback_cb' => 'lunart_fallback_menu'
                    ));
                    ?>
                </div>

                <button class="mobile-menu-toggle" aria-label="Toggle mobile menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>

                <div class="mobile-menu" role="dialog" aria-modal="true" aria-label="Mobilni meni">
                    <div class="mobile-menu-header">
                        <button class="mobile-menu-close" aria-label="Zatvori meni">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="mobile-menu-body">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_class' => 'mobile-menu-list',
                            'container' => false,
                            'fallback_cb' => 'lunart_fallback_menu'
                        ));
                        ?>
                    </div>
                    <div class="mobile-menu-footer">
                        <?php echo lunart_get_social_media_html(); ?>
                    </div>
                </div>
                <div class="mobile-menu-overlay" tabindex="-1" aria-hidden="true"></div>
            </div>
        </nav>
    </header>

    <div id="content" class="site-content">
