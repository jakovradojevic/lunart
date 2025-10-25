<?php
/**
 * Archive template for Gallery Items (gallery_item)
 */
get_header(); ?>

<main id="primary" class="site-main">
    <section class="gallery-archive-section">
        <div class="absolute inset-0 paper-texture opacity-20"></div>
        <div class="container relative z-10">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">
                    Galerija Radova
                </h1>
                <div class="section-divider"></div>
                <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                    Pregled pre i posle restauracije: pažljivo dokumentovane transformacije crteža, akvarela, plakata i rukopisa.
                    Svaki rad priča priču o očuvanju i vraćanju originalne lepote uz arhivske, reverzibilne postupke.
                </p>
            </div>

            <?php if (have_posts()) : ?>
                <div class="gallery-grid">
                    <?php while (have_posts()) : the_post();
                        $before_image = get_post_meta(get_the_ID(), '_before_image', true);
                        $after_image  = get_post_meta(get_the_ID(), '_after_image', true);
                        $category     = get_post_meta(get_the_ID(), '_category', true);
                        $subtitle     = get_post_meta(get_the_ID(), '_subtitle', true);
                    ?>
                        <div class="gallery-item elegant-border overflow-hidden elegant-hover">
                            <div class="gallery-images">
                                <?php if (!empty($before_image)) : ?>
                                    <div class="gallery-image">
                                        <img src="<?php echo esc_url($before_image); ?>" alt="<?php echo esc_attr(get_the_title() . ' - pre restauracije'); ?>">
                                        <div class="gallery-image-overlay"><span>PRE</span></div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($after_image)) : ?>
                                    <div class="gallery-image">
                                        <img src="<?php echo esc_url($after_image); ?>" alt="<?php echo esc_attr(get_the_title() . ' - posle restauracije'); ?>">
                                        <div class="gallery-image-overlay"><span>POSLE</span></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="gallery-content">
                                <div class="flex items-center justify-between mb-3">
                                    <?php if (!empty($category)) : ?>
                                        <span class="gallery-category"><?php echo esc_html($category); ?></span>
                                    <?php else: ?>
                                        <span class="gallery-category">&nbsp;</span>
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline text-muted-foreground hover:text-primary">
                                        <svg class="h-4 w-4 mr-1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        Detalji
                                    </a>
                                </div>
                                <h3 class="gallery-title"><?php the_title(); ?></h3>
                                <?php if (!empty($subtitle)) : ?>
                                    <div class="gallery-subtitle" style="opacity:0.8; margin-top: -0.5rem;"><?php echo esc_html($subtitle); ?></div>
                                <?php endif; ?>
                                <p class="gallery-description"><?php echo get_the_excerpt(); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="pagination mt-12 flex justify-center">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 1,
                        'prev_text' => __('Prethodna', 'lunart'),
                        'next_text' => __('Sledeća', 'lunart'),
                    ));
                    ?>
                </div>
            <?php else : ?>
                <div class="text-center py-12">
                    <p class="text-muted-foreground text-lg">Trenutno nema radova u galeriji.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
