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

            <?php 
                // Term filter bar
                $active_filter = isset($_GET['gallery_category']) ? sanitize_text_field(wp_unslash($_GET['gallery_category'])) : '';
                $per_page = isset($_GET['pp']) ? intval($_GET['pp']) : 12;
                $terms_list = get_terms(array('taxonomy' => 'gallery_category', 'hide_empty' => true));
                if (!is_wp_error($terms_list) && !empty($terms_list)) : ?>
                    <?php 
                    $base_url = get_post_type_archive_link('gallery_item');
                    $all_url = add_query_arg(array_filter(array('pp' => $per_page ?: null)), $base_url);
                    ?>
                    <div class="gallery-filters">
                        <div class="gallery-filters-cats flex flex-wrap gap-2 justify-center mb-4">
                            <a href="<?php echo esc_url($all_url); ?>" class="btn btn-sm <?php echo empty($active_filter) ? 'btn-primary' : 'btn-outline'; ?>">Sve</a>
                            <?php foreach ($terms_list as $term) : 
                                $url = add_query_arg(array_filter(array('gallery_category' => $term->slug, 'pp' => $per_page ?: null)), $base_url);
                                $is_active = ($active_filter === $term->slug);
                            ?>
                                <a href="<?php echo esc_url($url); ?>" class="btn btn-sm <?php echo $is_active ? 'btn-primary' : 'btn-outline'; ?>"><?php echo esc_html($term->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                        <div class="gallery-filters-per-page flex flex-wrap items-center gap-2 justify-end">
                            <form class="per-page-form" action="<?php echo esc_url($base_url); ?>" method="get">
                                <?php if (!empty($active_filter)) : ?>
                                    <input type="hidden" name="gallery_category" value="<?php echo esc_attr($active_filter); ?>" />
                                <?php endif; ?>
                                <label for="pp-select" class="text-sm text-muted-foreground mr-2">Po stranici:</label>
                                <select id="pp-select" name="pp" class="pp-select" onchange="this.form.submit()">
                                    <?php foreach (array(6,12,24,36,48) as $opt) : ?>
                                        <option value="<?php echo (int)$opt; ?>" <?php selected($per_page, $opt); ?>><?php echo (int)$opt; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
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
                    global $wp_query;
                    $max_pages = isset($wp_query) ? (int) $wp_query->max_num_pages : 0;
                    $add_args = array();
                    if (!empty($active_filter)) { $add_args['gallery_category'] = $active_filter; }
                    if (!empty($per_page)) { $add_args['pp'] = $per_page; }
                    if ($max_pages > 1) {
                        the_posts_pagination(array(
                            'mid_size'  => 1,
                            'prev_text' => __('Prethodna', 'lunart'),
                            'next_text' => __('Sledeća', 'lunart'),
                            'add_args'  => $add_args,
                        ));
                    } else {
                        $page1_url = get_pagenum_link(1);
                        if (!empty($add_args)) { $page1_url = add_query_arg($add_args, $page1_url); }
                        echo '<a class="page-numbers current" href="' . esc_url($page1_url) . '">1</a>';
                    }
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
