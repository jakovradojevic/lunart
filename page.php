<?php
/**
 * The template for displaying all pages
 *
 * This template ensures regular pages (e.g., O nama, Kontakt) render their own content
 * and do not fall back to the homepage layout from index.php.
 */

get_header(); ?>

<main id="primary" class="site-main main-content">
    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">','</h1>'); ?>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer();
