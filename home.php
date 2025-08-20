<?php
/**
 * The home template file (Posts index)
 *
 * Displays the blog posts assigned via Settings > Reading (page_for_posts),
 * ensuring it does not use the homepage layout from index.php.
 */

get_header(); ?>

<main id="primary" class="site-main main-content">
    <div class="container">
        <header class="page-header">
            <?php
            $blog_page_id = (int) get_option('page_for_posts');
            if ($blog_page_id) {
                echo '<h1 class="page-title">' . esc_html(get_the_title($blog_page_id)) . '</h1>';
            } else {
                echo '<h1 class="page-title">' . esc_html__('Blog', 'lunart') . '</h1>';
            }
            ?>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="posts-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-excerpt'); ?>>
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="entry-meta">
                        <span class="posted-on"><?php echo esc_html( get_the_date() ); ?></span>
                    </div>
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
            </div>

            <nav class="pagination">
                <?php the_posts_pagination(); ?>
            </nav>
        <?php else : ?>
            <p><?php esc_html_e('Trenutno nema blog postova.', 'lunart'); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer();
