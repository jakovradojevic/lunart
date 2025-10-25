<?php get_header(); ?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
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
                        <span class="gradient-text">Čuvamo Umetnost</span>
                        <span class="block mt-4 text-foreground">za Buduće Generacije</span>
                    </h1>
                </div>

                <div class="max-w-4xl mx-auto mb-12">
                    <p class="hero-subtitle">
                        Stručna konzervacija i restauracija umetničkih dela na papiru - crteža, akvarela, knjiga i plakata sa
                        preciznošću i posvećenošću očuvanju kulturnog nasleđa.
                    </p>
                </div>

                <div class="hero-buttons">
                    <a href="#gallery" class="btn btn-primary btn-xl elegant-hover shadow-lg">
                        Pogledajte Naše Radove
                        <svg class="ml-3 h-6 w-6" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12,5 19,12 12,19"></polyline>
                        </svg>
                    </a>
                    <a href="#services" class="btn btn-outline btn-xl border-2 border-primary/40 hover:bg-primary/10 hover:border-primary/60 bg-background/90 backdrop-blur-sm elegant-hover shadow-lg text-foreground">
                        Saznajte o Konzervaciji
                    </a>
                    
                </div>

                <div class="hero-features">
                    <div class="hero-feature">
                        <div class="hero-feature-icon primary">
                            <svg class="h-10 w-10" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                        </div>
                        <h3 class="hero-feature-title text-primary">Restauracija Akvarela</h3>
                        <p class="hero-feature-description">
                            Delikatan tretman akvarelnih slika i ilustracija sa očuvanjem originalnih boja i tekstura
                        </p>
                    </div>

                    <div class="hero-feature">
                        <div class="hero-feature-icon secondary">
                            <svg class="h-10 w-10" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <h3 class="hero-feature-title text-secondary">Konzervacija Knjiga</h3>
                        <p class="hero-feature-description">
                            Profesionalna nega retkih knjiga, rukopisa i istorijskih dokumenata
                        </p>
                    </div>

                    <div class="hero-feature">
                        <div class="hero-feature-icon accent">
                            <svg class="h-10 w-10" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 1 1 7.072 0l-.548.547A3.374 3.374 0 0 1 14 18.469V19a2 2 0 0 1-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="hero-feature-title text-accent">Crteži i Grafike</h3>
                        <p class="hero-feature-description">
                            Stručna restauracija crteža, grafika i vintage plakata različitih tehnika
                        </p>
                    </div>
                </div>

                <div class="hero-cta">
                    <h3 class="hero-cta-title gradient-text">
                        Vaše umetnička dela zaslužuju najbolju negu
                    </h3>
                    <p class="hero-cta-description">
                        Kontaktirajte nas za besplatnu procenu i savet o najboljem pristupu konzervaciji vašeg umetničkog blaga
                    </p>

                    <div class="hero-cta-buttons">
                        <a href="#contact" class="btn btn-primary elegant-hover text-lg px-8 py-6 shadow-lg">
                            <svg class="mr-2 h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            Zakažite Konsultaciju
                        </a>
                        <a href="mailto:info@lunart.rs" class="btn btn-outline border-2 border-accent/50 hover:bg-accent/15 hover:border-accent/70 text-foreground elegant-hover text-lg px-8 py-6 shadow-lg bg-background/80 backdrop-blur-sm">
                            <svg class="mr-2 h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            Pošaljite Upit
                        </a>
                    </div>

                    <div class="hero-cta-info">
                        <svg class="h-5 w-5 mr-2 text-primary" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span class="text-lg">Beograd, Srbija • Besplatna procena • 20+ godina iskustva</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="absolute inset-0 paper-texture opacity-30"></div>

        <div class="container relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">
                    Naše Usluge
                </h2>
                <div class="section-divider"></div>
                <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                    Pružamo kompletne usluge konzervacije i restauracije sa više od 15 godina iskustva u radu sa umetničkim
                    delima na papiru
                </p>
            </div>

            <div class="services-grid">
                <?php
                // Query za services post type
                $services_query = new WP_Query(array(
                    'post_type' => 'service',
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));

                if ($services_query->have_posts()) :
                    while ($services_query->have_posts()) : $services_query->the_post();
                        $icon_name = get_post_meta(get_the_ID(), '_service_icon_name', true);
                        $icon_color = get_post_meta(get_the_ID(), '_service_icon_color', true);
                        $taksativne_opcije = get_post_meta(get_the_ID(), '_taksativne_opcije', true);
                ?>
                    <div class="service-card elegant-border elegant-hover">
                        <div class="card-header">
                            <?php if ($icon_name) : ?>
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
                        <a href="<?php echo admin_url('edit.php?post_type=service'); ?>" class="btn btn-primary mt-4 elegant-hover">
                            Dodaj Uslugu
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Call to action -->
            <div class="cta-section text-center mt-16">
                <div class="elegant-border max-w-2xl mx-auto p-12">
                    <h3 class="text-2xl font-serif font-semibold mb-6">Potrebna vam je procena?</h3>
                    <p class="text-muted-foreground mb-8">
                        Kontaktirajte nas za besplatnu konsultaciju i procenu stanja vašeg umetničkog dela
                    </p>
                    <a href="#contact" class="btn btn-primary btn-lg elegant-hover">
                        Zakažite konsultaciju
                    </a>
                </div>
            </div>
        </div>
    </section>



    <!-- Gallery Section -->
    <section id="gallery" class="gallery-section">
        <div class="absolute inset-0 paper-texture opacity-20"></div>

        <div class="container relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">
                    Galerija Radova
                </h2>
                <div class="section-divider"></div>
                <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                    Pogledajte transformacije koje smo ostvarili kroz godine rada - svaki projekat je jedinstvena priča o obnovi
                    umetnosti
                </p>
            </div>

            <?php
            // Dinamička galerija: koristi shortcode koji prikazuje gallery_item postove sa pre/posle slikama
            echo do_shortcode('[lunart_gallery limit="12"]');
            ?>

            <!-- Call to action -->
            <div class="cta-section text-center mt-16">
                <div class="elegant-border max-w-2xl mx-auto p-12">
                    <h3 class="text-2xl font-serif font-semibold mb-6">Želite da vidite više?</h3>
                    <p class="text-muted-foreground mb-8">
                        Posetite našu kompletnu galeriju sa preko 200 uspešno restauriranih radova
                    </p>
                    <a href="#gallery" class="btn btn-primary btn-lg elegant-hover">
                        Kompletna Galerija
                        <svg class="ml-2 h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12,5 19,12 12,19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="blog-section">
        <div class="absolute inset-0 paper-texture opacity-30"></div>
        <div class="container text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">Blog o Konzervaciji</h2>
            <div class="section-divider"></div>
            <p class="text-lg text-muted-foreground max-w-2xl mx-auto mb-8">
                Saznajte više o tehnikama konzervacije, istoriji umetnosti i našim najnovijim projektima restauracije.
            </p>
            <div class="blog-placeholder">
                <p class="text-muted-foreground mb-4">Blog uskoro dostupan</p>
                <div class="blog-dots">
                    <div class="blog-dot primary"></div>
                    <div class="blog-dot accent"></div>
                    <div class="blog-dot secondary"></div>
                </div>
            </div>

            <!-- Call to action -->
            <div class="cta-section text-center mt-16">
                <div class="elegant-border max-w-2xl mx-auto p-12">
                    <h3 class="text-2xl font-serif font-semibold mb-6">Želite da saznate više?</h3>
                    <p class="text-muted-foreground mb-8">
                        Pratite naš blog za najnovije informacije o konzervaciji i restauraciji
                    </p>
                    <a href="#blog" class="btn btn-primary btn-lg elegant-hover">
                        Pratite Blog
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">O Lunart-u</h2>
            <div class="section-divider"></div>
            <div class="about-content">
                <p class="text-lg text-muted-foreground leading-relaxed mb-8">
                    Lunart je specijalizovana ustanova posvećena očuvanju kulturnog nasleđa kroz stručnu konzervaciju i
                    restauraciju umetničkih dela na papiru. Sa više od 15 godina iskustva, naš tim stručnjaka koristi
                    najsavremenije tehnike i materijale za vraćanje originalnog sjaja vašim dragocenim umetničkim delima.
                </p>
                <div class="about-quote">
                    <p class="about-quote-text">
                        "Svaki rad koji prođe kroz naše ruke nije samo restauriran - on je vraćen u život, spreman da inspiriše
                        buduće generacije."
                    </p>
                    <p class="about-quote-author">- Tim Lunart</p>
                </div>
            </div>

            <!-- Call to action -->
            <div class="cta-section text-center mt-16">
                <div class="elegant-border max-w-2xl mx-auto p-12">
                    <h3 class="text-2xl font-serif font-semibold mb-6">Želite da saznate više o nama?</h3>
                    <p class="text-muted-foreground mb-8">
                        Kontaktirajte nas za besplatnu konsultaciju i saznajte kako možemo pomoći vašem umetničkom delu
                    </p>
                    <a href="#contact" class="btn btn-primary btn-lg elegant-hover">
                        Kontaktirajte Nas
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
