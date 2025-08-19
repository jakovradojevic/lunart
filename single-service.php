<?php get_header(); ?>

<main class="main-content">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article class="service-single">
                <!-- Header -->
                <header class="service-header text-center mb-12">
                    <div class="service-icon-large mb-6">
                        <?php echo lunart_get_service_icon_html(get_the_ID()); ?>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4 gradient-text">
                        <?php the_title(); ?>
                    </h1>
                    <?php if (has_excerpt()) : ?>
                        <div class="service-excerpt text-xl text-muted-foreground max-w-3xl mx-auto">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="service-featured-image mb-12 text-center">
                        <?php the_post_thumbnail('large', array('class' => 'rounded-lg shadow-lg max-w-full h-auto')); ?>
                    </div>
                <?php endif; ?>

                <!-- Content -->
                <div class="service-content mb-12">
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Uključene Usluge -->
                <?php
                $taksativne_opcije = get_post_meta(get_the_ID(), '_taksativne_opcije', true);
                if (!empty($taksativne_opcije) && is_array($taksativne_opcije)) :
                ?>
                    <div class="service-taksativne-opcije mb-12">
                        <h3 class="text-2xl font-serif font-semibold mb-6 text-center">Uključene Usluge</h3>
                        <div class="taksativne-grid">
                            <?php foreach ($taksativne_opcije as $opcija) : ?>
                                <div class="taksativna-opcija">
                                    <span class="taksativna-text"><?php echo esc_html($opcija); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Call to Action -->
                <div class="service-cta cta-section text-center mb-12">
                    <div class="elegant-border max-w-2xl mx-auto p-8">
                        <h3 class="text-2xl font-serif font-semibold mb-4">Interesuje vas ova usluga?</h3>
                        <p class="text-muted-foreground mb-6">
                            Kontaktirajte nas za besplatnu konsultaciju i procenu vašeg umetničkog dela
                        </p>
                        <div class="cta-buttons">
                            <a href="#contact" class="btn btn-primary btn-lg elegant-hover mr-4">
                                Kontaktirajte Nas
                            </a>
                            <a href="<?php echo get_post_type_archive_link('service'); ?>" class="btn btn-outline btn-lg elegant-hover">
                                Sve Usluge
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="service-navigation flex justify-between items-center py-8 border-t border-border">
                    <div class="nav-previous">
                        <?php
                        $prev_post = get_previous_post();
                        if ($prev_post) :
                        ?>
                            <a href="<?php echo get_permalink($prev_post); ?>" class="nav-link">
                                <span class="nav-arrow">←</span>
                                <span class="nav-title"><?php echo get_the_title($prev_post); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="nav-next">
                        <?php
                        $next_post = get_next_post();
                        if ($next_post) :
                        ?>
                            <a href="<?php echo get_permalink($next_post); ?>" class="nav-link">
                                <span class="nav-title"><?php echo get_the_title($next_post); ?></span>
                                <span class="nav-arrow">→</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
