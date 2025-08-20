<?php
/**
 * Template for the Front Page
 *
 * Displays the content of the page set as the Front Page in Settings > Reading.
 * This makes the entire homepage editable via the page editor (Gutenberg/Classic).
 *
 * @package Lunart
 */

get_header(); ?>

<div class="container front-page-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</div>

<?php get_footer();
