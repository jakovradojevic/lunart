<?php
/**
 * The template for displaying all single posts
 *
 * Ensures single blog posts do not fall back to the homepage layout.
 */

get_header(); ?>

<main id="primary" class="site-main main-content">
    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">','</h1>'); ?>
                    <div class="entry-meta">
                        <span class="posted-on"><?php echo esc_html( get_the_date() ); ?></span>
                        <?php $cats = get_the_category_list(', ');
                        if ($cats) { echo ' • <span class="cat-links">' . wp_kses_post($cats) . '</span>'; }
                        ?>
                    </div>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <?php the_tags('<div class="tags-list">', ' ', '</div>'); ?>
                </footer>
            </article>

            <nav class="post-navigation">
                <div class="nav-links">
                    <div class="nav-previous"><?php previous_post_link('%link', '&larr; %title'); ?></div>
                    <div class="nav-next"><?php next_post_link('%link', '%title &rarr;'); ?></div>
                </div>
            </nav>

            <?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>

        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer();
