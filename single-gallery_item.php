<?php
/**
 * Template for displaying single Gallery Item (gallery_item)
 */
get_header(); ?>

<main id="primary" class="site-main">
    <section class="single-gallery-item-section">
        <div class="container">
            <?php if (have_posts()) : while (have_posts()) : the_post();
                $before_image = get_post_meta(get_the_ID(), '_before_image', true);
                $after_image  = get_post_meta(get_the_ID(), '_after_image', true);
                $category     = get_post_meta(get_the_ID(), '_category', true);
                $subtitle     = get_post_meta(get_the_ID(), '_subtitle', true);
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-gallery-item elegant-border'); ?>>
                    <header class="entry-header text-center mb-10">
                        <?php if (!empty($category)) : ?>
                            <span class="gallery-category block mb-2"><?php echo esc_html($category); ?></span>
                        <?php endif; ?>
                        <h1 class="entry-title gallery-title mb-2"><?php the_title(); ?></h1>
                        <?php if (!empty($subtitle)) : ?>
                            <div class="gallery-subtitle" style="opacity:0.8;"><?php echo esc_html($subtitle); ?></div>
                        <?php endif; ?>
                    </header>

                    <?php if (!empty($before_image) || !empty($after_image)) : ?>
                        <div class="gallery-images two-col mb-10">
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
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php if (empty(get_the_content())) : ?>
                            <p class="text-muted-foreground"><?php echo esc_html(get_the_excerpt()); ?></p>
                        <?php endif; ?>
                    </div>

                    <footer class="entry-footer mt-10">
                        <a href="<?php echo esc_url(get_post_type_archive_link('gallery_item') ?: home_url('#gallery')); ?>" class="btn btn-outline elegant-hover border-primary text-primary">
                            
                            <svg class="h-4 w-4 mr-2" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15,18 9,12 15,6"></polyline>
                                <line x1="9" y1="12" x2="21" y2="12"></line>
                            </svg>
                            Nazad na galeriju
                        </a>
                    </footer>
                </article>
            <?php endwhile; endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
