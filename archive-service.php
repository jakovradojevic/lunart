<?php get_header(); ?>

<main class="main-content">
    <div class="container">
        <!-- Header -->
        <header class="archive-header text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">
                Sve Usluge
            </h1>
            <div class="section-divider"></div>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                Kompletne usluge konzervacije i restauracije umetničkih dela na papiru
            </p>
        </header>

        <!-- Services Grid -->
        <div class="services-grid">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php
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
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-muted-foreground text-lg">Trenutno nema usluga.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if (get_next_posts_link() || get_previous_posts_link()) : ?>
            <nav class="pagination-wrapper mt-16">
                <div class="pagination flex justify-center items-center gap-4">
                    <?php
                    echo get_previous_posts_link('<span class="pagination-arrow">←</span> Prethodna strana');
                    echo get_next_posts_link('Sledeća strana <span class="pagination-arrow">→</span>');
                    ?>
                </div>
            </nav>
        <?php endif; ?>

        <!-- Call to Action -->
        <div class="cta-section text-center mt-16">
            <div class="elegant-border max-w-2xl mx-auto p-12">
                <h3 class="text-2xl font-serif font-semibold mb-6">Želite da vidite više?</h3>
                <p class="text-muted-foreground mb-8">
                    Kontaktirajte nas za besplatnu konsultaciju i procenu vašeg umetničkog dela
                </p>
                <a href="#contact" class="btn btn-primary btn-lg elegant-hover">
                    Kontaktirajte Nas
                </a>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
