<?php
/**
 * Taxonomy archive for Gallery Categories (gallery_category)
 */
get_header();
?>
<main id="primary" class="site-main">
    <section class="gallery-archive-section">
        <div class="absolute inset-0 paper-texture opacity-20"></div>
        <div class="container relative z-10">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-serif font-bold mb-6 gradient-text">
                    <?php single_term_title(); ?>
                </h1>
                <div class="section-divider"></div>
                <?php if (term_description()) : ?>
                    <p class="text-xl text-muted-foreground max-w-3xl mx-auto"><?php echo term_description(); ?></p>
                <?php else : ?>
                    <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                        Pregled radova iz odabrane kategorije galerije.
                    </p>
                <?php endif; ?>
            </div>

            <?php 
            // Controls
            $per_page = isset($_GET['pp']) ? intval($_GET['pp']) : 12;
            $terms_list = get_terms(array('taxonomy' => 'gallery_category', 'hide_empty' => true));
            $current_term = get_queried_object();
            if (!is_wp_error($terms_list) && !empty($terms_list)) : ?>
                <div class="gallery-filters flex flex-wrap gap-2 justify-center mb-10">
                    <?php 
                    $base_archive = get_post_type_archive_link('gallery_item');
                    $base_term = get_term_link($current_term);
                    ?>
                    <a href="<?php echo esc_url(add_query_arg(array_filter(array('pp' => $per_page ?: null)), $base_archive)); ?>" class="btn btn-sm btn-outline">Sve</a>
                    <?php foreach ($terms_list as $term) : 
                        $url = add_query_arg(array_filter(array('pp' => $per_page ?: null)), get_term_link($term));
                        $is_active = ($current_term && $current_term->term_id === $term->term_id);
                    ?>
                        <a href="<?php echo esc_url($url); ?>" class="btn btn-sm <?php echo $is_active ? 'btn-primary' : 'btn-outline'; ?>"><?php echo esc_html($term->name); ?></a>
                    <?php endforeach; ?>
                    <div class="ml-4 inline-flex items-center gap-2">
                        <span class="text-sm text-muted-foreground">Po stranici:</span>
                        <?php foreach (array(6,12,24,36,48) as $opt) : 
                            $url = add_query_arg(array('pp' => $opt), $base_term);
                            $cls = $per_page == $opt ? 'btn-primary' : 'btn-outline';
                        ?>
                            <a href="<?php echo esc_url($url); ?>" class="btn btn-xs <?php echo $cls; ?>"><?php echo (int)$opt; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (have_posts()) : ?>
                <div class="gallery-grid">
                    <?php while (have_posts()) : the_post();
                        $before_image = get_post_meta(get_the_ID(), '_before_image', true);
                        $after_image  = get_post_meta(get_the_ID(), '_after_image', true);
                        $subtitle     = get_post_meta(get_the_ID(), '_subtitle', true);
                        $terms        = get_the_terms(get_the_ID(), 'gallery_category');
                        $cat_html = '';
                        if (!is_wp_error($terms) && !empty($terms)) {
                            foreach ($terms as $t) { $cat_html .= '<a class="gallery-category" href="' . esc_url(get_term_link($t)) . '">' . esc_html($t->name) . '</a>'; }
                        } else {
                            $legacy = get_post_meta(get_the_ID(), '_category', true);
                            if (!empty($legacy)) { $cat_html = '<span class="gallery-category">' . esc_html($legacy) . '</span>'; }
                        }
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
                                <?php if (!empty($cat_html)) : ?>
                                    <div class="gallery-tags mb-3"><?php echo $cat_html; ?></div>
                                <?php endif; ?>
                                <h3 class="gallery-title"><?php the_title(); ?></h3>
                                <?php if (!empty($subtitle)) : ?>
                                    <div class="gallery-subtitle" style="opacity:0.8; margin-top: -0.5rem;"><?php echo esc_html($subtitle); ?></div>
                                <?php endif; ?>
                                <p class="gallery-description"><?php echo get_the_excerpt(); ?></p>
                                <div class="gallery-actions mt-3">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline text-muted-foreground hover:text-primary">
                                        <svg class="h-4 w-4 mr-1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        Detalji
                                    </a>
                                </div>
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
                        'add_args'  => array_filter(array('pp' => $per_page ?: null)),
                    ));
                    ?>
                </div>
            <?php else : ?>
                <div class="text-center py-12">
                    <p class="text-muted-foreground text-lg">Trenutno nema radova u ovoj kategoriji.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
