<?php
/**
 * Lunart Gutenberg Blocks Registration
 *
 * Registers dynamic blocks that replicate the homepage components exactly
 * while exposing all content as editable attributes via the block editor.
 *
 * Blocks:
 * - lunart/hero
 * - lunart/services (planned)
 * - lunart/gallery (planned)
 * - lunart/blog-teaser (planned)
 * - lunart/about (planned)
 * - lunart/cta (planned)
 */

if (!defined('ABSPATH')) { exit; }

add_action('init', function() {
    // Register a minimal editor script so Gutenberg recognizes server-rendered Lunart blocks (prevents unsupported block warnings)
    wp_register_script(
        'lunart-blocks-editor',
        get_template_directory_uri() . '/js/blocks-editor.js',
        array('wp-blocks', 'wp-element', 'wp-i18n', 'wp-editor', 'wp-block-editor', 'wp-server-side-render', 'wp-components', 'wp-compose'),
        defined('_S_VERSION') ? _S_VERSION : false,
        true
    );

    // Register blocks (server-side, dynamic render)
    lunart_register_hero_block();
    lunart_register_services_block();
    lunart_register_cta_block();
    lunart_register_gallery_block();
    lunart_register_blog_teaser_block();
    lunart_register_about_block();
    lunart_register_footer_block();
});

/**
 * Register Hero block
 */
function lunart_register_hero_block() {
    $args = array(
        'api_version' => 2,
        'render_callback' => 'lunart_render_hero_block',
        'attributes' => array(
            'titleLine1' => array('type' => 'string', 'default' => 'Čuvamo Umetnost'),
            'titleLine2' => array('type' => 'string', 'default' => 'za Buduće Generacije'),
            'subtitle' => array('type' => 'string', 'default' => 'Stručna konzervacija i restauracija umetničkih dela na papiru - crteža, akvarela, knjiga i plakata sa preciznošću i posvećenošću očuvanju kulturnog nasleđa.'),
            'primaryBtnLabel' => array('type' => 'string', 'default' => 'Pogledajte Naše Radove'),
            'primaryBtnAnchor' => array('type' => 'string', 'default' => '#gallery'),
            'secondaryBtnLabel' => array('type' => 'string', 'default' => 'Saznajte o Konzervaciji'),
            'secondaryBtnHref' => array('type' => 'string', 'default' => '#services'),
            // Features (fixed 3 to keep exact layout)
            'feature1Title' => array('type' => 'string', 'default' => 'Restauracija Akvarela'),
            'feature1Desc' => array('type' => 'string', 'default' => 'Delikatan tretman akvarelnih slika i ilustracija sa očuvanjem originalnih boja i tekstura'),
            'feature2Title' => array('type' => 'string', 'default' => 'Konzervacija Knjiga'),
            'feature2Desc' => array('type' => 'string', 'default' => 'Profesionalna nega retkih knjiga, rukopisa i istorijskih dokumenata'),
            'feature3Title' => array('type' => 'string', 'default' => 'Crteži i Grafike'),
            'feature3Desc' => array('type' => 'string', 'default' => 'Stručna restauracija crteža, grafika i vintage plakata različitih tehnika'),
            // CTA inside hero
            'ctaTitle' => array('type' => 'string', 'default' => 'Vaše umetnička dela zaslužuju najbolju negu'),
            'ctaDesc' => array('type' => 'string', 'default' => 'Kontaktirajte nas za besplatnu procenu i savet o najboljem pristupu konzervaciji vašeg umetničkog blaga'),
            'ctaPrimaryLabel' => array('type' => 'string', 'default' => 'Zakažite Konsultaciju'),
            'ctaPrimaryAnchor' => array('type' => 'string', 'default' => '#contact'),
            'ctaSecondaryLabel' => array('type' => 'string', 'default' => 'Pošaljite Upit'),
            'ctaSecondaryHref' => array('type' => 'string', 'default' => 'mailto:info@lunart.rs'),
            'ctaInfoText' => array('type' => 'string', 'default' => 'Beograd, Srbija • Besplatna procena • 20+ godina iskustva'),
        ),
        'supports' => array(
            'anchor' => true,
        ),
        'editor_script' => 'lunart-blocks-editor',
    );

    register_block_type('lunart/hero', $args);
}

/**
 * Render callback for Hero block
 */
function lunart_render_hero_block($attributes, $content = '', $block = null) {
    // Sanitize attributes
    $a = wp_parse_args($attributes, array());

    // Build HTML exactly as in index.php hero section
    ob_start();
    ?>
    <section id="home" class="hero-section hero-background vintage-paper-texture">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-20 w-40 h-40 rounded-full bg-gradient-to-br from-primary/20 to-primary/5 subtle-float blur-lg" style="animation-delay: 0s;"></div>
            <div class="absolute top-40 right-32 w-32 h-32 rounded-full bg-gradient-to-br from-accent/25 to-accent/8 subtle-float blur-md" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-32 left-1/4 w-36 h-36 rounded-full bg-gradient-to-br from-secondary/20 to-secondary/5 subtle-float blur-lg" style="animation-delay: 4s;"></div>
            <div class="absolute top-1/2 right-1/4 w-28 h-28 rounded-full bg-gradient-to-br from-primary/15 to-primary/3 subtle-float blur-md" style="animation-delay: 6s;"></div>

            <div class="absolute top-0 left-0 w-64 h-64 bg-gradient-to-br from-primary/5 to-transparent rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-gradient-to-tl from-accent/5 to-transparent rounded-full blur-3xl"></div>
        </div>

        <div class="container text-center relative z-10 pt-20 pb-20">
            <div class="hero-content">
                <div class="mb-12">
                    <h1 class="hero-title">
                        <span class="gradient-text"><?php echo esc_html(isset($a['titleLine1']) ? $a['titleLine1'] : ''); ?></span>
                        <span class="block mt-4 text-foreground"><?php echo esc_html(isset($a['titleLine2']) ? $a['titleLine2'] : ''); ?></span>
                    </h1>
                </div>

                <div class="max-w-4xl mx-auto mb-12">
                    <p class="hero-subtitle">
                        <?php echo esc_html(isset($a['subtitle']) ? $a['subtitle'] : ''); ?>
                    </p>
                </div>

                <div class="hero-buttons">
                    <a href="<?php echo esc_url(isset($a['primaryBtnAnchor']) ? $a['primaryBtnAnchor'] : '#gallery'); ?>" class="btn btn-primary btn-xl elegant-hover shadow-lg">
                        <?php echo esc_html(isset($a['primaryBtnLabel']) ? $a['primaryBtnLabel'] : ''); ?>
                        <svg class="ml-3 h-6 w-6" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12,5 19,12 12,19"></polyline>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(isset($a['secondaryBtnHref']) ? $a['secondaryBtnHref'] : '#services'); ?>" class="btn btn-outline btn-xl border-2 border-primary/40 hover:bg-primary/10 hover:border-primary/60 bg-background/90 backdrop-blur-sm elegant-hover shadow-lg text-foreground">
                        <?php echo esc_html(isset($a['secondaryBtnLabel']) ? $a['secondaryBtnLabel'] : ''); ?>
                    </a>
                </div>

                <div class="hero-features">
                    <div class="hero-feature">
                        <div class="hero-feature-icon primary">
                            <svg class="h-10 w-10" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                        </div>
                        <h3 class="hero-feature-title text-primary"><?php echo esc_html(isset($a['feature1Title']) ? $a['feature1Title'] : ''); ?></h3>
                        <p class="hero-feature-description"><?php echo esc_html(isset($a['feature1Desc']) ? $a['feature1Desc'] : ''); ?></p>
                    </div>

                    <div class="hero-feature">
                        <div class="hero-feature-icon secondary">
                            <svg class="h-10 w-10" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <h3 class="hero-feature-title text-secondary"><?php echo esc_html(isset($a['feature2Title']) ? $a['feature2Title'] : ''); ?></h3>
                        <p class="hero-feature-description"><?php echo esc_html(isset($a['feature2Desc']) ? $a['feature2Desc'] : ''); ?></p>
                    </div>

                    <div class="hero-feature">
                        <div class="hero-feature-icon accent">
                            <svg class="h-10 w-10" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 1 1 7.072 0l-.548.547A3.374 3.374 0 0 1 14 18.469V19a2 2 0 0 1-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="hero-feature-title text-accent"><?php echo esc_html(isset($a['feature3Title']) ? $a['feature3Title'] : ''); ?></h3>
                        <p class="hero-feature-description"><?php echo esc_html(isset($a['feature3Desc']) ? $a['feature3Desc'] : ''); ?></p>
                    </div>
                </div>

                <div class="hero-cta">
                    <h3 class="hero-cta-title gradient-text">
                        <?php echo esc_html(isset($a['ctaTitle']) ? $a['ctaTitle'] : ''); ?>
                    </h3>
                    <p class="hero-cta-description">
                        <?php echo esc_html(isset($a['ctaDesc']) ? $a['ctaDesc'] : ''); ?>
                    </p>

                    <div class="hero-cta-buttons">
                        <a href="<?php echo esc_url(isset($a['ctaPrimaryAnchor']) ? $a['ctaPrimaryAnchor'] : '#contact'); ?>" class="btn btn-primary elegant-hover text-lg px-8 py-6 shadow-lg">
                            <svg class="mr-2 h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <?php echo esc_html(isset($a['ctaPrimaryLabel']) ? $a['ctaPrimaryLabel'] : ''); ?>
                        </a>
                        <a href="<?php echo esc_url(isset($a['ctaSecondaryHref']) ? $a['ctaSecondaryHref'] : 'mailto:info@lunart.rs'); ?>" class="btn btn-outline border-2 border-accent/50 hover:bg-accent/15 hover:border-accent/70 text-foreground elegant-hover text-lg px-8 py-6 shadow-lg bg-background/80 backdrop-blur-sm">
                            <svg class="mr-2 h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <?php echo esc_html(isset($a['ctaSecondaryLabel']) ? $a['ctaSecondaryLabel'] : ''); ?>
                        </a>
                    </div>

                    <div class="hero-cta-info">
                        <svg class="h-5 w-5 mr-2 text-primary" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span class="text-lg"><?php echo esc_html(isset($a['ctaInfoText']) ? $a['ctaInfoText'] : ''); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}


/**
 * Register Services block
 */
function lunart_register_services_block() {
    $args = array(
        'api_version' => 2,
        'render_callback' => 'lunart_render_services_block',
        'attributes' => array(
            'heading' => array('type' => 'string', 'default' => 'Naše Usluge'),
            'description' => array('type' => 'string', 'default' => 'Pružamo kompletne usluge konzervacije i restauracije sa više od 15 godina iskustva u radu sa umetničkim delima na papiru'),
            'limit' => array('type' => 'number', 'default' => 6),
            'ctaTitle' => array('type' => 'string', 'default' => 'Potrebna vam je procena?'),
            'ctaDesc' => array('type' => 'string', 'default' => 'Kontaktirajte nas za besplatnu konsultaciju i procenu stanja vašeg umetničkog dela'),
            'ctaBtnLabel' => array('type' => 'string', 'default' => 'Zakažite konsultaciju'),
            'ctaBtnAnchor' => array('type' => 'string', 'default' => '#contact'),
        ),
        'supports' => array(
            'anchor' => true,
        ),
        'editor_script' => 'lunart-blocks-editor',
    );

    register_block_type('lunart/services', $args);
}

function lunart_render_services_block($attributes) {
    $a = wp_parse_args($attributes, array());
    $limit = isset($a['limit']) ? intval($a['limit']) : 6;

    ob_start();
    ?>
    <section id="services" class="services-section">
        <div class="absolute inset-0 paper-texture opacity-30"></div>

        <div class="container relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">
                    <?php echo esc_html(isset($a['heading']) ? $a['heading'] : ''); ?>
                </h2>
                <div class="section-divider"></div>
                <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                    <?php echo esc_html(isset($a['description']) ? $a['description'] : ''); ?>
                </p>
            </div>

            <div class="services-grid">
                <?php
                $services_query = new WP_Query(array(
                    'post_type' => 'service',
                    'posts_per_page' => $limit,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));

                if ($services_query->have_posts()) :
                    while ($services_query->have_posts()) : $services_query->the_post();
                        $taksativne_opcije = get_post_meta(get_the_ID(), '_taksativne_opcije', true);
                ?>
                    <div class="service-card elegant-border elegant-hover">
                        <div class="card-header">
                            <?php $icon_name = get_post_meta(get_the_ID(), '_service_icon_name', true); if ($icon_name) : ?>
                                <div class="service-icon">
                                    <?php echo lunart_get_service_icon_html(get_the_ID()); ?>
                                </div>
                            <?php endif; ?>
                            <h3 class="service-title"><?php the_title(); ?></h3>
                            <p class="service-description"><?php echo get_the_excerpt(); ?></p>
                        </div>
                        <div class="card-content">
                            <?php if (!empty($taksativne_opcije) && is_array($taksativne_opcije)) : ?>
                                <ul class="service-details">
                                    <?php foreach ($taksativne_opcije as $opcija) : ?>
                                        <li><?php echo esc_html($opcija); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline w-full elegant-hover border-primary text-primary hover:bg-primary hover:text-primary-foreground bg-transparent">
                                Saznajte više
                            </a>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <div class="col-span-full text-center py-12">
                        <p class="text-muted-foreground text-lg">Trenutno nema usluga. Dodajte ih kroz admin panel.</p>
                        <a href="<?php echo esc_url(admin_url('edit.php?post_type=service')); ?>" class="btn btn-primary mt-4 elegant-hover">
                            Dodaj Uslugu
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="cta-section text-center mt-16">
                <div class="elegant-border max-w-2xl mx-auto p-12">
                    <h3 class="text-2xl font-serif font-semibold mb-6"><?php echo esc_html(isset($a['ctaTitle']) ? $a['ctaTitle'] : ''); ?></h3>
                    <p class="text-muted-foreground mb-8"><?php echo esc_html(isset($a['ctaDesc']) ? $a['ctaDesc'] : ''); ?></p>
                    <a href="<?php echo esc_url(isset($a['ctaBtnAnchor']) ? $a['ctaBtnAnchor'] : '#contact'); ?>" class="btn btn-primary btn-lg elegant-hover">
                        <?php echo esc_html(isset($a['ctaBtnLabel']) ? $a['ctaBtnLabel'] : ''); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Register generic CTA block
 */
function lunart_register_cta_block() {
    $args = array(
        'api_version' => 2,
        'render_callback' => 'lunart_render_cta_block',
        'attributes' => array(
            'title' => array('type' => 'string', 'default' => 'Želite da saznate više?'),
            'description' => array('type' => 'string', 'default' => 'Kontaktirajte nas za besplatnu konsultaciju.'),
            'buttonLabel' => array('type' => 'string', 'default' => 'Kontaktirajte Nas'),
            'buttonHref' => array('type' => 'string', 'default' => '#contact'),
            'styleVariant' => array('type' => 'string', 'default' => 'primary'),
        ),
        'supports' => array(
            'anchor' => true,
        ),
        'editor_script' => 'lunart-blocks-editor',
    );

    register_block_type('lunart/cta', $args);
}

function lunart_render_cta_block($attributes) {
    $a = wp_parse_args($attributes, array());
    $btn_class = (isset($a['styleVariant']) && $a['styleVariant'] === 'outline') ? 'btn btn-outline' : 'btn btn-primary';
    ob_start();
    ?>
    <div class="cta-section text-center mt-16">
        <div class="elegant-border max-w-2xl mx-auto p-12">
            <h3 class="text-2xl font-serif font-semibold mb-6"><?php echo esc_html(isset($a['title']) ? $a['title'] : ''); ?></h3>
            <p class="text-muted-foreground mb-8"><?php echo esc_html(isset($a['description']) ? $a['description'] : ''); ?></p>
            <a href="<?php echo esc_url(isset($a['buttonHref']) ? $a['buttonHref'] : '#'); ?>" class="<?php echo esc_attr($btn_class); ?> btn-lg elegant-hover">
                <?php echo esc_html(isset($a['buttonLabel']) ? $a['buttonLabel'] : ''); ?>
            </a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}


/**
 * Register Gallery block (wraps existing [lunart_gallery] shortcode)
 */
function lunart_register_gallery_block() {
    register_block_type('lunart/gallery', array(
        'api_version' => 2,
        'render_callback' => 'lunart_render_gallery_block',
        'attributes' => array(
            'heading' => array('type' => 'string', 'default' => 'Galerija Radova'),
            'description' => array('type' => 'string', 'default' => 'Pogledajte transformacije koje smo ostvarili kroz godine rada - svaki projekat je jedinstvena priča o obnovi umetnosti'),
            'limit' => array('type' => 'number', 'default' => 12),
            'category' => array('type' => 'string', 'default' => ''), // gallery_category slug(s)
            'ctaTitle' => array('type' => 'string', 'default' => 'Želite da vidite više?'),
            'ctaDesc' => array('type' => 'string', 'default' => 'Posetite našu kompletnu galeriju sa preko 200 uspešno restauriranih radova'),
            'ctaBtnLabel' => array('type' => 'string', 'default' => 'Kompletna Galerija'),
            'ctaBtnAnchor' => array('type' => 'string', 'default' => '#gallery')
        ),
        'supports' => array('anchor' => true),
        'editor_script' => 'lunart-blocks-editor',
    ));
}

function lunart_render_gallery_block($attributes) {
    $a = wp_parse_args($attributes, array());
    $limit = isset($a['limit']) ? intval($a['limit']) : 12;
    ob_start();
    ?>
    <section id="gallery" class="gallery-section">
        <div class="absolute inset-0 paper-texture opacity-20"></div>
        <div class="container relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">
                    <?php echo esc_html(isset($a['heading']) ? $a['heading'] : ''); ?>
                </h2>
                <div class="section-divider"></div>
                <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                    <?php echo esc_html(isset($a['description']) ? $a['description'] : ''); ?>
                </p>
            </div>
            <?php
                $cat = isset($a['category']) ? sanitize_text_field($a['category']) : '';
                echo do_shortcode('[lunart_gallery limit="' . $limit . '"' . ($cat ? ' category="' . esc_attr($cat) . '"' : '') . ']');
            ?>
            <div class="cta-section text-center mt-16">
                <div class="elegant-border max-w-2xl mx-auto p-12">
                    <h3 class="text-2xl font-serif font-semibold mb-6"><?php echo esc_html(isset($a['ctaTitle']) ? $a['ctaTitle'] : ''); ?></h3>
                    <p class="text-muted-foreground mb-8"><?php echo esc_html(isset($a['ctaDesc']) ? $a['ctaDesc'] : ''); ?></p>
                    <a href="<?php echo esc_url(isset($a['ctaBtnAnchor']) ? $a['ctaBtnAnchor'] : '#gallery'); ?>" class="btn btn-primary btn-lg elegant-hover">
                        <?php echo esc_html(isset($a['ctaBtnLabel']) ? $a['ctaBtnLabel'] : ''); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Register Blog Teaser block
 */
function lunart_register_blog_teaser_block() {
    register_block_type('lunart/blog-teaser', array(
        'api_version' => 2,
        'render_callback' => 'lunart_render_blog_teaser_block',
        'attributes' => array(
            'heading' => array('type' => 'string', 'default' => 'Blog o Konzervaciji'),
            'description' => array('type' => 'string', 'default' => 'Saznajte više o tehnikama konzervacije, istoriji umetnosti i našim najnovijim projektima restauracije.'),
            // Listing controls
            'postsPerPage' => array('type' => 'number', 'default' => 3),
            'category' => array('type' => 'string', 'default' => ''), // category slug filter (optional)
            'orderBy' => array('type' => 'string', 'default' => 'date'),
            'order' => array('type' => 'string', 'default' => 'DESC'),
            'showDate' => array('type' => 'boolean', 'default' => true),
            'showExcerpt' => array('type' => 'boolean', 'default' => true),
            'excerptLength' => array('type' => 'number', 'default' => 20),
            'showImage' => array('type' => 'boolean', 'default' => true),
            'columns' => array('type' => 'number', 'default' => 3),
            'readMoreLabel' => array('type' => 'string', 'default' => 'Pročitaj više'),
            'showViewAll' => array('type' => 'boolean', 'default' => true),
            'viewAllLabel' => array('type' => 'string', 'default' => 'Pogledaj sve objave'),
            // CTA (optional secondary)
            'ctaTitle' => array('type' => 'string', 'default' => ''),
            'ctaDesc' => array('type' => 'string', 'default' => ''),
            'ctaBtnLabel' => array('type' => 'string', 'default' => ''),
            'ctaBtnAnchor' => array('type' => 'string', 'default' => ''),
        ),
        'supports' => array('anchor' => true),
        'editor_script' => 'lunart-blocks-editor',
    ));
}

function lunart_render_blog_teaser_block($attributes) {
    $a = wp_parse_args($attributes, array());
    // Build query args
    $ppp = isset($a['postsPerPage']) ? max(1, intval($a['postsPerPage'])) : 3;
    $orderby = isset($a['orderBy']) ? sanitize_key($a['orderBy']) : 'date';
    $order = (isset($a['order']) && strtoupper($a['order']) === 'ASC') ? 'ASC' : 'DESC';
    $tax_query = array();
    if (!empty($a['category'])) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => sanitize_title($a['category'])
        );
    }
    $q = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => $ppp,
        'orderby' => $orderby,
        'order' => $order,
        'tax_query' => !empty($tax_query) ? $tax_query : null,
        'no_found_rows' => true,
        'ignore_sticky_posts' => true,
        'post_status' => 'publish',
    ));

    // Columns class for grid
    $cols = isset($a['columns']) ? intval($a['columns']) : 3;
    if ($cols < 1) { $cols = 1; } elseif ($cols > 3) { $cols = 3; }
    $cols_class = 'cols-' . $cols;

    // View All link (posts page)
    $blog_id = (int) get_option('page_for_posts');
    $view_all_url = $blog_id ? get_permalink($blog_id) : '';

    ob_start();
    ?>
    <section id="blog" class="blog-section">
        <div class="absolute inset-0 paper-texture opacity-30"></div>
        <div class="container relative z-10">
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text"><?php echo esc_html(isset($a['heading']) ? $a['heading'] : ''); ?></h2>
                <div class="section-divider"></div>
                <?php if (!empty($a['description'])): ?>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto mb-8"><?php echo esc_html($a['description']); ?></p>
                <?php endif; ?>
            </div>

            <?php if ($q->have_posts()) : ?>
                <div class="blog-cards <?php echo esc_attr($cols_class); ?>">
                    <?php while ($q->have_posts()) : $q->the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card post-excerpt'); ?>>
                            <?php if (!empty($a['showImage']) && has_post_thumbnail()) : ?>
                                <a class="blog-card-thumb" href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large', array('class' => 'blog-card-img')); ?>
                                </a>
                            <?php endif; ?>
                            <h3 class="entry-title blog-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php if (!empty($a['showDate'])) : ?>
                                <div class="entry-meta blog-card-meta"><span class="posted-on"><?php echo esc_html(get_the_date()); ?></span></div>
                            <?php endif; ?>
                            <?php if (!empty($a['showExcerpt'])) : ?>
                                <div class="entry-summary blog-card-excerpt">
                                    <?php
                                    $len = isset($a['excerptLength']) ? intval($a['excerptLength']) : 20;
                                    $ex = get_the_excerpt();
                                    echo esc_html(wp_trim_words($ex, $len));
                                    ?>
                                </div>
                            <?php endif; ?>
                            <div class="blog-card-actions">
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline elegant-hover">
                                    <?php echo esc_html(!empty($a['readMoreLabel']) ? $a['readMoreLabel'] : __('Pročitaj više', 'lunart')); ?>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php else : ?>
                <p class="text-muted-foreground text-center mb-8"><?php esc_html_e('Trenutno nema blog postova.', 'lunart'); ?></p>
                <?php if (current_user_can('edit_posts')): ?>
                    <p class="text-center"><a class="btn btn-primary elegant-hover" href="<?php echo esc_url(admin_url('post-new.php')); ?>"><?php esc_html_e('Dodaj prvi post', 'lunart'); ?></a></p>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!empty($a['showViewAll']) && $view_all_url): ?>
                <div class="text-center mt-10">
                    <a class="btn btn-primary elegant-hover" href="<?php echo esc_url($view_all_url); ?>">
                        <?php echo esc_html(!empty($a['viewAllLabel']) ? $a['viewAllLabel'] : __('Pogledaj sve objave', 'lunart')); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty($a['ctaTitle']) || !empty($a['ctaDesc']) || !empty($a['ctaBtnLabel'])): ?>
                <div class="cta-section text-center mt-16">
                    <div class="elegant-border max-w-2xl mx-auto p-12">
                        <?php if (!empty($a['ctaTitle'])): ?><h3 class="text-2xl font-serif font-semibold mb-6"><?php echo esc_html($a['ctaTitle']); ?></h3><?php endif; ?>
                        <?php if (!empty($a['ctaDesc'])): ?><p class="text-muted-foreground mb-8"><?php echo esc_html($a['ctaDesc']); ?></p><?php endif; ?>
                        <?php if (!empty($a['ctaBtnLabel'])): ?><a href="<?php echo esc_url(!empty($a['ctaBtnAnchor']) ? $a['ctaBtnAnchor'] : '#'); ?>" class="btn btn-primary btn-lg elegant-hover"><?php echo esc_html($a['ctaBtnLabel']); ?></a><?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Register About block
 */
function lunart_register_about_block() {
    register_block_type('lunart/about', array(
        'api_version' => 2,
        'render_callback' => 'lunart_render_about_block',
        'attributes' => array(
            'heading' => array('type' => 'string', 'default' => 'O Lunart-u'),
            'paragraph' => array('type' => 'string', 'default' => 'Lunart je specijalizovana ustanova posvećena očuvanju kulturnog nasleđa kroz stručnu konzervaciju i restauraciju umetničkih dela na papiru. Sa više od 15 godina iskustva, naš tim stručnjaka koristi najsavremenije tehnike i materijale za vraćanje originalnog sjaja vašim dragocenim umetničkim delima.'),
            'quoteText' => array('type' => 'string', 'default' => '"Svaki rad koji prođe kroz naše ruke nije samo restauriran - on je vraćen u život, spreman da inspiriše buduće generacije."'),
            'quoteAuthor' => array('type' => 'string', 'default' => '- Tim Lunart'),
            'ctaTitle' => array('type' => 'string', 'default' => 'Želite da saznate više o nama?'),
            'ctaDesc' => array('type' => 'string', 'default' => 'Kontaktirajte nas za besplatnu konsultaciju i saznajte kako možemo pomoći vašem umetničkom delu'),
            'ctaBtnLabel' => array('type' => 'string', 'default' => 'Kontaktirajte Nas'),
            'ctaBtnAnchor' => array('type' => 'string', 'default' => '#contact'),
        ),
        'supports' => array('anchor' => true),
        'editor_script' => 'lunart-blocks-editor',
    ));
}

function lunart_render_about_block($attributes) {
    $a = wp_parse_args($attributes, array());
    ob_start();
    ?>
    <section id="about" class="about-section">
        <div class="container text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text"><?php echo esc_html(isset($a['heading']) ? $a['heading'] : ''); ?></h2>
            <div class="section-divider"></div>
            <div class="about-content">
                <p class="text-lg text-muted-foreground leading-relaxed mb-8"><?php echo esc_html(isset($a['paragraph']) ? $a['paragraph'] : ''); ?></p>
                <div class="about-quote">
                    <p class="about-quote-text"><?php echo esc_html(isset($a['quoteText']) ? $a['quoteText'] : ''); ?></p>
                    <p class="about-quote-author"><?php echo esc_html(isset($a['quoteAuthor']) ? $a['quoteAuthor'] : ''); ?></p>
                </div>
            </div>
            <div class="cta-section text-center mt-16">
                <div class="elegant-border max-w-2xl mx-auto p-12">
                    <h3 class="text-2xl font-serif font-semibold mb-6"><?php echo esc_html(isset($a['ctaTitle']) ? $a['ctaTitle'] : ''); ?></h3>
                    <p class="text-muted-foreground mb-8"><?php echo esc_html(isset($a['ctaDesc']) ? $a['ctaDesc'] : ''); ?></p>
                    <a href="<?php echo esc_url(isset($a['ctaBtnAnchor']) ? $a['ctaBtnAnchor'] : '#contact'); ?>" class="btn btn-primary btn-lg elegant-hover">
                        <?php echo esc_html(isset($a['ctaBtnLabel']) ? $a['ctaBtnLabel'] : ''); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}


/**
 * Register Footer block
 */
function lunart_register_footer_block() {
    register_block_type('lunart/footer', array(
        'api_version' => 2,
        'render_callback' => 'lunart_render_footer_block',
        'attributes' => array(
            'showLogo' => array('type' => 'boolean', 'default' => true),
            'title' => array('type' => 'string', 'default' => 'LUNART'),
            'tagline' => array('type' => 'string', 'default' => 'Vaš pouzdani partner za konzervaciju i restauraciju umetničkih dela'),
            // Business info
            'companyName' => array('type' => 'string', 'default' => 'LUNART'),
            'businessName' => array('type' => 'string', 'default' => 'Mila Borak preduzetnik Umetničko stvaralaštvo Lunart Beograd-Zvezdara'),
            'status' => array('type' => 'string', 'default' => 'Aktivan'),
            'legalForm' => array('type' => 'string', 'default' => 'Preduzetnik'),
            'registrationNumber' => array('type' => 'string', 'default' => '68039665'),
            'establishmentDate' => array('type' => 'string', 'default' => '20.05.2025.'),
            // Activity
            'activityCode' => array('type' => 'string', 'default' => '9003'),
            'activityDescription' => array('type' => 'string', 'default' => 'Umetničko stvaralaštvo'),
            'taxId' => array('type' => 'string', 'default' => '115033613'),
            'bankAccount' => array('type' => 'string', 'default' => '265-1630310011591-68'),
            // Contact
            'address' => array('type' => 'string', 'default' => 'Beograd-Zvezdara'),
            'email' => array('type' => 'string', 'default' => 'info@lunart.rs'),
            'phone' => array('type' => 'string', 'default' => '+381 XX XXX XXXX'),
            // Socials
            'showSocial' => array('type' => 'boolean', 'default' => true),
            // Copyright
            'copyright' => array('type' => 'string', 'default' => '&copy; {year} LUNART. Sva prava zadržana.'),
        ),
        'supports' => array('anchor' => true),
        'editor_script' => 'lunart-blocks-editor',
    ));
}

function lunart_render_footer_block($attributes) {
    $a = wp_parse_args($attributes, array());
    $year = date('Y');
    $copyright = isset($a['copyright']) ? $a['copyright'] : '&copy; {year} LUNART. Sva prava zadržana.';
    $copyright = str_replace(array('{year}', '[year]', '{{year}}'), $year, $copyright);

    ob_start();
    ?>
    <div class="footer-grid">
        <div class="footer-column">
            <?php if (!isset($a['showLogo']) || $a['showLogo']) : ?>
                <div class="footer-logo">
                    <?php echo lunart_get_logo_html(); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($a['title'])) : ?>
                <h3 class="gradient-text"><?php echo esc_html($a['title']); ?></h3>
            <?php endif; ?>
            <?php if (!empty($a['tagline'])) : ?>
                <p><?php echo esc_html($a['tagline']); ?></p>
            <?php endif; ?>
        </div>

        <div class="footer-column">
            <h4>Poslovni podaci</h4>
            <div class="business-info">
                <p><strong>Naziv:</strong> <?php echo esc_html(isset($a['companyName']) ? $a['companyName'] : ''); ?></p>
                <p><strong>Poslovno ime:</strong> <?php echo esc_html(isset($a['businessName']) ? $a['businessName'] : ''); ?></p>
                <p><strong>Status:</strong> <?php echo esc_html(isset($a['status']) ? $a['status'] : ''); ?></p>
                <p><strong>Pravna forma:</strong> <?php echo esc_html(isset($a['legalForm']) ? $a['legalForm'] : ''); ?></p>
                <p><strong>Matični broj:</strong> <?php echo esc_html(isset($a['registrationNumber']) ? $a['registrationNumber'] : ''); ?></p>
                <p><strong>Datum osnivanja:</strong> <?php echo esc_html(isset($a['establishmentDate']) ? $a['establishmentDate'] : ''); ?></p>
            </div>
        </div>

        <div class="footer-column">
            <h4>Delatnost</h4>
            <div class="activity-info">
                <p><strong>Šifra delatnosti:</strong> <?php echo esc_html(isset($a['activityCode']) ? $a['activityCode'] : ''); ?></p>
                <p><strong>Opis delatnosti:</strong> <?php echo esc_html(isset($a['activityDescription']) ? $a['activityDescription'] : ''); ?></p>
                <p><strong>PIB:</strong> <?php echo esc_html(isset($a['taxId']) ? $a['taxId'] : ''); ?></p>
                <p><strong>Broj tekućeg računa:</strong> <?php echo esc_html(isset($a['bankAccount']) ? $a['bankAccount'] : ''); ?></p>
            </div>
        </div>

        <div class="footer-column">
            <h4>Kontakt</h4>
            <div class="contact-info">
                <p><?php echo esc_html(isset($a['address']) ? $a['address'] : ''); ?></p>
                <p>Email: <?php $email = isset($a['email']) ? trim($a['email']) : ''; if ($email) { echo '<a class="footer-link" href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>'; } ?></p>
                <p>Tel: <?php $phone = isset($a['phone']) ? trim($a['phone']) : ''; if ($phone) { $tel_href = preg_replace('/\s+|\(|\)|\-/', '', $phone); echo '<a class="footer-link" href="tel:' . esc_attr($tel_href) . '">' . esc_html($phone) . '</a>'; } ?></p>
            </div>
            <?php if (!isset($a['showSocial']) || $a['showSocial']) : ?>
                <div class="footer-social-wrap">
                    <?php echo lunart_get_social_media_html(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer-section footer-copyright">
        <p><?php echo wp_kses_post($copyright); ?></p>
    </div>
    <?php
    return ob_get_clean();
}
